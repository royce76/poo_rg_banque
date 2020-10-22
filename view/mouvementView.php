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
      </div>
      <div class="form-group">
        <label for="operationType">Retrait/Dépôt :</label>
        <select class="form-control" id="operationType" name="operationType">
          <option value="">--Retrait/Dépôt--</option>
          <option value="debit">Débit</option>
          <option value="credit">Crédit</option>
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
  </div>
</div>

<?php
require 'view/template/footer.php';
?>
