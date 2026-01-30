@extends('layouts.funnel')
@section('title', 'Add Question')

@section('content')
<style>
  .page{max-width:900px;margin:0 auto;padding:28px 18px;font-family:ui-sans-serif,system-ui;}
  .card{background:#fff;border:1px solid rgba(0,0,0,.08);border-radius:18px;box-shadow:0 16px 40px rgba(0,0,0,.08);padding:18px}
  .grid{display:grid;grid-template-columns:1fr 1fr;gap:12px}
  @media(max-width:800px){.grid{grid-template-columns:1fr}}
  .label{display:block;font-size:12px;color:#64748b;margin:0 0 6px}
  .input,.select,.textarea{width:85%;padding:12px;border-radius:14px;border:1px solid rgba(0,0,0,.15)}
  .textarea{min-height:110px}
  .btn{display:inline-flex;align-items:center;gap:8px;padding:10px 14px;border-radius:12px;border:1px solid rgba(0,0,0,.12);background:#fff;text-decoration:none;color:#111}
  .btn-primary{background:linear-gradient(135deg,#2563eb,#22c55e);color:#fff;border:none}
  .err{color:#b91c1c;font-size:12px;margin-top:6px}
</style>

<div class="page">
  <h2 style="margin:0 0 10px;">Add Question</h2>

  <div class="card">
    <form method="POST" action="{{ route('admin.funnels.questions.store', $funnel) }}">
      @csrf

      <div class="grid">
        <div>
          <label class="label">Sort Order</label>
          <input class="input" name="sort_order" type="number" min="1" value="{{ old('sort_order', 1) }}">
          @error('sort_order') <div class="err">{{ $message }}</div> @enderror
        </div>

        <div>
          <label class="label">Key (for routing)</label>
          <input class="input" name="key" value="{{ old('key') }}" placeholder="age_range / goal / concern">
          @error('key') <div class="err">{{ $message }}</div> @enderror
        </div>

        <div style="grid-column: span 2;">
          <label class="label">Label (question text)</label>
          <input class="input" name="label" value="{{ old('label') }}" placeholder="What’s your biggest financial concern right now?">
          @error('label') <div class="err">{{ $message }}</div> @enderror
        </div>

        <div style="grid-column: span 2;">
          <label class="label">Help Text (optional)</label>
          <textarea class="textarea" name="help_text">{{ old('help_text') }}</textarea>
          @error('help_text') <div class="err">{{ $message }}</div> @enderror
        </div>

        <div>
          <label class="label">Type</label>
          <select class="select" name="type">
            <option value="radio" {{ old('type')==='radio'?'selected':'' }}>Radio (single)</option>
            <option value="checkbox" {{ old('type')==='checkbox'?'selected':'' }}>Checkbox (multi)</option>
            <option value="dropdown" {{ old('type')==='dropdown'?'selected':'' }}>Dropdown</option>
            <option value="text" {{ old('type')==='text'?'selected':'' }}>Text</option>
          </select>
          @error('type') <div class="err">{{ $message }}</div> @enderror
        </div>

        <div>
          <label class="label">Flags</label>
          <label style="display:flex;gap:10px;align-items:center;margin-top:8px;">
            <input type="checkbox" name="is_required" value="1" checked> Required
          </label>
          <label style="display:flex;gap:10px;align-items:center;margin-top:8px;">
            <input type="checkbox" name="is_active" value="1" checked> Active
          </label>
        </div>
      </div>

      <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:flex-end;margin-top:14px;">
        <a class="btn" href="{{ route('admin.funnels.questions.index', $funnel) }}">Cancel</a>
        <button class="btn btn-primary" type="submit">Save</button>
      </div>
    </form>
  </div>
</div>
@endsection
