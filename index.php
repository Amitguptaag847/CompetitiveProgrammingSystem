<?php
  session_start();

  if(isset($_COOKIE['user_id'])){
    header("location:contest_arena.php?question=1");
  }

  if(isset($_SESSION['adminPermission'])){
    if($_SESSION['adminPermission'] != "true"){
      if(isset($_GET['timeup'])){
        header("location:adminPermission.php?timeup=true");
      } else {
        header("location:adminPermission.php");
      }
    }
  } else {
    header("location:adminPermission.php");
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
        <form class="mt-5 p-3 pt-4" action="startcontest.php" method="post" id="login_form" autocomplete="off">
          <div class="form-group">
            <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Enter your full name" autocomplete="off" required>
          </div>
          <div class="form-group">
            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
          </div>
          <div class="form-group">
            <input type="text" name="collegename" id="collegename" class="form-control" placeholder="Enter your College name" required>
          </div>
          <div class="form-group">
            <input type="text" name="department" id="department" class="form-control" placeholder="Enter your Department" required>
          </div>
          <div class="form-group">
            <input type="text" name="year" id="first" class="form-control" placeholder="Enter your year" required>
          </div>
          <div class="form-group">
            <input type="text" name="phonenumber" pattern="[1-9]{1}[0-9]{9}" id="phonenumber" class="form-control" placeholder="Enter 10 Digit Phone number" minlength="10" maxlength="10" required oninvalid="this.setCustomValidity('Please Enter 10 Digit number')">
          </div>

          <!-- Button trigger modal -->
          <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#rulesAndRegulationModal">
            Next
          </button>

          <!-- Modal -->
          <div class="modal fade" id="rulesAndRegulationModal" tabindex="-1" role="dialog" aria-labelledby="rulesAndRegulationModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header justify-content-center">
                  <h3>Rules and Regulation</h3>
                </div>
                <div class="modal-body">
                  <ul class="p-2 my-0">
                    <li>Use of unfair means may lead to debarrment</li>
                    <li>Only final submission will be considered for evaluation</li>
                    <li>Passing the pretests doesn't guarentee that it will pass all testcases</li>
                    <li>Earlier the submission, more points you get</li>
                    <li>This Contest Comprises of three sections - Easy, Medium , Hard</li>
                    <li>Hello</li>
                    <li>Hello</li>
                    <li>Hello</li>
                  </ul>
                </div>
                <div class="modal-footer">
                  <button type="button" class="mr-auto btn btn-secondary" data-dismiss="modal">Close</button>
                  <input type="submit" name="" id="startcontest" value="Start Contest" class="btn btn-primary">
                </div>
              </div>
            </div>
          </div>

        </form>
      </div>
    </div>


  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/index.js"></script>
</body>
</html>
