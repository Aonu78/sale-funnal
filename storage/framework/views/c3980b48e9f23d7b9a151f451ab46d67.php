
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

    <div style="color:#64748b;font-size:13px;">Step <?php echo e($step); ?> of <?php echo e($maxStep); ?></div>
    <h2 style="margin:12px 0 0;">See Your Personalized Options</h2>
    <p style="color:#64748b;margin-top:6px;">Based on your answers, we found strategies that may fit your situation.</p>

    <form method="POST" action="<?php echo e(route('funnels.step.save', [$funnel->slug, $step])); ?>" style="margin-top:12px;">
      <?php echo csrf_field(); ?>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
        <div>
          <label style="font-size:12px;color:#64748b;">First Name</label>
          <input name="first_name" value="<?php echo e(old('first_name')); ?>"
                 style="width:90%;padding:12px;border-radius:14px;border:1px solid rgba(0,0,0,.15);">
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div style="color:#b91c1c;font-size:12px;margin-top:6px;"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
        <div>
          <label style="font-size:12px;color:#64748b;">Phone</label>
          <input name="phone" value="<?php echo e(old('phone')); ?>"
                 style="width:90%;padding:12px;border-radius:14px;border:1px solid rgba(0,0,0,.15);">
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div style="color:#b91c1c;font-size:12px;margin-top:6px;"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
      </div>

      <div style="margin-top:12px;">
        <label style="font-size:12px;color:#64748b;">Email</label>
        <input name="email" type="email" value="<?php echo e(old('email')); ?>"
               style="width:95%;padding:12px;border-radius:14px;border:1px solid rgba(0,0,0,.15);">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div style="color:#b91c1c;font-size:12px;margin-top:6px;"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </div>
      <div style="margin-top:12px;">
        <label style="font-size:14px;color:#0f172a;font-weight:500;">Your Availability For 15-30 Minutes Slot</label>
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
        <div style="margin-top:8px;">
          <label style="font-size:12px;color:#64748b;">Select the date</label>
          <input name="preferred_call_date_from" type="date" value="<?php echo e(old('preferred_call_date_from')); ?>"
                 style="width:90%;padding:12px;border-radius:14px;border:1px solid rgba(0,0,0,.15);margin-top:4px;">
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['preferred_call_date_from'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div style="color:#b91c1c;font-size:12px;margin-top:6px;"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div style="margin-top:8px;">
          <label style="font-size:12px;color:#64748b;">Select time</label>
          <input name="preferred_call_date_to" type="time" value="<?php echo e(old('preferred_call_date_to')); ?>"
                 style="width:90%;padding:12px;border-radius:14px;border:1px solid rgba(0,0,0,.15);margin-top:4px;">
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['preferred_call_date_to'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div style="color:#b91c1c;font-size:12px;margin-top:6px;"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
      </div>

      <div style="margin-top:12px;">
        <label style="font-size:12px;color:#64748b;">Description (Optional)</label>
        <textarea name="call_availability_description" rows="3" placeholder="Please describe your availability..."
                  style="width:95%;padding:12px;border-radius:14px;border:1px solid rgba(0,0,0,.15);resize:vertical;"><?php echo e(old('call_availability_description')); ?></textarea>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['call_availability_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div style="color:#b91c1c;font-size:12px;margin-top:6px;"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </div>

      <button style="margin-top:14px;padding:12px 14px;border-radius:14px;border:none;color:#fff;background:#0f172a;cursor:pointer;width:100%;">
        👉 See My Personalized Options
      </button>
    </form>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.funnel', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\xampp\sale-funnal\resources\views/funnels/public/contact.blade.php ENDPATH**/ ?>