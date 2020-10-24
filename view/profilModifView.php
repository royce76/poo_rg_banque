<?php
include "view/template/nav.php";
include "view/template/header.php";
?>

<section class="container">
      <h3 class="text-center">Modifier vos informations</h3>
      <div class="my-4">
        <a href="index.php" class="btn btn-primary" role="button">Retour</a>
      </div>
      <div class="row">
        <form class="col-10 mx-auto" action="" method="POST">
          <div class="form-group">
            <label for="email">E-mail :</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" value=<?=$user[0]->getEmail()?>>
          </div>
          <div class="form-group">
            <label for="city">Ville :</label>
            <input type="text" class="form-control" id="city" name="city" value=<?=$user[0]->getCity()?>>
          </div>
          <div class="form-group">
            <label for="city_code">Code Postale :</label>
            <input type="number" class="form-control" id="city_code" name="cityCode" value=<?=$user[0]->getCityCode()?>>
          </div>
          <div class="form-group">
            <label for="adress">Adresse :</label>
            <input type="text" class="form-control" id="adress" name="adress" value="">
          </div>
          <div class="form-group">
            <label for="password">Mot de passe :</label>
            <input type="text" class="form-control" id="password" name="password" value=<?=$user[0]->getPassword()?>>
          </div>
          <div class="form-group">
            <label for="password_b">Confirmer mot de passe :</label>
            <input type="text" class="form-control" id="password_b" name="password_b" value=<?=$user[0]->getPassword()?>>
          </div>
          <button type="submit" class="btn btn-primary" name="validate" value="validate">Valider</button>
        </form>
        <?php if ($response !== ""): ?>
          <div class="alert alert-success col-10 mx-auto text-center" role="alert">
            <?=$response?>
            <a href="index.php" class="btn btn-primary mb-2">Retour</a>
          </div>
        <?php endif; ?>
        <?php if ($error_entries != ""): ?>
          <div class="alert alert-warning col-10 mx-auto text-center" role="alert">
            <?=$error_entries?>
          </div>
        <?php endif; ?>
        <?php if ($empty_entries !== ""): ?>
          <div class="alert alert-warning col-10 mx-auto text-center" role="alert">
            <?=$empty_entries?>
          </div>
        <?php endif; ?>
      </div>
    </section>

<?php
include "view/template/footer.php";
?>
