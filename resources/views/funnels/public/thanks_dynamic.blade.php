@extends('layouts.funnel')
@section('title', 'Thank You')

@section('content')
<div style="max-width:900px;margin:0 auto;padding:28px 18px;">
  <div style="background:#fff;border:1px solid rgba(0,0,0,.08);border-radius:18px;padding:18px;">
    <h1 style="margin:0;">{{ $data['title'] ?: 'Thank you!' }}</h1>
    {{-- <p style="color:#64748b;margin-top:10px;line-height:1.6;">{{ $data['body'] ?: 'We received your request.' }}</p> --}}

    @if(!empty($data['tag']))
      <div style="margin-top:12px;padding:16px;background:#f8fafc;border-radius:12px;border:1px solid #e2e8f0;">
        @if($data['tag'] === 'IUL_Prospect')
          <p style="color:#1e293b;margin:0;font-weight:500;">You may qualify for a tax-advantaged strategy that offers growth, protection, and flexibility.</p>
        @elseif($data['tag'] === 'Term_Life_Prospect')
          <p style="color:#1e293b;margin:0;font-weight:500;">Protecting your family starts with affordable coverage tailored to your stage of life.</p>
        @elseif($data['tag'] === 'IRA_Rollover_Prospect')
          <p style="color:#1e293b;margin:0;font-weight:500;">Rolling over your retirement assets may reduce fees and improve control.</p>
        @elseif($data['tag'] === 'Annuity_Prospect')
          <p style="color:#1e293b;margin:0;font-weight:500;">Lifetime income options can help create certainty regardless of market conditions.</p>
        @endif
      </div>
    @endif

    <p style="color:#64748b;margin-top:10px;line-height:1.6;">We have received your request and we will get back to you soon.</p>

    @if(!empty($data['tag']))
      <div style="margin-top:12px;color:#94a3b8;font-size:12px;">Tag: {{ $data['tag'] }}</div>
    @endif
  </div>
</div>
@endsection
