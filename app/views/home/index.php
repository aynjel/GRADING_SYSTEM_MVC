<?php $this->setSiteTitle('Home Page'); ?>

<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>

<?= $data['title']; ?>
<br>
<?= $data['description']; ?>
<br>

<a href="<?=Config::PROJECT_ROOT?>auth/admin_login">Admin Login</a>
<a href="<?=Config::PROJECT_ROOT?>auth/admin_register">Admin Register</a>

<br>

<a href="<?=Config::PROJECT_ROOT?>auth/login">Login</a>
<a href="<?=Config::PROJECT_ROOT?>auth/register">Register</a>

<?php $this->end(); ?>