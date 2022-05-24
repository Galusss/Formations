<?php

use App\Auth;
use App\Database;
use App\Table\PostTable;

Auth::check();

$title = "Administration";
$pdo = Database::getPDO();
$link = $router->url('admin_posts');
[$posts, $pagination] = (new PostTable($pdo))->findPaginated();
?>

<?php if (isset($_GET['delete'])): ?>
    <div class="alert alert-success">L'enregistrement a bien été supprimé</div>
<?php endif ?>
<table class="table">
    <thead>
        <th>ID</th>
        <th>Titre</th>
        <th>
            <a href="<?= $router->url('admin_post_new') ?>" class="btn btn-primary">Nouvel article</a>
        </th>
    </thead>
    <tbody>
        <?php foreach ($posts as $post): ?>
        <tr>
            <td>#<?= $post->getID() ?></td>
            <td>
                <a href="<?= $router->url('admin_post', ['id' => $post->getID()]) ?>">
                    <?= htmlentities($post->getName()) ?>
                </a>
            </td>
            <td>
                <a href="<?= $router->url('admin_post', ['id' => $post->getID()]) ?>" class="btn btn-primary">
                    Editer
                </a>
            </td>
            <td>
                <form action="<?= $router->url('admin_post_delete', ['id' => $post->getID()]) ?>" method="POST"
                    onsubmit="return confirm('Voulez jous vraiment effectuer cette action ?')" style="display:inline">
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

<div class="d-flex justify-content-between my-4">
    <?= $pagination->previousLink($link) ?>
    <?= $pagination->nextLink($link) ?>
</div>
