<?php
/**
 *
 */
 // session_start();
class Account
{
  const ACCOUNT_TYPE = [
    "Compte courant",
    "Livret A",
    "PEL",
    "Livret Jeune",
    "Perp",
    "Lep"
  ];

  protected int $id;
  protected float $a_amount;
  protected string $opening_date;
  protected string $account_type;
  protected int $user_id;

  public function setId(int $id):self {
    $this->id = $id;
    return $this;
  }

  public function getId() {
    return $this->id;
  }

  public function setA_amount(float $a_amount):self {
    $this->a_amount = $a_amount;
    return $this;
  }

  public function getA_amount() {
    return $this->a_amount;
  }

  public function setOpeningDate(string $opening_date):self {
    $this->opening_date = $opening_date;
    return $this;
  }

  public function getOpeningDate() {
    return $this->opening_date;
  }

  public function setAccount_type(string $account_type):self {
    if (in_array($account_type,self::ACCOUNT_TYPE)) {
      $this->account_type = $account_type;
    }
    return $this;
  }

  public function getAccount_type() {
    return $this->account_type;
  }

  public function setUser_id(int $id_user):self {
    $id_user = $_SESSION["user_id"];
    $this->user_id = $id_user;
    return $this;
  }

  public function getUser_id() {
    return $this->user_id;
  }

  public function hydrate(array $data) {
      foreach ($data as $key => $value) {
        $method = "set". ucfirst($key);
        if (method_exists($this,$method)) {
          $this->$method($value);
        }
      }
  }

  function __construct(array $data = null) {
    if($data) {
      $this->hydrate($data);
    }
  }
}
