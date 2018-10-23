<?php

  require_once 'db.php';

  class SubmitCodeDb extends Database{
    function __construct(){
			parent::__construct();
		}

    public function setSubmitData($user_id,$submitId,$submitTime){
      $sqlTime = "SELECT * FROM `contest`.`user` WHERE id = :user_id";
      $stmtTime = $this->pdo->prepare($sqlTime);
      $stmtTime->execute(['user_id'=>$user_id]);
      $row = $stmtTime->fetch();
      $start_time = $row->start;
      $delay = $submitTime-$start_time;

      $submission = "submission".$submitId;
      $timer = "time".$submitId;

      $attempt_number = "attempt".$submitId;
      $attempt = $row->$attempt_number;
      $attempt++;

      $this->pdo->beginTransaction();
      try {
        $sql = "UPDATE `contest`.`user` SET ".$submission." = 1 , ".$timer." = $delay , $attempt_number = $attempt WHERE id = $user_id";
        $stmt = $this->pdo->query($sql);
        $this->pdo->commit();
        return true;
      } catch (PDOException $e) {
        $this->pdo->rollBack();
        return $e->getMessage();
      }
    }
  }


?>
