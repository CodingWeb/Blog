<?php
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
    $bdd->exec('SET NAMES utf8');
    $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}
catch (Exception $e)
{
    die('Erreur : a la basse de données ' . $e->getMessage());
}
