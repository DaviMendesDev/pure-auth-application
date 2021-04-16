<?php $v->layout('_theme'); ?>

<div class="login-form">
    <div class="form-title">
        Login
    </div>

    <form action="<?= url('/login'); ?>" method="post">
        <input type="text" name="email" placeholder="Email" />
        <input type="password" name="password" placeholder="Password" />

        <?php if (session()->has('failed_login')): ?>
            <div class="text-error"> <?= session()->pull('failed_login') ?> </div>
        <?php endif; ?>
        
        <div class="separator"></div>
        <div class="labed-input">
            <input type="checkbox" name="remember_me" id="remember_me"> 
            <label for="remember_me"> Remember me. </label>
        </div>

        <div class="form-buttons">
            <input type="submit" value="Confirm" />
            <input type="reset" value="Reset">
        </div>
    </form>
</div>