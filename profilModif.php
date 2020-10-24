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
}

require 'view/profilModifView.php';
