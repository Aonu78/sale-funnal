
<?php $__env->startSection('title', 'Questions'); ?>

<?php $__env->startSection('content'); ?>
<style>
  .page{max-width:1100px;margin:0 auto;padding:28px 18px;font-family:ui-sans-serif,system-ui;}
  .card{background:#fff;border:1px solid rgba(0,0,0,.08);border-radius:18px;box-shadow:0 16px 40px rgba(0,0,0,.08);overflow:hidden}
  .top{display:flex;justify-content:space-between;gap:10px;flex-wrap:wrap;align-items:center;margin-bottom:14px}
  .btn{display:inline-flex;align-items:center;gap:8px;padding:10px 14px;border-radius:12px;border:1px solid rgba(0,0,0,.12);background:#fff;text-decoration:none;color:#111;box-shadow:0 8px 20px rgba(0,0,0,.06)}
  .btn-dark{background:#0f172a;color:#fff;border-color:rgba(15,23,42,.25)}
  .btn-primary{background:linear-gradient(135deg,#2563eb,#22c55e);color:#fff;border:none}
  .notice{padding:12px 16px;border-bottom:1px solid rgba(0,0,0,.08);font-size:13px;background:rgba(34,197,94,.08);color:#166534}
  table{width:100%;border-collapse:separate;border-spacing:0 10px;padding:14px 16px}
  thead th{font-size:12px;color:#64748b;text-transform:uppercase;letter-spacing:.03em;text-align:left;padding:0 10px 6px}
  tbody tr{background:#fff;border:1px solid rgba(0,0,0,.08);box-shadow:0 10px 24px rgba(0,0,0,.06)}
  tbody td{padding:12px 10px;border-top:1px solid rgba(0,0,0,.06);border-bottom:1px solid rgba(0,0,0,.06);font-size:14px}
  tbody tr td:first-child{border-left:1px solid rgba(0,0,0,.06);border-top-left-radius:14px;border-bottom-left-radius:14px}
  tbody tr td:last-child{border-right:1px solid rgba(0,0,0,.06);border-top-right-radius:14px;border-bottom-right-radius:14px}
  .pill{display:inline-flex;padding:6px 10px;border-radius:999px;font-size:12px;border:1px solid rgba(0,0,0,.12);background:rgba(0,0,0,.04)}
  .mono{font-family:ui-monospace,Menlo,Consolas,monospace;font-size:12px;color:#334155}
  .row-actions{display:flex;gap:10px;flex-wrap:wrap}
  .danger{border:1px solid rgba(239,68,68,.22);background:rgba(239,68,68,.06);color:#991b1b;cursor:pointer;padding:9px 12px;border-radius:12px}
</style>

<div class="page">
  <div class="top">
    <div>
      <h2 style="margin:0;">Questions Builder</h2>
      <div style="color:#64748b;font-size:13px;margin-top:4px;">
        Funnel: <strong><?php echo e($funnel->title); ?></strong> <span class="mono">/f/<?php echo e($funnel->slug); ?></span>
      </div>
    </div>
    <div style="display:flex;gap:10px;flex-wrap:wrap;">
      <a class="btn" href="<?php echo e(route('admin.funnels.index')); ?>">Back</a>
      <a class="btn btn-dark" href="<?php echo e(route('admin.funnels.rules.index', $funnel)); ?>">Routing Rules</a>
      <a class="btn btn-primary" href="<?php echo e(route('admin.funnels.questions.create', $funnel)); ?>">+ Add Question</a>
    </div>
  </div>

  <div class="card">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
      <div class="notice"><?php echo e(session('success')); ?></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <table>
      <thead>
        <tr>
          <th>Order</th>
          <th>Key</th>
          <th>Label</th>
          <th>Type</th>
          <th>Required</th>
          <th>Active</th>
          <th>Options</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td class="mono"><?php echo e($q->sort_order); ?></td>
          <td class="mono"><?php echo e($q->key ?: '—'); ?></td>
          <td><strong><?php echo e($q->label); ?></strong></td>
          <td><span class="pill"><?php echo e($q->type); ?></span></td>
          <td><?php echo e($q->is_required ? 'Yes' : 'No'); ?></td>
          <td><?php echo e($q->is_active ? 'Yes' : 'No'); ?></td>
          <td>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(in_array($q->type, ['radio','checkbox'])): ?>
              <a class="btn" style="padding:8px 10px;" href="<?php echo e(route('admin.questions.options.index', $q)); ?>">
                Manage (<?php echo e($q->options_count); ?>)
              </a>
            <?php else: ?>
              <span class="mono">N/A</span>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          </td>
          <td>
            <div class="row-actions">
              <a class="btn" style="padding:8px 10px;" href="<?php echo e(route('admin.funnels.questions.edit', [$funnel, $q])); ?>">Edit</a>
              <form method="POST" action="<?php echo e(route('admin.funnels.questions.destroy', [$funnel, $q])); ?>">
                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                <button class="danger" type="submit" onclick="return confirm('Delete this question?')">Delete</button>
              </form>
            </div>
          </td>
        </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="8" style="padding:18px;color:#64748b;">No questions yet. Add your first question.</td></tr>
      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.funnel', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\xampp\sale-funnal\resources\views/admin/questions/index.blade.php ENDPATH**/ ?>