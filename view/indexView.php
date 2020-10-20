<?php
require 'view/template/nav.php';
require 'view/template/header.php';
?>

<h2 class="text-center my-4">Tous vos comptes</h2>
<div class="container">
  <div class="row">
    <?php foreach ($accounts_user as $key => $accounts): ?>
      <div class="card col-10 col-md-5 mx-auto my-4" style="width: 18rem;">
        <div class="card-header">
          <?= $accounts->getAccountType(); ?>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Votre solde : <?= $accounts->getAccountType(); ?></li>
          <li class="list-group-item">Ouvert le : <?= $accounts->getAccountType(); ?></li>
          <li class="list-group-item">Dernière transaction<?= $accounts->getAccountType(); ?></li>
          <li class="list-group-item">Montant : <?= $accounts->getAccountType(); ?></li>
          <li class="list-group-item">Enregistré le : <?= $accounts->getAccountType(); ?></li>
          <li class="list-group-item">Label : <?= $accounts->getAccountType(); ?></li>
        </ul>
        <div class="card-body d-flex justify-content-center align-items-center">
          <a href=<?="showaccount.php?id={$accounts->getAccountType()}"?> class="btn btn-primary">Voir mon compte</a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<?php
require 'view/template/footer.php';
?>
