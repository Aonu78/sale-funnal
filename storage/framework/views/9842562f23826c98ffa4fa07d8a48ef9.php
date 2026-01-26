
<?php $__env->startSection('title', 'Options'); ?>

<?php $__env->startSection('content'); ?>
<style>
  .page{max-width:1000px;margin:0 auto;padding:28px 18px;font-family:ui-sans-serif,system-ui;}
  .card{background:#fff;border:1px solid rgba(0,0,0,.08);border-radius:18px;box-shadow:0 16px 40px rgba(0,0,0,.08);overflow:hidden}
  .top{display:flex;justify-content:space-between;gap:10px;flex-wrap:wrap;align-items:center;margin-bottom:14px}
  .btn{display:inline-flex;align-items:center;gap:8px;padding:10px 14px;border-radius:12px;border:1px solid rgba(0,0,0,.12);background:#fff;text-decoration:none;color:#111}
  .btn-primary{background:linear-gradient(135deg,#2563eb,#22c55e);color:#fff;border:none}
  .danger{border:1px solid rgba(239,68,68,.22);background:rgba(239,68,68,.06);color:#991b1b;cursor:pointer;padding:9px 12px;border-radius:12px}
  .notice{padding:12px 16px;border-bottom:1px solid rgba(0,0,0,.08);font-size:13px;background:rgba(34,197,94,.08);color:#166534}
  .input{width:85%;padding:10px 12px;border-radius:12px;border:1px solid rgba(0,0,0,.15)}
  table{width:100%;border-collapse:separate;border-spacing:0 10px;padding:14px 16px}
  thead th{font-size:12px;color:#64748b;text-transform:uppercase;letter-spacing:.03em;text-align:left;padding:0 10px 6px}
  tbody tr{background:#fff;border:1px solid rgba(0,0,0,.08);box-shadow:0 10px 24px rgba(0,0,0,.06)}
  tbody td{padding:10px;border-top:1px solid rgba(0,0,0,.06);border-bottom:1px solid rgba(0,0,0,.06)}
  tbody tr td:first-child{border-left:1px solid rgba(0,0,0,.06);border-top-left-radius:14px;border-bottom-left-radius:14px}
  tbody tr td:last-child{border-right:1px solid rgba(0,0,0,.06);border-top-right-radius:14px;border-bottom-right-radius:14px}
</style>

<div class="page">
  <div class="top">
    <div>
      <h2 style="margin:0;">Options</h2>
      <div style="color:#64748b;font-size:13px;margin-top:4px;">
        Question: <strong><?php echo e($question->label); ?></strong>
      </div>
    </div>
    <div style="display:flex;gap:10px;flex-wrap:wrap;">
      <a class="btn" href="<?php echo e(route('admin.funnels.questions.index', $question->funnel)); ?>">Back to Questions</a>
    </div>
  </div>

  <div class="card">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
      <div class="notice"><?php echo e(session('success')); ?></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div style="padding:14px 16px;border-bottom:1px solid rgba(0,0,0,.08);">
      <form method="POST" action="<?php echo e(route('admin.questions.options.store', $question)); ?>" style="display:grid;grid-template-columns: 120px 1fr 1fr 120px 120px;gap:10px;align-items:end;">
        <?php echo csrf_field(); ?>
        <div>
          <label style="font-size:12px;color:#64748b;">Order</label>
          <input class="input" type="number" min="1" name="sort_order" value="<?php echo e(old('sort_order', 1)); ?>">
        </div>
        <div>
          <label style="font-size:12px;color:#64748b;">Label</label>
          <input class="input" name="label" value="<?php echo e(old('label')); ?>" placeholder="Planning a secure retirement">
        </div>
        <div>
          <label style="font-size:12px;color:#64748b;">Value (optional)</label>
          <input class="input" name="value" value="<?php echo e(old('value')); ?>" placeholder="retirement">
        </div>
        <div>
          <label style="font-size:12px;color:#64748b;">Active</label>
          <label style="display:flex;gap:10px;align-items:center;margin-top:8px;">
            <input type="checkbox" name="is_active" value="1" checked> Yes
          </label>
        </div>
        <button class="btn btn-primary" type="submit">Add</button>
      </form>
    </div>

    <table>
      <thead>
        <tr>
          <th>Order</th>
          <th>Label</th>
          <th>Value</th>
          <th>Active</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td style="width:110px;">
            <form method="POST" action="<?php echo e(route('admin.questions.options.update', [$question, $opt])); ?>">
              <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
              <input class="input" type="number" min="1" name="sort_order" value="<?php echo e($opt->sort_order); ?>">
          </td>
          <td>
              <input class="input" name="label" value="<?php echo e($opt->label); ?>">
          </td>
          <td>
              <input class="input" name="value" value="<?php echo e($opt->value); ?>">
          </td>
          <td style="width:120px;">
              <label style="display:flex;gap:10px;align-items:center;">
                <input type="checkbox" name="is_active" value="1" <?php echo e($opt->is_active ? 'checked' : ''); ?>>
                Active
              </label>
          </td>
          <td style="width:220px;">
              <div style="display:flex;gap:10px;flex-wrap:wrap;">
                <button class="btn" type="submit">Save</button>
            </form>

                <form method="POST" action="<?php echo e(route('admin.questions.options.destroy', [$question, $opt])); ?>">
                  <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                  <button class="danger" type="submit" onclick="return confirm('Delete option?')">Delete</button>
                </form>
              </div>
          </td>
        </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="5" style="padding:18px;color:#64748b;">No options yet. Add options above.</td></tr>
      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.funnel', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\xampp\sale-funnal\resources\views/admin/options/index.blade.php ENDPATH**/ ?>