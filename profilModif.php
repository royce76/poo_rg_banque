<?php
session_start();
if (!isset($_SESSION["user_info"]) && empty($_SESSION["user_info"])) {
  header("Location: userConnection.php");
  exit();
}
function test_input($data) {
  $data = trim($data); // remove space of both side
  $data = stripslashes($data);// remove backslashes
  $data = htmlspecialchars($data, ENT_QUOTES);//both quotes
  return $data;
}
require 'model/connection/Connection.php';
require 'model/entity/User.php';
require 'model/manager/UserManager.php';

//on récupère user
$user_manager = new UserManager();
$user = $user_manager->user();

//variable initial
$entries = array_filter($_POST);
$empty_entries = "";
$error_entries = "";
$response = "";
$email = "";
$city = "";
$city_code = "";
$adress = "";
$password = "";
$password_b = "";

if (isset($_POST["validate"]) && !empty($_POST["validate"])) {
  foreach ($_POST as $key => $value) {
    $_POST[$key] = test_input($_POST[$key]);
  }
  if (count($entries) === count($_POST)) {
    $user_modify = new User($_POST);
    if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
      if (preg_match("/^[a-zA-Z-' ]{2,30}$/",$_POST["city"])) {
        if (preg_match("/^[0-9]{0,5}$/",$_POST["cityCode"])) {
          if (preg_match("/[0-9a-zA-Z-' ]{2,50}/",$_POST["adress"])) {
            if (preg_match("/.{2,255}/",$_POST["password"])) {
              if ($_POST["password"] === $_POST["password_b"]) {
                $update_profil = $user_manager->updateProfil($user[0], $user_modify);
                if ($update_profil) {
                  $response = "Bravo votre profil est à jour";
                }
                else {
                  $response = "erreur de données";
                }
              }
              else {
                $error_entries = "Champs mals renseignés";
              }
            }
            else {
              $error_entries = "Champs mals renseignés";
            }
          }
          else {
            $error_entries = "Champs mals renseignés";
          }
        }
        else {
          $error_entries = "Champs mals renseignés";
        }
      }
      else {
        $error_entries = "Champs mals renseignés";
      }
    }
    else {
      $error_entries = "Champs mals renseignés";
    }
  }
  else {
    $empty_entries = "Vous avez oublié de remplir tous les champs.";
  }
  if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $email = "email non valide";
  }
  if (!preg_match("/^[a-zA-Z-' ]{2,30}$/",$_POST["city"])) {
    $city = "2 à 30 caractères";
  }
  if (!preg_match("/^[0-9]{0,5}$/",$_POST["cityCode"])) {
    $city_code = "0 à 5 caractères";
  }
  if (!preg_match("/[0-9a-zA-Z-' ]{2,50}/",$_POST["adress"])) {
    $adress = "2 à 50 caractères";
  }
  if (!preg_match("/.{2,255}/",$_POST["password"])) {
    $password = "2 caractères minimums";
  }
  if ($_POST["password"] !== $_POST["password_b"]) {
    $password_b = "Mot de passe différent du précedent";
  }
  if (empty($_POST["email"])) {
    $email = "*Champs à remplir";
  }
  if (empty($_POST["city"])) {
    $city = "*Champs à remplir";
  }
  if (empty($_POST["cityCode"])) {
    $city_code = "*Champs à remplir";
  }
  if (empty($_POST["adress"])) {
    $adress = "*Champs à remplir";
  }
  if (empty($_POST["password"])) {
    $password = "*Champs à remplir";
  }
  if (empty($_POST["password_b"])) {
    $password_b = "*Champs à remplir";
  }
}

require 'view/profilModifView.php';
