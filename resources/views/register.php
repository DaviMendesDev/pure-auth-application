<?php $v->layout('_theme'); ?>

<div class="register-form">
    <div class="form-title">
        Register
    </div>

    <form action="<?= url('/register'); ?>" method="post">
        <input type="text" name="first_name" placeholder="First name" />
        <input type="text" name="last_name" placeholder="Last name" />
        <input type="text" name="email" placeholder="Email" />
        <input type="password" name="password" placeholder="Password" />
        <input type="password" name="password_confirmation" placeholder="Password" />
        
        <div class="separator"></div>

        <?php if (session()->has('failed_register')): ?>
            <div class="text-error"> <?= session()->pull('failed_register') ?> </div>
        <?php endif; ?>

        <div class="form-buttons">
            <input type="submit" value="Confirm" />
            <input type="reset" value="Reset">
        </div>
    </form>
</div>