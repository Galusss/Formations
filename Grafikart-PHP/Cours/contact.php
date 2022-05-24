<?php 
session_start();
$title = "Nous contacter";
require_once 'config.php';
require_once 'functions.php';
date_default_timezone_set('Europe/Paris');
$heure = (int)($_GET['heure'] ?? date('G'));
$jour = (int)($_GET['jour'] ?? date('N') - 1);
$creneaux = CRENEAUX[date('N') - 1];
$ouvert = in_creneaux($heure, $creneaux);
require ('header.php');
?>

<div class="row">
    <div class="col-md-8">
        <h2>Debug</h2>
        <?= var_dump($_SESSION); ?>
        <h2>Nous contacter</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio, praesentium neque. Architecto, ea eum dolores sit fugit voluptatum fugiat reiciendis itaque nemo. Ab beatae iusto a libero iure deleniti unde!</p>
    </div>
    <div class="col-md-4">
        <h2>Horaire d'ouvertures :</h2>

        <?php if ($ouvert): ?>
            <div class="alert alert-success">
                Le magasin sera ouvert
            </div>
        <?php else: ?>
            <div class="alert alert-danger">
                Le magasin sera fermé
            </div>
        <?php endif ?>

        <form action="" method="GET">
            <div class="form-group">
                <select name="jour" id="" class="form-control">
                    <?php foreach (JOURS as $k => $jour): ?>
                        <option value="<?= $k ?>"><?= $jour ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <input class="form-control" type="number" name="heure" id="" value="<?= $heure ?>">
            </div>
            <button class="btn btn-primary"type="submit">Vérifier si le magasin est ouvert</button>
        </form>

        <ul>
            <?php foreach(JOURS as $k => $jour): ?>
                <li <?php if($k + 1 === (int)date('N')): ?> <?php endif ?>>
                    
                    <strong><?= $jour ?></strong> : 
                    <?= creneaux_html(CRENEAUX[$k]); ?>
                </li>
            <?php endforeach ?>
        </ul>
    </div>
</div>

<?php 
require('footer.php');
?>