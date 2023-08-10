<?php
/**
 * Reset Password text email template
 *
 * @var \App\View\AppView $this
 * @var string $first_name email recipient's first name
 * @var string $last_name email recipient's last name
 * @var string $email email recipient's email address
 * @var string $nonce nonce used to reset the password
 */
?>

GAMBLOCK® - STAFF PASSWORD RESET
==========

Hi <?= h($f_name) ?>,

Thank you for your request to reset the password of your account on GamBlock® staff portal.

To reset your account password, use the button below to access the reset password page:
<?= $this->Url->build(['controller' => 'Staff', 'action' => 'resetpassword', $nonce], ['fullBase' => true]) ?>


==========
This email is addressed to <?= $f_name ?>  <?= $l_name ?> <<?= $email ?>>
Please discard this email if it is not meant for you

Copyright (c) <?= date("Y"); ?> Holistic Healings
