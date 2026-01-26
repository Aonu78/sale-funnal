
<?php $__env->startSection('title', $funnel->seo_title ?: $funnel->title); ?>
<?php $__env->startSection('meta_description', $funnel->seo_description ?: ''); ?>

<?php $__env->startSection('content'); ?>
<div style="max-width:900px;margin:0 auto;padding:28px 18px;">
    <div style="background:#fff;border:1px solid rgba(0,0,0,.08);border-radius:18px;padding:18px;">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($funnel->hero_image_path)): ?>
    <img
        src="<?php echo e(asset($funnel->hero_image_path)); ?>"
        alt="Hero"
        style="width:100%;max-height:320px;object-fit:cover;border-radius:16px;margin-bottom:14px;"
    >
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <h1 style="margin:0;"><?php echo e($funnel->title); ?></h1>
    <p style="color:#64748b;margin-top:10px;"><?php echo e($funnel->seo_description); ?></p>

    <form method="POST" action="<?php echo e(route('funnels.start', $funnel->slug)); ?>">
      <?php echo csrf_field(); ?>
      <button style="margin-top:14px;padding:12px 14px;border-radius:14px;border:none;color:#fff;background:#0f172a;cursor:pointer;">
        👉 Get Started (30 seconds)
      </button>
    </form>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($funnel->footer_text): ?>
      <p style="margin-top:14px;color:#94a3b8;font-size:12px;"><?php echo e($funnel->footer_text); ?></p>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.funnel', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\xampp\sale-funnal\resources\views/funnels/public/landing.blade.php ENDPATH**/ ?>