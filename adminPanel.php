
<?php
  session_start();
  if(!isset($_SESSION['admin_id'])){
    header("location:TccAdmin.php");
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
  <link rel="stylesheet" href="css/adminPanel.css">
</head>
<body class="px-3">
  <div class="row fest_title" id="fest_title">
    <div class="col-3 d-flex" >
      <h3 class="mt-2">Technovation 2K18</h3>
    </div>
    <div class="col-1 logout text-center ml-auto d-flex align-items-center justify-content-center">
      <i class="fas fa-sign-out-alt"></i> Logout
    </div>
  </div>


  <div class="mx-3" style="min-height:79vh;">
    <div class="row">
      <div class="col pt-3">
        <button class="btn btn-warning mr-3 loadsubmissions">Load Submissions</button>
        <button class="btn btn-info mr-3 judge">Judge</button>
        <button class="btn btn-primary sort">Sort</button>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col">
        <table class="table table-striped table-dark table-hover">
          <thead>
            <tr class="text-center">
              <th scope="col">ID</th>
              <th scope="col">Name</th>
              <th scope="col">Phone no. </th>
              <th scope="col">Que 1</th>
              <th scope="col">Que 2</th>
              <th scope="col">Que 3</th>
              <th scope="col">Time 1</th>
              <th scope="col">Time 2</th>
              <th scope="col">Time 3</th>
              <th scope="col">Points</th>
            </tr>
          </thead>
          <tbody class="submissionData">

          </tbody>
        </table>
        <a href="#fest_title" class="btn btn-success">Go to top</a>
      </div>
    </div>
  </div>
  <div class="row mt-5" style="background-color:#2358a8;height:35px;">

  </div>

  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/adminPanel.js"></script>
</body>
</html>
