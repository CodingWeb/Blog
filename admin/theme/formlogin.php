<form method="post" class="form-horizontal" role="form" action="../admin/index.php">
    <div class="form-group">
        <div class="col-sm-4">
            <label for="login">Login :</label>
            <input class="form-control" name="login" id="login" type="text" value="<?php if (isset($login)) echo $login; ?>" />
            <div class="text-danger"><b><?php if (isset($erreurlogin)) echo $erreurlogin; ?></b></div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-4">
            <label for="pass">Mot de pass :</label>
            <input class="form-control" id="pass" type="password" name="pass" />
            <div class="text-danger"><b><?php if (isset($erreurpass)) echo $erreurpass; ?></b></div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-4">
           <button type="submit" class="btn btn-info">Connexion</button>
        </div>
    </div>
</form>