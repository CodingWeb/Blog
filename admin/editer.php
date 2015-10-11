<?php
session_start();

if (empty($_SESSION['Webcode'])) {
    header('Location: index.php');
}

if (empty($_GET)) {
    header('Location: index.php');
}

if (!empty($_GET)) {
    extract($_GET);
    $page = strip_tags($page);
    require_once "../connexion.php";

    $requetes = $bdd->prepare('SELECT article_id FROM articles WHERE article_id=:article_id');
    $requetes->execute(array('article_id' => $page));
    if ($requetes->rowCount() == 0) {
        header('Location: index.php');
    }
    $requetes->closeCursor();

    if (!empty($_POST)) {
        extract($_POST);
        $valid = true;

        if (empty($pseudo)) {
            $valid = false;
            $erreurpseudo = 'Indiquez un pseudo';
        }
        if (empty($titre)) {
            $valid = false;
            $erreurtitre = 'Indiquez votre titre';
        }
        if (empty($article)) {
            $valid = false;
            $erreurarticle = 'Indiquez votre titre';
        }
        if ($valid) {
            $requetes = $bdd->prepare('UPDATE articles SET pseudo=:pseudo, titre=:titre, contenu=:contenu WHERE article_id=:article_id');
            $requetes->execute(array(
                'pseudo' => $pseudo,
                'titre' => $titre,
                'contenu' => $article,
                'article_id' => $page
            ));
            $requetes->closeCursor();
            header('Location: admin.php?page=' . $page);
        }
    }
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document sans titre</title>
    <link href="../style/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="../style/css/style.css" rel="stylesheet" type="text/css">
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
    <ol class="breadcrumb">
        <li class="active">Accueil</li>
        <li class="active"><a href="index.php">Admin</a></li>
    </ol>
    <h3>Modifier l'article</h3>
    <?php
    $requetes = $bdd->prepare('SELECT pseudo, titre, contenu FROM articles WHERE article_id=:article_id');
    $requetes->execute(array('article_id' => $page));
    $donnees = $requetes->fetch();
    $pseudo = strip_tags($donnees->pseudo);
    $titre = strip_tags($donnees->titre);
    $article = strip_tags($donnees->contenu);
    $requetes->closeCursor();
    ?>
    <form class="form-horizontal" action="editer.php?page=<?php echo $page; ?>" method="post" name="edit">
        <div class="form-group">
            <div class="col-xs-4">
                <label for="pseudo">Pseudo :</label>
                <input type="text" name="pseudo" id="pseudo" class="form-control" value="<?php echo $pseudo; ?>"/>

                <div class="text-danger"><b><?php if (isset($erreurpseudo)) echo $erreurpseudo; ?></b></div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-4">
                <label for="titre">Titre :</label>
                <input class="form-control" name="titre" id="titre" type="text" value="<?php echo $titre; ?>"/>

                <div class="text-danger"><b><?php if (isset($erreurtitre)) echo $erreurtitre; ?></b></div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-4">
                <label for="article">Article :</label>
                <textarea class="form-control" id="article" name="article" rows="4"><?php echo $article; ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-4">
                <button class="btn btn-info" name="envoyer" type="submit">Modifier</button>
            </div>
        </div>
    </form>
    <?php
    $requetes = $bdd->prepare('SELECT * FROM commentaires WHERE article_id = :article_id ORDER BY id DESC');
    $requetes->execute(array('article_id' => $page));
    while ($donnees = $requetes->fetch()): ?>
        <div class="well">
            <p><?php echo nl2br(strip_tags($donnees->contenu)); ?></p>

            <p class="pull-right text-info"><?php echo ucfirst(strip_tags($donnees->pseudo)); ?> à
                postée
                le <?php echo date('j/n/Y à G:i', strtotime($donnees->date)) ?></p>
                <span><a title="Suprimer l'article" href="suprimer_commentaire.php?page=<?php echo $donnees->id; ?>"><span
                            class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></span>

        </div>
    <?php endwhile;
    ?>

    <div class="panel-footer text-right"><a href="#haut">Haut de page</a></div>
</div>
<script src="../style/js/jquery-1.11.2.min.js" type="text/javascript"></script>
<script src="../style/js/bootstrap.js" type="text/javascript"></script>
<script>
    /* Affiche la boîte de dialogue avec des réglages pour la fermeture */
    $(function () {
        var alert = $('.alert');
        if (alert.length > 0) {
            alert.hide().show().delay(3000).slideUp(2000);
        }
    });
    $(document).ready(function () {
        $('a[href=#haut]').click(function () {
            $('html, body').animate({scrollTop: 0}, 'slow');
            return false;
        });
    });
</script>
</body>
</html>