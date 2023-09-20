<?php
//$this->layout = 'error';
//
//$customMessage = 'Error 500: Unknown Error Occurred';
//
//?>
<!---->
<!---->
<!--<h2>--><?php //= h($customMessage) ?><!--</h2>-->
<?php ////debug($message);?>
<!--<p class="error">-->
<!--    <strong>--><?php //= __d('cake', 'Error') ?><!--: </strong>-->
<!--    --><?php //= __d('cake', 'An internal error has occurred') ?>
<!--      <a href="--><?php ////= $this->Url->build(['controller' => 'Pages', 'action' => 'Home']) ?><!--<!--">Take me home!</a>-->-->
<!--</p>-->


<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Database\StatementInterface $error
 * @var string $message
 * @var string $url
 */
use Cake\Core\Configure;
use Cake\Error\Debugger;

$this->layout = 'error';

if (Configure::read('debug')) :
    $this->layout = 'dev_error';

    $this->assign('title', $message);
    $this->assign('templateName', 'error500.php');

    $this->start('file');
    ?>
    <?php if (!empty($error->queryString)) : ?>
    <p class="notice">
        <strong>SQL Query: </strong>
        <?= h($error->queryString) ?>
    </p>
<?php endif; ?>
    <?php if (!empty($error->params)) : ?>
    <strong>SQL Query Params: </strong>
    <?php Debugger::dump($error->params) ?>
<?php endif; ?>
    <?php if ($error instanceof Error) : ?>
    <strong>Error in: </strong>
    <?= sprintf('%s, line %s', str_replace(ROOT, 'ROOT', $error->getFile()), $error->getLine()) ?>
<?php endif; ?>
    <?php
    echo $this->element('auto_table_warning');

    $this->end();
endif;
?>
<h2><?= __d('cake', 'Something has gone wrong!') ?></h2>
<p class="error">
    <strong><?= __d('cake', 'Error') ?>: </strong>
    <?= h($message) ?>
</p>
