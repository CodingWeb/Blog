<?php
session_start();
if (empty($_SESSION['Webcode']))
{
    header('Location: index.php');
}
if (empty($_GET))
{
    header('Location: index.php');
}
if (!empty($_GET))
{
    extract($_GET);
    $page = strip_tags($page);
    require_once "../connexion.php";

    $requetes = $bdd->prepare('SELECT * FROM commentaires WHERE id=:id');
    $requetes->execute(array('id' => $page));
    if ($requetes->rowCount() == 0) {
        header('Location: index.php');
    }
    $requetes->closeCursor();

    $requetes = $bdd->prepare('DELETE FROM commentaires WHERE id=:id');
    $requetes->execute(array('id' => $page));
    header('Location: admin.php');
    $requetes->closeCursor();
}