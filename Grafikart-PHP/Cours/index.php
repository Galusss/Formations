<?php 
session_start();
$_SESSION['role'] = 'administrateur';
$_SESSION['user'] = [
    'user' => 'John',
    'name' => 'Doe',
    'password' => '1234'
];
//unset($_SESSION['role']);
$title = "Page d'accueil";
require ('header.php');
?>

<div class="starter-template">
    <h1>Bootstrap starter template</h1>
    <p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p>
</div>

<?php 
require('footer.php');
?>
