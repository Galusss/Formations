<?php 
$user = [
    'prenom' => 'Jean',
    'nom' => 'Doe',
    'age' => '18'
];
setcookie('user', serialize($user));
$utilisateur = $_COOKIE['user'];
var_dump(unserialize($utilisateur));



$nom = null;
if(!empty($_GET['action'] && $_GET['action'] === 'deconnecter')) {
    unset($_COOKIE['user']);
    setcookie('nom', '', time() - 10);
}
if(!empty($_COOKIE['user'])) {
    $nom = $_COOKIE['user'];
}
if(!empty($_POST)) {
    setcookie('nom', $_POST['nom']);
    $nom = $_POST['nom'];
}
require('header.php');
?>

<?php 
if ($nom): ?>
<h1>Bonjour <?= htmlspecialchars($nom) ?></h1>
<a href="profil.php?action=deconnecter">Déconnecter</a>
<?php else: ?>
<form action="" method="post">
    <div class="form-group">
        <input type="text" class="form-control" name="nom" placeholder="Entrez votre nom">
    </div>
    <button class="btn btn-primary">Envoyer</button>
</form>
<?php endif ?>

<?php
require('footer.php');
?>