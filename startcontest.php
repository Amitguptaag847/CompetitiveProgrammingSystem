<?php

  require_once 'startcontestdb.php';

  $db = new StartContest;

  if(!isset($_POST['fullname']) || !isset($_POST['email']) || !isset($_POST['department']) || !isset($_POST['collegename']) || !isset($_POST['year']) || !isset($_POST['phonenumber'])){
    header("location:index.php");
  }

  $question1 = mt_rand(1,25);
  $question2 = mt_rand(1,25);
  $question3 = mt_rand(1,20);

  $response = $db->start($_POST['fullname'],$_POST['phonenumber'],$_POST['department'],$_POST['email'],$_POST['collegename'],$_POST['year'],$question1,$question2,$question3);
  if($response === true){
    header("location:contest_arena.php?question=1");
  } else {
    header("location:index.php");
  }

?>
