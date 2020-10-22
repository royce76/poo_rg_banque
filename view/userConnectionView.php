<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

  </head>
  <body>
    <main>
      <section class="container">
        <h3 class="text-center">Connexion</h3>
        <div class="row">
          <form class="col-10 mx-auto" action="" method="POST">
            <div class="form-group">
              <label for="email">Adresse E-mail :</label>
              <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
              <small><?=$error_email?></small>
            </div>
            <div class="form-group">
              <label for="password">Mot de passe :</label>
              <input type="password" class="form-control" id="password" name="password">
              <small><?=$error_password?></small>
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
          <?php if ($empty_entries !== ""): ?>
            <div class="alert alert-warning col-10 mx-auto text-center my-4" role="alert">
              <?=$empty_entries?>
            </div>
          <?php endif; ?>
          <?php if ($error_entries !== ""): ?>
            <div class="alert alert-warning col-10 mx-auto text-center my-4" role="alert">
              <?=$error_entries?>
            </div>
          <?php endif; ?>
        </div>
      </section>
    </main>

    <!--script bootstrap4-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>
