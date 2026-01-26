@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="card">
    <h1>Available Funnels</h1>
    <p class="small">Select a funnel to open the landing page.</p>

    @if($funnels->isEmpty())
        <p class="small" style="color:red">No active funnels found. Create one in admin.</p>
    @else
        <ul>
            @foreach($funnels as $f)
                <li style="margin:10px 0;">
                    <a href="{{ route('funnels.show', $f->slug) }}">{{ $f->title }}</a>
                    <div class="small">/f/{{ $f->slug }}</div>
                </li>
            @endforeach
        </ul>
    @endif

    <div class="mt">
        <a href="{{ url('/admin/funnels') }}">Go to Admin Funnels</a>
    </div>
</div>
@endsection
