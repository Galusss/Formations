<?php

use App\Database;
use App\Table\CategoryTable;
use App\Table\PostTable;

$id = (int)$params['id'];
$slug = $params['slug'];

$pdo = Database::getPDO();
$post = (new PostTable($pdo))->find($id);
(new CategoryTable($pdo))->hydratePosts([$post]);

if ($post->getSlug() !== $slug) {
    $url = $router->url('post', ['slug' => $post->getSlug(), 'id' => $id]);
    header('Location: ' . $url);
    http_response_code(301);
}

$title = $post->getName();
?>

<h1 class="card-title"><?= htmlentities($post->getName()) ?></h1>
<p class="text-muted"><?= $post->getCreatedAt()->format('d F Y'); ?></p>
<?php foreach ($post->getCategories() as $k => $category): ?>
    <?php if($k > 0): ?>
    /
    <?php endif ?>
    <a href="<?= $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()]) ?>"><?= htmlentities($category->getName()) ?></a>
<?php endforeach ?>
<p><?= $post->getFormatedContent() ?></p>