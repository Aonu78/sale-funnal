@extends('layouts.funnel')
@section('title', 'Add Routing Rule')

@section('content')
<style>
  .page{max-width:950px;margin:0 auto;padding:28px 18px;font-family:ui-sans-serif,system-ui;}
  .card{background:#fff;border:1px solid rgba(0,0,0,.08);border-radius:18px;box-shadow:0 16px 40px rgba(0,0,0,.08);padding:18px}
  .grid{display:grid;grid-template-columns:1fr 1fr;gap:12px}
  @media(max-width:850px){.grid{grid-template-columns:1fr}}
  .label{display:block;font-size:12px;color:#64748b;margin:0 0 6px}
  .input,.textarea{width:85%;padding:12px;border-radius:14px;border:1px solid rgba(0,0,0,.15)}
  .textarea{min-height:160px;font-family:ui-monospace,Menlo,Consolas,monospace;font-size:12px;color:#0f172a}
  .btn{display:inline-flex;align-items:center;gap:8px;padding:10px 14px;border-radius:12px;border:1px solid rgba(0,0,0,.12);background:#fff;text-decoration:none;color:#111}
  .btn-primary{background:linear-gradient(135deg,#2563eb,#22c55e);color:#fff;border:none}
  .err{color:#b91c1c;font-size:12px;margin-top:6px}
  .hint{color:#64748b;font-size:12px;line-height:1.6;margin-top:8px}
</style>

<div class="page">
  <h2 style="margin:0 0 10px;">Add Routing Rule</h2>

  <div class="card">
    <form method="POST" action="{{ route('admin.funnels.rules.store', $funnel) }}">
      @csrf

      <div class="grid">
        <div>
          <label class="label">Tag</label>
          <input class="input" name="tag" value="{{ old('tag') }}" placeholder="IUL_Prospect">
          @error('tag') <div class="err">{{ $message }}</div> @enderror
        </div>

        <div>
          <label class="label">Priority (higher wins)</label>
          <input class="input" type="number" min="1" name="priority" value="{{ old('priority', 100) }}">
          @error('priority') <div class="err">{{ $message }}</div> @enderror
        </div>

        <div style="grid-column: span 2;">
          <label class="label">Conditions JSON (array)</label>
          <textarea class="textarea" name="conditions_json" placeholder='[{"question_key":"age_range","op":"in","value":["25–35","36–45"]}]'>{{ old('conditions_json') }}</textarea>
          @error('conditions_json') <div class="err">{{ $message }}</div> @enderror

          <div class="hint">
            Supported ops: <strong>equals</strong>, <strong>in</strong>, <strong>contains</strong>, <strong>multi_count_gte</strong><br>
            Example (IUL):<br>
<pre style="margin:8px 0 0;white-space:pre-wrap;">
[
  {"question_key":"age_range","op":"in","value":["25–35","36–45","46–55"]},
  {"question_key":"goal","op":"in","value":["Grow tax-free","Leave a legacy"]}
]
</pre>
          </div>
        </div>

        <div style="grid-column: span 2;">
          <label class="label">Thank-you Title</label>
          <input class="input" name="thankyou_title" value="{{ old('thankyou_title') }}" placeholder="You may qualify for...">
        </div>

        <div style="grid-column: span 2;">
          <label class="label">Thank-you Body</label>
          <textarea class="input" style="min-height:120px;" name="thankyou_body">{{ old('thankyou_body') }}</textarea>
        </div>

        <div style="grid-column: span 2;">
          <label style="display:flex;gap:10px;align-items:center;">
            <input type="checkbox" name="is_active" value="1" checked> Active
          </label>
        </div>
      </div>

      <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:flex-end;margin-top:14px;">
        <a class="btn" href="{{ route('admin.funnels.rules.index', $funnel) }}">Cancel</a>
        <button class="btn btn-primary" type="submit">Save Rule</button>
      </div>
    </form>
  </div>
</div>
@endsection
