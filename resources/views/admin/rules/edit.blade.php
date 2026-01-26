@extends('layouts.funnel')

@section('title', 'Edit Routing Rule')

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
  .page{max-width:950px;margin:0 auto;padding:28px 18px;}
  .card{
      background:rgba(255,255,255,.94);
      border:1px solid rgba(15,23,42,.08);
      border-radius:18px;
      box-shadow:0 16px 40px rgba(15,23,42,.08);
      padding:18px;
  }
  .grid{display:grid;grid-template-columns:1fr 1fr;gap:12px;}
  @media (max-width:850px){ .grid{grid-template-columns:1fr;} }

  .label{display:block;font-size:12px;color:#64748b;margin:0 0 6px;}
  .input,.textarea{
      width:85%;
      padding:12px;
      border-radius:14px;
      border:1px solid rgba(15,23,42,.15);
      background:#fff;
      outline:none;
      transition:border-color .12s ease, box-shadow .12s ease;
      font-size:14px;
  }
  .input:focus,.textarea:focus{
      border-color: rgba(37,99,235,.55);
      box-shadow: 0 0 0 4px rgba(37,99,235,.12);
  }

  .textarea{
      min-height:170px;
      font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
      font-size:12px;
      color:#0f172a;
  }

  .btn{
      display:inline-flex;
      align-items:center;
      justify-content:center;
      gap:8px;
      padding:10px 14px;
      border-radius:12px;
      border:1px solid rgba(15,23,42,.12);
      background:#fff;
      text-decoration:none;
      color:#0f172a;
      box-shadow:0 8px 20px rgba(15,23,42,.06);
      transition:transform .12s ease, box-shadow .12s ease;
      font-size:14px;
      white-space:nowrap;
  }
  .btn:hover{
      transform:translateY(-1px);
      box-shadow:0 14px 30px rgba(15,23,42,.10);
  }
  .btn-primary{
      background: linear-gradient(135deg, #2563eb, #22c55e);
      color:#fff;
      border:none;
      box-shadow:0 16px 36px rgba(37,99,235,.22);
  }
  .err{color:#b91c1c;font-size:12px;margin-top:6px;}
  .hint{
      color:#64748b;
      font-size:12px;
      line-height:1.6;
      margin-top:8px;
  }
  .topbar{
      display:flex;
      justify-content:space-between;
      align-items:flex-end;
      flex-wrap:wrap;
      gap:12px;
      margin-bottom:14px;
  }
  .title h2{margin:0;font-size:20px;}
  .title p{margin:6px 0 0;color:#64748b;font-size:13px;}
</style>

<div class="page">

  <div class="topbar">
      <div class="title">
          <h2>Edit Routing Rule</h2>
          <p>
              Funnel: <strong>{{ $funnel->title }}</strong>
              <span style="color:#94a3b8;font-size:12px;">(Tag Logic + Thank-you Copy)</span>
          </p>
      </div>

      <div style="display:flex;gap:10px;flex-wrap:wrap;">
          <a class="btn" href="{{ route('admin.funnels.rules.index', $funnel) }}">Back</a>
          <a class="btn" href="{{ route('admin.funnels.questions.index', $funnel) }}">Questions</a>
      </div>
  </div>

  <div class="card">
      <form method="POST" action="{{ route('admin.funnels.rules.update', [$funnel, $rule]) }}">
          @csrf
          @method('PUT')

          <div class="grid">
              <div>
                  <label class="label">Tag</label>
                  <input class="input" name="tag"
                         value="{{ old('tag', $rule->tag) }}"
                         placeholder="IUL_Prospect">
                  @error('tag') <div class="err">{{ $message }}</div> @enderror
              </div>

              <div>
                  <label class="label">Priority (higher wins)</label>
                  <input class="input" type="number" min="1" max="9999" name="priority"
                         value="{{ old('priority', $rule->priority) }}">
                  @error('priority') <div class="err">{{ $message }}</div> @enderror
              </div>

              <div style="grid-column: span 2;">
                  <label class="label">Conditions JSON (array)</label>

                  @php
                      $json = json_encode($rule->conditions, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                  @endphp

                  <textarea class="textarea" name="conditions_json"
                            placeholder='[{"question_key":"age_range","op":"in","value":["25–35"]}]'>{{ old('conditions_json', $json) }}</textarea>

                  @error('conditions_json') <div class="err">{{ $message }}</div> @enderror

                  <div class="hint">
                      ✅ Supported ops:
                      <strong>equals</strong>,
                      <strong>in</strong>,
                      <strong>contains</strong>,
                      <strong>multi_count_gte</strong>
                      <br><br>

                      Example (IUL):
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
                  <input class="input" name="thankyou_title"
                         value="{{ old('thankyou_title', $rule->thankyou_title) }}"
                         placeholder="You may qualify for a tax-advantaged strategy...">
                  @error('thankyou_title') <div class="err">{{ $message }}</div> @enderror
              </div>

              <div style="grid-column: span 2;">
                  <label class="label">Thank-you Body</label>
                  <textarea class="input" style="min-height:120px;" name="thankyou_body"
                            placeholder="Write a short thank you message shown to the user...">{{ old('thankyou_body', $rule->thankyou_body) }}</textarea>
                  @error('thankyou_body') <div class="err">{{ $message }}</div> @enderror
              </div>

              <div style="grid-column: span 2;">
                  <label style="display:flex;gap:10px;align-items:center;">
                      <input type="checkbox" name="is_active" value="1"
                             {{ old('is_active', $rule->is_active) ? 'checked' : '' }}>
                      Active
                  </label>
              </div>
          </div>

          <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:flex-end;margin-top:14px;">
              <a class="btn" href="{{ route('admin.funnels.rules.index', $funnel) }}">Cancel</a>
              <button class="btn btn-primary" type="submit">Update Rule</button>
          </div>

      </form>
  </div>
</div>
@endsection
