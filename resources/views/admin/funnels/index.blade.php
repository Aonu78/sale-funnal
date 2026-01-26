@extends('layouts.app')

@section('title', 'Funnels')

@section('content')
<div class="card">
    <div style="display:flex;justify-content:space-between;align-items:center;gap:10px;">
        <h1>Funnels</h1>
        <a class="btn" style="display:inline-block;text-align:center;padding:10px 14px;border-radius:8px;"
           href="{{ route('admin.funnels.create') }}">+ Create Funnel</a>
    </div>

    @if(session('success'))
        <p class="small" style="color:green">{{ session('success') }}</p>
    @endif

    <div class="mt">
        <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse:collapse;">
            <thead>
            <tr style="background:#eee">
                <th align="left">Title</th>
                <th align="left">Slug</th>
                <th align="left">Active</th>
                <th align="left">Public URL</th>
                <th align="left">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($funnels as $funnel)
                <tr style="border-top:1px solid #ddd">
                    <td>{{ $funnel->title }}</td>
                    <td>{{ $funnel->slug }}</td>
                    <td>{{ $funnel->is_active ? 'Yes' : 'No' }}</td>
                    <td><a href="{{ route('funnels.show', $funnel->slug) }}" target="_blank">Open</a></td>
                    <td>
                        <a href="{{ route('admin.funnels.edit', $funnel) }}">Edit</a>
                        |
                        <form method="POST" action="{{ route('admin.funnels.destroy', $funnel) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="border:none;background:none;color:red;cursor:pointer"
                                    onclick="return confirm('Delete this funnel?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mt">
            {{ $funnels->links() }}
        </div>

        <div class="mt">
            <a href="{{ route('admin.submissions.index') }}">View Submissions</a>
        </div>
    </div>
</div>
@endsection
