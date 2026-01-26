@extends('layouts.funnel')
@section('title', 'Thank You')

@section('content')
<div style="max-width:900px;margin:0 auto;padding:28px 18px;">
  <div style="background:#fff;border:1px solid rgba(0,0,0,.08);border-radius:18px;padding:18px;">
    <h1 style="margin:0;">{{ $data['title'] ?: 'Thank you!' }}</h1>
    <p style="color:#64748b;margin-top:10px;line-height:1.6;">{{ $data['body'] ?: 'We received your request.' }}</p>

    <div style="margin-top:14px;">
      <a href="{{ url('/dashboard') }}" style="text-decoration:none;color:#2563eb;">Go to Dashboard</a>
    </div>

    @if(!empty($data['tag']))
      <div style="margin-top:12px;color:#94a3b8;font-size:12px;">Tag: {{ $data['tag'] }}</div>
    @endif
  </div>
</div>
@endsection
