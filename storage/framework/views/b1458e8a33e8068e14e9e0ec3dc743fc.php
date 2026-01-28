<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $__env->yieldContent('title', 'Funnel'); ?></title>
    <meta name="description" content="<?php echo $__env->yieldContent('meta_description', ''); ?>">

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
                <a class="brand" href="<?php echo e(url('/')); ?>">
                    <span class="dot"></span>
                    <span>Insurance Funnels</span>
                </a>

                <div class="links">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                        <a class="link" href="<?php echo e(url('/admin')); ?>">Home</a>
                        <a class="link" href="<?php echo e(url('/admin/funnels')); ?>">Funnels</a>
                        <a class="link" href="<?php echo e(url('/admin/submissions')); ?>">Submissions</a>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->is_admin ?? false): ?>
                            <a class="link link-admin" href="<?php echo e(route('admin.email-templates.index')); ?>">Templates</a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>

            <div class="links">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->guest()): ?>
                    <a class="link link-dark" href="<?php echo e(route('login')); ?>">Login</a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                    <span style="color:#64748b;font-size:13px;white-space:nowrap;">
                        <?php echo e(auth()->user()->email); ?>

                    </span>

                    <form method="POST" action="<?php echo e(route('logout')); ?>" style="display:inline;">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="logout-btn">Logout</button>
                    </form>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>

    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\xampp\sale-funnal\resources\views/layouts/funnel.blade.php ENDPATH**/ ?>