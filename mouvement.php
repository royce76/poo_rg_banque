<?php
session_start();
if (!isset($_SESSION["user_info"]) && empty($_SESSION["user_info"])) {
  header("Location: userConnection.php");
  exit();
}
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

//function for mouvement
function mouvement(array $data):string {
  $message = "";
  $operation_manager = new OperationManager();
  $account_manager = new AccountManager();
  $new_operation = new Operation($data);
  $account = new Account($data);
  //i select the right account user
  $account_select = $account_manager->accountInMouvement($account);
  $_SESSION["account_mouvement_id"] = $account_select[0]->getId();
  $add_operation = $operation_manager->addOperation($new_operation);
  //opération
  $amount_account = $account_select[0]->getAmountA();
  $amount_operation = $new_operation->getAmountO();
  $result = $amount_account + $amount_operation;
  $_SESSION["amount_mouvement"] = $result;
  //and we update this account
  $update_account = $account_manager->updateAccountMouvement($account);
  if ($update_account) {
    $message = "Votre opération s'est bien déroulé.";
  }
  else {
    $message = "erreur de notre part, désolé";
  }
  return $message;
}

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
$response = "";
$entries = array_filter($_POST);

if (isset($_POST["valider"]) && !empty($_POST["valider"]) && $_POST["operationType"] === "debit") {
  $_POST["amountO"] = "-{$_POST["amountO"]}";
  if (count($entries) === count($_POST)) {
    if ($_POST["amountO"] <= (-20) && strlen($_POST["label"]) < 50) {
      $response = mouvement($_POST);
    }
    else {
      $error_entries = "Champs mal renseignés";
    }
  }
  else {
    $empty_entries = "Vous avez oublié de remplir tous les champs.";
  }
  if ($_POST["amountO"] > (-20)) {
    $error_amount = "*Montant non valide.";
  }
}

if (isset($_POST["valider"]) && !empty($_POST["valider"]) && $_POST["operationType"] === "credit") {
  if (count($entries) === count($_POST)) {
    if ($_POST["amountO"] >= 20 && strlen($_POST["label"]) < 50) {
      $response = mouvement($_POST);
    }
    else {
      $error_entries = "Champs mal renseignés";
    }
  }
  if ($_POST["amountO"] < 20) {
    $error_amount = "*Montant non valide.";
  }
}

if (isset($_POST["valider"]) && !empty($_POST["valider"])) {
  if (count($entries) !== count($_POST)) {
    $empty_entries = "Vous avez oublié de remplir tous les champs.";
  }
  if (empty($_POST["accountType"])) {
    $error_account = "*Champs à renseigner.";
  }
  if (empty($_POST["amountO"])) {
    $error_amount = "*Champs à renseigner.";
  }
  if (empty($_POST["label"])) {
    $error_label = "*Champs à renseigner.";
  }
  if (strlen($_POST["label"]) > 50) {
    $error_label = "*Maxi 50 caractères.";
  }
  if (empty($_POST["operationType"])) {
    $error_mouvement = "*Champs à renseigner.";
  }
}

require 'view/mouvementView.php';
