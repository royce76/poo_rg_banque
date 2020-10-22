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
if (isset($_POST["valider"]) && !empty($_POST["valider"]) && $_POST["operationType"] === "debit") {
  $_POST["accountType"] = test_input($_POST["accountType"]);
  $_POST["amountO"] = test_input($_POST["amountO"]);
  $_POST["amountO"] = "-{$_POST["amountO"]}";
  $_POST["operationType"] = test_input($_POST["operationType"]);
  $_POST["label"] = test_input($_POST["label"]);
  $entries = array_filter($_POST);
  // if (count($entries) === count($_POST)) {
  //   if ($_POST["amountO"] >= 20) {
      $new_operation = new Operation($_POST);
      // var_dump($new_operation);
      $account = new Account($_POST);
      // var_dump($account);
      $account_select = $account_manager->accountInMouvement($account);
      $_SESSION["account_mouvement_id"] = $account_select[0]->getId();
      $add_operation = $operation_manager->addOperation($new_operation);
      //opération addition crédit
      $amount_account = $account_select[0]->getAmountA();
      $amount_operation = $new_operation->getAmountO();
      $result = $amount_account + $amount_operation;
      $_SESSION["amount_mouvement"] = $result;
      echo $_SESSION["amount_mouvement"];
      $update_account = $account_manager->updateAccountMouvement($account);
      print_r($update_account);
      // if ($new_operation) {
      //   $add_account = $account_manager->addAccount($new_account);
      //   if ($add_account) {
      //     header("Location: index.php");
      //     exit();
      //   }
      // }
      // else {
      //   $error_entries = "Champs mal renseignés";
      // }
    // }
    // else {
    //   $error_entries = "Champs mal renseignés";
    // }
  // }
  // else {
  //   $empty_entries = "Vous avez oublié de remplir tous les champs.";
  // }

  if (empty($_POST["accountType"])) {
    $error_account = "*Champs à renseigner.";
  }
  if (empty($_POST["amountO"])) {
    $error_amount = "*Champs à renseigner.";
  }
  if ($_POST["amountO"] < 20) {
    $error_amount = "*Montant non valide.";
  }

}

require 'view/mouvementView.php';
