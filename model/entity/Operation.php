<?php

/**
 *
 */
class Operation
{
  protected int $id;
  protected ?string $operation_type;
  protected float $amount;
  protected ?string $registered;
  protected ?string $label;
  protected ?int $account_id;

  public function setId(int $id):self {
    $this->id = $id;
    return $this;
  }

  public function getId() {
    return $this->id;
  }

  public function setOperationType(string $operation_type = null):self {
    $this->operation_type = $operation_type;
    return $this;
  }

  public function getOperationType() {
    return $this->operation_type;
  }

  public function setAmountO(float $amountO):self {
    $this->amountO = $amountO;
    return $this;
  }

  public function getAmountO() {
    return $this->amountO;
  }

  public function setRegistered(string $registered = null):self {
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

  public function setAccountId(int $account_id = null):self {
    $this->account_id = $account_id;
    return $this;
  }

  public function getAccountId() {
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
