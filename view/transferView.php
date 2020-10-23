<?php
require 'view/template/nav.php';
require 'view/template/header.php';
?>

<div class="container">
  <div class="row">
    <form action="" method="POST" class="col-10 mx-auto">
      <div class="form-group">
        <label for="compte_emetteur">Votre compte émetteur :</label>
        <select class="form-control" id="compte_emetteur" name="compte_emetteur">
          <option value="">--Choisissez votre de compte--</option>
          <?php foreach ($accounts_user as $key => $account): ?>
            <option class="emetteur" value=<?=$account->getAccountType()?>><?=$account->getAccountType()?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <label for="compte_beneficiaire">Votre compte bénéficiaire:</label>
        <select class="form-control" id="compte_beneficiaire" name="compte_beneficiaire">
          <option value="">--Choisissez votre de compte--</option>
          <?php foreach ($accounts_user as $key => $account): ?>
            <option class="beneficiaire" value=<?=$account->getAccountType()?>><?=$account->getAccountType()?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <label for="amountO">Montant (Minimum 20 euro) :</label>
        <input type="number" class="form-control" id="amountO" name="amountO" value="20" min="20" required>
      </div>
      <div class="form-group">
        <label for="label">Example label</label>
        <input type="text" class="form-control" id="label" placeholder="label..." name="label">
      </div>
      <button type="submit" class="btn btn-primary mb-2" name="valider" value="valider">Valider</button>
    </form>
    <?php if ($message !== ""): ?>
      <div class="alert alert-success col-10 mx-auto text-center" role="alert">
        <?=$message?>
        <a href="index.php" class="btn btn-primary mb-2">Retour</a>
      </div>
    <?php endif; ?>
  </div>
</div>

<script src="js/transfer.js" charset="utf-8"></script>

<?php
require 'view/template/footer.php';
?>
