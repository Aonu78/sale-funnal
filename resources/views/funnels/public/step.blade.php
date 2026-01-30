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
    <div style="display:flex;justify-content:space-between;gap:10px;flex-wrap:wrap;">
      <div style="color:#64748b;font-size:13px;">Step {{ $step }} of {{ $maxStep }}</div>
      <div style="color:#64748b;font-size:13px;">{{ $funnel->title }}</div>
    </div>
    <h2 style="margin:12px 0 0;">{{ $question->label }}</h2>
    @if($question->help_text)
      <p style="color:#64748b;margin-top:6px;">{{ $question->help_text }}</p>
    @endif

    <form method="POST" action="{{ route('funnels.step.save', [$funnel->slug, $step]) }}" style="margin-top:12px;">
      @csrf

      @if($question->type === 'text')
        <input name="answer" value="{{ old('answer', $value) }}" placeholder="Type here..."
              _toggle=""
               style="width:100%;padding:12px;border-radius:14px;border:1px solid rgba(0,0,0,.15);">
      @elseif($question->type === 'checkbox')
        <div style="display:grid;gap:10px;margin-top:10px;">
          @foreach($question->options->where('is_active', true) as $opt)
            @php
              $old = old('answer', is_array($value) ? $value : []);
            @endphp
            <label style="display:flex;gap:10px;align-items:center;padding:10px;border:1px solid rgba(0,0,0,.12);border-radius:14px;">
              <input type="checkbox" name="answer[]" value="{{ $opt->label }}" {{ in_array($opt->label, $old ?? [], true) ? 'checked' : '' }}>
              <span>{{ $opt->label }}</span>
            </label>
          @endforeach
        </div>
      @elseif($question->type === 'dropdown')
        <select name="answer" style="width:100%;padding:12px;border-radius:14px;border:1px solid rgba(0,0,0,.15);">
          <option value="">Select an option...</option>
          @foreach($question->options->where('is_active', true) as $opt)
            <option value="{{ $opt->label }}" {{ old('answer', $value)===$opt->label ? 'selected' : '' }}>{{ $opt->label }}</option>
          @endforeach
        </select>
      @else
        <div style="display:grid;gap:10px;margin-top:10px;">
          @foreach($question->options->where('is_active', true) as $opt)
            <label style="display:flex;gap:10px;align-items:center;padding:10px;border:1px solid rgba(0,0,0,.12);border-radius:14px;">
              <input type="radio" name="answer" value="{{ $opt->label }}" {{ old('answer', $value)===$opt->label ? 'checked' : '' }}>
              <span>{{ $opt->label }}</span>
            </label>
          @endforeach
        </div>
      @endif

      @error('answer')
        <div style="color:#b91c1c;font-size:12px;margin-top:8px;">{{ $message }}</div>
      @enderror

      <button style="margin-top:14px;padding:12px 14px;border-radius:14px;border:none;color:#fff;background:#0f172a;cursor:pointer;">
        Next →
      </button>
    </form>
  </div>
</div>
@endsection
