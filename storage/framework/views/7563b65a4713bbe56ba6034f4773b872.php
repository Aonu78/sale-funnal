
<?php $__env->startSection('title', 'Edit Question'); ?>

<?php $__env->startSection('content'); ?>
<style>
  .page{max-width:900px;margin:0 auto;padding:28px 18px;font-family:ui-sans-serif,system-ui;}
  .card{background:#fff;border:1px solid rgba(0,0,0,.08);border-radius:18px;box-shadow:0 16px 40px rgba(0,0,0,.08);padding:18px}
  .grid{display:grid;grid-template-columns:1fr 1fr;gap:12px}
  @media(max-width:800px){.grid{grid-template-columns:1fr}}
  .label{display:block;font-size:12px;color:#64748b;margin:0 0 6px}
  .input,.select,.textarea{width:85%;padding:12px;border-radius:14px;border:1px solid rgba(0,0,0,.15)}
  .textarea{min-height:110px}
  .btn{display:inline-flex;align-items:center;gap:8px;padding:10px 14px;border-radius:12px;border:1px solid rgba(0,0,0,.12);background:#fff;text-decoration:none;color:#111}
  .btn-primary{background:linear-gradient(135deg,#2563eb,#22c55e);color:#fff;border:none}
  .err{color:#b91c1c;font-size:12px;margin-top:6px}
  .hint{font-size:12px;color:#64748b;margin-top:8px}
</style>

<div class="page">
  <h2 style="margin:0 0 10px;">Edit Question</h2>

  <div class="card">
    <form method="POST" action="<?php echo e(route('admin.funnels.questions.update', [$funnel, $question])); ?>">
      <?php echo csrf_field(); ?>
      <?php echo method_field('PUT'); ?>

      <div class="grid">
        <div>
          <label class="label">Sort Order</label>
          <input class="input" name="sort_order" type="number" min="1" value="<?php echo e(old('sort_order', $question->sort_order)); ?>">
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['sort_order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="err"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div>
          <label class="label">Key (for routing)</label>
          <input class="input" name="key" value="<?php echo e(old('key', $question->key)); ?>">
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="err"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          <div class="hint">Routing rules use question_key (example: <strong>age_range</strong>, <strong>goal</strong>).</div>
        </div>

        <div style="grid-column: span 2;">
          <label class="label">Label</label>
          <input class="input" name="label" value="<?php echo e(old('label', $question->label)); ?>">
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['label'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="err"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div style="grid-column: span 2;">
          <label class="label">Help Text</label>
          <textarea class="textarea" name="help_text"><?php echo e(old('help_text', $question->help_text)); ?></textarea>
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['help_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="err"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div>
          <label class="label">Type</label>
          <select class="select" name="type">
            <option value="radio" <?php echo e(old('type',$question->type)==='radio'?'selected':''); ?>>Radio (single)</option>
            <option value="checkbox" <?php echo e(old('type',$question->type)==='checkbox'?'selected':''); ?>>Checkbox (multi)</option>
            <option value="text" <?php echo e(old('type',$question->type)==='text'?'selected':''); ?>>Text</option>
          </select>
        </div>

        <div>
          <label class="label">Flags</label>
          <label style="display:flex;gap:10px;align-items:center;margin-top:8px;">
            <input type="checkbox" name="is_required" value="1" <?php echo e(old('is_required',$question->is_required) ? 'checked' : ''); ?>>
            Required
          </label>
          <label style="display:flex;gap:10px;align-items:center;margin-top:8px;">
            <input type="checkbox" name="is_active" value="1" <?php echo e(old('is_active',$question->is_active) ? 'checked' : ''); ?>>
            Active
          </label>
        </div>
      </div>

      <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:space-between;margin-top:14px;">
        <a class="btn" href="<?php echo e(route('admin.funnels.questions.index', $funnel)); ?>">Back</a>

        <div style="display:flex;gap:10px;flex-wrap:wrap;">
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(in_array($question->type, ['radio','checkbox'])): ?>
            <a class="btn" href="<?php echo e(route('admin.questions.options.index', $question)); ?>">Manage Options</a>
          <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          <button class="btn btn-primary" type="submit">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.funnel', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\xampp\sale-funnal\resources\views/admin/questions/edit.blade.php ENDPATH**/ ?>