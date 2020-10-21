<?php
session_start();
require 'model/connection/Connection.php';
require 'model/entity/Account.php';
require 'model/manager/AccountManager.php';

require 'model/entity/Operation.php';
require 'model/manager/OperationManager.php';

$operations = new OperationManager();
$show_operations = $operations->showOperations();

$account = new AccountManager();
$show_account_single = $account->accountSingle();


require 'view/showaccountView.php';
