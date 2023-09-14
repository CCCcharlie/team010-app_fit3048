<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Commdetail $cb
 */

?>

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
    <?= $this->Html->css(['fontawesome-all'], ['block' => true]) ?>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

    <style>
        .table th {
            padding-right: 20px;
        }
    </style>

</head>

<body>
<div class="column-responsive column-80">
    <div class="commdetails form content">
        <div class="card">
            <h5 class="card-header"> <legend><?= __('Edit Content block: ' . $cb->hint) ?></legend></h5>
            <?= $this->Form->create($cb, ['type'=> 'file']) ?>
            <div class="card-body">
                <fieldset>
                    <p>Welcome to the Edit Page. Please make any changes below. </p>
                    <!-- Constrain content type to be impossible to edit so that it doesnt break -->
                    <table>
                        <tr>
                            <th style="padding-right: 80px"><?= __('Content Type') ?></th>
                            <td><?= h($cb->content_type) ?></td>
                        </tr>

                        <tr>
                            <th><?= __('Content Description') ?></th>
                            <td><?= h($cb->content_description) ?></td>
                        </tr>

                    <!-- Displays the content of the previous value (which is your current value here) -->
                        <tr>
                            <th><?= __('Previous Value') ?></th>
                            <td><?php if(!$cb->previous_value){
                                    echo h("No previous value");
                                } else {
                                    echo h($cb->previous_value);
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                    <br>


                    <?php
                    //                    debug($content_types === "text");

                    //  content_value and content_image is simply the name of the field, not content_value in database
                    //  therefore I can add another validator rule for name content_value for texts and content_image for images
                    if ($cb->content_type == "Number") {
                        echo $this->Form->control('content_value', [
                            'type' => 'number',
                            'label' => [
                                'text' => 'Number Value:',
                                'style' => 'padding-right: 10px' // Add class here
                            ],
                            'value' => $cb->content_value
                        ]);
                    }else {
                        echo $this->Form->control('content_image', [
                            'type' => 'file',
                            'label' => [
                                'text' => 'Image File:',
                                'style' => 'padding-right: 10px' // Add class here
                            ],
                            'onchange' => 'showPreview(event)' // Add this line
                        ]);
                    }
                    //Validation for field names content_value and content_image is in CbTable.php
                    //(This is to ensure that content_value = string and content_image = file)

                    echo '<!-- Image preview area -->';
                    echo '<div id="imagePreview" style="display: none;">';
                    echo '<img id="previewImage" src="#" alt="Image Preview" />';
                    echo '</div>';
                    ?>

                </fieldset>

                <div class="form-group d-flex justify-content-between align-items-center">
                    <?= $this->Html->link(__('Go Back'), ['action' => 'index'], ['class' => 'btn btn-rounded btn-secondary']) ?>
                    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<script>
    function showPreview(event) {
        var input = event.target;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var previewImage = document.getElementById("previewImage");
                previewImage.src = e.target.result;
                document.getElementById("imagePreview").style.display = "block";
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<?= $this->Html->script('https://kit.fontawesome.com/b5c616a120.js', ['crossorigin' => 'anonymous']) ?>
<?= $this->Html->script(['jquery-3.3.1.min.js', 'bootstrap.bundle.js', 'main-js', 'jquery.slimscroll.js']) ?>

</body>
</html>
