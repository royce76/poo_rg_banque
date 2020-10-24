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

$account_manager = new AccountManager();
$list_accounts = $account_manager->listAccounts();
$operation_manager = new OperationManager();

if (isset($_POST["delete"]) && !empty($_POST["delete"])) {
  $_POST["accountType"] = test_input($_POST["accountType"]);
  $account_select = new Account($_POST);
  $account_user = $account_manager->accountInMouvement($account_select);
  print_r($account_user);
  $account_manager->deleteAccount($account_user[0]);
  $operation_manager->deleteOperation($account_user[0]);
}

require 'view/deleteView.php';
