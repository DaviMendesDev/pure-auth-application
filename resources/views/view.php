<?php $v->layout('_theme'); ?>

<div class="register-form">
    <div class="form-title">
        <?= auth()->user()->fullName; ?>
    </div>

    <form action="<?= url('/edit'); ?>" method="post">
        <input id="first_name" type="text" name="first_name" placeholder="First name" disabled="true" value="<?= auth()->user()->first_name; ?>" />
        <input id="last_name" type="text" name="last_name" placeholder="Last name" disabled="true" value="<?= auth()->user()->last_name; ?>" />
        <input type="text" name="email" placeholder="Email" disabled="true" value="<?= auth()->user()->email; ?>" />
        
        <div class="separator"></div>

        <?php if (session()->has('failed_edit')): ?>
            <div class="text-error"> <?= session()->pull('failed_edit') ?> </div>
        <?php endif; ?>

        <div class="form-buttons">
            <input id="edit_button" type="submit" value="Edit" />
            <input id="submit_button" type="submit" value="Confirm" disabled="true">
        </div>
    </form>
</div>

<script>
    let isDisabled = false;

    $(document).ready(function () {
        $('#edit_button').click(function (e) {
            e.preventDefault();

            $('#first_name').attr('disabled', isDisabled);
            $('#last_name').attr('disabled', isDisabled);
            $('#submit_button').attr('disabled', isDisabled);

            $(this).val(isDisabled ? 'Edit' : 'Cancel' );
            isDisabled = !isDisabled;
        });
    });
</script>