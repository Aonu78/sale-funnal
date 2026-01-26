

<?php $__env->startSection('title', 'Funnels'); ?>

<?php $__env->startSection('content'); ?>
<style>
    body{
        background:
            radial-gradient(1000px 300px at 20% 0%, rgba(37,99,235,.16), transparent),
            radial-gradient(900px 260px at 80% 0%, rgba(34,197,94,.12), transparent),
            #f1f5f9;
        font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial, "Noto Sans";
        color:#0f172a;
    }
    .page{max-width:1100px;margin:0 auto;padding:28px 18px;}
    .topbar{display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;margin-bottom:14px;}
    .title h1{margin:0;font-size:22px;letter-spacing:-.02em;}
    .title p{margin:4px 0 0;color:#64748b;font-size:13px;}
    .actions{display:flex;gap:10px;flex-wrap:wrap;}
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
    .notice{padding:12px 16px;border-bottom:1px solid rgba(15,23,42,.08);font-size:13px;}
    .notice-success{background:rgba(34,197,94,.08);color:#166534;}
    .table-wrap{padding:14px 16px 18px;}
    table{width:100%;border-collapse:separate;border-spacing:0 10px;}
    thead th{
        text-align:left;font-size:12px;color:#64748b;font-weight:800;
        padding:0 10px 6px;letter-spacing:.02em;text-transform:uppercase;
    }
    tbody tr{
        background:#fff;border:1px solid rgba(15,23,42,.08);
        box-shadow:0 10px 24px rgba(15,23,42,.06);
    }
    tbody td{
        padding:12px 10px;border-top:1px solid rgba(15,23,42,.06);
        border-bottom:1px solid rgba(15,23,42,.06);font-size:14px;vertical-align:middle;
    }
    tbody tr td:first-child{border-left:1px solid rgba(15,23,42,.06);border-top-left-radius:14px;border-bottom-left-radius:14px;}
    tbody tr td:last-child{border-right:1px solid rgba(15,23,42,.06);border-top-right-radius:14px;border-bottom-right-radius:14px;}
    .pill{
        display:inline-flex;align-items:center;justify-content:center;
        padding:6px 10px;border-radius:999px;font-size:12px;white-space:nowrap;
        border:1px solid rgba(15,23,42,.12);background:rgba(15,23,42,.04);color:#0f172a;
    }
    .pill-on{background:rgba(34,197,94,.10);border-color:rgba(34,197,94,.25);color:#166534;}
    .pill-off{background:rgba(239,68,68,.08);border-color:rgba(239,68,68,.22);color:#991b1b;}
    .link{color:#2563eb;text-decoration:none;}
    .link:hover{text-decoration:underline;}
    .mono{font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;font-size:13px;color:#334155;}
    .actions-cell{display:flex;gap:10px;flex-wrap:wrap;align-items:center;}
    .btn-danger{
        border:1px solid rgba(239,68,68,.25);
        background:rgba(239,68,68,.06);
        color:#991b1b;
        padding:9px 12px;border-radius:12px;cursor:pointer;
    }
    .btn-danger:hover{transform:translateY(-1px);}
</style>

<div class="page">
    <div class="topbar">
        <div class="title">
            <h1>Funnels</h1>
            <p>Create and manage your landing pages.</p>
        </div>
        <div class="actions">
            <a class="btn" href="<?php echo e(url('/admin')); ?>">Home</a>
            <a class="btn btn-dark" href="<?php echo e(route('admin.submissions.index')); ?>">Submissions</a>
            <a class="btn btn-primary" href="<?php echo e(route('admin.funnels.create')); ?>">+ Create Funnel</a>
        </div>
    </div>

    <div class="card">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
            <div class="notice notice-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Public</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $funnels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $funnel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><strong><?php echo e($funnel->title); ?></strong></td>
                        <td class="mono"><?php echo e($funnel->slug); ?></td>
                        <td>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($funnel->is_active): ?>
                                <span class="pill pill-on">Active</span>
                            <?php else: ?>
                                <span class="pill pill-off">Inactive</span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </td>
                        <td>
                            <a class="link" target="_blank" href="<?php echo e(route('funnels.landing', $funnel->slug)); ?>">Open</a>
                        </td>
                        <td>
                            <div class="actions-cell">
                                <a class="btn" href="<?php echo e(route('admin.funnels.edit', $funnel)); ?>">Edit</a>
                                <a class="btn" href="<?php echo e(route('admin.submissions.export', ['funnel_id' => $funnel->id])); ?>">Export CSV</a>
                                <a class="btn" href="<?php echo e(route('admin.funnels.questions.index', $funnel)); ?>">Builder</a>
                                <a class="btn" href="<?php echo e(route('admin.funnels.rules.index', $funnel)); ?>">Rules</a>

                                <form method="POST" action="<?php echo e(route('admin.funnels.destroy', $funnel)); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="btn-danger" type="submit"
                                            onclick="return confirm('Delete this funnel?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" style="padding:18px;color:#64748b;">No funnels found. Create your first funnel.</td>
                    </tr>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>

            <div style="margin-top:14px;">
                <?php echo e($funnels->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.funnel', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\xampp\sale-funnal\resources\views/admin/funnels/index.blade.php ENDPATH**/ ?>