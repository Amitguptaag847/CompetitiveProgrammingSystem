<?php

  require_once 'queueDb.php';
  $queueDb = new QueueDb;

  $language = $_POST['language'];
  $user_id = $_POST['user_id'];

  $queueDb->insert($user_id,'run');

  $inQueue = $queueDb->top('run',6);

  while(!in_array($user_id,$inQueue)) {
    usleep(300000); //Sleep for 0.3 second
    $inQueue = $queueDb->top('run',6);
  }

  switch ($language) {
    case 'cpp':
      require_once 'compilers/cpp.php';
      break;
    case 'java':
      require_once 'compilers/java.php';
      break;
    case 'python3':
      require_once 'compilers/python3.php';
      break;
  }
?>
