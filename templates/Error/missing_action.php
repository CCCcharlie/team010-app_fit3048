<?php
$this->layout = 'error';

$customMessage = 'Error 404: Action not found';

?>


<h2><?= h($customMessage) ?></h2>
<?php //debug($message);?>
<p class="error">
    <strong><?= __d('cake', 'Error') ?>: </strong>
    <?= __d('cake', 'The requested address {0} was not found on this server.', "<strong>'{$url}'</strong>") ?>
<!--    <a href="--><?php //= $this->Url->build(['controller' => 'Pages', 'action' => 'Home']) ?><!--">Take me home!</a>-->
</p>

