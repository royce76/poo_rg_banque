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

  protected ?int $id;
  protected ?float $amount;
  protected ?string $opening_date;
  protected string $account_type;
  protected ?int $user_id;

  public function setId(int $id = null):self {
    $this->id = $id;
    return $this;
  }

  public function getId() {
    return $this->id;
  }

  public function setAmount(float $amount = null):self {
    $this->amount = $amount;
    return $this;
  }

  public function getAmount() {
    return $this->amount;
  }

  public function setOpeningDate(string $opening_date = null):self {
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

  public function setUserId(int $id_user = null):self {
    $id_user = $_SESSION["user_id"];
    $this->user_id = $id_user;
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
