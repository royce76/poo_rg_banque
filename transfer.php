<?php
session_start();
function test_input($data) {
  $data = trim($data); // remove space of both side
  $data = stripslashes($data);// remove backslashes
  $data = htmlspecialchars($data, ENT_QUOTES);//both quotes
  return $data;
}
require 'model/connection/Connection.php';

require 'model/entity/Account.php';
require 'model/manager/AccountManager.php';

require 'model/entity/Operation.php';
require 'model/manager/OperationManager.php';

//on récupère les comptes
$account_manager = new AccountManager();
$accounts_user = $account_manager->listAccounts();
$operation_manager = new OperationManager();

$error_entries = "";
$empty_entries = "";
$error_account = "";
$error_amount = "";
$error_label = "";
$error_mouvement = "";
$message = "";
$issuer_array = ["virement émis"];
$beneficiary_array = ["virement reçu"];
$key_array = ["operationType", "accountType","amountO", "label", "valider"];

if (isset($_POST["valider"]) && !empty($_POST["valider"])) {
  $_POST["compte_emetteur"] = test_input($_POST["compte_emetteur"]);
  $_POST["compte_beneficiaire"] = test_input($_POST["compte_beneficiaire"]);
  $_POST["amountO"] = test_input($_POST["amountO"]);
  $_POST["label"] = test_input($_POST["label"]);
  $entries = array_filter($_POST);
  if (count($entries) === count($_POST)) {
    if ($_POST["amountO"] >= 20 && strlen($_POST["label"]) < 50) {
      //we will create two arrays for the accounts in movement and make instances of them
      foreach ($_POST as $key => $value) {
        if ($key !== "compte_beneficiaire") {
          array_push($issuer_array,$_POST[$key]);
        }
      }
      foreach ($_POST as $key => $value) {
        if ($key !== "compte_emetteur") {
          array_push($beneficiary_array,$_POST[$key]);
        }
      }
      $account_issuer = array_combine($key_array, $issuer_array);
      $account_beneficiary = array_combine($key_array, $beneficiary_array);

      //we instantiate with issuer
      $new_operation_issuer = new Operation($account_issuer);
      $new_account_issuer = new Account($account_issuer);

      //we select the issuer account
      $account_select_issuer = $account_manager->accountInMouvement($new_account_issuer);
      $_SESSION["account_mouvement_id"] = $account_select_issuer[0]->getId();
      $new_operation_issuer->setAmountO($new_operation_issuer->getAmountO()*(-1));
      $add_operation_issuer = $operation_manager->addOperation($new_operation_issuer);

      //opération issuer
      $amount_account_issuer = $account_select_issuer[0]->getAmountA();
      $amount_operation_issuer = $new_operation_issuer->getAmountO();
      $result_issuer = $amount_account_issuer + $amount_operation_issuer;
      $_SESSION["amount_mouvement"] = $result_issuer;
      $update_account_issuer = $account_manager->updateAccountMouvement($new_account_issuer);

      //we instantiate with beneficiary
      $new_operation_beneficiary = new Operation($account_beneficiary);
      $new_account_beneficiary = new Account($account_beneficiary);

      //we select the beneficiary account
      $account_select_beneficiary = $account_manager->accountInMouvement($new_account_beneficiary);
      $_SESSION["account_mouvement_id"] = $account_select_beneficiary[0]->getId();
      $add_operation_beneficiary = $operation_manager->addOperation($new_operation_beneficiary);

      //opération beneficiary
      $amount_account_beneficiary = $account_select_beneficiary[0]->getAmountA();
      $amount_operation_beneficiary = $new_operation_beneficiary->getAmountO();
      $result_beneficiary = $amount_account_beneficiary + $amount_operation_beneficiary;
      $_SESSION["amount_mouvement"] = $result_beneficiary;
      $update_account_beneficiary = $account_manager->updateAccountMouvement($new_account_beneficiary);
      if ($update_account_issuer && $update_account_beneficiary) {
        $message = "Votre opération s'est bien déroulé.";
      }
      else {
        $error_entries = "Champs mal renseignésss";
      }
    }
    else {
      $error_entries = "Champs mal renseignés";
    }
  }
  else {
    $empty_entries = "Vous avez oublié de remplir tous les champs.";
  }
}

require 'view/transferView.php';
