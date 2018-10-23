<?php
  session_start();
  if(isset($_SESSION['admin_id'])){
    header("location:adminPanel.php");
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
    <div class="row align-items-center">
      <div class="col-md-1 logo_container mr-5">
        <img src="img/hitk_logo_sketch.png">
      </div>
      <div class="col-md-6 college_name">
        <div class="row mt-1">
          <h1 class="display-4">HITK</h1>
        </div>
        <div class="row">
          <p>KOLKATA</p>
        </div>
      </div>
      <div class="col-md-4 align-items-center fest_title">
        <h1 class="mr-0">Technovation 2K18</h1>
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
        <form class="mt-5 p-3 pt-4" action="validateLogin.php" method="post" id="login_form" autocomplete="off">
          <div class="form-group">
            <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
          </div>
          <div class="form-group">
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
          </div>
          <input type="submit" name="" value="Login" class="btn btn-block btn-primary">
        </form>
      </div>
    </div>


  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>

</body>
</html>
