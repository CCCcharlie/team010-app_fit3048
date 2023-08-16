<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Content $content
 * @var \Cake\Collection\CollectionInterface|string[] $tickets
 */
?>
<!DOCTYPE html>
<html lang="en">

<!-- include libraries(jQuery, bootstrap) -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Contents'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
        <?= $this->Html->link(__('Go back'), ['controller' => 'Customers', 'action' => 'view', $custId], ['class' => 'btn btn-rounded btn-primary']) ?>
    </aside>
    <div class="column-responsive column-80">
        <div class="contents form content">
            <?= $this->Form->create($content, ['type'=> 'file']) ?>
            <fieldset>
                <legend>
                    <?= __('Add content for customer: ' . $fullName) ?>
                    <br>
                    <?= __('Ticket Id: ' . $ticketId) ?>
                </legend>
                <?php
//                    echo $this->Form->control('content');
//                    echo $this->Form->control('createtime');
//                    echo $this->Form->control('ticket_id', ['options' => $tickets, 'default' => $ticketId]);
                //Default value, not very safe
                //echo $this->Form->text('ticket_id', ['value' => $ticketId, 'readonly' => true, 'class' => 'form-control']);
                    echo $this->Form->control('content_type', [
                                'type' => 'select',
                                'options' => $content_types,
                                //onchange actually exists to call JS
                                'onchange' => 'switchInput()',
                            ]);
//                    echo $this->Form->control('file', ['type' => 'file']);
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
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
</html>
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
        }else if (selectedOption === "file") {
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
            reader.onload = function(e) {
                var previewImage = document.getElementById("previewImage");
                previewImage.src = e.target.result;
                document.getElementById("imagePreview").style.display = "block";
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
