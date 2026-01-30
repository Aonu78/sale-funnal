
<?php $__env->startSection('title', $funnel->title); ?>

<?php $__env->startSection('content'); ?>
<div style="max-width:900px;margin:0 auto;padding:28px 18px;">
  <div style="background:#fff;border:1px solid rgba(0,0,0,.08);border-radius:18px;padding:18px;">

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($funnel->hero_image_path)): ?>
    <img
        src="<?php echo e(asset($funnel->hero_image_path)); ?>"
        alt="Hero"
        style="width:100%;max-height:160px;object-fit:cover;border-radius:16px;margin-bottom:12px;"
    >
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <div style="display:flex;justify-content:space-between;gap:10px;flex-wrap:wrap;">
      <div style="color:#64748b;font-size:13px;">Step <?php echo e($step); ?> of <?php echo e($maxStep); ?></div>
      <div style="color:#64748b;font-size:13px;"><?php echo e($funnel->title); ?></div>
    </div>
    <h2 style="margin:12px 0 0;"><?php echo e($question->label); ?></h2>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($question->help_text): ?>
      <p style="color:#64748b;margin-top:6px;"><?php echo e($question->help_text); ?></p>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <form method="POST" action="<?php echo e(route('funnels.step.save', [$funnel->slug, $step])); ?>" style="margin-top:12px;">
      <?php echo csrf_field(); ?>

      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($question->type === 'text'): ?>
        <input name="answer" value="<?php echo e(old('answer', $value)); ?>" placeholder="Type here..."
              _toggle=""
               style="width:100%;padding:12px;border-radius:14px;border:1px solid rgba(0,0,0,.15);">
      <?php elseif($question->type === 'checkbox'): ?>
        <div style="display:grid;gap:10px;margin-top:10px;">
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $question->options->where('is_active', true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
              $old = old('answer', is_array($value) ? $value : []);
            ?>
            <label style="display:flex;gap:10px;align-items:center;padding:10px;border:1px solid rgba(0,0,0,.12);border-radius:14px;">
              <input type="checkbox" name="answer[]" value="<?php echo e($opt->label); ?>" <?php echo e(in_array($opt->label, $old ?? [], true) ? 'checked' : ''); ?>>
              <span><?php echo e($opt->label); ?></span>
            </label>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
      <?php elseif($question->type === 'dropdown'): ?>
        <select name="answer" style="width:100%;padding:12px;border-radius:14px;border:1px solid rgba(0,0,0,.15);">
          <option value="">Select an option...</option>
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $question->options->where('is_active', true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($opt->label); ?>" <?php echo e(old('answer', $value)===$opt->label ? 'selected' : ''); ?>><?php echo e($opt->label); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </select>
      <?php else: ?>
        <div style="display:grid;gap:10px;margin-top:10px;">
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $question->options->where('is_active', true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <label style="display:flex;gap:10px;align-items:center;padding:10px;border:1px solid rgba(0,0,0,.12);border-radius:14px;">
              <input type="radio" name="answer" value="<?php echo e($opt->label); ?>" <?php echo e(old('answer', $value)===$opt->label ? 'checked' : ''); ?>>
              <span><?php echo e($opt->label); ?></span>
            </label>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['answer'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div style="color:#b91c1c;font-size:12px;margin-top:8px;"><?php echo e($message); ?></div>
      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

      <button style="margin-top:14px;padding:12px 14px;border-radius:14px;border:none;color:#fff;background:#0f172a;cursor:pointer;">
        Next →
      </button>
    </form>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.funnel', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\xampp\sale-funnal\resources\views/funnels/public/step.blade.php ENDPATH**/ ?>