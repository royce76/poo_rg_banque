<?php
require 'view/template/nav.php';
require 'view/template/header.php';
?>

<div class="container">
  <div class="row">
    <form action="" method="POST" class="col-10 mx-auto">
      <div class="form-group">
        <label for="accountType">Votre compte :</label>
        <select class="form-control" id="accountType" name="accountType">
          <option value="">--Choisissez votre de compte--</option>
          <?php foreach ($accounts_user as $key => $account): ?>
                <option value=<?=$account->getAccountType()?>><?=$account->getAccountType()?></option>
          <?php endforeach; ?>
        </select>
        <small><?=$error_account?></small>
      </div>
      <div class="form-group">
        <label for="operationType">Retrait/Dépôt :</label>
        <select class="form-control" id="operationType" name="operationType">
          <option value="">--Retrait/Dépôt--</option>
          <option value="debit">Débit</option>
          <option value="credit">Crédit</option>
        </select>
        <small><?=$error_mouvement?></small>
      </div>
      <div class="form-group">
        <label for="amountO">Montant (Minimum 20 euro) :</label>
        <input type="number" class="form-control" id="amountO" name="amountO" required>
        <small><?=$error_amount?></small>
      </div>
      <div class="form-group">
        <label for="label">Example label : max 50 caractères</label>
        <input type="text" class="form-control" id="label" placeholder="label..." name="label">
        <small><?=$error_label?></small>
      </div>
      <button type="submit" class="btn btn-primary mb-2" name="valider" value="valider">Valider</button>
    </form>
    <?php if ($message !== ""): ?>
      <div class="alert alert-success col-10 mx-auto text-center" role="alert">
        <?=$message?>
        <a href="index.php" class="btn btn-primary mb-2">Retour</a>
      </div>
    <?php endif; ?>
    <?php if ($error_entries !== ""): ?>
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
</div>

<?php
require 'view/template/footer.php';
?>
