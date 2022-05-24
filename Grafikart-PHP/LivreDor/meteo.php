<?php 
declare(strict_types=1);
require_once 'class/OpenWeather.php';
$weather = new OpenWeather('dd6ecf990423f22444e8c9f4bac30f63');
$error = null;
try {
    //$data = explode(' ');
    $today = $weather->getToday('Grenoble, fr');
} catch (CurlException $e) {
    exit($e->getMessage());
} catch (Exception | Error $e) {
    $error = $e->getCode() . ' : ' . $e->getMessage();
}
require 'elements/header.php';
?>

<?php if ($error): ?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php else: ?>

<div class="container">
    <h1>La météo de Grenoble</h1>
    <p> Température : <?= $today['temp'] ?>°C <br> Description : <?= $today['description'] ?></p>
</div>

<?php endif ?>

<?php require 'elements/footer.php'; ?>
