@extends('layouts.app')

@section('title', 'Thank You')

@section('content')
<div class="card">
    <h1>Thank you!</h1>
    <p class="small">We received your request. Our team will contact you soon.</p>
    <a href="{{ route('funnels.show', $funnel->slug) }}">Back</a>
</div>
@endsection
