

<?php $__env->startSection('title', 'Email Templates'); ?>

<?php $__env->startSection('content'); ?>
<style>
    :root{
        --bg:#f1f5f9;
        --text:#0f172a;
        --muted:#64748b;
        --card: rgba(255,255,255,.86);
        --stroke: rgba(15,23,42,.10);
        --shadow: 0 18px 55px rgba(15,23,42,.10);
        --shadow2: 0 10px 24px rgba(15,23,42,.08);
        --radius: 18px;
    }

    body{
        background:
            radial-gradient(1100px 360px at 18% 0%, rgba(37,99,235,.16), transparent 60%),
            radial-gradient(1000px 340px at 82% 0%, rgba(34,197,94,.12), transparent 60%),
            var(--bg);
        font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial, "Noto Sans";
        color: var(--text);
    }

    .wrap{
        max-width: 1080px;
        margin: 0 auto;
        padding: 28px 16px 60px;
    }

    .header{
        display:flex;
        align-items:flex-end;
        justify-content:space-between;
        gap: 14px;
        flex-wrap: wrap;
        margin-bottom: 16px;
    }

    .header h1{
        margin: 0;
        font-size: 24px;
        letter-spacing: -.02em;
        font-weight: 800;
        line-height: 1.1;
    }
    .header p{
        margin: 6px 0 0;
        color: var(--muted);
        font-size: 13px;
    }

    .btn{
        display:inline-flex;
        align-items:center;
        justify-content:center;
        gap: 10px;
        padding: 10px 14px;
        border-radius: 14px;
        border: 1px solid rgba(255,255,255,.35);
        background: rgba(255,255,255,.55);
        color: var(--text);
        text-decoration:none;
        box-shadow: var(--shadow2);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        transition: transform .12s ease, box-shadow .12s ease, background .12s ease;
        font-weight: 700;
        font-size: 14px;
        white-space: nowrap;
    }
    .btn:hover{
        transform: translateY(-1px);
        box-shadow: 0 16px 40px rgba(15,23,42,.12);
        background: rgba(255,255,255,.72);
    }
    .btn-primary{
        color: #fff;
        border: none;
        background: linear-gradient(135deg, #2563eb, #22c55e);
        box-shadow: 0 18px 44px rgba(37,99,235,.22);
    }
    .btn-primary:hover{
        box-shadow: 0 22px 52px rgba(37,99,235,.28);
    }

    .card{
        background: var(--card);
        border: 1px solid var(--stroke);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        overflow: hidden;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    .table-wrap{
        overflow-x: auto;
    }

    table{
        width:100%;
        border-collapse: separate;
        border-spacing: 0;
        min-width: 760px;
    }

    thead th{
        text-align:left;
        font-size: 12px;
        letter-spacing: .08em;
        text-transform: uppercase;
        color: rgba(100,116,139,.95);
        background: rgba(248,250,252,.55);
        padding: 14px 18px;
        border-bottom: 1px solid var(--stroke);
        position: sticky;
        top: 0;
        backdrop-filter: blur(8px);
    }

    tbody td{
        padding: 14px 18px;
        border-bottom: 1px solid rgba(15,23,42,.06);
        font-size: 14px;
        color: rgba(15,23,42,.92);
        vertical-align: middle;
    }

    tbody tr{
        transition: background .12s ease;
    }
    tbody tr:hover{
        background: rgba(255,255,255,.45);
    }

    .name{
        font-weight: 800;
        color: rgba(15,23,42,.95);
        display:flex;
        gap:10px;
        align-items:center;
    }
    .dot{
        width: 10px; height: 10px;
        border-radius: 50%;
        background: rgba(99,102,241,.35);
        box-shadow: 0 0 0 6px rgba(99,102,241,.10);
    }

    .muted{ color: rgba(100,116,139,.95); }

    .badge{
        display:inline-flex;
        align-items:center;
        gap: 8px;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 800;
        border: 1px solid rgba(15,23,42,.08);
        background: rgba(255,255,255,.55);
    }
    .badge .pip{
        width: 8px; height: 8px;
        border-radius: 50%;
    }
    .badge-active{
        color: #166534;
        border-color: rgba(22,101,52,.18);
        background: rgba(34,197,94,.12);
    }
    .badge-active .pip{ background:#22c55e; }
    .badge-inactive{
        color: #991b1b;
        border-color: rgba(153,27,27,.18);
        background: rgba(239,68,68,.12);
    }
    .badge-inactive .pip{ background:#ef4444; }

    .actions{
        display:flex;
        gap: 10px;
        align-items:center;
        flex-wrap: wrap;
    }
    .link{
        font-weight: 800;
        font-size: 13px;
        text-decoration: none;
        padding: 8px 10px;
        border-radius: 12px;
        border: 1px solid rgba(15,23,42,.10);
        background: rgba(255,255,255,.55);
        transition: transform .12s ease, background .12s ease, box-shadow .12s ease;
        box-shadow: 0 8px 18px rgba(15,23,42,.06);
        color: rgba(15,23,42,.88);
    }
    .link:hover{
        transform: translateY(-1px);
        background: rgba(255,255,255,.80);
        box-shadow: 0 14px 28px rgba(15,23,42,.10);
    }
    .link-danger{
        color: #b91c1c;
        border-color: rgba(185,28,28,.18);
        background: rgba(239,68,68,.08);
    }

    .empty{
        padding: 34px 18px;
        text-align:center;
        color: rgba(100,116,139,.95);
    }
    .empty strong{
        display:block;
        color: rgba(15,23,42,.9);
        font-size: 16px;
        margin-bottom: 6px;
    }
    .empty small{
        display:block;
        margin-top: 6px;
        font-size: 13px;
        color: rgba(100,116,139,.95);
    }

    /* pagination wrapper */
    .pagination{
        margin-top: 16px;
    }
</style>

<div class="wrap">
    <div class="header">
        <div>
            <h1>Email Templates</h1>
            <p>Manage, preview, and update your outgoing email templates.</p>
        </div>

        <a href="<?php echo e(route('admin.email-templates.create')); ?>" class="btn btn-primary">
            <span>+ Create Template</span>
        </a>
    </div>

    <div class="card">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th style="width: 28%;">Name</th>
                        <th style="width: 18%;">Category</th>
                        <th>Subject</th>
                        <th style="width: 12%;">Status</th>
                        <th style="width: 18%;">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <div class="name">
                                    <span class="dot"></span>
                                    <span><?php echo e($template->name); ?></span>
                                </div>
                            </td>

                            <td class="muted">
                                <?php echo e($template->category ?: '—'); ?>

                            </td>

                            <td class="muted">
                                <?php echo e($template->subject); ?>

                            </td>

                            <td>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($template->is_active): ?>
                                    <span class="badge badge-active">
                                        <span class="pip"></span> Active
                                    </span>
                                <?php else: ?>
                                    <span class="badge badge-inactive">
                                        <span class="pip"></span> Inactive
                                    </span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>

                            <td>
                                <div class="actions">
                                    <a href="<?php echo e(route('admin.email-templates.show', $template)); ?>" class="link">
                                        View
                                    </a>

                                    <a href="<?php echo e(route('admin.email-templates.edit', $template)); ?>" class="link">
                                        Edit
                                    </a>

                                    <form method="POST" action="<?php echo e(route('admin.email-templates.destroy', $template)); ?>" class="inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button
                                            type="submit"
                                            class="link link-danger"
                                            onclick="return confirm('Are you sure you want to delete this template?')"
                                        >
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5">
                                <div class="empty">
                                    <strong>No email templates found</strong>
                                    <span>Create one to start sending consistent, branded emails.</span>
                                    <small>Tip: Use categories to keep templates organized.</small>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="pagination">
        <?php echo e($templates->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.funnel', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\xampp\sale-funnal\resources\views/admin/email-templates/index.blade.php ENDPATH**/ ?>