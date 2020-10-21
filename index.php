<?php
session_start();
if (!isset($_SESSION["user_info"]) && empty($_SESSION["user_info"])) {
  header("Location: userConnection.php");
}
require 'model/connection/Connexion.php';
require 'model/entity/Account.php';
require 'model/manager/AccountManager.php';


$account_manager = new AccountManager();
//On récupère les comptes objets dans un tableau
$accounts_user = $account_manager->showAccounts();

require 'view/indexView.php';
