<?php $v->layout('_theme'); ?>

<?php if ($users): 
    foreach ($users as $user): ?>
        <div class="user-card">
            <?= $user->fullName; ?>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="text-muted">No data find..</div>
<?php endif; ?>