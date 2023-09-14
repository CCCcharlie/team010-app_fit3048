<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Ticket> $tickets
 */
?>

<?= $this->Html->meta('icon', 'favicon.ico', ['type' => 'icon']) ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GamBlock® - Customer Management: Unassigned Customers</title>
    <!-- Bootstrap CSS -->
    <!-- In-built CSS -->
    <?= $this->Html->css(['style', 'bootstrap.min']) ?>
    <?= $this->Html->css(['style', 'error']) ?>
    <?= $this->Html->css(['fontawesome-all'], ['block' => true]) ?>
    <style>
        /* Add your custom styles here */
    </style>
</head>
<body>
<div class="tickets index content">
    <h3><?= __('Tickets') ?></h3>
    <div class="table-responsive table table-hover table-striped">
        <table>
            <thead>
            <tr>
                <th><?= $this->Paginator->sort('title') ?></th>
                <th><?= $this->Paginator->sort('type') ?></th>
                <th><?= __('Closed?') ?></th>
                <th><?= __('Customer') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($unassignedTickets as $ticket): ?>
                <tr>
                    <td><?= h($ticket->title) ?></td>
                    <td><?= h($ticket->type) ?></td>
                    <td><?= !empty($ticket->closetime) ? h($ticket->closetime) : 'Not close' ?></td>
                    <td><?= $ticket->closed ? "Yes" : "No" ?></td>
                    <td>
                        <?php
                        if ($ticket->has('customer')) {
                            echo h($ticket->customer->f_name . ' ' . $ticket->customer->l_name);
                        } else {
                            echo 'Not available';
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        echo !empty($ticket->user) ? $this->Html->link($ticket->user->id, ['controller' => 'Users', 'action' => 'view', $ticket->user->id]) : 'Not available';
                        ?>
                    </td>
                    <td class="actions">
                        <?= $this->Html->link(__('Re-Assign'), ['action' => 'edit', $ticket->id]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->Html->script('https://kit.fontawesome.com/b5c616a120.js', ['crossorigin' => 'anonymous']) ?>
<?= $this->Html->script(['jquery-3.3.1.min.js', 'bootstrap.bundle.js', 'main-js', 'jquery.slimscroll.js', 'gototoparrow.js']) ?>
</body>
</html>
