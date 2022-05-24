<?php

use App\Auth;
use App\Database;
use App\Table\PostTable;

Auth::check();

$pdo = Database::getPDO();
$table = new PostTable($pdo);
$table->delete($params['id']);
header('Location: ' . $router->url('admin_posts') . '?delete=1');
?>

<h1>Suppression de l'article <?= $params['id'] ?></h1>