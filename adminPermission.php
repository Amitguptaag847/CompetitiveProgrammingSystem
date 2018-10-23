<?php
  session_start();
  if(isset($_COOKIE['user_id'])){
    header("location:contest_arena.php?question=1");
  }

  if(isset($_POST['password'])){
    if($_POST['password'] == "1234"){
      $_SESSION['adminPermission'] = "true";
      header("location:index.php");
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Technovation Coding Challenge</title>
  <link rel="icon" href="img/logo_coding.png">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/fontawesome-all.css">
  <link rel="stylesheet" href="css/signup.css">
</head>
<body class="px-5 pt-2">

    <script type="text/javascript">
      <?php
      if(isset($_GET['timeup'])){
        echo "alert('Thankyou for participating!!!');";
      }
      ?>
    </script>

    <div class="row align-items-center">
      <div class="col-md-1 logo_container mr-5">
        <img src="img/hitk_logo_sketch.png">
      </div>
      <div class="col-md-6 college_name">
        <div class="row mt-1">
          <h1 class="display-4">HIT</h1>
        </div>
        <div class="row">
          <p>KOLKATA</p>
        </div>
      </div>
      <div class="col-md-4 align-items-center text-right fest_title">
        <h1>Technovation 2K18</h1>
        <p>Technovation Coding Challenge</p>
        <div class="row">
          <div class="col" style="background-color:#ffb911"></div>
          <div class="col" style="background-color:#65BEE9"></div>
          <div class="col" style="background-color:#ff0000"></div>
        </div>
      </div>
    </div>

    <div class="hr"></div>

    <div class="row">
      <div class="col d-flex justify-content-center">
        <form class="mt-5 p-3 pt-4" action="adminPermission.php" method="post" id="login_form" autocomplete="off">
          <div class="form-group">
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" autocomplete="off" required>
          </div>
          <input type="submit" name="" value="Verify" class="btn btn-primary btn-block" />
        </form>
      </div>
    </div>


  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>
