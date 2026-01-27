

<?php $__env->startSection('title', 'Submission Details'); ?>

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
    .page{max-width:900px;margin:0 auto;padding:28px 18px;}
    .topbar{display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;margin-bottom:14px;}
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
    .btn-danger{
        border:1px solid rgba(239,68,68,.22);
        background:rgba(239,68,68,.06);
        color:#991b1b;
        cursor:pointer;
        padding:10px 14px;border-radius:12px;
        box-shadow:0 8px 20px rgba(15,23,42,.06);
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
    .box{
        border:1px solid rgba(15,23,42,.08);
        background:#fff;
        border-radius:16px;
        padding:14px;
        box-shadow:0 10px 24px rgba(15,23,42,.06);
    }
    .label{color:#64748b;font-size:12px;margin-bottom:6px;}
    .value{font-size:14px;}
    .mono{font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;}
</style>

<div class="page">
    <div class="topbar">
        <div>
            <h2 style="margin:0;">Submission Details</h2>
            <div style="color:#64748b;font-size:13px;margin-top:4px;">
                Funnel: <strong><?php echo e($submission->funnel->title); ?></strong>
            </div>
        </div>

        <div style="display:flex;gap:10px;flex-wrap:wrap;">
            <a class="btn" href="<?php echo e(route('admin.submissions.index')); ?>">Back</a>
            <form method="POST" action="<?php echo e(route('admin.submissions.destroy', $submission)); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button class="btn-danger" type="submit" onclick="return confirm('Delete this submission?')">
                    Delete
                </button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="content">
            <div class="grid">
                <div class="box">
                    <div class="label">Date</div>
                    <div class="value mono"><?php echo e($submission->created_at->format('Y-m-d H:i:s')); ?></div>
                </div>

                <div class="box">
                    <div class="label">Answer</div>
                    <div class="value"><?php echo e($submission->question_answer ?: '—'); ?></div>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($submission->answers->count() > 0): ?>
                <div class="box" style="grid-column: span 2;">
                    <div class="label">Detailed Answers</div>
                    <div class="value">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $submission->answers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div style="margin-bottom: 8px;">
                                <strong><?php echo e($answer->question->question_text); ?></strong><br>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($answer->answer_text): ?>
                                    <?php echo e($answer->answer_text); ?>

                                <?php elseif($answer->answer_json): ?>
                                    <?php echo e(implode(', ', $answer->answer_json)); ?>

                                <?php else: ?>
                                    —
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <div class="box">
                    <div class="label">Name</div>
                    <div class="value"><?php echo e($submission->name); ?></div>
                </div>

                <div class="box">
                    <div class="label">Email</div>
                    <div class="value"><a href="mailto:<?php echo e($submission->email); ?>"><?php echo e($submission->email); ?></a></div>
                </div>

                <div class="box">
                    <div class="label">Phone</div>
                    <div class="value mono"><?php echo e($submission->phone); ?></div>
                </div>

                <div class="box">
                    <div class="label">IP Address</div>
                    <div class="value mono"><?php echo e($submission->ip_address ?: '—'); ?></div>
                </div>

                <div class="box" style="grid-column: span 2;">
                    <div class="label">User Agent</div>
                    <div class="value mono" style="word-break:break-word;"><?php echo e($submission->user_agent ?: '—'); ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.funnel', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\xampp\sale-funnal\resources\views/admin/submissions/show.blade.php ENDPATH**/ ?>