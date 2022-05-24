<?php 
$fichier = __DIR__ . DIRECTORY_SEPARATOR . 'demo.txt';
file_put_contents($fichier, 'Salut toi !', FILE_APPEND);
echo file_get_contents($fichier);