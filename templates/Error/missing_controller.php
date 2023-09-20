<?php
$this->layout = 'error';

$customMessage = 'Error 404: Page not found';

?>


<h2><?= h($customMessage) ?></h2>
<?php //debug($message);?>
<p class="error">
    <?= __d('cake', 'It seems the address: {0} does not exist on this site.', "<strong>'{$url}'</strong>") ?> <br>
    <?= __d('cake', 'If this does not seem right. Contact your network admin.',) ?>
    <!--    <a href="--><?php //= $this->Url->build(['controller' => 'Pages', 'action' => 'Home']) ?><!--">Take me home!</a>-->
</p>

