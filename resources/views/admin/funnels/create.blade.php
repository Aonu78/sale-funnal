@extends('layouts.funnel')

@section('title', 'Create Funnel')

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
    .page{max-width:900px;margin:0 auto;padding:28px 18px;}
    .topbar{display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;margin-bottom:14px;}
    .title h1{margin:0;font-size:22px;letter-spacing:-.02em;}
    .title p{margin:4px 0 0;color:#64748b;font-size:13px;}
    .btn{
        display:inline-flex;align-items:center;justify-content:center;
        padding:10px 14px;border-radius:12px;
        border:1px solid rgba(15,23,42,.12);
        background:#fff;color:#0f172a;text-decoration:none;
        box-shadow:0 8px 20px rgba(15,23,42,.06);
        transition:transform .12s ease, box-shadow .12s ease;
        font-size:14px; white-space:nowrap;
    }
    .btn:hover{transform:translateY(-1px);box-shadow:0 14px 30px rgba(15,23,42,.10);}
    .btn-dark{background:#0f172a;color:#fff;border-color:rgba(15,23,42,.25);}
    .btn-primary{
        background: linear-gradient(135deg, #2563eb, #22c55e);
        color:#fff;border:none;
        box-shadow:0 16px 36px rgba(37,99,235,.22);
    }

    .card{
        background:rgba(255,255,255,.92);
        border:1px solid rgba(15,23,42,.08);
        border-radius:18px;
        box-shadow:0 16px 40px rgba(15,23,42,.08);
        overflow:hidden;
    }
    .content{padding:18px;}
    .grid{display:grid;grid-template-columns:1fr 1fr;gap:12px;}
    @media (max-width:800px){ .grid{grid-template-columns:1fr;} }

    .field label{display:block;font-size:12px;color:#64748b;margin:0 0 6px;}
    .input, .select{
        width:85%;
        padding:11px 12px;border-radius:12px;
        border:1px solid rgba(15,23,42,.12);
        background:#fff; outline:none;
        transition:border-color .12s ease, box-shadow .12s ease;
        font-size:14px;
    }
    .input:focus, .select:focus{
        border-color: rgba(37,99,235,.5);
        box-shadow: 0 0 0 4px rgba(37,99,235,.12);
    }
    .error{color:#b91c1c;font-size:12px;margin-top:6px;}
    .hint{color:#64748b;font-size:12px;margin-top:6px;line-height:1.5;}
    .row{display:flex;gap:10px;flex-wrap:wrap;align-items:center;justify-content:flex-end;margin-top:14px;}
    .check{display:flex;gap:10px;align-items:center;margin-top:10px;color:#334155;font-size:14px;}
</style>

<div class="page">
    <div class="topbar">
        <div class="title">
            <h1>Create Funnel</h1>
            <p>Set hero, SEO, question and footer text.</p>
        </div>
        <div style="display:flex;gap:10px;flex-wrap:wrap;">
            <a class="btn" href="{{ route('admin.funnels.index') }}">Back</a>
            <a class="btn btn-dark" href="{{ route('admin.submissions.index') }}">Submissions</a>
        </div>
    </div>

    <div class="card">
        <div class="content">
            <form method="POST" action="{{ route('admin.funnels.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="grid">
                    <div class="field">
                        <label>Slug (unique)</label>
                        <input class="input" type="text" name="slug" value="{{ old('slug') }}" placeholder="health-insurance">
                        @error('slug') <div class="error">{{ $message }}</div> @enderror
                        <div class="hint">Used in URL: <span style="font-family:ui-monospace;">/f/your-slug</span></div>
                    </div>

                    <div class="field">
                        <label>Title</label>
                        <input class="input" type="text" name="title" value="{{ old('title') }}" placeholder="Get Insurance Quote">
                        @error('title') <div class="error">{{ $message }}</div> @enderror
                    </div>

                    <div class="field">
                        <label>SEO Title</label>
                        <input class="input" type="text" name="seo_title" value="{{ old('seo_title') }}" placeholder="Insurance Quote - Fast">
                        @error('seo_title') <div class="error">{{ $message }}</div> @enderror
                    </div>

                    <div class="field">
                        <label>SEO Description</label>
                        <input class="input" type="text" name="seo_description" value="{{ old('seo_description') }}" placeholder="Compare plans and get a quote in minutes.">
                        @error('seo_description') <div class="error">{{ $message }}</div> @enderror
                    </div>

                    <div class="field" style="grid-column: span 2;">
                        <label>Hero Image</label>
                        <input class="input" type="file" name="hero_image">
                        @error('hero_image') <div class="error">{{ $message }}</div> @enderror
                        <div class="hint">Recommended: wide image (1200x500). Max 2MB.</div>
                    </div>

                    <div class="field" style="grid-column: span 2;">
                        <label>Footer Text</label>
                        <input class="input" type="text" name="footer_text" value="{{ old('footer_text') }}" placeholder="By submitting, you agree to be contacted by our team.">
                        @error('footer_text') <div class="error">{{ $message }}</div> @enderror
                    </div>
                </div>

                <label class="check">
                    <input type="checkbox" name="is_active" value="1" checked>
                    Active (public page is accessible)
                </label>

                <div class="row">
                    <a class="btn" href="{{ route('admin.funnels.index') }}">Cancel</a>
                    <button class="btn btn-primary" type="submit">Save Funnel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
