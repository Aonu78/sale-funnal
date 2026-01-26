@extends('layouts.funnel')
@section('title', 'Questions')

@section('content')
<style>
  .page{max-width:1100px;margin:0 auto;padding:28px 18px;font-family:ui-sans-serif,system-ui;}
  .card{background:#fff;border:1px solid rgba(0,0,0,.08);border-radius:18px;box-shadow:0 16px 40px rgba(0,0,0,.08);overflow:hidden}
  .top{display:flex;justify-content:space-between;gap:10px;flex-wrap:wrap;align-items:center;margin-bottom:14px}
  .btn{display:inline-flex;align-items:center;gap:8px;padding:10px 14px;border-radius:12px;border:1px solid rgba(0,0,0,.12);background:#fff;text-decoration:none;color:#111;box-shadow:0 8px 20px rgba(0,0,0,.06)}
  .btn-dark{background:#0f172a;color:#fff;border-color:rgba(15,23,42,.25)}
  .btn-primary{background:linear-gradient(135deg,#2563eb,#22c55e);color:#fff;border:none}
  .notice{padding:12px 16px;border-bottom:1px solid rgba(0,0,0,.08);font-size:13px;background:rgba(34,197,94,.08);color:#166534}
  table{width:100%;border-collapse:separate;border-spacing:0 10px;padding:14px 16px}
  thead th{font-size:12px;color:#64748b;text-transform:uppercase;letter-spacing:.03em;text-align:left;padding:0 10px 6px}
  tbody tr{background:#fff;border:1px solid rgba(0,0,0,.08);box-shadow:0 10px 24px rgba(0,0,0,.06)}
  tbody td{padding:12px 10px;border-top:1px solid rgba(0,0,0,.06);border-bottom:1px solid rgba(0,0,0,.06);font-size:14px}
  tbody tr td:first-child{border-left:1px solid rgba(0,0,0,.06);border-top-left-radius:14px;border-bottom-left-radius:14px}
  tbody tr td:last-child{border-right:1px solid rgba(0,0,0,.06);border-top-right-radius:14px;border-bottom-right-radius:14px}
  .pill{display:inline-flex;padding:6px 10px;border-radius:999px;font-size:12px;border:1px solid rgba(0,0,0,.12);background:rgba(0,0,0,.04)}
  .mono{font-family:ui-monospace,Menlo,Consolas,monospace;font-size:12px;color:#334155}
  .row-actions{display:flex;gap:10px;flex-wrap:wrap}
  .danger{border:1px solid rgba(239,68,68,.22);background:rgba(239,68,68,.06);color:#991b1b;cursor:pointer;padding:9px 12px;border-radius:12px}
</style>

<div class="page">
  <div class="top">
    <div>
      <h2 style="margin:0;">Questions Builder</h2>
      <div style="color:#64748b;font-size:13px;margin-top:4px;">
        Funnel: <strong>{{ $funnel->title }}</strong> <span class="mono">/f/{{ $funnel->slug }}</span>
      </div>
    </div>
    <div style="display:flex;gap:10px;flex-wrap:wrap;">
      <a class="btn" href="{{ route('admin.funnels.index') }}">Back</a>
      <a class="btn btn-dark" href="{{ route('admin.funnels.rules.index', $funnel) }}">Routing Rules</a>
      <a class="btn btn-primary" href="{{ route('admin.funnels.questions.create', $funnel) }}">+ Add Question</a>
    </div>
  </div>

  <div class="card">
    @if(session('success'))
      <div class="notice">{{ session('success') }}</div>
    @endif

    <table>
      <thead>
        <tr>
          <th>Order</th>
          <th>Key</th>
          <th>Label</th>
          <th>Type</th>
          <th>Required</th>
          <th>Active</th>
          <th>Options</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
      @forelse($questions as $q)
        <tr>
          <td class="mono">{{ $q->sort_order }}</td>
          <td class="mono">{{ $q->key ?: '—' }}</td>
          <td><strong>{{ $q->label }}</strong></td>
          <td><span class="pill">{{ $q->type }}</span></td>
          <td>{{ $q->is_required ? 'Yes' : 'No' }}</td>
          <td>{{ $q->is_active ? 'Yes' : 'No' }}</td>
          <td>
            @if(in_array($q->type, ['radio','checkbox']))
              <a class="btn" style="padding:8px 10px;" href="{{ route('admin.questions.options.index', $q) }}">
                Manage ({{ $q->options_count }})
              </a>
            @else
              <span class="mono">N/A</span>
            @endif
          </td>
          <td>
            <div class="row-actions">
              <a class="btn" style="padding:8px 10px;" href="{{ route('admin.funnels.questions.edit', [$funnel, $q]) }}">Edit</a>
              <form method="POST" action="{{ route('admin.funnels.questions.destroy', [$funnel, $q]) }}">
                @csrf @method('DELETE')
                <button class="danger" type="submit" onclick="return confirm('Delete this question?')">Delete</button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr><td colspan="8" style="padding:18px;color:#64748b;">No questions yet. Add your first question.</td></tr>
      @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
