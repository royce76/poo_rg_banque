<?php
require 'model/connection/Connection.php';
require 'model/entity/User.php';
require 'model/manager/UserManager.php';

$error_entries = "";
$empty_entries = "";
$error_email = "";
$error_password = "";

$userManager = new UserManager();

if (isset($_POST["connect"]) && !empty($_POST["connect"])) {
  $entries = array_filter($_POST);
  $email = $_POST["email"];
  if (count($entries) === count($_POST)) {
    $email = filter_var($email,FILTER_SANITIZE_EMAIL);
    //instantiate a user with the form data
    $user = new User($_POST);
    if ($user) {
      //We retrieve all the user's informations
      $user_info = $userManager->userInfo($user);
      if ($user_info) {
        $password_user = $user_info[0]->getPassword();
        $password_POST = $user->getPassword();
        if ($password_user === $password_POST) {
          session_start();
          $_SESSION["user_info"] = $userManager->userInfo($user);
          $_SESSION["user_id"] = $_SESSION["user_info"][0]->getId();
          header("Location: index.php");
          exit();
        }
        else {
          $error_entries = "Identifiant ou mot de passe incorrect.";
        }
      }
    }
  }
  else {
    $empty_entries = "Vous avez oublié de remplir tous les champs.";
  }
  if (empty($_POST["email"])) {
    $error_email = "*Champs à remplir.";
  }
  if (empty($_POST["password"])) {
    $error_password = "*Champs à remplir.";
  }
  if (filter_var($email,FILTER_SANITIZE_EMAIL)) {
    $error_email = "*Email incorrect.";
  }
}

require 'view/userConnectionView.php';
