<?php
  $language = $_POST['language'];
  $time_limit = 3; // Time limit of execution
  $sleep = 0.3; // Sleep during execution

  require_once 'submitCodedb.php';
  $SubmitDB = new SubmitCodeDb;
  require_once 'queueDb.php';
  $queueDb = new QueueDb;

  switch ($language) {
    case 'cpp':
      $time_limit = 3; // Time limit of execution
      $sleep = 0.2; // Sleep during execution
      require_once 'SubmitCompilers/cpp.php';
      break;
    case 'java':
      $time_limit = 5; // Time limit of execution
      $sleep = 0.5; // Sleep during execution
      require_once 'SubmitCompilers/java.php';
      break;
    case 'python3':
      $time_limit = 5; // Time limit of execution
      $sleep = 0.5; // Sleep during execution
      require_once 'SubmitCompilers/python3.php';
      break;
  }

  //Setting submittedCode true
  $submitTime = time();
  $response = $SubmitDB->setSubmitData($user_id,$questionlevel_number,$submitTime);

  if($response !== true){
    die("Submit Db error");
  }

  $queueDb->insert($user_id,'submit');

  $inQueue = $queueDb->top('submit',4);

  while(!in_array($user_id,$inQueue)) {
    usleep(500000);
    $inQueue = $queueDb->top('submit',4);
  }



  $testcaseDir = "data/questions/".$questionlevel_number."/".$_COOKIE['question'.$questionlevel_number]."/";

  $fileIterator = new FilesystemIterator($testcaseDir."inputs", FilesystemIterator::SKIP_DOTS);
  $testcaseCount = iterator_count($fileIterator);
  $testcaseCount = 2;
  $successTestcaseCount = 0;
  $data ="";

  for($i =1 ; $i <= $testcaseCount ; $i++){

    $input = ltrim(file_get_contents($testcaseDir."inputs/".$i.".txt"));
    $output = ltrim(file_get_contents($testcaseDir."outputs/".$i.".txt"));

    $result = getOutput($input,$code,$time_limit,$sleep,$path,$language);

    $output = preg_replace('/\s+/', '',  $output);
    $result = preg_replace('/\s+/', '',  $result);

    if(rtrim($output)==rtrim($result)){
      $successTestcaseCount++;
    }
    //echo "'".trim($output)."'>>>>'".trim($result)."'<br>";
  }

  $queueDb->dqueue($user_id,'submit');

  if($successTestcaseCount == $testcaseCount){
    echo "success";
  } else {
    $failedCount = $testcaseCount - $successTestcaseCount;
    echo "<strong>Unsuccessful</strong> : ".$successTestcaseCount." pretestcase passed and ".$failedCount." pretestcase failed";
  }

?>
