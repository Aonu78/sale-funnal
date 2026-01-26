
<?php $__env->startSection('title', 'Thank You'); ?>

<?php $__env->startSection('content'); ?>
<div style="max-width:900px;margin:0 auto;padding:28px 18px;">
  <div style="background:#fff;border:1px solid rgba(0,0,0,.08);border-radius:18px;padding:18px;">
    <h1 style="margin:0;"><?php echo e($data['title'] ?: 'Thank you!'); ?></h1>
    <p style="color:#64748b;margin-top:10px;line-height:1.6;"><?php echo e($data['body'] ?: 'We received your request.'); ?></p>

    <div style="margin-top:14px;">
      <a href="<?php echo e(url('/dashboard')); ?>" style="text-decoration:none;color:#2563eb;">Go to Dashboard</a>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($data['tag'])): ?>
      <div style="margin-top:12px;color:#94a3b8;font-size:12px;">Tag: <?php echo e($data['tag']); ?></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.funnel', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\xampp\sale-funnal\resources\views/funnels/public/thanks_dynamic.blade.php ENDPATH**/ ?>