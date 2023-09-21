<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Counsellor> $counsellors
 */
?>
<div class="page-header" id="top">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/" class="breadcrumb-link">Home</a></li>

                    <li class="breadcrumb-item active" aria-current="page">Counsellors</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- To obtain the identity, use $identity = $this->request->getAttribute('authentication')->getIdentity(); to find the currently logged in entity
to get the name or any value in the staff table, use the get and then the name of the attribute $identity->get('staff_fname')-->
    <!--                                <h2 class="pageheader-title" style="color: lightslategrey">Welcome, --><?php //= $identity->get('f_name'); ?><!--</h2>-->

    <!-- Can you add login user to name here if you get chance Bryan?  -->
    <!-- Sure Alex-->

    <p class="pageheader-text"></p>
</div>

<div class="counsellors index content">

    <h3><?= __('Counsellors') ?></h3>
    <div class="table table-hover table-striped">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('f_name') ?></th>
                    <th><?= $this->Paginator->sort('l_name') ?></th>
                    <th><?= $this->Paginator->sort('notes') ?></th>
                    <th><?= $this->Paginator->sort('cust_id') ?></th>
                    <th><?= $this->Paginator->sort('contact') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($counsellors as $counsellor): ?>
                <tr>
                    <td><?= $this->Number->format($counsellor->id) ?></td>
                    <td><?= h($counsellor->f_name) ?></td>
                    <td><?= h($counsellor->l_name) ?></td>
                    <td><?= h($counsellor->notes) ?></td>

                    <td><?= $counsellor->has('customer') ? $this->Html->link($counsellor->customer->id, ['controller' => 'Customers', 'action' => 'view', $counsellor->customer->id]) : '' ?></td>
                    <td><?= h($counsellor->contact) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $counsellor->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $counsellor->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $counsellor->id], ['confirm' => __('Are you sure you want to delete # {0}?', $counsellor->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
