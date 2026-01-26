@extends('layouts.funnel')

@section('title', 'Dashboard')

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
    .page{max-width:1100px;margin:0 auto;padding:28px 18px;}
    .header{display:flex;justify-content:space-between;align-items:flex-end;gap:12px;flex-wrap:wrap;margin-bottom:14px;}
    .header h1{margin:0;font-size:24px;letter-spacing:-.02em;}
    .header p{margin:6px 0 0;color:#64748b;font-size:13px;}
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
    .btn-dark{background:#0f172a;color:#fff;border-color:rgba(15,23,42,.25);}
    .grid{display:grid;grid-template-columns:repeat(4, minmax(0,1fr));gap:12px;}
    @media (max-width: 980px){ .grid{grid-template-columns:repeat(2, minmax(0,1fr));} }
    @media (max-width: 520px){ .grid{grid-template-columns:1fr;} }

    .card{
        background:rgba(255,255,255,.92);
        border:1px solid rgba(15,23,42,.08);
        border-radius:18px;
        box-shadow:0 16px 40px rgba(15,23,42,.08);
        overflow:hidden;
    }
    .stat{
        padding:14px;
        background: linear-gradient(180deg, #fff, #f8fafc);
    }
    .label{color:#64748b;font-size:12px;margin:0 0 6px;font-weight:700;text-transform:uppercase;letter-spacing:.04em;}
    .value{font-size:22px;font-weight:900;letter-spacing:-.02em;margin:0;}
    .sub{margin-top:6px;color:#64748b;font-size:13px;}

    .section{margin-top:14px;}
    .section-title{display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;margin:0 0 10px;}
    .section-title h2{margin:0;font-size:16px;}
    .pill{
        display:inline-flex;align-items:center;justify-content:center;
        padding:6px 10px;border-radius:999px;
        font-size:12px;border:1px solid rgba(15,23,42,.12);
        background:rgba(15,23,42,.04);color:#0f172a;
        white-space:nowrap;
    }
    .pill-yes{background:rgba(34,197,94,.10);border-color:rgba(34,197,94,.25);color:#166534;}
    .pill-no{background:rgba(239,68,68,.08);border-color:rgba(239,68,68,.22);color:#991b1b;}
    .two{display:grid;grid-template-columns:1fr 1fr;gap:12px;}
    @media (max-width: 980px){ .two{grid-template-columns:1fr;} }

    table{width:100%;border-collapse:separate;border-spacing:0 10px;}
    thead th{
        text-align:left;font-size:12px;color:#64748b;font-weight:800;
        padding:0 14px 6px;letter-spacing:.02em;text-transform:uppercase;
    }
    tbody tr{
        background:#fff;border:1px solid rgba(15,23,42,.08);
        box-shadow:0 10px 24px rgba(15,23,42,.06);
    }
    tbody td{
        padding:12px 14px;border-top:1px solid rgba(15,23,42,.06);
        border-bottom:1px solid rgba(15,23,42,.06);font-size:14px;
    }
    tbody tr td:first-child{border-left:1px solid rgba(15,23,42,.06);border-top-left-radius:14px;border-bottom-left-radius:14px;}
    tbody tr td:last-child{border-right:1px solid rgba(15,23,42,.06);border-top-right-radius:14px;border-bottom-right-radius:14px;}
    .mono{font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;font-size:13px;color:#334155;}
    .bar{
        height:10px;border-radius:999px;background:rgba(15,23,42,.08);overflow:hidden;
        border:1px solid rgba(15,23,42,.08);
    }
    .bar > div{height:100%;background:linear-gradient(135deg, #2563eb, #22c55e);}
</style>

<div class="page">
    <div class="header">
        <div>
            <h1>Dashboard</h1>
            <p>Quick overview of funnels and leads.</p>
        </div>
        <div style="display:flex;gap:10px;flex-wrap:wrap;">
            <a class="btn" href="{{ url('/admin/funnels') }}">Funnels</a>
            <a class="btn btn-dark" href="{{ url('/admin/submissions') }}">Submissions</a>
        </div>
    </div>

    {{-- Top stats --}}
    <div class="grid">
        <div class="card"><div class="stat">
            <div class="label">Funnels</div>
            <p class="value">{{ $funnelsTotal }}</p>
            <div class="sub">Active: <strong>{{ $funnelsActive }}</strong></div>
        </div></div>

        <div class="card"><div class="stat">
            <div class="label">Submissions (Total)</div>
            <p class="value">{{ $subsTotal }}</p>
            <div class="sub">All time leads</div>
        </div></div>

        <div class="card"><div class="stat">
            <div class="label">Today</div>
            <p class="value">{{ $subsToday }}</p>
            <div class="sub">From midnight</div>
        </div></div>

        <div class="card"><div class="stat">
            <div class="label">This Week</div>
            <p class="value">{{ $subsWeek }}</p>
            <div class="sub">From week start</div>
        </div></div>
    </div>

    <div class="grid section" style="grid-template-columns:repeat(4, minmax(0,1fr));">
        <div class="card"><div class="stat">
            <div class="label">This Month</div>
            <p class="value">{{ $subsMonth }}</p>
            <div class="sub">From month start</div>
        </div></div>

        <div class="card"><div class="stat">
            <div class="label">Yes Answers</div>
            <p class="value">{{ $yesCount }}</p>
            <div class="sub"><span class="pill pill-yes">YES</span></div>
        </div></div>

        <div class="card"><div class="stat">
            <div class="label">No Answers</div>
            <p class="value">{{ $noCount }}</p>
            <div class="sub"><span class="pill pill-no">NO</span></div>
        </div></div>

        @php
            $ynTotal = max(1, ($yesCount + $noCount));
            $yesPct = round(($yesCount / $ynTotal) * 100);
        @endphp
        <div class="card"><div class="stat">
            <div class="label">Yes Rate</div>
            <p class="value">{{ $yesPct }}%</p>
            <div class="sub">
                <div class="bar"><div style="width: {{ $yesPct }}%"></div></div>
            </div>
        </div></div>
    </div>

    {{-- Bottom sections --}}
    <div class="two section">
        <div class="card">
            <div style="padding:14px;border-bottom:1px solid rgba(15,23,42,.08);">
                <div class="section-title">
                    <h2>Top Funnels</h2>
                    <span class="pill">By total submissions</span>
                </div>
            </div>
            <div style="padding:14px;">
                @forelse($topFunnels as $f)
                    <div style="display:flex;justify-content:space-between;align-items:center;gap:10px;padding:10px 0;border-bottom:1px solid rgba(15,23,42,.06);">
                        <div>
                            <div style="font-weight:900;">{{ $f->title }}</div>
                            <div class="mono">/f/{{ $f->slug }}</div>
                        </div>
                        <div style="display:flex;gap:10px;align-items:center;">
                            <span class="pill">{{ $f->submissions_count }} leads</span>
                            <a class="btn" style="padding:8px 10px;" target="_blank" href="{{ route('funnels.landing', $f->slug) }}">Open</a>
                            <a class="btn" style="padding:8px 10px;" href="{{ route('admin.submissions.index', ['funnel_id' => $f->id]) }}">View</a>
                        </div>
                    </div>
                @empty
                    <div style="color:#64748b;">No funnels yet.</div>
                @endforelse
            </div>
        </div>

        <div class="card">
            <div style="padding:14px;border-bottom:1px solid rgba(15,23,42,.08);">
                <div class="section-title">
                    <h2>Recent Submissions</h2>
                    <span class="pill">Latest 10</span>
                </div>
            </div>
            <div style="padding:14px;">
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Funnel</th>
                            <th>Name</th>
                            <th>Answer</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($recent as $s)
                        @php $ans = strtolower((string) $s->question_answer); @endphp
                        <tr>
                            <td class="mono">{{ $s->created_at->format('Y-m-d H:i') }}</td>
                            <td>{{ $s->funnel->title ?? '—' }}</td>
                            <td>{{ $s->name }}</td>
                            <td>
                                @if($ans === 'yes')
                                    <span class="pill pill-yes">Yes</span>
                                @elseif($ans === 'no')
                                    <span class="pill pill-no">No</span>
                                @elseif($ans === '' || $ans === null)
                                    <span class="pill">—</span>
                                @else
                                    <span class="pill">{{ $s->question_answer }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" style="padding:14px;color:#64748b;">No submissions yet.</td></tr>
                    @endforelse
                    </tbody>
                </table>

                <div style="margin-top:12px;">
                    <a class="btn btn-dark" href="{{ route('admin.submissions.index') }}">Open Submissions</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
