<?php

require_once 'queueDb.php';
$queueDb = new QueueDb;

function PsExecute($command, $timeout = 10, $sleep = 1,$pathcmd) {
// First, execute the process, get the process ID
  $sleep = $sleep*1000000;
  $pid = PsExec($command,$pathcmd);

  if( $pid === false )
    return false;

  $cur = 0;
  // Second, loop for $timeout seconds checking if process is running
  while( $cur < $timeout ) {
    usleep($sleep);
    $temp_time = $sleep/1000000;
    $cur += $temp_time;
    // If process is no longer running, return true;-

    if( !PsExists($pid) ){
      return true; // Process must have exited, success!
    }
  }

  // If process is still running after timeout, kill the process and return false
  PsKill($pid);
  return false;
}

function PsExec($commandJob,$pathcmd) {
  $command = $commandJob.' > '.$pathcmd.'output.txt 2> '.$pathcmd.'output.txt & echo $!';

  exec($command ,$op);
  $pid = (int)$op[0];

  if($pid!="") return $pid;

  return false;
}

function PsExists($pid) {

  exec("ps ax | grep $pid 2>&1", $output);

  while( list(,$row) = each($output) ) {

    $row_array = explode(" ", $row);
    $check_pid = $row_array[0];

    if($pid == $check_pid) {
      return true;
    }
  }

  return false;
}

function PsKill($pid) {
  exec("kill -9 $pid", $output);
}


  if(isset($_POST['user_id'])){
    $user_id = $_POST['user_id'];

    $queueDb->insert($user_id,'submit');

    $inQueue = $queueDb->top('submit',1);

    while(!in_array($user_id,$inQueue)) {
      usleep(1000000);
      $inQueue = $queueDb->top('submit',1);
    }


    require_once "loadSubmissionsDb.php";
    $db = new LoadSubmissions;
    $data =  $db->getUserData($user_id);

    $points = 0;
    $updateData = array();
    for($i = 1;$i < 4 ;$i++){
      $temp = "submission".$i;
      $checkSubmission = $data->$temp;
      if($checkSubmission == 1){
        $questionlevel_number = $i;
        $temp = "question".$i;
        $question_id = $data->$temp;

        $path="data/users/".$user_id."/".$questionlevel_number."/submittedCode";
        if(file_exists($path)){
          $path = $path."/";
          $language = file_get_contents($path."language.txt");
          $time_limit = 3; // Time limit of execution
          $sleep = 0.1; // Sleep during execution

          switch ($language) {
            case 'cpp':
              $time_limit = 3; // Time limit of execution
              $sleep = 0.1; // Sleep during execution
              require_once 'judgeCompilers/cpp.php';
              break;
            case 'java':
              $time_limit = 5; // Time limit of execution
              $sleep = 0.5; // Sleep during execution
              require_once 'judgeCompilers/java.php';
              break;
            case 'python3':
              $time_limit = 5; // Time limit of execution
              $sleep = 0.1; // Sleep during execution
              require_once 'judgeCompilers/python3.php';
              break;
          }

          $testcaseDir = "data/questions/".$questionlevel_number."/".$question_id."/";

          $fileIterator = new FilesystemIterator($testcaseDir."inputs", FilesystemIterator::SKIP_DOTS);
          $testcaseCount = iterator_count($fileIterator);
          $successTestcaseCount = 0;

          for($j =1 ; $j <= $testcaseCount ; $j++){
            $input = ltrim(file_get_contents($testcaseDir."inputs/".$j.".txt"));
            $output = ltrim(file_get_contents($testcaseDir."outputs/".$j.".txt"));
            if($language == 'cpp'){
              $result = getOutputCpp($input,$time_limit,$sleep,$path);
            } else if($language == 'java'){
              $result = getOutputJava($input,$time_limit,$sleep,$path);
            } else if($language == 'python3'){
              $result = getOutputPython($input,$time_limit,$sleep,$path);
            }

            $output = preg_replace('/\s+/', '',  $output);
            $result = preg_replace('/\s+/', '',  $result);

            if(rtrim($output)== rtrim($result)){
              $successTestcaseCount++;
            }
            //echo $output." >>>> ".$result."<br>";
          }
          if($successTestcaseCount == $testcaseCount){
            $status = "status".$i;
            //echo $status;
            $timer = "time".$i;
            $submittime= $data->$timer;
            $points += $submittime * $i;
            $updateData[$status] = $successTestcaseCount;
          } else {
            $submittime = 3600*2;
            $status = "status".$i;
            $points += $submittime * $i;
            $updateData[$status] = $successTestcaseCount;
          }
        }
      } else {
        $submittime = 3600*2;
        $status = "status".$i;
        $points += $submittime * $i;
        //echo $status;
        $updateData[$status] = 0;
      }
    }
    $updateData['index'] = $_POST['index'];
    $updateData["id"] = $user_id; //Queue part
    $updateData["points"] = $points;
    $response = $db->updateUserData($user_id,$updateData);

    $queueDb->dqueue($user_id,'submit');

    if($response === true){
      echo json_encode($updateData);
    } else {
      echo $response;
    }
  }

?>
