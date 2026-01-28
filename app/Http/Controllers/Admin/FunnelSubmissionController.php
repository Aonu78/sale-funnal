<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SubmissionReply;
use App\Models\EmailTemplate;
use App\Models\Funnel;
use App\Models\FunnelSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\StreamedResponse;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class FunnelSubmissionController extends Controller
{
    public function index(Request $request)
    {
        $funnels = Funnel::orderBy('title')->get();

        $q = FunnelSubmission::query()->with('funnel', 'answers.question');

        if ($request->filled('funnel_id')) {
            $q->where('funnel_id', $request->funnel_id);
        }

        if ($request->filled('answer')) {
            $q->where('question_answer', $request->answer);
        }

        if ($request->filled('search')) {
            $s = $request->search;
            $q->where(function($w) use ($s) {
                $w->where('name', 'like', "%{$s}%")
                  ->orWhere('email', 'like', "%{$s}%")
                  ->orWhere('phone', 'like', "%{$s}%");
            });
        }

        if ($request->filled('from')) {
            $q->whereDate('created_at', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $q->whereDate('created_at', '<=', $request->to);
        }

        if ($request->filled('tag')) {
            $q->where('tag', $request->tag);
        }

        $submissions = $q->latest()->paginate(25)->withQueryString();

        return view('admin.submissions.index', compact('submissions','funnels'));
    }

    public function show(FunnelSubmission $submission)
    {
        $submission->load('funnel', 'answers.question');
        return view('admin.submissions.show', compact('submission'));
    }

    public function destroy(FunnelSubmission $submission)
    {
        $submission->delete();
        return redirect()->route('admin.submissions.index')->with('success', 'Submission deleted');
    }

    public function export(Request $request): StreamedResponse
    {
        $q = FunnelSubmission::query()->with('funnel', 'answers.question');

        if ($request->filled('funnel_id')) {
            $q->where('funnel_id', $request->funnel_id);
        }

        if ($request->filled('answer')) {
            $q->where('question_answer', $request->answer);
        }

        if ($request->filled('search')) {
            $s = $request->search;
            $q->where(function($w) use ($s) {
                $w->where('name', 'like', "%{$s}%")
                ->orWhere('email', 'like', "%{$s}%")
                ->orWhere('phone', 'like', "%{$s}%");
            });
        }

        if ($request->filled('from')) {
            $q->whereDate('created_at', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $q->whereDate('created_at', '<=', $request->to);
        }

        if ($request->filled('tag')) {
            $q->where('tag', $request->tag);
        }

        $filename = 'submissions_' . now()->format('Y-m-d_H-i') . '.csv';

        return response()->streamDownload(function () use ($q) {
            $out = fopen('php://output', 'w');

            // Header row
            fputcsv($out, [
                'Date',
                'Funnel',
                'Name',
                'Email',
                'Phone',
                'Answer',
                'IP',
                'Tag',
                'Preferred Call Date From',
                'Preferred Call Date To',
                'Call Availability Description',
                'All Answers',
            ]);

            // Stream rows (avoid memory issues)
            $q->orderByDesc('id')->chunk(500, function ($rows) use ($out) {
                foreach ($rows as $s) {
                    $allAnswers = [];
                    foreach ($s->answers as $index => $answer) {
                        $questionText = $answer->question->question_text ?? 'Unknown Question';
                        $answerValue = '';
                        if ($answer->answer_text) {
                            $answerValue = $answer->answer_text;
                        } elseif ($answer->answer_json) {
                            $answerValue = implode(', ', $answer->answer_json);
                        }
                        $allAnswers[] = "Answer " . ($index + 1) . ": " . $answerValue;
                    }

                    fputcsv($out, [
                        optional($s->created_at)->format('Y-m-d H:i:s'),
                        optional($s->funnel)->title,
                        $s->name,
                        $s->email,
                        $s->phone,
                        $s->question_answer,
                        $s->ip_address,
                        $s->tag,
                        $s->preferred_call_date_from,
                        $s->preferred_call_date_to,
                        $s->call_availability_description,
                        implode("\n", $allAnswers),
                    ]);
                }
            });

            fclose($out);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    public function reply(FunnelSubmission $submission)
    {
        $submission->load('funnel');
        $emailTemplates = EmailTemplate::where('is_active', true)->orderBy('name')->get();
        return view('admin.submissions.reply', compact('submission', 'emailTemplates'));
    }

    public function sendReply(Request $request, FunnelSubmission $submission)
    {
        $data = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Use PHPMailer to send email
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.hostinger.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'support@answerdone.com';
            $mail->Password = 'D_DHSwr#*c8.';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('support@answerdone.com', 'Support');
            $mail->addAddress("syedaoonhussain@gmail.com");

            // Content
            $mail->isHTML(true);
            $mail->Subject = $data['subject'];
            $mail->Body = '<!DOCTYPE html><html><head><meta charset="utf-8"><title>' . $data['subject'] . '</title></head><body><p>' . nl2br(htmlspecialchars($data['message'])) . '</p></body></html>';

            $mail->send();

            // Mark submission as replied
            $submission->update(['replied' => true]);

            \Log::info('Email sent to ' . $submission->email . ' with subject: ' . $data['subject']);

            return redirect()->route('admin.submissions.show', $submission)->with('success', 'Reply sent successfully');
        } catch (Exception $e) {
            \Log::error('Email failed to send: ' . $mail->ErrorInfo);
            return redirect()->route('admin.submissions.show', $submission)->with('error', 'Failed to send reply: ' . $mail->ErrorInfo);
        }
    }

}
