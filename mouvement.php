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
if (isset($_POST["valider"]) && !empty($_POST["valider"]) && $_POST["operationType"] === "debit") {
  $_POST["accountType"] = test_input($_POST["accountType"]);
  $_POST["amountO"] = test_input($_POST["amountO"]);
  $_POST["amountO"] = "-{$_POST["amountO"]}";
  $_POST["operationType"] = test_input($_POST["operationType"]);
  $_POST["label"] = test_input($_POST["label"]);
  $entries = array_filter($_POST);
  if (count($entries) === count($_POST)) {
    if ($_POST["amountO"] <= 20 && strlen($_POST["label"]) < 50) {
      $new_operation = new Operation($_POST);
      $account = new Account($_POST);
      $account_select = $account_manager->accountInMouvement($account);
      $_SESSION["account_mouvement_id"] = $account_select[0]->getId();
      $add_operation = $operation_manager->addOperation($new_operation);
      //opération addition débit
      $amount_account = $account_select[0]->getAmountA();
      $amount_operation = $new_operation->getAmountO();
      $result = $amount_account + $amount_operation;
      $_SESSION["amount_mouvement"] = $result;
      $update_account = $account_manager->updateAccountMouvement($account);
      if ($update_account) {
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
  if ($_POST["amountO"] > 20) {
    $error_amount = "*Montant non valide.";
  }
}
if (isset($_POST["valider"]) && !empty($_POST["valider"]) && $_POST["operationType"] === "credit") {
  $_POST["accountType"] = test_input($_POST["accountType"]);
  $_POST["amountO"] = test_input($_POST["amountO"]);
  $_POST["operationType"] = test_input($_POST["operationType"]);
  $_POST["label"] = test_input($_POST["label"]);
  $entries = array_filter($_POST);
  if (count($entries) === count($_POST)) {
    if ($_POST["amountO"] >= 20 && strlen($_POST["label"]) < 50) {
      $new_operation = new Operation($_POST);
      $account = new Account($_POST);
      $account_select = $account_manager->accountInMouvement($account);
      $_SESSION["account_mouvement_id"] = $account_select[0]->getId();
      $add_operation = $operation_manager->addOperation($new_operation);
      //opération addition débit
      $amount_account = $account_select[0]->getAmountA();
      $amount_operation = $new_operation->getAmountO();
      $result = $amount_account + $amount_operation;
      $_SESSION["amount_mouvement"] = $result;
      $update_account = $account_manager->updateAccountMouvement($account);
      if ($update_account) {
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
  if ($_POST["amountO"] < 20) {
    $error_amount = "*Montant non valide.";
  }
}

if (isset($_POST["valider"]) && !empty($_POST["valider"])) {
  if (empty($_POST["accountType"])) {
    $error_account = "*Champs à renseigner.";
    $empty_entries = "Vous avez oublié de remplir tous les champs.";
  }
  if (empty($_POST["amountO"])) {
    $error_amount = "*Champs à renseigner.";
    $empty_entries = "Vous avez oublié de remplir tous les champs.";
  }
  if (empty($_POST["label"])) {
    $error_label = "*Champs à renseigner.";
    $empty_entries = "Vous avez oublié de remplir tous les champs.";
  }
  if (strlen($_POST["label"]) > 50) {
    $error_label = "*Maxi 50 caractères.";
    $empty_entries = "Vous avez oublié de remplir tous les champs.";
  }
  if (empty($_POST["operationType"])) {
    $error_mouvement = "*Champs à renseigner.";
    $empty_entries = "Vous avez oublié de remplir tous les champs.";
  }
}

require 'view/mouvementView.php';
