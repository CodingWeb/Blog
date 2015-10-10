<h3 id="commenter">Ajouter un commentaire</h3>
<form action="../Blog/article.php?page=<?php echo $page; ?>" name="form" class="form-horizontal" method="post">
    <div class="form-group">
        <div class="col-sm-4">
            <label for="pseudo">Pseudo :</label>
            <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Votre pseudo"
                   value="<?php if (isset($pseudo)) echo $pseudo; ?>"/ >
            <div class="text-danger"><b><?php if (isset($erreurpseudo)) echo $erreurpseudo; ?></b></div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-4">
            <label for="commentaires">Commentaire :</label>
            <textarea id="commentaires" placeholder="Rédiger votre commentaire" name="commentaire" rows="4"
                      class="form-control"></textarea>

            <div class="text-danger"><b><?php if (isset($erreurcommentaire)) echo $erreurcommentaire; ?></b></div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-4">
            <button type="submit" role="button" class="btn btn-info">Envoyer</button>
        </div>
    </div>
</form>