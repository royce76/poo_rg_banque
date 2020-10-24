<?php
session_start();
if (!isset($_SESSION["user_info"]) && empty($_SESSION["user_info"])) {
  header("Location: userConnection.php");
  exit();
}
include 'view/blogView.php';
