<?php
include "view/template/nav.php";
include "view/template/header.php";
?>

<section class="container">
      <h3 class="text-center">Modifier vos informations</h3>
      <div class="row">
        <div class="col-10 mx-auto my-4">
          <a href="index.php" class="btn btn-primary" role="button">Retour</a>
        </div>
        <form class="col-10 mx-auto my-4" action="" method="POST">
          <div class="form-group">
            <label for="email">E-mail : <?=$user[0]->getEmail()?></label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
            <small><?=$email?></small>
          </div>
          <div class="form-group">
            <label for="city">Ville : <?=$user[0]->getCity()?></label>
            <input type="text" class="form-control" id="city" name="city">
            <small><?=$city?></small>
          </div>
          <div class="form-group">
            <label for="city_code">Code Postale : <?=$user[0]->getCityCode()?></label>
            <input type="number" class="form-control" id="city_code" name="cityCode">
            <small><?=$city_code?></small>
          </div>
          <div class="form-group">
            <label for="adress">Adresse : <?=$user[0]->getAdress()?></label>
            <input type="text" class="form-control" id="adress" name="adress">
            <small><?=$adress?></small>
          </div>
          <div class="form-group">
            <label for="password">Mot de passe : <?=$user[0]->getPassword()?></label>
            <input type="text" class="form-control" id="password" name="password">
            <small><?=$password?></small>
          </div>
          <div class="form-group">
            <label for="password_b">Confirmer mot de passe :</label>
            <input type="text" class="form-control" id="password_b" name="password_b">
            <small><?=$password?></small>
            <small><?=$password_b?></small>
          </div>
          <button type="submit" class="btn btn-primary" name="validate" value="validate">Valider</button>
        </form>
        <?php if ($response !== ""): ?>
          <div class="alert alert-success col-10 mx-auto text-center my-4" role="alert">
            <?=$response?>
            <a href="index.php" class="btn btn-primary mb-2">Retour</a>
          </div>
        <?php endif; ?>
        <?php if ($error_entries != ""): ?>
          <div class="alert alert-warning col-10 mx-auto text-center my-4" role="alert">
            <?=$error_entries?>
          </div>
        <?php endif; ?>
        <?php if ($empty_entries !== ""): ?>
          <div class="alert alert-warning col-10 mx-auto text-center my-4" role="alert">
            <?=$empty_entries?>
          </div>
        <?php endif; ?>
      </div>
    </section>

<?php
include "view/template/footer.php";
?>
