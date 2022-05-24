<?php 
require_once 'functions/auth.php';
utilisateur_connecte();
require_once 'functions/compteur.php';

$annee = (int)date('Y');
$anneeSelectionner = empty($_GET['annee']) ? null : (int)$_GET['annee'];
$moisSelectionner = empty($_GET['mois']) ? null : $_GET['mois'];
if ($anneeSelectionner && $moisSelectionner) {
    $total = nombre_vues_mois($anneeSelectionner, $moisSelectionner);
}
$mois = [
    '01' => 'Janvier',
    '02' => 'Fevrier',
    '03' => 'Mars',
    '04' => 'Avril',
    '05' => 'Mai',
    '06' => 'Juin',
    '07' => 'Juillet',
    '08' => 'Aout',
    '09' => 'Septembre',
    '10' => 'Octobre',
    '11' => 'Novembre',
    '12' => 'Decembre'
];
require 'header.php'; 
?>



<div class="row">
    <div class="col-md-4">
        <div class="list-group">
            <?php for ($i = 0; $i < 5; $i++): ?>
            <a class="list-group-item <?= $annee - $i === $anneeSelectionner ? 'active' : ''; ?>" href="dashboard.php?annee=<?= $annee - $i ?>"><?= $annee - $i ?></a>
            <?php if ($annee - $i === $anneeSelectionner): ?>
                <?php foreach($mois as $numero => $nom): ?>
                    <a href="dashboard.php?annee=<?= $anneeSelectionner ?>&mois=<?= $numero ?>" class="list-group-item <?= $numero === $moisSelectionner ? 'active' : '' ?>"><?= $nom ?></a>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php endfor; ?>
        </div>
    </div>
    <div class="col-md-8">
    <div class="card">
        <div class="card-body">
            <strong style="font-size: 3em;"><?= $total ?></strong><br>
            Visite<?php if ($total > 1): ?>s<?php endif ?> total 
        </div>
</div>
    </div>
</div>

<?php require 'footer.php'; ?>