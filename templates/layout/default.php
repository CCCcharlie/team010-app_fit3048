<?php
/**
 * CakePHP(tm): The Rapid Development PHP Framework (https://cakephp.org)
 * Copyright(c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright(c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: The rapid development PHP framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon', 'favicon.ico', ['type' => 'icon']) ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

    <?= $this->Html->css(['bootstrap.min.css', 'style.css', 'cake']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/webroot/css/bootstrap.min.css">
    <link href="/webroot/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="/webroot/css/style.css">
</head>
<body>
<!-- main wrapper -->
<!--==============================================================-->
<div class="dashboard-main-wrapper">
    <!--==============================================================-->
    <!-- navbar -->
    <!--==============================================================-->
    <div class="dashboard-header">
        <nav class="navbar navbar-expand-lg bg-white fixed-top">
            <a class="navbar-brand" href="/">Gamblock</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="top-nav-links">
                    <?php
                    if ($this->Identity->isLoggedIn()) {
                        echo $this->Html->link('Logout', ['controller' => 'Auth', 'action' => 'logout']);
                    }
                    ?>
                </div>
            </div>
        </nav>
    </div>
    <!--==============================================================-->
    <!-- end navbar -->
    <!--==============================================================-->
    <!--==============================================================-->
    <!-- wrapper -->
    <!--==============================================================-->
    <div class="dashboard-wrapper">
        <div class="container-fluid dashboard-content">
            <!--==============================================================-->
            <!-- page header -->
            <!--==============================================================-->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title">Gamblock</h2>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Blank Page header</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!--==============================================================-->
            <!-- end page header -->
            <!--==============================================================-->
            <main class="main">
                <div class="container">
                    <?= $this->Flash->render() ?>
                    <?= $this->fetch('content') ?>
                </div>
            </main>
            <footer>
            </footer>
            <!-- Optional JavaScript -->
            <script src="/webroot/js/jquery-3.3.1.min.js"></script>
            <script src="/webroot/js/bootstrap.bundle.js"></script>
            <script src="/webroot/js/jquery.slimscroll.js"></script>
            <script src="/webroot/js/main-js.js"></script>
        </div>
    </div>
</div>
<!--==============================================================-->
<!-- end main wrapper -->
<!--==============================================================-->
</body>
</html>

