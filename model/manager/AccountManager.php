<?php
// session_start();

/**
 *
 */
class AccountManager
{
  private PDO $_db;

  function __construct() {
    $this->setDb(CONNEXION::getConnexion());
  }

  public function setDb(PDO $db) {
    $this->_db = $db;
  }

  public function getDb() {
    return $this->_db;
  }

  //use in index.php to show all accounts from user
  public function showAccounts() {
    $query = $this->getDb()->prepare (
      "SELECT a.id, a.amount AS amountA, a.opening_date, a.account_type, a.user_id
      FROM Account AS a
      WHERE a.user_id = :user_id"
    );
    $result = $query->execute([
      "user_id" => $_SESSION["user_id"]
    ]);

    $accounts = $query->fetchAll(PDO::FETCH_CLASS, "Account");
    return $accounts;
  }

  //use in showaccount.php to echo account's user
  public function accountSingle() {
    $con = $this->getDb()->prepare(
      "SELECT a.amount AS amountA, a.opening_date, a.account_type
      FROM Account AS a
      WHERE a.id = :id_account"
    );
    $results = $con->execute([
      "id_account" => $_GET["id"]
    ]);
    $account_user = $con->fetchAll(PDO::FETCH_CLASS, "Account");
    return $account_user;
  }

}
