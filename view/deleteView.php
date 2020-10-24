<?php
require 'view/template/nav.php';
require 'view/template/header.php';
?>
<div class="container">
   <div class="row">
     <form action="" method="POST" class="col-10 mx-auto my-4">
       <div class="form-group">
         <label for="accountType">Votre compte :</label>
         <select class="form-control" id="accountType" name="accountType">
           <option value="">--Choisissez votre de compte--</option>
           <?php foreach ($list_accounts as $key => $account): ?>
             <option value=<?=$account->getAccountType()?>><?=$account->getAccountType()?></option>
           <?php endforeach; ?>
         </select>
       </div>
       <button type="submit" class="btn btn-primary mb-2" name="delete" value="delete">Supprimer</button>
     </form>
   </div>
 </div>
<?php
require 'view/template/footer.php';
?>
