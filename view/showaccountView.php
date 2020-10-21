<?php
require 'view/template/nav.php';
require 'view/template/header.php';
?>

<article>
  <h3 class="text-center my-4">Votre compte et vos dernières opérations</h3>
  <div class="container">
    <div class="row">
      <div class="card col-10 col-md-5 mx-auto my-4" style="width: 18rem;">
        <div class="card-header">
          <?= $show_account_single[0]->getAccountType()?>
        </div>
        <ul class="list-group list-group-flush">
          <?php foreach ($show_account_single as $key => $account): ?>
            <li class="list-group-item">Votre solde : <?=$account->getAmountA()?> euro</li>
            <li class="list-group-item">Enregistré le : <?=$account->getOpeningDate()?></li>
          <?php endforeach; ?>
        </ul>
        <a href="index.php" class="btn btn-primary">Acceuil</a>
      </div>
      <table class="table col-10 col-md-5 mx-auto my-4">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Opérations</th>
            <th scope="col">Montant</th>
            <th scope="col">Date</th>
            <th scope="col">Label</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($show_operations as $key => $operation): ?>
            <tr>
              <th scope="row"><?=$operation->getOperationType()?></th>
              <td><?=$operation->getAmountO()?></td>
              <td><?=$operation->getRegistered()?></td>
              <td><?=$operation->getLabel()?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</article>

<?php
require 'view/template/footer.php';
?>
