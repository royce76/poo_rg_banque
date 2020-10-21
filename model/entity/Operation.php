<?php

/**
 *
 */
class Operation
{
  protected int $id;
  protected string $operation_type;
  protected float $amount;
  protected string $registered;
  protected ?string $label;
  protected int $account_id;

  public function setId(int $id):self {
    $this->id = $id;
    return $this;
  }

  public function getId() {
    return $this->id;
  }

  public function setOperation_type(string $operation_type):self {
    $this->operation_type = $operation_type;
    return $this;
  }

  public function getOperation_type() {
    return $this->operation_type;
  }

  public function setAmount(float $amount):self {
    $this->amount = $amount;
    return $this;
  }

  public function getAmount() {
    return $this->amount;
  }

  public function setRegistered(string $registered):self {
    $this->registered = $registered;
    return $this;
  }

  public function getRegistered() {
    return $this->registered;
  }

  public function setLabel(string $label = null):self {
    $this->label = $label;
    return $this;
  }

  public function getLabel() {
    return $this->label;
  }

  public function setAccount_id(int $account_id):self {
    $this->account_id = $account_id;
    return $this;
  }

  public function getAccount_id() {
    return $this->account_id;
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
