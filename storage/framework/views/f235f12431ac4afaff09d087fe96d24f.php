
<?php $__env->startSection('title', 'Thank You'); ?>

<?php $__env->startSection('content'); ?>
<div style="max-width:900px;margin:0 auto;padding:28px 18px;">
  <div style="background:#fff;border:1px solid rgba(0,0,0,.08);border-radius:18px;padding:18px;">
    <h1 style="margin:0;"><?php echo e($data['title'] ?: 'Thank you!'); ?></h1>
    

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($data['tag'])): ?>
      <div style="margin-top:12px;padding:16px;background:#f8fafc;border-radius:12px;border:1px solid #e2e8f0;">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($data['tag'] === 'IUL_Prospect'): ?>
          <p style="color:#1e293b;margin:0;font-weight:500;">You may qualify for a tax-advantaged strategy that offers growth, protection, and flexibility.</p>
        <?php elseif($data['tag'] === 'Term_Life_Prospect'): ?>
          <p style="color:#1e293b;margin:0;font-weight:500;">Protecting your family starts with affordable coverage tailored to your stage of life.</p>
        <?php elseif($data['tag'] === 'IRA_Rollover_Prospect'): ?>
          <p style="color:#1e293b;margin:0;font-weight:500;">Rolling over your retirement assets may reduce fees and improve control.</p>
        <?php elseif($data['tag'] === 'Annuity_Prospect'): ?>
          <p style="color:#1e293b;margin:0;font-weight:500;">Lifetime income options can help create certainty regardless of market conditions.</p>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <p style="color:#64748b;margin-top:10px;line-height:1.6;">We have received your request and we will get back to you soon.</p>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($data['tag'])): ?>
      <div style="margin-top:12px;color:#94a3b8;font-size:12px;">Tag: <?php echo e($data['tag']); ?></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.funnel', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\xampp\sale-funnal\resources\views/funnels/public/thanks_dynamic.blade.php ENDPATH**/ ?>