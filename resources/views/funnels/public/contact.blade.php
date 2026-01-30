@extends('layouts.funnel')
@section('title', $funnel->title)

@section('content')
<div style="max-width:900px;margin:0 auto;padding:28px 18px;">
  <div style="background:#fff;border:1px solid rgba(0,0,0,.08);border-radius:18px;padding:18px;">
    @if(!empty($funnel->hero_image_path))
  <img
    src="{{ asset($funnel->hero_image_path) }}"
    alt="Hero"
    style="width:100%;max-height:160px;object-fit:cover;border-radius:16px;margin-bottom:12px;"
  >
@endif

    <div style="color:#64748b;font-size:13px;">Step {{ $step }} of {{ $maxStep }}</div>
    <h2 style="margin:12px 0 0;">See Your Personalized Options</h2>
    <p style="color:#64748b;margin-top:6px;">Based on your answers, we found strategies that may fit your situation.</p>

    <form method="POST" action="{{ route('funnels.step.save', [$funnel->slug, $step]) }}" style="margin-top:12px;">
      @csrf

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
        <div>
          <label style="font-size:12px;color:#64748b;">First Name</label>
          <input name="first_name" value="{{ old('first_name') }}"
                 style="width:90%;padding:12px;border-radius:14px;border:1px solid rgba(0,0,0,.15);">
          @error('first_name') <div style="color:#b91c1c;font-size:12px;margin-top:6px;">{{ $message }}</div> @enderror
        </div>
        <div>
          <label style="font-size:12px;color:#64748b;">Phone</label>
          <input name="phone" value="{{ old('phone') }}"
                 style="width:90%;padding:12px;border-radius:14px;border:1px solid rgba(0,0,0,.15);">
          @error('phone') <div style="color:#b91c1c;font-size:12px;margin-top:6px;">{{ $message }}</div> @enderror
        </div>
      </div>

      <div style="margin-top:12px;">
        <label style="font-size:12px;color:#64748b;">Email</label>
        <input name="email" type="email" value="{{ old('email') }}"
               style="width:95%;padding:12px;border-radius:14px;border:1px solid rgba(0,0,0,.15);">
        @error('email') <div style="color:#b91c1c;font-size:12px;margin-top:6px;">{{ $message }}</div> @enderror
      </div>
      <div style="margin-top:12px;">
        <label style="font-size:14px;color:#0f172a;font-weight:500;">Your Availability For 15-30 Minutes Slot</label>
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
        <div style="margin-top:8px;">
          <label style="font-size:12px;color:#64748b;">Select the date</label>
          <input name="preferred_call_date_from" type="date" value="{{ old('preferred_call_date_from') }}"
                 style="width:90%;padding:12px;border-radius:14px;border:1px solid rgba(0,0,0,.15);margin-top:4px;">
          @error('preferred_call_date_from') <div style="color:#b91c1c;font-size:12px;margin-top:6px;">{{ $message }}</div> @enderror
        </div>

        <div style="margin-top:8px;">
          <label style="font-size:12px;color:#64748b;">Select time</label>
          <input name="preferred_call_date_to" type="time" value="{{ old('preferred_call_date_to') }}"
                 style="width:90%;padding:12px;border-radius:14px;border:1px solid rgba(0,0,0,.15);margin-top:4px;">
          @error('preferred_call_date_to') <div style="color:#b91c1c;font-size:12px;margin-top:6px;">{{ $message }}</div> @enderror
        </div>
      </div>

      <div style="margin-top:12px;">
        <label style="font-size:12px;color:#64748b;">Description (Optional)</label>
        <textarea name="call_availability_description" rows="3" placeholder="Please describe your availability..."
                  style="width:95%;padding:12px;border-radius:14px;border:1px solid rgba(0,0,0,.15);resize:vertical;">{{ old('call_availability_description') }}</textarea>
        @error('call_availability_description') <div style="color:#b91c1c;font-size:12px;margin-top:6px;">{{ $message }}</div> @enderror
      </div>

      <button style="margin-top:14px;padding:12px 14px;border-radius:14px;border:none;color:#fff;background:#0f172a;cursor:pointer;width:100%;">
        Submit
      </button>
    </form>
  </div>
</div>
@endsection
