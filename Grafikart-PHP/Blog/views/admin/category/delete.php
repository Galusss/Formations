<?php

use App\Auth;
use App\Database;
use App\Table\CategoryTable;

Auth::check();

$pdo = Database::getPDO();
$table = new CategoryTable($pdo);
$table->delete($params['id']);
header('Location: ' . $router->url('admin_categories') . '?delete=1');
?>

<h1>Suppression de l'article <?= $params['id'] ?></h1>