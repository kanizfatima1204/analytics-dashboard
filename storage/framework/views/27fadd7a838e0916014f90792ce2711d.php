<?php $__env->startSection('body'); ?>
<div class="auth-shell">
    <div class="auth-card">
        <div class="brand auth-brand"><div class="brand-mark">P</div><div><strong>Pulse</strong><span>Analytics</span></div></div>
        <div class="auth-copy"><span class="eyebrow">BUSINESS INTELLIGENCE</span><h1>Sign in to your dashboard</h1><p>Use the demo account below to explore the complete analytics experience.</p></div>
        <?php if(session('status')): ?><div class="alert success"><?php echo e(session('status')); ?></div><?php endif; ?>
        <?php if($errors->any()): ?><div class="alert error"><?php echo e($errors->first()); ?></div><?php endif; ?>
        <form method="POST" action="<?php echo e(route('login.store')); ?>" class="auth-form">
            <?php echo csrf_field(); ?>
            <label>Email<input type="email" name="email" value="<?php echo e(old('email', 'admin@example.com')); ?>" required autocomplete="email"></label>
            <label>Password<input type="password" name="password" value="password" required autocomplete="current-password"></label>
            <label class="remember"><input type="checkbox" name="remember" value="1"> Remember me</label>
            <button class="primary-btn" type="submit">Sign in</button>
        </form>
        <div class="demo-box"><strong>Demo credentials</strong><span>admin@example.com</span><span>password</span></div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['title' => 'Login — Pulse Analytics'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\My Projects\advanced-analytics-dashboard-laravel12\laravel12-analytics-dashboard\resources\views/auth/login.blade.php ENDPATH**/ ?>