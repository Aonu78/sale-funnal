@extends('layouts.funnel')

@section('title', 'Show Templates')

@section('content')
<style>
    :root{
        --bg:#f1f5f9;
        --text:#0f172a;
        --muted:#64748b;
        --card: rgba(255,255,255,.86);
        --stroke: rgba(15,23,42,.10);
        --shadow: 0 18px 55px rgba(15,23,42,.10);
        --shadow2: 0 10px 24px rgba(15,23,42,.08);
        --radius: 18px;
    }

    body{
        background:
            radial-gradient(1100px 360px at 18% 0%, rgba(37,99,235,.16), transparent 60%),
            radial-gradient(1000px 340px at 82% 0%, rgba(34,197,94,.12), transparent 60%),
            var(--bg);
        font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial, "Noto Sans";
        color: var(--text);
    }

    .wrap{
        max-width: 1080px;
        margin: 0 auto;
        padding: 28px 16px 60px;
    }

    .header{
        display:flex;
        align-items:flex-end;
        justify-content:space-between;
        gap: 14px;
        flex-wrap: wrap;
        margin-bottom: 16px;
    }

    .header h1{
        margin: 0;
        font-size: 24px;
        letter-spacing: -.02em;
        font-weight: 900;
        line-height: 1.1;
    }
    .header p{
        margin: 6px 0 0;
        color: var(--muted);
        font-size: 13px;
        line-height: 1.5;
        max-width: 80ch;
    }

    .btn{
        display:inline-flex;
        align-items:center;
        justify-content:center;
        gap: 10px;
        padding: 10px 14px;
        border-radius: 14px;
        border: 1px solid rgba(255,255,255,.35);
        background: rgba(255,255,255,.55);
        color: var(--text);
        text-decoration:none;
        box-shadow: var(--shadow2);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        transition: transform .12s ease, box-shadow .12s ease, background .12s ease;
        font-weight: 800;
        font-size: 14px;
        white-space: nowrap;
    }
    .btn:hover{
        transform: translateY(-1px);
        box-shadow: 0 16px 40px rgba(15,23,42,.12);
        background: rgba(255,255,255,.72);
    }
    .btn-primary{
        color:#fff;
        border:none;
        background: linear-gradient(135deg, #2563eb, #22c55e);
        box-shadow: 0 18px 44px rgba(37,99,235,.22);
    }
    .btn-primary:hover{ box-shadow: 0 22px 52px rgba(37,99,235,.28); }
    .btn-dark{
        background: rgba(15,23,42,.92);
        color:#fff;
        border: 1px solid rgba(15,23,42,.25);
        box-shadow: 0 18px 44px rgba(15,23,42,.18);
    }
    .btn-dark:hover{ background: rgba(15,23,42,1); }

    .card{
        background: var(--card);
        border: 1px solid var(--stroke);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        overflow: hidden;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    .card-head{
        padding: 16px 18px;
        border-bottom: 1px solid rgba(15,23,42,.08);
        background: rgba(248,250,252,.50);
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap: 12px;
        flex-wrap: wrap;
    }

    .kicker{
        display:inline-flex;
        align-items:center;
        gap: 8px;
        font-size: 12px;
        font-weight: 900;
        letter-spacing: .08em;
        text-transform: uppercase;
        color: rgba(100,116,139,.95);
    }
    .dot{
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: rgba(99,102,241,.35);
        box-shadow: 0 0 0 6px rgba(99,102,241,.10);
    }

    .badge{
        display:inline-flex;
        align-items:center;
        gap: 8px;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 900;
        border: 1px solid rgba(15,23,42,.08);
        background: rgba(255,255,255,.55);
        white-space: nowrap;
    }
    .badge .pip{ width: 8px; height: 8px; border-radius: 999px; }
    .badge-active{
        color:#166534;
        border-color: rgba(22,101,52,.18);
        background: rgba(34,197,94,.12);
    }
    .badge-active .pip{ background:#22c55e; }
    .badge-inactive{
        color:#991b1b;
        border-color: rgba(153,27,27,.18);
        background: rgba(239,68,68,.12);
    }
    .badge-inactive .pip{ background:#ef4444; }

    .card-body{ padding: 18px; }

    .two{
        display:grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
        align-items: start;
    }
    @media (max-width: 900px){
        .two{ grid-template-columns: 1fr; }
    }

    .panel{
        border: 1px solid rgba(15,23,42,.08);
        border-radius: 18px;
        background: rgba(255,255,255,.55);
        box-shadow: 0 10px 24px rgba(15,23,42,.06);
        overflow: hidden;
    }
    .panel h3{
        margin: 0;
        padding: 14px 16px;
        font-size: 13px;
        font-weight: 900;
        letter-spacing: .08em;
        text-transform: uppercase;
        color: rgba(100,116,139,.95);
        border-bottom: 1px solid rgba(15,23,42,.08);
        background: rgba(248,250,252,.55);
    }
    .panel .inner{ padding: 14px 16px; }

    dl{ margin: 0; }
    .dl{
        display:grid;
        grid-template-columns: 160px 1fr;
        gap: 10px 14px;
        align-items: start;
    }
    @media (max-width: 520px){
        .dl{ grid-template-columns: 1fr; }
    }
    dt{
        font-size: 12px;
        font-weight: 900;
        letter-spacing: .06em;
        text-transform: uppercase;
        color: rgba(100,116,139,.95);
    }
    dd{
        margin: 0;
        font-size: 14px;
        color: rgba(15,23,42,.92);
        font-weight: 700;
        word-break: break-word;
    }
    .muted{ color: rgba(100,116,139,.95); font-weight: 700; }

    .chips{
        display:flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 10px;
    }
    .chip{
        display:inline-flex;
        align-items:center;
        gap: 8px;
        padding: 7px 10px;
        border-radius: 999px;
        border: 1px solid rgba(37,99,235,.18);
        background: rgba(37,99,235,.10);
        color: rgba(30,64,175,.95);
        font-size: 12px;
        font-weight: 900;
    }

    .email{
        border: 1px solid rgba(15,23,42,.08);
        border-radius: 18px;
        background: rgba(255,255,255,.55);
        box-shadow: 0 10px 24px rgba(15,23,42,.06);
        overflow:hidden;
        margin-top: 14px;
    }
    .email-head{
        padding: 14px 16px;
        border-bottom: 1px solid rgba(15,23,42,.08);
        background: rgba(248,250,252,.55);
    }
    .email-head .subject{
        font-size: 14px;
        font-weight: 950;
        color: rgba(15,23,42,.95);
        margin: 0;
    }
    .email-head .meta{
        margin-top: 6px;
        font-size: 12px;
        color: rgba(100,116,139,.95);
        display:flex;
        flex-wrap: wrap;
        gap: 8px 12px;
        font-weight: 700;
    }
    .email-body{
        padding: 14px 16px;
        font-size: 14px;
        color: rgba(15,23,42,.92);
        line-height: 1.6;
        white-space: pre-wrap;
    }

    .note{
        color: rgba(100,116,139,.95);
        font-size: 13px;
        line-height: 1.5;
    }
</style>

<div class="wrap">
    <div class="header">
        <div>
            <h1>Email Template: {{ $emailTemplate->name }}</h1>
            <p>Review details, variables, and the full email preview before using it in a flow.</p>
        </div>

        <div style="display:flex; gap:10px; flex-wrap:wrap;">
            <a href="{{ route('admin.email-templates.index') }}" class="btn btn-dark">← Back</a>
            <a href="{{ route('admin.email-templates.edit', $emailTemplate) }}" class="btn btn-primary">Edit Template</a>
        </div>
    </div>

    <div class="card">
        <div class="card-head">
            <span class="kicker"><span class="dot"></span> Template Overview</span>

            @if($emailTemplate->is_active)
                <span class="badge badge-active"><span class="pip"></span> Active</span>
            @else
                <span class="badge badge-inactive"><span class="pip"></span> Inactive</span>
            @endif
        </div>

        <div class="card-body">
            <div class="two">
                <div class="panel">
                    <h3>Details</h3>
                    <div class="inner">
                        <dl class="dl">
                            <dt>Name</dt>
                            <dd>{{ $emailTemplate->name }}</dd>

                            <dt>Category</dt>
                            <dd class="muted">{{ $emailTemplate->category ?: '—' }}</dd>

                            <dt>Subject</dt>
                            <dd class="muted">{{ $emailTemplate->subject }}</dd>

                            <dt>Created</dt>
                            <dd class="muted">{{ $emailTemplate->created_at->format('M d, Y H:i') }}</dd>

                            <dt>Updated</dt>
                            <dd class="muted">{{ $emailTemplate->updated_at->format('M d, Y H:i') }}</dd>
                        </dl>
                    </div>
                </div>

                <div class="panel">
                    <h3>Description & Variables</h3>
                    <div class="inner">
                        <div class="note">
                            {{ $emailTemplate->description ?: 'No description provided.' }}
                        </div>

                        @if($emailTemplate->variables)
                            <div style="margin-top:14px;">
                                <div style="font-size:12px; font-weight:900; letter-spacing:.06em; text-transform:uppercase; color: rgba(100,116,139,.95);">
                                    Variables
                                </div>

                                <div class="chips">
                                    @foreach($emailTemplate->variables as $variable)
                                        <span class="chip">{{ $variable }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="email">
                <div class="email-head">
                    <p class="subject">{{ $emailTemplate->subject }}</p>
                    <div class="meta">
                        <span><strong>Template:</strong> {{ $emailTemplate->name }}</span>
                        <span><strong>Category:</strong> {{ $emailTemplate->category ?: '—' }}</span>
                        <span><strong>Status:</strong> {{ $emailTemplate->is_active ? 'Active' : 'Inactive' }}</span>
                    </div>
                </div>

                <div class="email-body">{{ $emailTemplate->body }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
