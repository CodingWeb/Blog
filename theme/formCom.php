<h3 id="commenter">Ajouter un commentaire</h3>
<form action="../Blog/article.php?page=<?php echo $page;?>" name="form" class="form-horizontal" method="post">
  <div class="form-group">
      <div class="col-sm-4">
          <label for="pseudo">Pseudo :</label>
          <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Votre pseudo" value="<?php if (isset($pseudo)) echo $pseudo; ?>"/ >
          <div class="text-danger"><?php if (isset($erreurpseudo)) echo $erreurpseudo;?></div>
      </div>
  </div>
  <div class="form-group">
      <div class="col-sm-4">
          <label for="commentaire">Commentaire :</label>
          <textarea placeholder="Rédiger votre commentaire" name="commentaire" id="commentaire" rows="4" class="form-control"><?php if (isset($commentaire)) echo $commentaire; ?></textarea>
          <div class="text-danger"><?php if (isset($erreurcommentaire)) echo $erreurcommentaire; ?></div>
      </div>
  </div>
    <div class="form-group">
        <div class="col-sm-4">
            <button type="submit" role="button" class="btn btn-info">Envoyer</button>
        </div>
    </div>
</form>