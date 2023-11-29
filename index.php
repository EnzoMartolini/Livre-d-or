<?php 
require_once 'class/message.php';
$error = null;

if (isset($_POST["username"], $_POST["message"]))
{
    $message = new Message($_POST["username"], $_POST["message"]);
    $error = $message->isValide();
}

$title = "Livre d'or";

require 'elements/header.php';
?>

<div class="container">
    <h1><?= $title ?></h1>
    <?php if ($error):?>
        <div class="alert alert-danger">
            <?= $error;?>
        </div>
    <?php endif;?>
    <form action="" method="post">
        <div class="form-group">
            <input type="text" name="username" placeholder="Votre pseudo" class="form-control">
            <textarea name="message" placeholder="Votre message" class="form-control"></textarea>
            <button class="btn btn-primary">Envoyer</button>
        </div>
    </form>
</div>
