<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Funnel;
use App\Models\FunnelSubmission;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FunnelSubmissionController extends Controller
{
    public function index(Request $request)
    {
        $funnels = Funnel::orderBy('title')->get();

        $q = FunnelSubmission::query()->with('funnel');

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

        $submissions = $q->latest()->paginate(25)->withQueryString();

        return view('admin.submissions.index', compact('submissions','funnels'));
    }

    public function show(FunnelSubmission $submission)
    {
        $submission->load('funnel');
        return view('admin.submissions.show', compact('submission'));
    }

    public function destroy(FunnelSubmission $submission)
    {
        $submission->delete();
        return redirect()->route('admin.submissions.index')->with('success', 'Submission deleted');
    }

    public function export(Request $request): StreamedResponse
    {
        $q = FunnelSubmission::query()->with('funnel');

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
            ]);

            // Stream rows (avoid memory issues)
            $q->orderByDesc('id')->chunk(500, function ($rows) use ($out) {
                foreach ($rows as $s) {
                    fputcsv($out, [
                        optional($s->created_at)->format('Y-m-d H:i:s'),
                        optional($s->funnel)->title,
                        $s->name,
                        $s->email,
                        $s->phone,
                        $s->question_answer,
                        $s->ip_address,
                    ]);
                }
            });

            fclose($out);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

}
