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

$operations = new OperationManager();
$show_operations = $operations->listOperations();

$account = new AccountManager();
$show_account_single = $account->accountSingle();


require 'view/showaccountView.php';
