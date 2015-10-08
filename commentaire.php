<?php
require_once "connexion.php";
if (empty($_GET))
{
    header('Location: index.php');
}
if (!empty($_GET))
{
    extract($_GET);
    $page = strip_tags($page);
}
$requete = $bdd->prepare('SELECT id FROM commentaires WHERE article_id = :article_id');
$requete->execute(array('article_id' => $page));
if ($requete->rowCount()==0)
{
    header('Location: index.php');
}
$requete = $bdd->prepare('SELECT titre FROM articles WHERE article_id = :article_id');
$requete->execute(array('article_id' => $page));
$donnees = $requete->fetch();
$titre = strip_tags($donnees->titre);
$requete->closeCursor();

$requete = $bdd->prepare('SELECT pseudo, titre FROM articles WHERE article_id = :article_id');
$requete->execute(array('article_id' => $page));
$donnees = $requete->fetch();
$requete->closeCursor();
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titre; ?></title>
    <link href="style/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="style/css/style.css" rel="stylesheet" type="text/css">
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
                <li><a href="article.php?page=<?php echo $page; ?>">Article</a></li>
                  <li class="active"><a href="commentaire.php?page=<?php echo $page; ?>">Commentaire</a></li>
            </ol>
            <h4>Article : <a href="article.php?page=<?php echo $page; ?>"><?php echo $donnees->titre .'</a> Postée par '.$donnees->pseudo; ?></h4>
            <?php
            $requete = $bdd->prepare('SELECT * FROM commentaires WHERE article_id = :article_id ORDER BY id DESC');
            $requete->execute(array('article_id' => $page));
            while ($donnees = $requete->fetch()): ?>
            <div class="well">
                <p><?php echo nl2br(strip_tags($donnees->contenu)); ?></p>
                <p class="pull-right clearfix text-info"><?php echo ucfirst(strip_tags($donnees->pseudo)); ?> à
                    postée
                    le <?php echo date('j/n/Y à G:i', strtotime($donnees->date)) ?></p><br>
            </div>
            <?php endwhile;
            ?>
            <div class="panel-footer text-right"><a href="#haut">Haut de page</a></div>
        </div>
    </div>
</div>
</body>
<script src="style/js/jquery-1.11.2.min.js" type="text/javascript"></script>
<script src="style/js/bootstrap.js" type="text/javascript"></script>
<script>
    /* Affiche la boîte de dialogue avec des réglages pour la fermeture */
    $(function () {
        var alert = $('.alert');
        if (alert.length > 0) {
            alert.hide().show().delay(3000).slideUp(2000);
        }
    });
    $(document).ready(function() {
        $('a[href=#haut]').click(function(){
            $('html, body').animate({scrollTop:0}, 'slow');
            return false;
        });
    });
</script>
</html>