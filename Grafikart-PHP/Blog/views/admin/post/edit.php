<?php

use App\Auth;
use App\Database;
use App\HTML\Form;
use App\Table\PostTable;
use App\Validators\PostValidator;
use App\ObjectHelper;
use App\Table\CategoryTable;

Auth::check();

$pdo = Database::getPDO();
$postTable = new PostTable($pdo);
$categoryTable = new CategoryTable($pdo);
$categories = $categoryTable->list();
$post = $postTable->find($params['id']);
$categoryTable->hydratePosts([$post]);
$success = false;
$errors = [];
$title = "Editer l'article - " . htmlentities($post->getName());

if (!empty($_POST)) {
    $v = new PostValidator($_POST, $postTable, $post->getID(), $categories);
    ObjectHelper::hydrate($post, $_POST, ['name', 'content', 'slug', 'created_at']);
    if ($v->validate()) {
        $pdo->beginTransaction();
        $postTable->updatePost($post);
        $postTable->attachCategories($post->getID(), $_POST['categories_ids']);
        $pdo->commit();
        $categoryTable->hydratePosts([$post]);
        $success = true;
    } else {
        $errors = $v->errors();
    }
}
$form = new Form($post, $errors);
?>

<?php if ($success): ?>
<div class="alert alert-success">
    L'enregistrement a bien été modifier
</div>
<?php endif ?>

<?php if (isset($_GET['created'])): ?>
<div class="alert alert-success">
    L'article a bien été créer
</div>
<?php endif ?>

<?php if ($errors): ?>
<div class="alert alert-danger">
    Une erreur est survenue
</div>
<?php endif ?>

<h1>Editer l'article <?= htmlentities($post->getName()) ?></h1>

<?php require('_form.php') ?>