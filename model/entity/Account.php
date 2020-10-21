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
  protected float $amountA;
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

  public function setAmountA(float $amountA):self {
    $this->amountA = $amountA;
    return $this;
  }

  public function getAmountA() {
    return $this->amountA;
  }

  public function setOpeningDate(string $opening_date):self {
    $this->opening_date = $opening_date;
    return $this;
  }

  public function getOpeningDate() {
    return $this->opening_date;
  }

  public function setAccountType(string $account_type):self {
    if (in_array($account_type,self::ACCOUNT_TYPE)) {
      $this->account_type = $account_type;
    }
    return $this;
  }

  public function getAccountType() {
    return $this->account_type;
  }

  public function setUserId(int $user_id):self {
    $this->user_id = $user_id;
    return $this;
  }

  public function getUserId() {
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
