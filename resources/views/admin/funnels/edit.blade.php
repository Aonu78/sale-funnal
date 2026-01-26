@extends('layouts.app')

@section('title', 'Edit Funnel')

@section('content')
<div class="card">
    <h1>Edit Funnel</h1>

    <form method="POST" action="{{ route('admin.funnels.update', $funnel) }}" enctype="multipart/form-data" class="mt">
        @csrf
        @method('PUT')

        <div class="mt">
            <label>Slug</label>
            <input type="text" name="slug" value="{{ old('slug', $funnel->slug) }}">
            @error('slug') <div class="small" style="color:red">{{ $message }}</div> @enderror
        </div>

        <div class="mt">
            <label>Title</label>
            <input type="text" name="title" value="{{ old('title', $funnel->title) }}">
            @error('title') <div class="small" style="color:red">{{ $message }}</div> @enderror
        </div>

        <div class="mt">
            <label>SEO Title</label>
            <input type="text" name="seo_title" value="{{ old('seo_title', $funnel->seo_title) }}">
        </div>

        <div class="mt">
            <label>SEO Description</label>
            <input type="text" name="seo_description" value="{{ old('seo_description', $funnel->seo_description) }}">
        </div>

        <div class="mt">
            <label>Hero Image</label>
            <input type="file" name="hero_image">
            @if($funnel->hero_image_path)
                <div class="small mt">
                    Current: <a target="_blank" href="{{ asset('storage/'.$funnel->hero_image_path) }}">view</a>
                </div>
            @endif
        </div>

        <div class="mt">
            <label>Question Label</label>
            <input type="text" name="question_label" value="{{ old('question_label', $funnel->question_label) }}">
        </div>

        <div class="mt">
            <label>Question Type</label>
            <select name="question_type">
                <option value="yes_no" {{ old('question_type', $funnel->question_type)=='yes_no'?'selected':'' }}>Yes/No</option>
                <option value="text" {{ old('question_type', $funnel->question_type)=='text'?'selected':'' }}>Text Input</option>
            </select>
        </div>

        <div class="mt">
            <label>Footer Text</label>
            <input type="text" name="footer_text" value="{{ old('footer_text', $funnel->footer_text) }}">
        </div>

        <div class="mt">
            <label>
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $funnel->is_active) ? 'checked' : '' }}>
                Active
            </label>
        </div>

        <button class="btn mt" type="submit">Update</button>
        <div class="mt"><a href="{{ route('admin.funnels.index') }}">Back</a></div>
    </form>
</div>
@endsection
