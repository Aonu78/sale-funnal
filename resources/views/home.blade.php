@extends('layouts.funnel')

@section('title', 'Home')

@section('content')
<style>
    .page {
        max-width: 1000px;
        margin: 0 auto;
        padding: 28px 18px;
        font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial, "Noto Sans", "Apple Color Emoji", "Segoe UI Emoji";
        color: #0f172a;
    }

    .topbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        margin-bottom: 18px;
    }

    .brand {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .logo {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        background: linear-gradient(135deg, #2563eb, #22c55e);
        box-shadow: 0 8px 18px rgba(37, 99, 235, .25);
    }

    .title h1 {
        font-size: 20px;
        margin: 0;
        line-height: 1.2;
    }

    .title p {
        margin: 2px 0 0;
        color: #475569;
        font-size: 13px;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 14px;
        border-radius: 12px;
        border: 1px solid rgba(15, 23, 42, .12);
        background: #fff;
        color: #0f172a;
        text-decoration: none;
        font-size: 14px;
        box-shadow: 0 6px 16px rgba(15, 23, 42, .06);
        transition: transform .12s ease, box-shadow .12s ease;
        white-space: nowrap;
    }
    .btn:hover { transform: translateY(-1px); box-shadow: 0 10px 24px rgba(15, 23, 42, .10); }

    .btn-primary {
        background: #0f172a;
        color: #fff;
        border-color: rgba(15, 23, 42, .25);
    }

    .card {
        background: rgba(255,255,255,.92);
        border: 1px solid rgba(15, 23, 42, .08);
        border-radius: 18px;
        box-shadow: 0 16px 40px rgba(15, 23, 42, .08);
        overflow: hidden;
    }

    .hero {
        padding: 18px 18px 0 18px;
    }

    .hero-box {
        border-radius: 16px;
        padding: 18px;
        background: radial-gradient(1200px 200px at 20% 0%, rgba(37,99,235,.25), transparent),
                    radial-gradient(1200px 200px at 80% 0%, rgba(34,197,94,.20), transparent),
                    linear-gradient(180deg, #ffffff, #f8fafc);
        border: 1px solid rgba(15, 23, 42, .08);
    }

    .hero-box h2 {
        margin: 0 0 6px;
        font-size: 22px;
        letter-spacing: -0.02em;
    }

    .hero-box p {
        margin: 0;
        color: #475569;
        font-size: 14px;
        line-height: 1.6;
    }

    .content {
        padding: 18px;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
        margin-top: 14px;
    }

    @media (max-width: 760px) {
        .topbar { flex-direction: column; align-items: flex-start; }
        .grid { grid-template-columns: 1fr; }
        .actions { width: 100%; display:flex; gap:10px; flex-wrap:wrap; }
    }

    .funnel {
        display: block;
        text-decoration: none;
        color: inherit;
        background: #fff;
        border: 1px solid rgba(15, 23, 42, .08);
        border-radius: 16px;
        padding: 14px;
        transition: transform .12s ease, box-shadow .12s ease, border-color .12s ease;
        box-shadow: 0 8px 22px rgba(15, 23, 42, .06);
    }
    .funnel:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 30px rgba(15, 23, 42, .10);
        border-color: rgba(37,99,235,.35);
    }

    .funnel .name {
        font-weight: 700;
        font-size: 15px;
        margin: 0 0 6px;
    }

    .funnel .meta {
        display: flex;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
        color: #64748b;
        font-size: 13px;
    }

    .pill {
        display: inline-flex;
        align-items: center;
        padding: 6px 10px;
        border-radius: 999px;
        background: rgba(37, 99, 235, .08);
        border: 1px solid rgba(37, 99, 235, .15);
        color: #1e40af;
        font-size: 12px;
    }

    .empty {
        margin-top: 14px;
        padding: 14px;
        border-radius: 14px;
        border: 1px dashed rgba(239, 68, 68, .35);
        background: rgba(239, 68, 68, .04);
        color: #b91c1c;
        font-size: 14px;
    }

    .footer {
        margin-top: 16px;
        padding: 14px 18px;
        border-top: 1px solid rgba(15, 23, 42, .08);
        color: #64748b;
        font-size: 13px;
        display: flex;
        justify-content: space-between;
        gap: 10px;
        flex-wrap: wrap;
    }

    body {
        background:
            radial-gradient(1000px 300px at 20% 0%, rgba(37,99,235,.18), transparent),
            radial-gradient(900px 260px at 80% 0%, rgba(34,197,94,.14), transparent),
            #f1f5f9;
    }
</style>

<div class="page">
    <div class="topbar">
        <div class="brand">
            <div class="logo"></div>
            <div class="title">
                <h1>Insurance Funnels</h1>
                <p>Choose a funnel to open the landing page</p>
            </div>
        </div>

        <div class="actions">
            <a class="btn btn-primary" href="{{ url('/admin/funnels') }}">Admin Dashboard</a>
            <a class="btn" href="{{ url('/admin/submissions') }}">View Submissions</a>
        </div>
    </div>

    <div class="card">
        <div class="hero">
            <div class="hero-box">
                <h2>Live funnels</h2>
                <p>Click any funnel card below to open the public landing page. Each funnel is editable from the admin panel.</p>
            </div>
        </div>

        <div class="content">
            @if($funnels->isEmpty())
                <div class="empty">
                    No active funnels found. Create one from <strong>Admin Dashboard</strong> first.
                </div>
            @else
                <div class="grid">
                    @foreach($funnels as $f)
                        <a class="funnel" href="{{ route('funnels.landing', $f->slug) }}">
                            <p class="name">{{ $f->title }}</p>
                            <div class="meta">
                                <span class="pill">Public URL</span>
                                <span>/f/{{ $f->slug }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="footer">
            <span>Tip: Keep slugs short (example: <strong>car-insurance</strong>)</span>
            <span>{{ now()->format('Y-m-d H:i') }}</span>
        </div>
    </div>
</div>
@endsection
