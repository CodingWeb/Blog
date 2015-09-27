<?php
require_once('connexion.php');
if (!empty($_POST)) {
    extract($_POST);
    $valid = true;

    if (empty($pseudo)) {
        $valid = false;
        $erreurpseudo = 'Indiquez votre pseudo';
    }
    if (!empty($pseudo) && strlen($pseudo)< 3) {
        $valid = false;
        $erreurpseudo = '3 caractère minimum';
    }
    if (empty($titre)) {
        $valid = false;
        $erreurtitre = 'Indiquez un titre';
    }
    if (!empty($titre) && strlen($titre)< 15) {
        $valid = false;
        $erreurtitre = '15 caractère minimum';
    }
    if (empty($article)) {
        $valid = false;
        $erreurarticle = 'Vous devez rédiger un article.';
    }
    if (!empty($article) && strlen($article)< 255) {
        $valid = false;
        $erreurarticle = 'Votre article ne comporte pas 255 caractére';
    }
    if (!empty($article) && !empty($pseudo) && !empty($titre)) {
        $valid = true;
        $articleEnvoyer = 'Votre article a été posté avec succès';
    }
    if ($valid) {
        $requetes = $bdd->prepare('INSERT INTO articles (pseudo, titre, contenu) VALUES (:pseudo, :titre, :contenu)');
        $requetes->execute(array(
            'pseudo' => $pseudo,
            'titre' => $titre,
            'contenu' => $article
        ));
        $requetes->closeCursor();
        unset($pseudo);
        unset($titre);
        unset($article);
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
        <?php if (isset($articleEnvoyer)) echo '<div class="alert alert-success alert-dismissible text-center" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $articleEnvoyer . '</div>'; ?>
      <ol class="breadcrumb">
        <li class="active"><a href="index.php">Accueil</a></li>
      </ol>
      <div class="jumbotron">
        <h1 class="text-center">Bienvenue sur mon blog</h1>
      </div>
          <?php
          $requetes = $bdd->query('SELECT * FROM articles');
          while ($donnees = $requetes->fetch()): ?>
        <div class="well">
          <a href="article.php?page=<?php echo $donnees->article_id;?>">
              <h2 class="text-center"><?php echo ucfirst(strip_tags($donnees->titre));?></h2>
          </a>
          <p><?php echo nl2br(strip_tags($donnees->contenu));?></p>
          <p class="text-right text-info"><?php echo ucfirst(strip_tags($donnees->pseudo));?> à postée le <?php echo date('j/n/Y à G:i', strtotime($donnees->date)) ?></p>
         </div>
          <?php endwhile;
          ?>
      <hr>
      <h3 id="poster">Ajouter un article</h3>
        <?php include('theme/formArticle.php'); ?>
        <div class="panel-footer text-right"><a href="#haut">Haut de page</a></div>
    </div>
  </div>
</div>
<script src="../../js/jquery-1.11.2.min.js" type="text/javascript"></script> 
<script src="../../js/bootstrap.js" type="text/javascript"></script>
<script>
    $(function () {
        var alert = $('.alert');
        if(alert.length > 0){
            alert.hide().show().delay(3000).slideUp(2000);
        }
    });
</script>
</body>
</html>