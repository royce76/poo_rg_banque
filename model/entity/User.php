<?php

class User
{
  // le sexe est une constante
  const SEX = ["h", "f"];
  //on récupère les champs de la table user en propritété
  protected int $id;
  protected ?string $lastname;
  protected ?string $firstname;
  protected ?string $email;
  protected ?string $city;
  protected ?int $city_code;
  protected ?string $adress;
  protected string $sex;
  protected ?string $password;
  protected ?string $birth_date;

  public function setId(int $id):self {
    $this->id = $id;
    return $this;
  }

  public function getId() {
    return $this->id;
  }

  public function setLastname(string $lastname = null):self {
    if (preg_match("/^[a-zA-Z-' ]{2,50}$/",$lastname)) {
      $this->lastname = $lastname;
    }
    return $this;
  }

  public function getLastname() {
    return $this->lastname;
  }

  public function setfirstname(string $firstname = null):self {
    if (preg_match("/^[a-zA-Z-' ]{2,50}$/",$firstname)) {
      $this->firstname = $firstname;
    }
    return $this;
  }

  public function getFirstname() {
    return $this->firstname;
  }

  public function setEmail(string $email = null):self {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $this->email = $email;
    }
    return $this;
  }

  public function getEmail() {
    return $this->email;
  }

  public function setCity(string $city = null):self {
    if (preg_match("/^[a-zA-Z-' ]{2,30}$/",$city)) {
      $this->city = $city;
    }
    return $this;
  }

  public function getCity() {
    return $this->city;
  }

  public function setCityCode(int $city_code = null):self {
    if (preg_match("/^[0-9]{0,5}$/",$city_code)) {
      $this->city_code = $city_code;
    }
    return $this;
  }

  public function getCityCode() {
    return $this->city_code;
  }

  public function setAdress(string $adress = null):self {
    if (preg_match("/[0-9a-zA-Z-' ]{2,50}/",$adress)) {
      $this->adress = $adress;
    }
    return $this;
  }

  public function getAdress() {
    return $this->adress;
  }

  public function setPassword(string $password = null):self {
    if (preg_match("/.{2,255}/",$password)) {
      $this->password = $password;
    }
    return $this;
  }

  public function getPassword() {
    return $this->password;
  }

  public function setSex(string $sex):self {
    if (in_array($sex, self::SEX)) {
      $this->sex = $sex;
    }
    return $this;
  }

  public function getSex() {
    return $this->sex;
  }

  public function setBirthDate(string $birth_date = null):self {
    $this->birth_date = $birth_date;
    return $this;
  }

  public function getBirthDate() {
    return $this->birth_date;
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
