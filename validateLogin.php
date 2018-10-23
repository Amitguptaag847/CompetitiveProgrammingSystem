<?php

  require_once 'validateLogindb.php';

  $db = new LoginDb;

  if(!isset($_POST['username']) || !isset($_POST['password'])){
    header("location:TccAdmin.php");
  }

  if($db->check($_POST['username'],$_POST['password'])){
    header("location:adminPanel.php");
  } else {
    header("location:TccAdmin.php");
  }

?>
