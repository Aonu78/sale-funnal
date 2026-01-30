<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Funnel')</title>
    <meta name="description" content="@yield('meta_description', '')">

    <style>
        .nav-wrap{
            position: sticky; top: 0; z-index: 50;
            backdrop-filter: blur(10px);
            background: rgba(255,255,255,.70);
            border-bottom: 1px solid rgba(15,23,42,.08);
        }
        .nav{
            max-width: 1100px;
            margin: 0 auto;
            padding: 12px 18px;
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap: 12px;
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial, "Noto Sans";
        }
        .nav-left{display:flex;align-items:center;gap:10px;flex-wrap:wrap;}
        .brand{
            display:flex;align-items:center;gap:10px;
            text-decoration:none;color:#0f172a;
            font-weight:900; letter-spacing:-.02em;
        }
        .dot{
            width:12px;height:12px;border-radius:999px;
            background: linear-gradient(135deg, #2563eb, #22c55e);
            box-shadow:0 10px 18px rgba(37,99,235,.25);
        }
        .links{display:flex;align-items:center;gap:8px;flex-wrap:wrap;}
        .link{
            text-decoration:none;
            color:#0f172a;
            font-size:14px;
            padding:8px 10px;
            border-radius:12px;
            border: 1px solid rgba(15,23,42,.10);
            background:#fff;
            box-shadow:0 8px 18px rgba(15,23,42,.06);
            transition:transform .12s ease, box-shadow .12s ease;
            white-space:nowrap;
        }
        .link:hover{transform:translateY(-1px);box-shadow:0 14px 30px rgba(15,23,42,.10);}
        .link-dark{
            background:#0f172a;color:#fff;border-color:rgba(15,23,42,.20);
        }
        .logout-btn{
            border:1px solid rgba(239,68,68,.22);
            background:rgba(239,68,68,.06);
            color:#991b1b;
            padding:8px 10px;
            border-radius:12px;
            cursor:pointer;
            box-shadow:0 8px 18px rgba(15,23,42,.06);
        }
        .logout-btn:hover{transform:translateY(-1px);}
        main{min-height: calc(100vh - 58px);}
    </style>
</head>
<body>
    <div class="nav-wrap">
        <div class="nav">
            <div class="nav-left">
                @auth
                <a class="brand" href="{{ url('/') }}">
                    <span class="dot"></span>
                    <span>Insurance Funnels</span>
                </a>

                <div class="links">
                    
                        <a class="link" href="{{ url('/admin') }}">Home</a>
                        <a class="link" href="{{ url('/admin/funnels') }}">Funnels</a>
                        <a class="link" href="{{ url('/admin/submissions') }}">Submissions</a>
                        @if(auth()->user()->is_admin ?? false)
                            <a class="link link-admin" href="{{ route('admin.email-templates.index') }}">Templates</a>
                        @endif
                    
                </div>
                @endauth
            </div>

            <div class="links">
                {{-- @guest
                    <a class="link link-dark" href="{{ route('login') }}">Login</a>
                @endguest --}}

                @auth
                    <span style="color:#64748b;font-size:13px;white-space:nowrap;">
                        {{ auth()->user()->email }}
                    </span>

                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="logout-btn">Logout</button>
                    </form>
                @endauth
            </div>
        </div>
    </div>

    <main>
        @yield('content')
    </main>
</body>
</html>
