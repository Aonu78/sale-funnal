

<?php $__env->startSection('title', 'Edit Templates'); ?>

<?php $__env->startSection('content'); ?>
<style>
    :root{
        --bg:#f1f5f9;
        --text:#0f172a;
        --muted:#64748b;
        --card: rgba(255,255,255,.86);
        --stroke: rgba(15,23,42,.10);
        --shadow: 0 18px 55px rgba(15,23,42,.10);
        --shadow2: 0 10px 24px rgba(15,23,42,.08);
        --radius: 18px;
    }

    body{
        background:
            radial-gradient(1100px 360px at 18% 0%, rgba(37,99,235,.16), transparent 60%),
            radial-gradient(1000px 340px at 82% 0%, rgba(34,197,94,.12), transparent 60%),
            var(--bg);
        font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial, "Noto Sans";
        color: var(--text);
    }

    .wrap{
        max-width: 980px;
        margin: 0 auto;
        padding: 28px 16px 60px;
    }

    .header{
        display:flex;
        align-items:flex-end;
        justify-content:space-between;
        gap: 14px;
        flex-wrap: wrap;
        margin-bottom: 16px;
    }
    .header h1{
        margin: 0;
        font-size: 24px;
        letter-spacing: -.02em;
        font-weight: 900;
        line-height: 1.1;
    }
    .header p{
        margin: 6px 0 0;
        color: var(--muted);
        font-size: 13px;
        line-height: 1.5;
        max-width: 70ch;
    }

    .btn{
        display:inline-flex;
        align-items:center;
        justify-content:center;
        gap: 10px;
        padding: 10px 14px;
        border-radius: 14px;
        border: 1px solid rgba(255,255,255,.35);
        background: rgba(255,255,255,.55);
        color: var(--text);
        text-decoration:none;
        box-shadow: var(--shadow2);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        transition: transform .12s ease, box-shadow .12s ease, background .12s ease;
        font-weight: 800;
        font-size: 14px;
        white-space: nowrap;
    }
    .btn:hover{
        transform: translateY(-1px);
        box-shadow: 0 16px 40px rgba(15,23,42,.12);
        background: rgba(255,255,255,.72);
    }
    .btn-primary{
        color:#fff;
        border:none;
        background: linear-gradient(135deg, #2563eb, #22c55e);
        box-shadow: 0 18px 44px rgba(37,99,235,.22);
    }
    .btn-primary:hover{ box-shadow: 0 22px 52px rgba(37,99,235,.28); }

    .btn-dark{
        background: rgba(15,23,42,.92);
        color:#fff;
        border: 1px solid rgba(15,23,42,.25);
        box-shadow: 0 18px 44px rgba(15,23,42,.18);
    }
    .btn-dark:hover{ background: rgba(15,23,42,1); }

    .card{
        background: var(--card);
        border: 1px solid var(--stroke);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        overflow: hidden;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    .card-head{
        padding: 16px 18px;
        border-bottom: 1px solid rgba(15,23,42,.08);
        background: rgba(248,250,252,.50);
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap: 12px;
        flex-wrap: wrap;
    }

    .kicker{
        display:inline-flex;
        align-items:center;
        gap: 8px;
        font-size: 12px;
        font-weight: 900;
        letter-spacing: .08em;
        text-transform: uppercase;
        color: rgba(100,116,139,.95);
    }
    .dot{
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: rgba(99,102,241,.35);
        box-shadow: 0 0 0 6px rgba(99,102,241,.10);
    }

    .pill{
        display:inline-flex;
        align-items:center;
        gap: 8px;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 900;
        border: 1px solid rgba(15,23,42,.10);
        background: rgba(255,255,255,.55);
        color: rgba(15,23,42,.75);
        white-space: nowrap;
    }
    .pill code{
        font-weight: 900;
        font-size: 12px;
        color: rgba(15,23,42,.75);
    }

    .card-body{ padding: 18px; }

    .grid{
        display:grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }
    @media (max-width: 860px){
        .grid{ grid-template-columns: 1fr; }
    }

    .field label{
        display:block;
        font-size: 12px;
        color: rgba(100,116,139,.95);
        font-weight: 900;
        letter-spacing: .06em;
        text-transform: uppercase;
        margin: 0 0 8px;
    }

    .control{
        width: 95%;
        padding: 12px 12px;
        border-radius: 14px;
        border: 1px solid rgba(15,23,42,.12);
        background: rgba(255,255,255,.70);
        outline: none;
        transition: border-color .12s ease, box-shadow .12s ease, background .12s ease;
        font-size: 14px;
        color: rgba(15,23,42,.92);
        box-shadow: 0 8px 18px rgba(15,23,42,.05);
    }
    .control:focus{
        border-color: rgba(37,99,235,.45);
        box-shadow: 0 0 0 4px rgba(37,99,235,.12), 0 12px 26px rgba(15,23,42,.08);
        background: rgba(255,255,255,.92);
    }
    textarea.control{
        min-height: 120px;
        resize: vertical;
    }

    .hint{
        margin-top: 8px;
        font-size: 12px;
        color: rgba(100,116,139,.95);
        line-height: 1.5;
    }
    .error{
        margin-top: 8px;
        font-size: 12px;
        color: #b91c1c;
        font-weight: 700;
    }

    .check{
        display:flex;
        align-items:center;
        gap: 10px;
        padding: 12px 12px;
        border-radius: 14px;
        border: 1px solid rgba(15,23,42,.10);
        background: rgba(255,255,255,.55);
        box-shadow: 0 10px 22px rgba(15,23,42,.06);
        width: fit-content;
    }
    .check input{
        width: 18px;
        height: 18px;
        accent-color: #2563eb;
        cursor: pointer;
    }
    .check span{
        font-size: 14px;
        font-weight: 800;
        color: rgba(15,23,42,.90);
    }

    .actions{
        display:flex;
        justify-content:flex-end;
        gap: 10px;
        flex-wrap: wrap;
        padding-top: 16px;
        border-top: 1px solid rgba(15,23,42,.08);
        margin-top: 8px;
    }
</style>

<div class="wrap">
    <div class="header">
        <div>
            <h1>Edit Email Template</h1>
            <p>Update the subject, body, and variables. Keep templates consistent and easy to reuse across flows.</p>
        </div>

        <a href="<?php echo e(route('admin.email-templates.index')); ?>" class="btn">
            ← Back to Templates
        </a>
    </div>

    <form method="POST" action="<?php echo e(route('admin.email-templates.update', $emailTemplate)); ?>" class="card">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="card-head">
            <span class="kicker"><span class="dot"></span> Editing Template</span>
            <span class="pill">
                ID: <code>#<?php echo e($emailTemplate->id ?? '—'); ?></code>
            </span>
        </div>

        <div class="card-body">
            <div class="grid">
                <div class="field">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name"
                           value="<?php echo e(old('name', $emailTemplate->name)); ?>"
                           class="control"
                           placeholder="e.g., Welcome Email"
                           required>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="error"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div class="field">
                    <label for="category">Category</label>
                    <input type="text" name="category" id="category"
                           value="<?php echo e(old('category', $emailTemplate->category)); ?>"
                           class="control"
                           placeholder="e.g., Onboarding / Billing / Support">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="error"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>

            <div class="field" style="margin-top:14px;">
                <label for="subject">Subject</label>
                <input type="text" name="subject" id="subject"
                       value="<?php echo e(old('subject', $emailTemplate->subject)); ?>"
                       class="control"
                       placeholder="e.g., Welcome, <?php echo e($emailTemplate->name); ?> !"
                       required>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <div class="field" style="margin-top:14px;">
                <label for="body">Body</label>
                <textarea name="body" id="body" rows="10"
                          class="control"
                          placeholder="Write the email body here..."
                          required><?php echo e(old('body', $emailTemplate->body)); ?></textarea>
                <div class="hint">
                    Tip: Use variables like <strong>Name</strong> or <strong>abc@gmail.com</strong> if your system replaces them.
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['body'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <div class="grid" style="margin-top:14px;">
                <div class="field">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" rows="3"
                              class="control"
                              placeholder="Internal notes (optional)"><?php echo e(old('description', $emailTemplate->description)); ?></textarea>
                    <div class="hint">Admin-only notes to help your team understand where this template is used.</div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="error"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div class="field">
                    <label for="variables">Variables (JSON)</label>
                    <textarea name="variables" id="variables" rows="3"
                              class="control"
                              placeholder='["name","email"]'><?php echo e(old('variables', is_string($emailTemplate->variables) ? $emailTemplate->variables : json_encode($emailTemplate->variables))); ?></textarea>
                    <div class="hint">
                        JSON array of supported variables (optional). Example: <code>["name","email"]</code>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['variables'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="error"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>

            <div style="margin-top:14px;">
                <label class="check">
                    <input type="checkbox" name="is_active" value="1" <?php echo e(old('is_active', $emailTemplate->is_active) ? 'checked' : ''); ?>>
                    <span>Active</span>
                </label>
                <div class="hint">Inactive templates won’t be available for sending (if your app enforces status).</div>
            </div>

            <div class="actions">
                <a href="<?php echo e(route('admin.email-templates.index')); ?>" class="btn btn-dark">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    Update Template
                </button>
            </div>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.funnel', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\xampp\sale-funnal\resources\views/admin/email-templates/edit.blade.php ENDPATH**/ ?>