@extends('layouts.funnel')

@section('title', 'Submission Details')

@section('content')
<style>
    body{
        background:
            radial-gradient(1000px 300px at 20% 0%, rgba(37,99,235,.16), transparent),
            radial-gradient(900px 260px at 80% 0%, rgba(34,197,94,.12), transparent),
            #f1f5f9;
        font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial, "Noto Sans";
        color:#0f172a;
    }
    .page{max-width:900px;margin:0 auto;padding:28px 18px;}
    .topbar{display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;margin-bottom:14px;}
    .btn{
        display:inline-flex;align-items:center;justify-content:center;
        padding:10px 14px;border-radius:12px;
        border:1px solid rgba(15,23,42,.12);
        background:#fff;color:#0f172a;text-decoration:none;
        box-shadow:0 8px 20px rgba(15,23,42,.06);
        transition:transform .12s ease, box-shadow .12s ease;
        font-size:14px; white-space:nowrap;
    }
    .btn:hover{transform:translateY(-1px);box-shadow:0 14px 30px rgba(15,23,42,.10);}
    .btn-danger{
        border:1px solid rgba(239,68,68,.22);
        background:rgba(239,68,68,.06);
        color:#991b1b;
        cursor:pointer;
        padding:10px 14px;border-radius:12px;
        box-shadow:0 8px 20px rgba(15,23,42,.06);
    }
    .card{
        background:rgba(255,255,255,.92);
        border:1px solid rgba(15,23,42,.08);
        border-radius:18px;
        box-shadow:0 16px 40px rgba(15,23,42,.08);
        overflow:hidden;
    }
    .content{padding:18px;}
    .grid{display:grid;grid-template-columns:1fr 1fr;gap:12px;}
    @media (max-width:800px){ .grid{grid-template-columns:1fr;} }
    .box{
        border:1px solid rgba(15,23,42,.08);
        background:#fff;
        border-radius:16px;
        padding:14px;
        box-shadow:0 10px 24px rgba(15,23,42,.06);
    }
    .label{color:#64748b;font-size:12px;margin-bottom:6px;}
    .value{font-size:14px;}
    .mono{font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;}
</style>

<div class="page">
    <div class="topbar">
        <div>
            <h2 style="margin:0;">Submission Details</h2>
            <div style="color:#64748b;font-size:13px;margin-top:4px;">
                Funnel: <strong>{{ $submission->funnel->title }}</strong>
            </div>
        </div>

        <div style="display:flex;gap:10px;flex-wrap:wrap;">
            <a class="btn" href="{{ route('admin.submissions.index') }}">Back</a>
            <a class="btn" style="background:#10b981;color:#fff;" href="{{ route('admin.submissions.reply', $submission) }}">Reply</a>
            <form method="POST" action="{{ route('admin.submissions.destroy', $submission) }}">
                @csrf
                @method('DELETE')
                <button class="btn-danger" type="submit" onclick="return confirm('Delete this submission?')">
                    Delete
                </button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="content">
            <div class="grid">
                <div class="box">
                    <div class="label">Date</div>
                    <div class="value mono">{{ $submission->created_at->format('Y-m-d H:i:s') }}</div>
                </div>

                <div class="box">
                    <div class="label">Answer</div>
                    <div class="value">{{ $submission->question_answer ?: '—' }}</div>
                </div>

                @if($submission->answers->count() > 0)
                <div class="box" style="grid-column: span 2;">
                    <div class="label">Detailed Answers</div>
                    <div class="value">
                        @foreach($submission->answers as $answer)
                            <div style="margin-bottom: 8px;">
                                <strong>{{ $answer->question->question_text }}</strong><br>
                                @if($answer->answer_text)
                                    {{ $answer->answer_text }}
                                @elseif($answer->answer_json)
                                    {{ implode(', ', $answer->answer_json) }}
                                @else
                                    —
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="box">
                    <div class="label">Name</div>
                    <div class="value">{{ $submission->name }}</div>
                </div>

                <div class="box">
                    <div class="label">Email</div>
                    <div class="value"><a href="mailto:{{ $submission->email }}">{{ $submission->email }}</a></div>
                </div>

                <div class="box">
                    <div class="label">Phone</div>
                    <div class="value mono">{{ $submission->phone }}</div>
                </div>

                <div class="box">
                    <div class="label">IP Address</div>
                    <div class="value mono">{{ $submission->ip_address ?: '—' }}</div>
                </div>

                <div class="box" style="grid-column: span 2;">
                    <div class="label">User Agent</div>
                    <div class="value mono" style="word-break:break-word;">{{ $submission->user_agent ?: '—' }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
