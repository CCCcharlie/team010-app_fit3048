
<?php
/**
 * Login layout
 *
 * This layout comes with no navigation bar and Flash renderer placeholder. Usually used for login page or similar.
 *
 * @var \App\View\AppView $this
 */

use Cake\Core\Configure;

$appLocale = Configure::read('App.defaultLocale');
?>
<!DOCTYPE html>
<html lang="<?= $appLocale ?>">
<head>
    <?= $this->Html->charset() ?>

<!--   -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!--    -->
    <title>
        <?= $this->fetch('title') ?> GamBlock® - Customer Management
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <link rel="stylesheet" href="/webroot/css/bootstrap.min.css">
    <link href="/webroot/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="/webroot/css/style.css">
    <link rel="stylesheet" href="../assets/vendor/fonts/fontawesome/css/fontawesome-all.css">

    <?= $this->Html->css(['bootstrap.min.css', 'style.css', 'cake']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

<!---->
    <style>
        html,
        body {
            height: 100%;
            width: 100%;
        }

        body {
            /*display: -ms-flexbox ;*/
            /*display: flex;*/
            -ms-flex-align: center;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
        }
    </style>
</head>
<body>

<main class="main">
    <?= $this->fetch('content') ?>
</main>
<footer>
    <!--    --><?php //= $this->element('footer_copyright'); ?>
    <script src="/webroot/js/jquery-3.3.1.min.js"></script>
    <script src="/webroot/js/bootstrap.bundle.js"></script>
    <?= $this->fetch('footer_script') ?>
</footer>
</body>
</html>
