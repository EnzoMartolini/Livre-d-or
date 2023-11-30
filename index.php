<?php 
require_once 'class/message.php';
require_once 'class/GuestBook.php';
$guestBook = new GuestBook(__DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR .'messages');
$error = null;

if (isset($_POST["username"], $_POST["message"]))
{
    $message = new Message($_POST["username"], $_POST["message"]);
    if ($message->isValide())
    {
        $guestBook->addMessage($message);
        $_POST = [];
    } else {
        $errors = $message->getError();
    };
}

$title = "Livre d'or";

require 'elements/header.php';
?>

<div class="container">
    <h1><?= $title ?></h1>
    <?php if (!empty($errors)):?>
        <div class="alert alert-danger">
            Le formulaire est invalide
        </div>
    <?php endif;?>
    <form action="" method="post">
        <div class="form-group">
            <input type="text" name="username" placeholder="Votre pseudo" class="form-control <?= isset($errors["username"]) ? 'is-invalid' : ''?>">
            <?php if (isset($errors['username'])) :?>
                <div class="invalid-feedback"> <?= $errors['username']?> </div>
            <?php endif?>
            <textarea name="message" placeholder="Votre message" class="form-control <?= isset($errors["message"]) ? 'is-invalid' : ''?>"></textarea>
            <?php if (isset($errors['message'])) :?>
                <div class="invalid-feedback"> <?= $errors['message']?> </div>
            <?php endif?>
            <button class="btn btn-primary">Envoyer</button>
        </div>
    </form>
</div>

<?php foreach($guestBook->getMessage() as $message):?>
    <?= $message->toHTML() ?>
<?php endforeach ?>