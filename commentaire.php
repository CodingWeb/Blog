<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
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
                <li><a href="article.php">Article</a></li>
                  <li class="active"><a href="commentaire.php">Commentaire</a></li>
            </ol>
            <div class="panel-footer text-right"><a href="#haut">Haut de page</a></div>
        </div>
    </div>
</div>
</body>
<script src="../../js/jquery-1.11.2.min.js" type="text/javascript"></script>
<script src="../../js/bootstrap.js" type="text/javascript"></script>
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