<?php
include 'view/template/nav.php';
include 'view/template/header.php';
?>
<section class="container">
  <h3 class="text-center">Connexion</h3>
  <div class="row">
    <form class="col-10 mx-auto" action="" method="POST">
      <div class="form-group">
        <label for="email">Adresse E-mail :</label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
      </div>
      <div class="form-group">
        <label for="password">Mot de passe :</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>
      <button type="submit" class="btn btn-primary" name="connect" value="Valider">Valider</button>
    </form>
  </div>
</section>
<section class="container">
  <h3 class="text-center">Créer votre profil</h3>
  <div class="row">
    <form class="col-10 mx-auto" action="" method="POST">
      <button type="submit" class="btn btn-primary" name="connexion" value="connexion">Nouveau profil</button>
    </form>
  </div>
</section>
<?php
include 'view/template/footer.php';
?>
