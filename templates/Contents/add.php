<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Content $content
 * @var \Cake\Collection\CollectionInterface|string[] $tickets
 */

$this->disableAutoLayout();
?>

<!doctype html>
<html lang="en">


<head>
    <?= $this->Html->meta('icon', 'favicon.ico', ['type' => 'icon']) ?>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GamBlock® - Customer Management: Contents add</title>
    <!-- Bootstrap CSS -->
    <!-- In-built CSS -->
    <?= $this->Html->css(['style', 'bootstrap.min',]) ?>
    <?= $this->Html->css(['style', 'error',]) ?>
    <?= $this->Html->css(['fontawesome-all'], ['block' => true]) ?>





</head>


<!-- ============================================================== -->
<!-- main wrapper -->
<!-- ============================================================== -->
<div class="dashboard-main-wrapper">
    <!-- ============================================================== -->
    <!-- navbar -->
    <!-- ============================================================== -->
    <div class="dashboard-header">
        <nav class="navbar navbar-expand-lg bg-white fixed-top">
            <a class="navbar-brand" href="/">
                <?= $this->Html->image('cake-logo.png', ['alt' => 'GamBlock Logo', 'class' => 'navbar-brand', 'style' => 'width: 225px; height: auto;']); ?> -Staff Portal
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto navbar-right-top">
                    <a href="#"><i class="fas fa-power-off mr-2"></i> <?php echo $this->Html->link(__('Logout'), ['controller' => 'Auth', 'action' => 'logout']); ?></a>


                    <!--                    <li class="nav-item dropdown nav-user">-->
                    <!--                        <a class="nav-link nav-user-file" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../assets/images/avatar-1.jpg" alt="" class="user-avatar-md rounded-circle"></a>-->
                    <!--                        <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">-->
                    <!--                            <div class="nav-user-info">-->
                    <!--                                <h5 class="mb-0 text-white nav-user-name">-->
                    <!--                                    Example User</h5>-->
                    <!--                            </div>-->
                    <!--                            <a class="dropdown-item" href="#"><i class="fas fa-power-off mr-2"></i> --><?php //echo $this->Html->link(__('Logout'), ['controller' => 'Auth', 'action' => 'logout']); ?><!--</a>-->
                    <!--                        </div>-->
                    <!--                    </li>-->
                </ul>
            </div>
        </nav>
    </div>
    <!-- ============================================================== -->
    <!-- end navbar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- left sidebar -->
    <!-- ============================================================== -->
    <div class="nav-left-sidebar sidebar-dark">
        <div class="menu-list">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="d-xl-none d-lg-none" href="#">Customer View</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav flex-column">
                        <li class="nav-divider">
                            Menu
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fa fa-fw fa-user-circle"></i>Customer Management <span class="badge badge-success">6</span></a>
                            <div id="submenu-1" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="/">Assigned to me</a>
                                        <!--                                        Change my link to assigned to me page when done.-->
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/customers">View All</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/customers/add">Add a Customer Profile</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!--                        <li class="nav-item">-->
                        <!--                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fa-solid fa-user-tag"></i>Tag Management</a>-->
                        <!--                            <div id="submenu-2" class="collapse submenu" style="">-->
                        <!--                                <ul class="nav flex-column">-->
                        <!--                                    <li class="nav-item">-->
                        <!--                                        <a class="nav-link" href="/Tags/index">View All Tags<span class="badge badge-secondary">New</span></a>-->
                        <!--                                    </li>-->
                        <!--                                    <li class="nav-item">-->
                        <!--                                        <a class="nav-link" href="/Tags/add">Add some Tags<span class="badge badge-secondary">New</span></a>-->
                        <!--                                    </li>-->
                        <!--                                </ul>-->
                        <!--                            </div>-->
                        <!--                        </li>-->
                        <li class="nav-divider">
                            Admin Features
                            <!--                            Change to me admin only visable.-->
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-6" aria-controls="submenu-6"><i class="fa-solid fa-user-tie"></i>Staff Management</a>
                            <div id="submenu-6" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="/Users/">View All Staff Accounts </a>
                                    </li>

                                </ul>
                            </div>


                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end left sidebar -->


    <!-- ============================================================== -->

    <div class="dashboard-wrapper">
        <div class="container-fluid dashboard-content">
            <!-- ============================================================== -->
            <!-- Flash rendering -->
            <!-- ============================================================== -->
            <?php
            // Check if the flash message exists and has content
            $flashMessage = $this->Flash->render();
            if (!empty($flashMessage)) {
                ?>
                <!-- Flash message, ONLY shows up if ticket is successfully opened/closed -->
                <div class="alert alert-success" role="alert">
                    <?= $flashMessage; ?>
                </div>
                <?php
            }
            ?>
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section-block" id="basicform">
                    </div>
                    <div class="card">
                        <?= $this->Form->create($content, ['type'=> 'file']) ?>
                        <fieldset>
                            <h5 class="card-header">
                                <legend>
                                    <?= __('Add content for customer: ' . $fullName) ?>
                                    <br>
                                </legend>
                            </h5>
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
                                        <!-- Uncomment and style the following controls as needed -->
                                        <!--
    <div class="form-group">
        <?= $this->Form->label('createtime', 'Create Time', ['class' => 'col-form-label']) ?>
        <?= $this->Form->input('createtime', ['class' => 'form-control']) ?>
    </div>
    <div class="form-group">
        <?= $this->Form->label('closetime', 'Close Time', ['class' => 'col-form-label']) ?>
        <?= $this->Form->input('closetime', ['class' => 'form-control']) ?>
    </div>
    <div class="form-group">
        <?= $this->Form->label('closed', 'Closed', ['class' => 'col-form-label']) ?>
        <?= $this->Form->input('closed', ['class' => 'form-control']) ?>
    </div>
    <div class="form-group">
        <?= $this->Form->label('cust_id', 'Customer', ['class' => 'col-form-label']) ?>
        <?= $this->Form->input('cust_id', ['class' => 'form-control', 'options' => $customers]) ?>
    </div>
    -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!--Footer-->
    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->
    <div class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    Copyright ©  GamBlock®. All rights reserved. This site is for access by GamBlock® Staff Only. Template by <a href="https://colorlib.com/wp/">Colorlib</a>.
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <!--                                        <div class="text-md-right footer-links d-none d-sm-block">-->
                    <!--                                            <a href="javascript: void(0);">Documentation</a>-->
                    <!--                                            <a href="javascript: void(0);">Contact Points</a>-->
                    <!--                                        </div>-->
                </div>
            </div>
        </div>


    </div>
    <!-- ============================================================== -->
    <!-- end footer -->
    <!-- ============================================================== -->

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
