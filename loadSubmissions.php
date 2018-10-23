<?php
  session_start();
  if(!isset($_SESSION['admin_id'])){
    header("location:index.php");
  }

  if(isset($_POST['loadsubmissions'])){
    require_once "loadSubmissionsDb.php";
    $db = new LoadSubmissions;
    echo $db->getData();
  }
?>
