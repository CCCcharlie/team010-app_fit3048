<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\User> $users
 */


//$this->disableAutoLayout();
?>
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

<!doctype html>
<html lang="en">

<head>
    <?= $this->Html->meta('icon', 'favicon.ico', ['type' => 'icon']) ?>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GamBlock® - Customer Management: Customers</title>
    <!-- Bootstrap CSS -->
    <!-- In-built CSS -->
    <?= $this->Html->css(['style', 'bootstrap.min',]) ?>
    <?= $this->Html->css(['style', 'error',]) ?>
    <?= $this->Html->css(['fontawesome-all'], ['block' => true]) ?>

    <style>
        .image-table img {
            max-width: 100%; /* Set the maximum width to 100% of the parent element (td) */
            height: auto; /* Maintain the aspect ratio */
        }
    </style>
</head>

<body>
<div class="users index content">
    <!-- ============================================================== -->
    <!-- pageheader  -->

    <div class="page-breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="breadcrumb-link">Home</a></li>

                <li class="breadcrumb-item active" aria-current="page"> Site Editor </li>
            </ol>
        </nav>
    </div>

    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- end pageheader  -->
    <!-- ============================================================== -->
        <div class="section-block container" style="float: left;" id="cardaction">
            <h3 class="section-title" style="color: midnightblue"><?= __('Site Editor') ?></h3>
            <div class="accordion cb" style="color: midnightblue">
                <div class="accordion-header button" style="color: midnightblue">
                    <button>
                        <span class="icon" style="color: midnightblue"> &#9654; Welcome to the Site Content Editor. If you are unsure of how to use this page. <span> <strong> Click me! </strong> </span> <br>
                    </button>
                </div>
                <div class="container" style="background-color: #ADD8E6; border: 2px midnightblue;">
                    <div class="accordion-panel" style="color: midnightblue">
                        <p>This is the site content editor. It's here to let you change your website and keep things up to-date. <br>
                        Don't know how to edit? Follow the tips listed here: </p>
                        <p>1. Find the piece you want to edit through using both the hint and the description.</p>
                        <p>2. Click 'Edit' on the Actions Column.</p>
                        <p>3. Change the content to your desires. </p>
                        <p>4. Hit submit. Your changes should apply to the website instantly. </p>
                        <p>Success! </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover custom-table">
                <thead>
                <tr>
                    <th style="font-family: 'Arial'; font-weight: bold;"><?= $this->Paginator->sort('hint', "Hint - the content you're editing") ?></th>
                    <th style="font-family: 'Arial'; font-weight: bold;"><?= $this->Paginator->sort('type', 'Content type') ?></th>
                    <th style="font-family: 'Arial'; font-weight: bold;"><?= $this->Paginator->sort('content_description', 'Content description') ?></th>
                    <th class="actions" style="font-family: 'Arial'; font-weight: bold; width: 100px"><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($cbs as $cb): ?>
                    <tr>
                        <td><?= h(str_replace("_", " ", $cb->hint)) ?></td>
                        <?php if($cb->content_type == 'image'): ?>
                            <td class="image-table"><?= $this->Html->image($cb->content_value, ['alt' => $cb->hint]); ?></td>
                        <?php else: ?>
                            <td><?= h($cb->content_type) ?>: <?= h($cb->content_value) ?></td>
                        <?php endif ?>
                        <td><?= h($cb->content_description) ?></td>
                        <td class="actions" style="width: 100px">
                            <?php if ($this->Identity->get('role') == 'root' || $this->Identity->get('role') == 'admin'): ?>
                                <?= $this->Html->link(__('Edit Me!'), ['action' => 'edit', $cb->id], ['style' => 'max-width: 100px;']) ?>
                            <?php else: ?>
                                <p>How are you here? Only admins are allowed here!</p>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<!-- Custom Accordian script-->
<script>
    var acc = document.querySelectorAll(".accordion-header");
    var i =0;

    for (i = 0; i < acc.length; i++) {

        var panel = acc[i].nextElementSibling; // Get the panel

        /* Hide panel initially */
        panel.style.display = "none";

        acc[i].addEventListener("click", function() {
            /* Toggle active class to expand/collapse panel */
            this.classList.toggle("active");

            /* Toggle display property of panel to show/hide content */
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    }
</script>
<!--EXPLAINING THE SCRIPTS -->
<!--Concept - Template-->
<!--SlimScroll - JS Plugin. Allows for any div to be scrollable.-->
<!--Jquery  - Essential Javascript library-->
<!--Add any explinations here for any scripts you add. - Alex-->

<?= $this->Html->script('https://kit.fontawesome.com/b5c616a120.js', ['crossorigin' => 'anonymous']) ?>

<?= $this->Html->script(['jquery-3.3.1.min.js', 'bootstrap.bundle.js', 'main-js', 'jquery.slimscroll.js', 'gototoparrow.js']) ?>

</body>

</html>
