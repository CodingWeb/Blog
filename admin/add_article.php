<?php
session_start();
require_once "../connexion.php";
if (empty($_SESSION['Webcode'])) {
    header('Location: index.php');
}
if (!empty($_POST)) {
    extract($_POST);
    $valid = true;

    if (empty($pseudo)) {
        $valid = false;
        $erreurpseudo = 'Entrer votre pseudo !';
    }
    if (!empty($pseudo) && strlen($pseudo) < 3) {
        $valid = false;
        $erreurpseudo = '3 caractères minimum !';
    }
    if (empty($titre)) {
        $valid = false;
        $erreurtitre = 'Indiquez un titre !';
    }
    if (!empty($titre) && strlen($titre) < 15) {
        $valid = false;
        $erreurtitre = '15 caractère minimum';
    }
    if (empty($article)) {
        $valid = false;
        $erreurarticle = 'Veuillez entrer un article';
    }
    if (!empty($article) && strlen($article) < 250) {
        $valid = false;
        $erreurarticle = '250 caractère minimum !';
    }
    if ($valid) {
        $requete = $bdd->prepare('INSERT INTO articles (pseudo, titre, contenu) VALUES (:pseudo, :titre, :contenu)');
        $requete->execute(array(
            'pseudo' => $pseudo,
            'titre' => $titre,
            'contenu' => $article
        ));
        $requete->closeCursor();
        header('Location: admin.php');
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
    <h3>Ajouter un article</h3>

    <form name="ajout" action="add_article.php" method="post" class="form-horizontal">
        <div class="form-group">
            <div class="col-xs-4">
                <label for="pseudo">Pseudo :</label>
                <input class="form-control" placeholder="Votre pseudo" name="pseudo" id="pseudo" type="text"
                       value="<?php if (isset($pseudo)) echo $pseudo; ?>"/>

                <div class="text-danger"><b><?php if (isset($erreurpseudo)) echo $erreurpseudo; ?></b></div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-4">
                <label for="titre">Titre :</label>
                <input value="<?php if (isset($titre)) echo $titre; ?>" placeholder="Votre tire" class="form-control"
                       name="titre" id="titre" type="text"/>

                <div class="text-danger"><b><?php if (isset($erreurtitre)) echo $erreurtitre; ?></b></div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-4">
                <label for="article">Article :</label>
                <textarea rows="4" class="form-control" id="article" name="article"
                          placeholder="Rédiger un article"><?php if (isset($article)) echo $article; ?></textarea>

                <div class="text-danger"><b><?php if (isset($erreurarticle)) echo $erreurarticle; ?></b></div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-4">
                <button type="submit" class="btn btn-info">Envoyer</button>
            </div>
        </div>
    </form>
    <div class="panel-footer text-right"><a href="#haut">Haut de page</a></div>
</div>
<script src="../style/js/jquery-1.11.2.min.js" type="text/javascript"></script>
<script src="../style/js/bootstrap.js" type="text/javascript"></script>
</body>
</html>