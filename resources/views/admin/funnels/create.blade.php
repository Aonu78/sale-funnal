@extends('layouts.app')

@section('title', 'Create Funnel')

@section('content')
<div class="card">
    <h1>Create Funnel</h1>

    <form method="POST" action="{{ route('admin.funnels.store') }}" enctype="multipart/form-data" class="mt">
        @csrf

        <div class="mt">
            <label>Slug (unique)</label>
            <input type="text" name="slug" value="{{ old('slug') }}" placeholder="health-insurance">
            @error('slug') <div class="small" style="color:red">{{ $message }}</div> @enderror
        </div>

        <div class="mt">
            <label>Title</label>
            <input type="text" name="title" value="{{ old('title') }}">
            @error('title') <div class="small" style="color:red">{{ $message }}</div> @enderror
        </div>

        <div class="mt">
            <label>SEO Title</label>
            <input type="text" name="seo_title" value="{{ old('seo_title') }}">
            @error('seo_title') <div class="small" style="color:red">{{ $message }}</div> @enderror
        </div>

        <div class="mt">
            <label>SEO Description</label>
            <input type="text" name="seo_description" value="{{ old('seo_description') }}">
            @error('seo_description') <div class="small" style="color:red">{{ $message }}</div> @enderror
        </div>

        <div class="mt">
            <label>Hero Image</label>
            <input type="file" name="hero_image">
            @error('hero_image') <div class="small" style="color:red">{{ $message }}</div> @enderror
        </div>

        <div class="mt">
            <label>Question Label</label>
            <input type="text" name="question_label" value="{{ old('question_label') }}" placeholder="Do you already have insurance?">
            @error('question_label') <div class="small" style="color:red">{{ $message }}</div> @enderror
        </div>

        <div class="mt">
            <label>Question Type</label>
            <select name="question_type">
                <option value="yes_no" {{ old('question_type')=='yes_no'?'selected':'' }}>Yes/No</option>
                <option value="text" {{ old('question_type')=='text'?'selected':'' }}>Text Input</option>
            </select>
            @error('question_type') <div class="small" style="color:red">{{ $message }}</div> @enderror
        </div>

        <div class="mt">
            <label>Footer Text</label>
            <input type="text" name="footer_text" value="{{ old('footer_text') }}">
            @error('footer_text') <div class="small" style="color:red">{{ $message }}</div> @enderror
        </div>

        <div class="mt">
            <label>
                <input type="checkbox" name="is_active" value="1" checked>
                Active
            </label>
        </div>

        <button class="btn mt" type="submit">Save</button>
        <div class="mt"><a href="{{ route('admin.funnels.index') }}">Back</a></div>
    </form>
</div>
@endsection
