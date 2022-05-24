<?php 
require 'class/Creneau.php';
require 'class/Form.php';
$creneau = new Creneau(8, 12);
$creneau2 = new Creneau(10, 19);
$creneau->intercept($creneau2);
var_dump(
    $creneau->intercept($creneau2)
);
echo $creneau->toHtml();

$form = new Form();
echo Form::checkbox('demo', 'Demo', []);