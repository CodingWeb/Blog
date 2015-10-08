<?php
session_start();
if (!empty($_SESSION['admin']))
{
    header('Location: admin.php');
}
if (!empty($_POST)) {
    extract($_POST);
    $valid = true;
    if (empty($login)) {
        $valid = false;
        $erreurlogin = 'Indiquez votre login';
    }
    if (!empty($_POST['login']) and $_POST['login'] !== 'admin') {
        $valid = false;
        $erreurlogin = 'Votre login est incorrecte !';
    }
    if (empty($pass)) {
        $valid = false;
        $erreurpass = 'Veuillez entrer votre mot de passe';
    }

    require_once "../connexion.php";

    $requete = $bdd->prepare('SELECT id FROM admin WHERE login = :login AND pass = :pass');
    $requete->execute(array(
        'login' => $login,
        'pass' => sha1($pass)
    ));
    if (!empty($login) && !empty($pass)) {
        if ($requete->rowCount() == 0) {
            $valid = false;
            $erreurid = 'Mauvais identifiants';
        }
    }
    if ($valid) {
        $_SESSION['flash'] = array(
            'type' => 'success',
            'message' => 'Vous étes connectè avec succès <strong>' . $_SESSION['admin'] . '</strong>'
        );
        $_SESSION['admin'] = $login;
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
        <li class="active"><a href="admin.php">Admin</a></li>
    </ol>
    <h3>Authentification</h3>
    <?php if (isset($erreurid)) echo '<div class="alert alert-danger alert-dismissible text-center" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $erreurid . '</div>'; ?>
    <?php include('theme/formlogin.php') ?>
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