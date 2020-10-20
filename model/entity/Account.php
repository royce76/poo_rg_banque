<?php
/**
 *
 */
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
  protected float $amount;
  protected string $opening_date;
  protected string $account_type;
  protected string $user_id;

  public function setId(int $id):self {
    $this->id = $id;
    return $this;
  }

  public function getId() {
    return $this->id;
  }

  public function setAmount(float $amount):self {
    $this->amount = $amount;
    return $this;
  }

  public function getAmount() {
    return $this->amount;
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
}
