<?php
$this->layout = 'error';

$customMessage = 'Error 500: Unknown Error Occurred';

?>


<h2><?= h($customMessage) ?></h2>
<?php //debug($message);?>
<p class="error">
    <strong><?= __d('cake', 'Error') ?>: </strong>
    <?= __d('cake', 'An internal error has occurred') ?>
    <!--    <a href="--><?php //= $this->Url->build(['controller' => 'Pages', 'action' => 'Home']) ?><!--">Take me home!</a>-->
</p>
