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

$account_manager = new AccountManager();
$accounts_user = $account_manager->showAccounts();

//on récupère la liste des comptes de user
$account_user = [];
foreach ($accounts_user as $key => $value) {
  $account_user[] = $value->getAccountType();
}
$ACCOUNT_TYPE = [
  "Compte_Courant",
  "Livret_A",
  "PEL",
  "Livret_Jeune",
  "Perp",
  "Lep"
];
//et on récupère les comptes n'appartenant pas à user
$account_less_userAc = array_diff($ACCOUNT_TYPE,$account_user);

$error_entries = "";
$empty_entries = "";
$message = "";
$error_account = "";
$error_amount = "";
if (isset($_POST["valider"]) && !empty($_POST["valider"])) {
  $_POST["accountType"] = test_input($_POST["accountType"]);
  $_POST["amountA"] = test_input($_POST["amountA"]);
  $entries = array_filter($_POST);
  if (count($entries) === count($_POST)) {
    if ($_POST["amountA"] >= 50) {
      $new_account = new Account($_POST);
      if ($new_account) {
        $add_account = $account_manager->addAccount($new_account);
        if ($add_account) {
          $_SESSION["message"] = "Bravo votre nouveau compte a été ajouté.";
          header("Location: index.php");
          exit();
        }
      }
      else {
        $error_entries = "Champs mal renseignés";
      }
    }
    else {
      $error_entries = "Champs mal renseignés";
    }
  }
  else {
    $empty_entries = "Vous avez oublié de remplir tous les champs.";
  }

  if (empty($_POST["accountType"])) {
    $error_account = "*Champs à renseigner.";
  }
  if (empty($_POST["amountA"])) {
    $error_amount = "*Champs à renseigner.";
  }
  if ($_POST["amountA"] < 50) {
    $error_amount = "*Montant non valide.";
  }

}

require 'view/formView.php';
