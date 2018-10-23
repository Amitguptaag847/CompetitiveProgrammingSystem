<?php

  session_start();
  if(!isset($_COOKIE['user_id'])){
    header("location:index.php");
  }
  if(!isset($_GET['question'])){
    header("location:contest_arena.php?question=1");
  } else {
    if($_GET['question'] < 1 || $_GET['question'] > 3){
      header("location:contest_arena.php?question=1");
    }
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Technovation coding challenge</title>
  <link rel="icon" href="img/logo_coding.png">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/fontawesome-all.css">
  <link rel="stylesheet" href="css/contest_arena.css">
  <script type="text/javascript">
    let questionlevel_number = <?php echo $_GET['question']; ?>;
    let user_id = <?php echo $_COOKIE["user_id"]; ?>;
    let ending_time = <?php echo $_COOKIE["ending_time"]; ?>;
    let current_time = <?php echo time(); ?>;
  </script>

  <?php
    $questionpath = "data/questions/".$_GET['question']."/".$_COOKIE['question'.$_GET['question']]."/";

    $codepath = "data/users/".$_COOKIE['user_id']."/".$_GET['question']."/";
    $codeExists = false;
    $codeData = "";
    if(file_exists($codepath."code.txt")){
      $codeExists = true;
      $codeData = file_get_contents($codepath."code.txt");
    }

    $inputExists = false;
    $inputData = "";
    if(file_exists($codepath."input.txt")){
      $inputExists = true;
      $inputData = file_get_contents($codepath."input.txt");
    }

    $codeLanguage = "none";
    if(file_exists($codepath."language.txt")){
      $codeLanguage = file_get_contents($codepath."language.txt");
    }

  ?>
</head>
<body class="px-3">

  <div class="row fest_title">
    <div class="col text-left">
      <h1 class="">TCC</h1>
    </div>
    <div class="col text-right">
      <h1 class="">Technovation 2K18</h1>
    </div>
  </div>

  <div class="row navigation">
    <div class="col-md-1 p-2 text-center que_number <?php if($_GET['question']==1){ echo "active"; } ?>" id="question1">Question 1</div>
    <div class="col-md-1 p-2 text-center que_number <?php if($_GET['question']==2){ echo "active"; } ?>" id="question2">Question 2</div>
    <div class="col-md-1 p-2 text-center que_number <?php if($_GET['question']==3){ echo "active"; } ?>" id="question3">Question 3</div>
    <div class="col-md-6 p-2"></div>
    <div class="col-md-2 p-2 text-center timer">Remaining : </div>
    <div class="col-md-1 p-2 text-center quit"  data-toggle="modal" data-target="#confirmQuit"><i class="fas fa-sign-out-alt"></i> Quit</div>

    <div class="modal fade" id="confirmQuit" tabindex="-1" role="dialog" aria-labelledby="confirmQuitTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header justify-content-center">
            <h3 class="text-dark">Are you sure you want to Quit</h3>
          </div>
          <div class="modal-footer">
            <button type="button" class="mr-auto btn btn-info" data-dismiss="modal">No</button>
            <button type="button" class="btn btn-danger confirmQuit" data-dismiss="modal">Yes</button>
          </div>
        </div>
      </div>
    </div>

  </div>

  <div class="container mt-1">

    <div class="row">
      <div class="col question_title pt-3">
        <center><h1><?php echo "Question ".$_GET['question']; ?></h1></center>
      </div>
    </div>

    <div class="row">
      <div class="col question pt-3">
        <?php $data = file_get_contents($questionpath."question.txt"); echo $data;?>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col editor pb-5">
        <form class="" action="" method="post">
          <div class="form-group">
            <label for="language">Select Your language :</label>
            <select class="ml-2" name="language" id="language">
              <option value="cpp" <?php if($codeLanguage == "cpp"){echo "selected";} ?>>c++ or c</option>
              <option value="java" <?php if($codeLanguage == "java"){echo "selected";} ?>>java</option>
              <option value="python3" <?php if($codeLanguage == "python3"){echo "selected";} ?>>python</option>
            </select>
            <span class="text-danger ml-2 language_suggestion"></span>
          </div>

          <div class="form-group">
            <label for="code_area">Enter Your Code : </label>
            <textarea name="code" class="form-control" id="code_area"><?php if($codeExists){ echo $codeData;}?></textarea>
          </div>

          <div class="form-group">
            <label for="input">Enter Your Custom Input :</label>
            <textarea name="input" class="form-control" id="input"><?php if($inputExists){ echo $inputData;} ?></textarea>
          </div>

          <div class="submit_loader mb-4 d-none"><img src="img/submit_loader.gif" width=35></div>
          <div id="submit_output" class="alert d-none"></div>


          <div class="form-group">
            <button type="button" class="btn btn-info mr-4" id="run_code" name="button">Run</button>
            <button type="button" class="btn btn-success" id="submit_code" name="button">Submit</button>
          </div>

          <div class="form-group">
            <label for="output">Output : <div class="d-none" id="output_loader">Generating Output <img src="img/loader.gif" alt=""></div></label>
            <textarea name="output" class="form-control" id="output" disabled></textarea>
          </div>
        </form>
      </div>
    </div>

    <div class="row">
      <div class="col question_title pt-3">
        <center><h1>End</h1></center>
      </div>
    </div>
  </div>

  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/insertTab.js"></script>
  <script type="text/javascript" src="js/autoClose.js"></script>
  <script type="text/javascript" src="js/autoIndentation.js"></script>
  <script type="text/javascript" src="js/contest_arena.js"></script>
</body>
</html>
