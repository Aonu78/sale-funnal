@extends('layouts.funnel')
@section('title', $funnel->seo_title ?: $funnel->title)
@section('meta_description', $funnel->seo_description ?: '')

@section('content')
<div style="max-width:900px;margin:0 auto;padding:28px 18px;">
    <div style="background:#fff;border:1px solid rgba(0,0,0,.08);border-radius:18px;padding:18px;">
        @if(!empty($funnel->hero_image_path))
    <img
        src="{{ asset($funnel->hero_image_path) }}"
        alt="Hero"
        style="width:100%;max-height:320px;object-fit:cover;border-radius:16px;margin-bottom:14px;"
    >
    @endif

    <h1 style="margin:0;">{{ $funnel->title }}</h1>
    <p style="color:#64748b;margin-top:10px;">{{ $funnel->seo_description }}</p>

    <form method="POST" action="{{ route('funnels.start', $funnel->slug) }}">
      @csrf
      <button style="margin-top:14px;padding:12px 14px;border-radius:14px;border:none;color:#fff;background:#0f172a;cursor:pointer;">
        👉 Get Started (30 seconds)
      </button>
    </form>

    @if($funnel->footer_text)
      <p style="margin-top:14px;color:#94a3b8;font-size:12px;">{{ $funnel->footer_text }}</p>
    @endif
  </div>
</div>
@endsection
