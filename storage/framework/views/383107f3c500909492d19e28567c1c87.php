

<?php $__env->startSection('title', 'Submissions'); ?>

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
        font-size:14px;
    }
    .btn:hover{transform:translateY(-1px);box-shadow:0 14px 30px rgba(15,23,42,.10);}
    .btn-dark{background:#0f172a;color:#fff;border-color:rgba(15,23,42,.25);}

    .card{
        background:rgba(255,255,255,.92);
        border:1px solid rgba(15,23,42,.08);
        border-radius:18px;
        box-shadow:0 16px 40px rgba(15,23,42,.08);
        overflow:hidden;
    }

    .filters{padding:16px 16px 14px;border-bottom:1px solid rgba(15,23,42,.08);}
    .filters-grid{
        display:grid;
        grid-template-columns: 1.2fr 1fr 1fr 1fr;
        gap:12px;
        align-items:end;
    }
    @media (max-width: 900px){
        .filters-grid{grid-template-columns:1fr 1fr;}
    }
    @media (max-width: 520px){
        .filters-grid{grid-template-columns:1fr;}
    }

    .field label{display:block;font-size:12px;color:#64748b;margin:0 0 6px;}
    .input, .select{
        width:85%;
        padding:11px 12px;
        border-radius:12px;
        border:1px solid rgba(15,23,42,.12);
        background:#fff;
        outline:none;
        transition:border-color .12s ease, box-shadow .12s ease;
        font-size:14px;
    }
    .input:focus, .select:focus{
        border-color: rgba(37,99,235,.5);
        box-shadow: 0 0 0 4px rgba(37,99,235,.12);
    }

    .filters-actions{
        display:flex;gap:10px;flex-wrap:wrap;margin-top:12px;
        align-items:center;justify-content:space-between;
    }
    .muted{color:#64748b;font-size:13px;}
    .btn-apply{
        background:#0f172a;color:#fff;border:1px solid rgba(15,23,42,.25);
        padding:11px 14px;border-radius:12px;cursor:pointer;
        box-shadow:0 10px 24px rgba(15,23,42,.10);
    }
    .btn-apply:hover{transform:translateY(-1px);}

    .table-wrap{padding:14px 16px 18px;}
    .table-head{
        display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;
        margin-bottom:10px;
    }
    .count-pill{
        display:inline-flex;align-items:center;gap:8px;
        padding:7px 10px;border-radius:999px;
        background:rgba(37,99,235,.08);
        border:1px solid rgba(37,99,235,.15);
        color:#1e40af;font-size:12px;
    }

    table{width:100%;border-collapse:separate;border-spacing:0 10px;}
    thead th{
        text-align:left;
        font-size:12px;
        color:#64748b;
        font-weight:700;
        padding:0 10px 6px;
        letter-spacing:.02em;
        text-transform:uppercase;
    }

    tbody tr{
        background:#fff;
        border:1px solid rgba(15,23,42,.08);
        box-shadow:0 10px 24px rgba(15,23,42,.06);
    }
    tbody td{
        padding:12px 10px;
        border-top:1px solid rgba(15,23,42,.06);
        border-bottom:1px solid rgba(15,23,42,.06);
        font-size:14px;
        vertical-align:middle;
    }
    tbody tr td:first-child{border-left:1px solid rgba(15,23,42,.06);border-top-left-radius:14px;border-bottom-left-radius:14px;}
    tbody tr td:last-child{border-right:1px solid rgba(15,23,42,.06);border-top-right-radius:14px;border-bottom-right-radius:14px;}

    .badge{
        display:inline-flex;align-items:center;justify-content:center;
        padding:6px 10px;border-radius:999px;
        font-size:12px;border:1px solid rgba(15,23,42,.12);
        background:rgba(15,23,42,.04); color:#0f172a;
        white-space:nowrap;
    }
    .badge-yes{background:rgba(34,197,94,.10);border-color:rgba(34,197,94,.25);color:#166534;}
    .badge-no{background:rgba(239,68,68,.08);border-color:rgba(239,68,68,.22);color:#991b1b;}
    .badge-empty{background:rgba(100,116,139,.08);border-color:rgba(100,116,139,.22);color:#334155;}

    .mono{font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace; font-size:13px;}
    .link{color:#2563eb;text-decoration:none;}
    .link:hover{text-decoration:underline;}

    .pagination{margin-top:14px;}
</style>

<div class="page">
    <div class="topbar">
        <div class="title">
            <h1>Submissions</h1>
            <p>Filter and review the leads submitted through your funnels.</p>
        </div>
        <div class="actions">
            <a class="btn" href="<?php echo e(url('/admin')); ?>">Home</a>
            <a class="btn btn-dark" href="<?php echo e(url('/admin/funnels')); ?>">Funnels</a>
        </div>
    </div>

    <div class="card">
        <div class="filters">
            <form method="GET">
                <div class="filters-grid">
                    <div class="field" style="grid-column: span 2;">
                        <label>Search (name / email / phone)</label>
                        <input class="input" type="text" name="search" placeholder="e.g. ali, ali@email.com, 0300..."
                               value="<?php echo e(request('search')); ?>">
                    </div>

                    <div class="field">
                        <label>Funnel</label>
                        <select class="select" name="funnel_id">
                            <option value="">All Funnels</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $funnels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($f->id); ?>" <?php echo e(request('funnel_id')==$f->id?'selected':''); ?>>
                                    <?php echo e($f->title); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </select>
                    </div>

                    <div class="field">
                        <label>Answer</label>
                        <select class="select" name="answer">
                            <option value="">Any Answer</option>
                            <option value="yes" <?php echo e(request('answer')=='yes'?'selected':''); ?>>Yes</option>
                            <option value="no"  <?php echo e(request('answer')=='no'?'selected':''); ?>>No</option>
                        </select>
                    </div>

                    <div class="field">
                        <label>From</label>
                        <input class="input" type="date" name="from" value="<?php echo e(request('from')); ?>">
                    </div>

                    <div class="field">
                        <label>To</label>
                        <input class="input" type="date" name="to" value="<?php echo e(request('to')); ?>">
                    </div>

                    <div class="field">
                        <label>Lead Tag</label>
                        <select class="select" name="tag">
                            <option value="">All Tags</option>
                            <option value="IUL_Prospect" <?php echo e(request('tag')=='IUL_Prospect'?'selected':''); ?>>🟢 IUL Lead</option>
                            <option value="Term_Life_Prospect" <?php echo e(request('tag')=='Term_Life_Prospect'?'selected':''); ?>>🔵 Term Life Lead</option>
                            <option value="IRA_Rollover_Prospect" <?php echo e(request('tag')=='IRA_Rollover_Prospect'?'selected':''); ?>>🟠 IRA Rollover Lead</option>
                            <option value="Annuity_Prospect" <?php echo e(request('tag')=='Annuity_Prospect'?'selected':''); ?>>🔴 Annuity Lead</option>
                            <option value="Hybrid_Strategy" <?php echo e(request('tag')=='Hybrid_Strategy'?'selected':''); ?>>🟣 Multi-Product Lead</option>
                        </select>
                    </div>
                </div>

                <div class="filters-actions">
                    <div class="muted">
                        Showing <strong><?php echo e($submissions->count()); ?></strong> on this page
                        (page <?php echo e($submissions->currentPage()); ?> of <?php echo e($submissions->lastPage()); ?>)
                    </div>

                    <div style="display:flex;gap:10px;flex-wrap:wrap;">
                        <button class="btn-apply" type="submit">Apply Filters</button>
                        <a class="btn" href="<?php echo e(route('admin.submissions.export', request()->query())); ?>">
                            Export CSV
                        </a>
                        <a class="btn" href="<?php echo e(route('admin.submissions.index')); ?>">Reset</a>
                    </div>

                </div>
            </form>
        </div>

        <div class="table-wrap">
            <div class="table-head">
                <span class="count-pill">Total results: <?php echo e($submissions->total()); ?></span>
                <span class="muted">Latest first</span>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Funnel</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Detailed Answers</th>
                        <th>Actions</th>

                    </tr>
                </thead>
                <tbody>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $submissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="mono"><?php echo e($s->created_at->format('Y-m-d H:i')); ?></td>
                        <td><?php echo e($s->funnel->title); ?></td>
                        <td><?php echo e($s->name); ?></td>
                        <td>
                            <a class="link" href="mailto:<?php echo e($s->email); ?>"><?php echo e($s->email); ?></a>
                        </td>
                        <td class="mono"><?php echo e($s->phone); ?></td>
                        
                        <td>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($s->answers->count() > 0): ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $s->answers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div style="margin-bottom: 4px;">
                                        <strong><?php echo e(Str::limit($answer->question->question_text, 20)); ?></strong><br>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($answer->answer_text): ?>
                                            <?php echo e(Str::limit($answer->answer_text, 20)); ?>

                                        <?php elseif($answer->answer_json): ?>
                                            <?php echo e(Str::limit(implode(', ', $answer->answer_json), 20)); ?>

                                        <?php else: ?>
                                            —
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php else: ?>
                                —
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </td>
                        <td>
                            <div style="display:flex;gap:10px;flex-wrap:wrap;">
                                <a class="btn" style="padding:8px 10px;" href="<?php echo e(route('admin.submissions.show', $s)); ?>">View</a>

                                <form method="POST" action="<?php echo e(route('admin.submissions.destroy', $s)); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="btn" style="padding:8px 10px;border:1px solid rgba(239,68,68,.22);background:rgba(239,68,68,.06);color:#991b1b;cursor:pointer;"
                                            onclick="return confirm('Delete this submission?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="muted" style="padding:18px;">
                            No submissions found for these filters.
                        </td>
                    </tr>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>

            <div class="pagination">
                <?php echo e($submissions->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.funnel', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\xampp\sale-funnal\resources\views/admin/submissions/index.blade.php ENDPATH**/ ?>