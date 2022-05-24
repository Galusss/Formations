<?php

use App\Auth;
use App\Database;
use App\HTML\Form;
use App\Table\CategoryTable;
use App\Validators\CategoryValidator;
use App\ObjectHelper;

$title = "Editer l'article";

Auth::check();

$pdo = Database::getPDO();
$table = new CategoryTable($pdo);
$item = $table->find($params['id']);
$success = false;
$errors = [];
$fields = ['name', 'slug'];

if (!empty($_POST)) {
    $v = new CategoryValidator($_POST, $table, $item->getID());
    ObjectHelper::hydrate($item, $_POST, $fields);
    if ($v->validate()) {
        $table->update([
            'name' => $item->getName(),
            'slug' => $item->getSlug()
        ], $item->getID());
        $success = true;
    } else {
        $errors = $v->errors();
    }
}
$form = new Form($item, $errors);
?>

<?php if ($success): ?>
<div class="alert alert-success">
    L'enregistrement a bien été modifier
</div>
<?php endif ?>

<?php if (isset($_GET['created'])): ?>
<div class="alert alert-success">
    La catégorie a bien été créer
</div>
<?php endif ?>

<?php if ($errors): ?>
<div class="alert alert-danger">
    Une erreur est survenue
</div>
<?php endif ?>

<h1>Editer la catégorie <?= htmlentities($item->getName()) ?></h1>

<?php require('_form.php') ?>