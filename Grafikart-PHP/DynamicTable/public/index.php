<?php

use App\NumberHelper;
use App\QueryBuilder;
use App\TableHelper;
use App\URLHelper;
use App\Table;

require '../vendor/autoload.php';

$pdo = new PDO('sqlite:../products.db', null, null, [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$query = (new QueryBuilder($pdo))->from('products');

if (!empty($_GET['q'])) {
    $query
        ->where("city LIKE :city")
        ->setParam('city', '%' . $_GET['q'] . '%');
}

$table = (new Table($query, $_GET))
    ->sortable('id', 'city', 'price')
    ->format('price', function ($value) {
        return NumberHelper::price($value);
    })
    ->columns([
        'id' => 'ID',
        'name' => 'Nom',
        'city' => 'Ville',
        'price' => 'Prix'
]);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Biens immobiliers</title>
</head>
<body class="p-4"> 

    <h1>Les biens immobilier</h1>

    <form action="" class="mb-4">
        <div class="form-group">
            <input type="text" class="form-control" name="q" placeholder="Rechercher par ville" value="<?= htmlentities($_GET['q']) ?? null ?>">
        </div>
        <button class="btn btn-primary mt-2">Rechercher</button>
    </form>

    <?php $table->render(); ?>

</body>
</html>