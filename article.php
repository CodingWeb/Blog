<?php
require_once('connexion.php');
// redirige si rien n'est indiqué dans l'URL
if (empty($_GET)) {
    header('Location: index.php');
}
if (!empty($_GET)) {
    extract($_GET);
    $page = strip_tags($page);
}
// redirige si paramètre est indiqué dans l'URL
$requete = $bdd->prepare('SELECT titre FROM articles WHERE article_id = :article_id');
$requete->execute(array('article_id' => $page));
if ($requete->rowCount() == 0) {
    header('Location: index.php');
}
$donnes = $requete->fetch();
$titre = strip_tags($donnes->titre);
$requete->closeCursor();

$requete = $bdd->prepare('SELECT id FROM commentaires WHERE article_id = :article_id');
$requete->execute(array('article_id' => $page));
$nombrecommentaire = $requete->rowCount();
$requete->closeCursor();
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titre;?></title>
    <link href="../../css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="style.css" rel="stylesheet" type="text/css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body id="haut">
<?php
include('theme/menu.php');
?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <ol class="breadcrumb">
                <li>Accueil</li>
                <li class="active"><a href="article.php">Article</a></li>
            </ol>
            <?php
            $requete = $bdd->prepare('SELECT * FROM articles WHERE article_id = :article_id');
            $requete->execute(array('article_id' => $page));
            while ($donnes = $requete->fetch()): ?>
                <div class="well">
                    <a href="#"><h2 class="text-center"><?php echo ucfirst(strip_tags($donnes->titre));?></h2></a>
                    <p><?php echo nl2br(strip_tags($donnes->contenu));?></p>
                    <p id="datecom" class="text-right text-info"><?php echo ucfirst(strip_tags($donnes->pseudo)); ?> à
                        postée
                        le <?php echo date('j/n/Y à G:i', strtotime($donnes->date)) ?></p>
                </div>
            <?php endwhile;
            ?>
            <div class="panel-footer text-right"><a href="#haut">Haut de page</a></div>
        </div>
    </div>
</div>
</body>
</html>