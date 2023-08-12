<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Content $content
 * @var \Cake\Collection\CollectionInterface|string[] $tickets
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Contents'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="contents form content">
            <?= $this->Form->create($content, ['type'=> 'file']) ?>
            <fieldset>
                <legend><?= __('Add Content') ?></legend>
                <?php
//                    echo $this->Form->control('content');
//                    echo $this->Form->control('createtime');
                    echo $this->Form->control('ticket_id', ['options' => $tickets]);
                        echo $this->Form->control('content_type', [
                            'type' => 'select',
                            'options' => $content_types,
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

<script>
    window.onload = function () {
        switchInput();
    };

    function switchInput() {
        var select = document.getElementById("content-type");
        var selectedOption = select.options[select.selectedIndex].value;
        var inputContainer = document.getElementById("inputContainer");
        inputContainer.innerHTML = ""; // Clear existing input elements

        // Hide the image preview and reset the source
        var imagePreview = document.getElementById("imagePreview");
        imagePreview.style.display = "none";
        var previewImage = document.getElementById("previewImage");
        previewImage.src = "";

        if (selectedOption === "text") {
            var textareaElement = document.createElement("textarea");
            textareaElement.name = "content"; // Adjust the input name as needed
            textareaElement.required = true; // Set the required attribute
            inputContainer.appendChild(textareaElement);

        } else if (selectedOption === "image") {
            var imageInput = document.createElement("input");
            imageInput.type = "file";
            imageInput.name = "image"; // Adjust the input name as needed
            imageInput.required = true; // Set the required attribute
            imageInput.addEventListener("change", showPreview); // Add event listener
            inputContainer.appendChild(imageInput);
        }else if (selectedOption === "file") {
            var fileInput = document.createElement("input");
            fileInput.type = "file";
            fileInput.name = "file"; // Adjust the input name as needed
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
