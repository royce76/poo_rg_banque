<?php
session_start();
if (!isset($_SESSION["user_info"]) && empty($_SESSION["user_info"])) {
  header("Location: userConnection.php");
  exit();
}
require 'model/connection/Connection.php';
require 'model/entity/Account.php';
require 'model/manager/AccountManager.php';
require 'model/entity/Operation.php';
require 'model/manager/OperationManager.php';


//on récupère les dernières opérations
$operation_manager = new OperationManager();
$account_last_operation = $operation_manager->AccountLastOperation();

//on récupère les comptes
$account_manager = new AccountManager();
$accounts_user = $account_manager->showAccounts();

require 'view/indexView.php';
