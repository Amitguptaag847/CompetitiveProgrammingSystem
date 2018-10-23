<?php
  $endind_time = 1;
  setcookie("user_id",$row->id,$endind_time);
  setcookie("endind_time",$endind_time,$endind_time);
  setcookie("question1",$question1,$endind_time);
  setcookie("quesuccess1",$question1,$endind_time);
  setcookie("question2",$question2,$endind_time);
  setcookie("quesuccess2",$question2,$endind_time);
  setcookie("question3",$question3,$endind_time);
  if(isset($_GET['timeup'])){
    header("location:index.php?timeup=true");
  } else {
    header("location:index.php");
  }
?>
