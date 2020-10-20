<?php
require 'model/Connexion.php';
require 'model/User.php';
require 'model/UserManager.php';

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
    // header("Location: index.php");
    echo "coucou";
    var_dump($_SESSION);
  }
}

require 'view/userConnectionView.php';
