<?php
require 'view/template/nav.php';
require 'view/template/header.php';
?>

<h2 class="text-center my-4">Tous vos comptes</h2>
<div class="container">
  <div class="row">
    <?php for ($i=0; $i < count($account_last_operation) ; $i++): ?>
      <?php if ($account_last_operation[$i]->getAccountId() === $accounts_user[$i]->getId()): ?>
        <div class="card col-10 col-md-5 mx-auto my-4" style="width: 18rem;">
          <div class="card-header">
            <?=$accounts_user[$i]->getAccountType()?>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Votre solde : <?=$accounts_user[$i]->getAmountA()?></li>
            <li class="list-group-item">Ouvert le : <?=$accounts_user[$i]->getOpeningDate()?></li>
            <li class="list-group-item">Dernière transaction : <?=$account_last_operation[$i]->getOperationType()?></li>
            <li class="list-group-item">Montant : <?=$account_last_operation[$i]->getAmountO()?></li>
            <li class="list-group-item">Enregistré le : <?=$account_last_operation[$i]->getRegistered()?></li>
            <li class="list-group-item">Label : <?=$account_last_operation[$i]->getLabel()?></li>
          </ul>
          <div class="card-body d-flex justify-content-center align-items-center">
            <a href=<?="showaccount.php?id={$accounts_user[$i]->getId()}"?> class="btn btn-primary">Voir mon compte</a>
          </div>
        </div>
      <?php else: ?>
        <div class="card col-10 col-md-5 mx-auto my-4" style="width: 18rem;">
          <div class="card-header">
            <?=$accounts_user[$i]->getAccountType()?>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Votre solde : <?=$accounts_user[$i]->getAmountA()?></li>
            <li class="list-group-item">Ouvert le : <?=$accounts_user[$i]->getOpeningDate()?></li>
            <li class="list-group-item">Dernière transaction : Aucune...</li>
          </ul>
          <div class="card-body d-flex justify-content-center align-items-center">
            <a href=<?="showaccount.php?id={$accounts_user[$i]->getId()}"?> class="btn btn-primary">Voir mon compte</a>
          </div>
        </div>
      <?php endif; ?>
    <?php endfor; ?>    
  </div>
</div>

<?php
require 'view/template/footer.php';
?>
