<div class="row">
    <?php foreach ($assignedCustomers as $customer): ?>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h4 class="card-header-title"><?= h($customer->f_name) ?> <?= h($customer->l_name) ?></h4>
                    <div class="toolbar card-toolbar-tabs ml-auto">
                        <ul class="nav nav-pills" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab-<?= $customer->id ?>" data-toggle="pill" href="#pills-home-<?= $customer->id ?>" role="tab" aria-controls="pills-home" aria-selected="true">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-profile-tab-<?= $customer->id ?>" data-toggle="pill" href="#pills-profile-<?= $customer->id ?>" role="tab" aria-controls="pills-profile" aria-selected="false">Technical Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-contact-tab-<?= $customer->id ?>" data-toggle="pill" href="#pills-contact-<?= $customer->id ?>" role="tab" aria-controls="pills-contact" aria-selected="false">Contact Methods</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content mb-3" id="pills-tabContent-<?= $customer->id ?>">
                        <div class="tab-pane fade show active" id="pills-home-<?= $customer->id ?>" role="tabpanel" aria-labelledby="pills-home-tab-<?= $customer->id ?>">
                            <br> Status: <?= h($customer->status) ?>
                            <br> Notes: <?= h($customer->notes) ?>

                        </div>
                        <div class="tab-pane fade" id="pills-profile-<?= $customer->id ?>" role="tabpanel" aria-labelledby="pills-profile-tab-<?= $customer->id ?>">
                            <!-- Add stuff like technical details and devices. -->
                            <?php
                            if (!empty($customer->devices)) {
                                foreach ($customer->devices as $device) {
                                    echo '<p>Device Model: ' . h($device->device_model) . '</p>';
                                    echo '<p>Technical Details: ' . h($device->technical_details) . '</p>';
                                    echo '<p>Session ID: ' . h($device->session_id) . '</p>';
                                    echo '<p>Transaction ID: ' . h($device->transaction_id) . '</p>';

                                }
                            } else {
                                echo '<p>No devices associated with this customer.</p>';
                            }
                            ?>
                        </div>

                        <div class="tab-pane fade" id="pills-contact-<?= $customer->id ?>" role="tabpanel" aria-labelledby="pills-contact-tab-<?= $customer->id ?>">
                            <br>Primary E-mail: <?= h($customer->email) ?>
                            <?php
                            if (!empty($customer->commdetails)) {
                                foreach ($customer->commdetails as $commdetail) {
                                    echo '<p>Alternate Contact: ' . h($commdetail->link) . '</p>';
                                }
                            } else {
                                echo '<p>No other contact methods were found</p>';
                            }
                            ?>
                        </div>
                    </div>
                    <?= $this->Html->link(__('View Full Profile'), ['action' => 'view', $customer->id], ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

<!--    --><?php //if ($this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) === 'Page 1 of 0, showing 0 record(s) out of 0 total'): ?>
<!--        <p>No results found.</p>-->
<!--    --><?php //endif; ?>


</div>
