@extends('layouts.funnel')

@section('title', 'Thank You')

@section('content')
<style>
    body{
        background:
            radial-gradient(1000px 320px at 20% 0%, rgba(37,99,235,.16), transparent),
            radial-gradient(900px 280px at 80% 0%, rgba(34,197,94,.12), transparent),
            #f1f5f9;
        font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial, "Noto Sans";
        color:#0f172a;
    }
    .page{max-width:700px;margin:0 auto;padding:28px 18px;}
    .card{
        background:rgba(255,255,255,.94);
        border:1px solid rgba(15,23,42,.08);
        border-radius:20px;
        box-shadow:0 18px 48px rgba(15,23,42,.10);
        overflow:hidden;
        padding:18px;
    }
    h1{margin:0 0 6px;font-size:26px;letter-spacing:-.02em;}
    p{margin:0;color:#475569;line-height:1.6;font-size:14px;}
    .btn{
        display:inline-flex;align-items:center;justify-content:center;
        padding:12px 14px;border-radius:14px;
        border:none;cursor:pointer;
        color:#fff;font-weight:800;
        background: linear-gradient(135deg, #2563eb, #22c55e);
        box-shadow:0 18px 36px rgba(37,99,235,.22);
        text-decoration:none;
        margin-top:14px;
    }
    .btn:hover{transform:translateY(-1px);}
</style>

<div class="page">
    <div class="card">
        <h1>Thank you!</h1>
        <p>We received your request. Our team will contact you soon.</p>
        <a class="btn" href="{{ route('funnels.landing', $funnel->slug) }}">Back to page</a>
    </div>
</div>
@endsection
