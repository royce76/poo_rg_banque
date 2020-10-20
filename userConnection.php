<?php
require 'model/connection/Connexion.php';
require 'model/entity/User.php';
require 'model/manager/UserManager.php';

//On instancie notre manager
$userManager = new UserManager();
if (isset($_POST["connect"]) && !empty($_POST["connect"])) {
  //on instancie un user avec les donnée du formulaire
  $user = new User($_POST);
  //on verifie l'utilisateur
  $userManager->checkUser($user);
  if ($userManager->checkUser($user)) {
    session_start();
    $_SESSION["user_email"] = $userManager->checkUser($user);
    header("Location: index.php");
  }
}

require 'view/userConnectionView.php';
