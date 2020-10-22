<?php
require 'view/template/nav.php';
require 'view/template/header.php';
?>

<?php if (count($account_less_userAc) !== 0): ?>
  <div class="container">
   <div class="row">
     <form action="" method="POST" class="col-10 mx-auto my-4">
       <div class="form-group">
         <label for="accountType">Type de compte</label>
         <select class="form-control" id="accountType" name="accountType">
           <option value="">--Choisissez un type de compte--</option>
           <?php foreach ($account_less_userAc as $key => $value): ?>
             <option value=<?=$value?>><?=$value?></option>
           <?php endforeach; ?>
         </select>
         <small><?=$error_account?></small>
       </div>
       <div class="form-group">
         <label for="amountA">Depôt d'argent (Minimum 50 euro)</label>
         <input type="number" class="form-control" id="amountA" name="amountA" value="50">
         <small><?=$error_amount?></small>
       </div>
       <button id="buttonNewAccount" type="submit" class="btn btn-primary mb-2" name="valider" value="valider">Valider</button>
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
 </div>
 <?php else: ?>
   <div class="alert alert-info col-10 mx-auto text-center my-4" role="alert">
   Vous ne pouvez plus créer de compte bancaire.
 </div>
<?php endif; ?>
<?php
require 'view/template/footer.php';
?>
