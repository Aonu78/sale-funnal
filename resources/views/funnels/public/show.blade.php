@extends('layouts.app')

@section('title', $funnel->seo_title ?: $funnel->title)
@section('meta_description', $funnel->seo_description ?: '')

@section('content')
<div class="card">
    @if($funnel->hero_image_path)
        <div class="hero">
            <img src="{{ asset('storage/'.$funnel->hero_image_path) }}" alt="Hero">
        </div>
    @endif

    <h1 class="mt">{{ $funnel->title }}</h1>
    @if($funnel->seo_description)
        <p class="small">{{ $funnel->seo_description }}</p>
    @endif

    <form method="POST" action="{{ route('funnels.submit', $funnel->slug) }}" class="mt">
        @csrf

        @if($funnel->question_label)
            <label class="mt"><strong>{{ $funnel->question_label }}</strong></label>

            @if($funnel->question_type === 'yes_no')
                <div class="row mt">
                    <label>
                        <input type="radio" name="question_answer" value="yes" {{ old('question_answer')=='yes'?'checked':'' }}>
                        Yes
                    </label>
                    <label>
                        <input type="radio" name="question_answer" value="no" {{ old('question_answer')=='no'?'checked':'' }}>
                        No
                    </label>
                </div>
            @else
                <input class="mt" type="text" name="question_answer" value="{{ old('question_answer') }}" placeholder="Type your answer">
            @endif
            @error('question_answer') <div class="small" style="color:red">{{ $message }}</div> @enderror
        @endif

        <div class="mt">
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name') }}">
            @error('name') <div class="small" style="color:red">{{ $message }}</div> @enderror
        </div>

        <div class="row mt">
            <div>
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}">
                @error('email') <div class="small" style="color:red">{{ $message }}</div> @enderror
            </div>
            <div>
                <label>Phone</label>
                <input type="text" name="phone" value="{{ old('phone') }}">
                @error('phone') <div class="small" style="color:red">{{ $message }}</div> @enderror
            </div>
        </div>

        <button class="btn mt" type="submit">Submit</button>
    </form>

    @if($funnel->footer_text)
        <p class="small mt">{{ $funnel->footer_text }}</p>
    @endif
</div>
@endsection
