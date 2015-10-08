<?php session_start();
if (empty($_SESSION['admin']))
{
    header('Location: index.php');
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
        <li class="active"><a href="admin.php">Admin</a></li>
    </ol>
    <?php
    /*
     * On regarde si on a un message et si c'est le cas
     * alors on le supprime des sessions (et seulement le message)
     * et on l'affiche dans une alert
     */
    if (isset($_SESSION['flash'])) {
        $message = $_SESSION['flash'];
        unset($_SESSION['flash']);
        ?>
        <div class="alert alert-<?php echo $message['type']; ?> alert-dismissible text-center" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <p>
                <?php echo $message['message']; ?>
            </p>
        </div>
        <?php
    }
    ?>
    <?php
    require_once "../connexion.php";
    $requete = $bdd->query('SELECT * FROM articles ORDER BY article_id DESC');
    while ($donnees = $requete->fetch()): ?>
        <div class="well"> <a class="pull-right clearfix" href="editer.php?page=<?php echo $donnees->article_id; ?>">Editer cet article</a>
            <h3 class="text-center"><?php echo strip_tags($donnees->titre); ?></h3>

            <p><?php echo nl2br(strip_tags($donnees->contenu)); ?></p>
            <p class="pull-right clearfix text-info"><?php echo ucfirst(strip_tags($donnees->pseudo)); ?> à
                postée
                le <?php echo date('j/n/Y à G:i', strtotime($donnees->date)) ?></p>
            <p><a href="suprimer.php?page=<?php echo $donnees->article_id; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></p>
        </div>

    <?php endwhile;
    ?>
    <div class="panel-footer text-right"><a href="#haut">Haut de page</a></div>
</div>
<script src="../style/js/jquery-1.11.2.min.js" type="text/javascript"></script>
<script src="../style/js/bootstrap.js" type="text/javascript"></script>
<script>
    /* Affiche la boite de dialogue avec des réglages pour la fermeture */
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
</body>
</html>