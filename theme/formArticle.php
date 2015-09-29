<!-- Le formulaire de l'article -->
<form name="form" class="form-horizontal" action="index.php" method="post" role="form">
    <div class="form-group">
        <div class="col-sm-4">
            <label for="pseudo">Pseudo :</label>
            <input value="<?php if (isset($pseudo)) echo $pseudo; ?>" type="text" name="pseudo" id="pseudo"
                   placeholder="Entrer votre pseudo" class="form-control">

            <div class="text-danger"><?php if (isset($erreurpseudo)) echo $erreurpseudo; ?></div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-4">
            <label for="titre">Titre de l'article :</label>
            <input value="<?php if (isset($titre)) echo $titre; ?>" type="text" placeholder="Entrer votre titre"
                   name="titre" id="titre" class="form-control">

            <div class="text-danger"><?php if (isset($erreurtitre)) echo $erreurtitre; ?></div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-4">
            <label for="article">Votre article :</label>
            <textarea placeholder="Rédiger votre article.." name="article" id="article" class="form-control"
                      rows="5"><?php if (isset($article)) echo $article; ?></textarea>

            <div class="text-danger"><?php if (isset($erreurarticle)) echo $erreurarticle; ?></div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-4">
            <button type="submit" class="btn btn-info">Envoyer</button>
        </div>
    </div>
</form>