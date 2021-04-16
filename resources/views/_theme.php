<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= url('/resources/public/style.css') ?>">
    <title><?= $title; ?></title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <nav>
        <ul>
            <li class="app-title">
                <a href="<?= url(); ?>">
                    <?= app('name'); ?>
                </a>
            </li>
            <li>
                <ul>
                <?php if(auth()->check()): ?>
                    <li>
                        <a href="<?= url('/view'); ?>">
                            <?= auth()->user()->fullName; ?>
                        </a>
                    </li>
                    <li>
                        <form action="<?= url('/logout'); ?>" method="post">
                            <a href="#">
                                <button type="submit">
                                    logout
                                </button>
                            </a>
                        </form>
                    </li>
                <?php endif; ?>
                </ul>
            </li>
        </ul>
    </nav>

    <main>
        <?php if (session()->has('message')): ?>
            <div class="message-<?= session()->get('type'); ?>"> <?= session()->get('message') ?> </div>
        <?php endif; ?>
        <?= $v->section('content'); ?>
    </main>
    
    <footer>
        This is the footer
    </footer>
</body>
</html>