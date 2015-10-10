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

    $requetes = $bdd->prepare('SELECT article_id FROM articles WHERE article_id = :article_id');
    $requetes->execute(array('article_id' => $page));
    if ($requetes->rowCount()==0)
    {
        header('Location: index.php');
    }
    $requetes->closeCursor();

    $requetes = $bdd->prepare('DELETE FROM articles WHERE article_id=:article_id');
    $requetes->execute(array('article_id' => $page));
    header('Location: admin.php');
}
?>