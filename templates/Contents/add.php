<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Content $content
 * @var \Cake\Collection\CollectionInterface|string[] $tickets
 */

//$this->disableAutoLayout();
?>

<!doctype html>
<html lang="en">


<head>
    <?= $this->Html->meta('icon', 'favicon.ico', ['type' => 'icon']) ?>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GamBlock® - Customer Management: Contents Add</title>
    <!-- Bootstrap CSS -->
    <!-- In-built CSS -->
    <?= $this->Html->css(['style', 'bootstrap.min',]) ?>
    <?= $this->Html->css(['style', 'error',]) ?>
    <?= $this->Html->css(['fontawesome-all'], ['block' => true]) ?>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">


</head>

<body>
<div class="contents add content">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="section-block" id="basicform">
            </div>
            <div class="card">
                <?= $this->Form->create($content, ['type' => 'file']) ?>
                <fieldset>
                    <h5 class="card-header">
                        <legend>
                            <?= __('Add content for customer: ' . $fullName) ?>
                            <br>
                        </legend>
                    </h5>
                    <?php
                    echo $this->Form->control('content_type', [
                        'type' => 'select',
                        'options' => $content_types,
                        //onchange actually exists to call JS
                        'onchange' => 'switchInput()',
                    ]);
                    //     t               echo $this->Form->control('file', ['type' => 'file']);
                    echo '<div id="inputContainer" >';
                    // The dynamic input field will be added here
                    echo '</div>';
                    echo '<!-- Image preview area -->';
                    echo '<div id="imagePreview" style="display: none;">';
                    echo '<img id="previewImage" src="#" alt="Image Preview" />';
                    echo '</div>';
                    ?>

                    <!-- Display validation error for the 'image' field -->
                    <?= $this->Form->error('image'); ?>
                    <!-- Display validation error for the 'image' field -->
                    <?= $this->Form->error('file'); ?>

                </fieldset>
                <div class="form-group d-flex justify-content-between align-items-center">
                    <?= $this->Html->link(__('Return to Customer'), ['controller' => 'Customers', 'action' => 'view', $custId], ['class' => 'btn btn-rounded btn-secondary']) ?>
                    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>


<script>
    //In order for the text box to render as soon as user
    //enters page, we call switchInput function
    window.onload = function () {
        switchInput();
    };

    function switchInput() {
        //content-type refers to content_type, no clue why it has to be content-type and not content_type
        var select = document.getElementById("content-type");
        //Line to obtain the value of the options selected in content-type
        var selectedOption = select.options[select.selectedIndex].value;
        var inputContainer = document.getElementById("inputContainer");
        inputContainer.innerHTML = ""; // Clear existing input elements

        // Hide the image preview and reset the source
        var imagePreview = document.getElementById("imagePreview");
        imagePreview.style.display = "none";
        var previewImage = document.getElementById("previewImage");
        previewImage.src = "";

        //Statements to rotate between Text, Image and File
        if (selectedOption === "text") {
            //create an element that is named textarea
            var textareaElement = document.createElement("textarea");
            //IMPORTANT: setting the name is equal to setting "field_name" in php
            textareaElement.name = "content"; // Name of content
            //Line required to be true
            textareaElement.required = true; // Set the required attribute
            //Display the area
            inputContainer.appendChild(textareaElement);

            $(textareaElement).summernote({
                // Summernote options and configurations
            });

        } else if (selectedOption === "image") {
            var imageInput = document.createElement("input");
            imageInput.type = "file";
            imageInput.name = "image"; //
            imageInput.required = true; // Set the required attribute
            imageInput.addEventListener("change", showPreview); // Add event listener
            inputContainer.appendChild(imageInput);
        } else if (selectedOption === "file") {
            var fileInput = document.createElement("input");
            fileInput.type = "file";
            fileInput.name = "file"; //
            fileInput.required = true; // Set the required attribute
            fileInput.addEventListener("change", showPreview); // Add event listener
            inputContainer.appendChild(fileInput);

        }
    }

    function showPreview(event) {
        var input = event.target;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var previewImage = document.getElementById("previewImage");
                previewImage.src = e.target.result;
                document.getElementById("imagePreview").style.display = "block";
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

</body>
</html>
