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


$account_manager = new AccountManager();
$accounts_user = $account_manager->showAccounts();
print_r($accounts_user);
require 'view/indexView.php';
