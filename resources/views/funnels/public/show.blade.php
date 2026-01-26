@extends('layouts.funnel')

@section('title', $funnel->seo_title ?: $funnel->title)
@section('meta_description', $funnel->seo_description ?: '')

@section('content')
<style>
    body{
        background:
            radial-gradient(1000px 320px at 20% 0%, rgba(37,99,235,.16), transparent),
            radial-gradient(900px 280px at 80% 0%, rgba(34,197,94,.12), transparent),
            #f1f5f9;
        font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial, "Noto Sans";
        color:#0f172a;
    }
    .page{max-width:980px;margin:0 auto;padding:28px 18px;}
    .card{
        background:rgba(255,255,255,.94);
        border:1px solid rgba(15,23,42,.08);
        border-radius:20px;
        box-shadow:0 18px 48px rgba(15,23,42,.10);
        overflow:hidden;
    }
    .hero{
        position:relative;
        padding:18px;
        border-bottom:1px solid rgba(15,23,42,.08);
        background: linear-gradient(180deg, rgba(255,255,255,1), rgba(248,250,252,1));
    }
    .hero-img{
        border-radius:18px;
        overflow:hidden;
        border:1px solid rgba(15,23,42,.08);
        box-shadow:0 12px 28px rgba(15,23,42,.10);
    }
    .hero-img img{width:100%;display:block;max-height:340px;object-fit:cover;}
    .header{
        padding:18px;
        display:grid;
        grid-template-columns: 1.2fr .8fr;
        gap:16px;
        align-items:start;
    }
    @media (max-width: 860px){
        .header{grid-template-columns:1fr;}
    }
    h1{margin:0;font-size:26px;letter-spacing:-.02em;}
    .desc{margin:10px 0 0;color:#475569;line-height:1.6;font-size:14px;}
    .trust{
        background: radial-gradient(1000px 200px at 30% 0%, rgba(37,99,235,.12), transparent),
                    #ffffff;
        border:1px solid rgba(15,23,42,.08);
        border-radius:18px;
        padding:14px;
        box-shadow:0 10px 24px rgba(15,23,42,.06);
    }
    .trust h3{margin:0 0 8px;font-size:14px;}
    .trust ul{margin:0;padding-left:18px;color:#475569;font-size:13px;line-height:1.6;}
    .form{padding:0 18px 18px;}
    .grid{display:grid;grid-template-columns:1fr 1fr;gap:12px;}
    @media (max-width: 760px){ .grid{grid-template-columns:1fr;} }
    .field label{display:block;font-size:12px;color:#64748b;margin:0 0 6px;}
    .input{
        width:85%;
        padding:12px 12px;border-radius:14px;
        border:1px solid rgba(15,23,42,.12);
        background:#fff; outline:none;
        transition:border-color .12s ease, box-shadow .12s ease;
        font-size:14px;
    }
    .input:focus{
        border-color: rgba(37,99,235,.55);
        box-shadow: 0 0 0 4px rgba(37,99,235,.12);
    }
    .error{color:#b91c1c;font-size:12px;margin-top:6px;}
    .question{
        margin-top:12px;
        padding:14px;
        border-radius:18px;
        border:1px solid rgba(15,23,42,.08);
        background: rgba(15,23,42,.02);
    }
    .question-title{font-weight:800;margin:0 0 10px;}
    .choice{
        display:flex;gap:12px;flex-wrap:wrap;
    }
    .chip{
        display:flex;align-items:center;gap:10px;
        border:1px solid rgba(15,23,42,.12);
        border-radius:999px;
        padding:10px 12px;
        background:#fff;
        cursor:pointer;
        user-select:none;
        box-shadow:0 10px 22px rgba(15,23,42,.06);
    }
    .chip input{margin:0;}
    .btn{
        width:100%;
        margin-top:14px;
        padding:13px 14px;
        border-radius:16px;
        border:none;
        cursor:pointer;
        color:#fff;
        font-weight:800;
        letter-spacing:.01em;
        background: linear-gradient(135deg, #2563eb, #22c55e);
        box-shadow:0 18px 36px rgba(37,99,235,.22);
        transition:transform .12s ease, box-shadow .12s ease;
    }
    .btn:hover{transform:translateY(-1px);box-shadow:0 22px 44px rgba(37,99,235,.26);}
    .footer{
        padding:14px 18px;
        border-top:1px solid rgba(15,23,42,.08);
        color:#64748b;
        font-size:13px;
        display:flex;justify-content:space-between;gap:10px;flex-wrap:wrap;
    }
    .tiny{font-size:12px;color:#94a3b8;}
</style>

<div class="page">
    <div class="card">
        <div class="hero">
            @if($funnel->hero_image_path)
                <div class="hero-img">
                    <img src="{{ asset($funnel->hero_image_path) }}" alt="Hero">
                </div>
            @endif
        </div>

        <div class="header">
            <div>
                <h1>{{ $funnel->title }}</h1>
                @if($funnel->seo_description)
                    <p class="desc">{{ $funnel->seo_description }}</p>
                @else
                    <p class="desc">Fill the form below and we will contact you shortly with the best options.</p>
                @endif
            </div>

            <div class="trust">
                <h3>What happens next?</h3>
                <ul>
                    <li>We review your details</li>
                    <li>We contact you for a quick confirmation</li>
                    <li>We share suitable insurance options</li>
                </ul>
                <div class="tiny" style="margin-top:10px;">Your info stays private.</div>
            </div>
        </div>

        <div class="form">
            <form method="POST" action="{{ route('funnels.start', $funnel->slug) }}">
                @csrf

                @if($funnel->question_label)
                    <div class="question">
                        <p class="question-title">{{ $funnel->question_label }}</p>

                        @if($funnel->question_type === 'yes_no')
                            <div class="choice">
                                <label class="chip">
                                    <input type="radio" name="question_answer" value="yes" {{ old('question_answer')=='yes'?'checked':'' }}>
                                    Yes
                                </label>
                                <label class="chip">
                                    <input type="radio" name="question_answer" value="no" {{ old('question_answer')=='no'?'checked':'' }}>
                                    No
                                </label>
                            </div>
                        @else
                            <div class="field">
                                <label>Your answer</label>
                                <input class="input" type="text" name="question_answer" value="{{ old('question_answer') }}" placeholder="Type here...">
                            </div>
                        @endif

                        @error('question_answer') <div class="error">{{ $message }}</div> @enderror
                    </div>
                @endif

                <div class="grid" style="margin-top:12px;">
                    <div class="field">
                        <label>Full name</label>
                        <input class="input" type="text" name="name" value="{{ old('name') }}" placeholder="Your name">
                        @error('name') <div class="error">{{ $message }}</div> @enderror
                    </div>

                    <div class="field">
                        <label>Email</label>
                        <input class="input" type="email" name="email" value="{{ old('email') }}" placeholder="you@email.com">
                        @error('email') <div class="error">{{ $message }}</div> @enderror
                    </div>

                    <div class="field" style="grid-column: span 2;">
                        <label>Phone</label>
                        <input class="input" type="text" name="phone" value="{{ old('phone') }}" placeholder="+92 3xx xxx xxxx">
                        @error('phone') <div class="error">{{ $message }}</div> @enderror
                    </div>
                </div>

                <button class="btn" type="submit">Get Quote</button>
            </form>
        </div>

        <div class="footer">
            <span>{{ $funnel->footer_text ?: 'By submitting, you agree to be contacted about insurance options.' }}</span>
            <span class="tiny">{{ now()->format('Y-m-d') }}</span>
        </div>
    </div>
</div>
@endsection
