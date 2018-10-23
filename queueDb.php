<?php

	require_once('db.php');

	class QueueDb extends Database{

		function __construct(){
			parent::__construct();
		}

    public function insert($user_id,$task){
      $this->pdo->beginTransaction();
			try {
        $sql = "INSERT into `contest`.`queue` (user_id,task) VALUES (:user_id,:task)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['user_id'=>$user_id,'task'=>$task]);
        $this->pdo->commit();
        return true;
      } catch (PDOException $e){
        $this->pdo->rollBack();
        return $e->getMessage();
      }
    }

    public function dqueue($user_id,$task){
      $this->pdo->beginTransaction();
			try {
        $sql = "DELETE from `contest`.`queue` WHERE user_id = :user_id AND task = :task";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['user_id'=>$user_id,'task'=>$task]);
        $this->pdo->commit();
        return true;
      } catch (PDOException $e){
        $this->pdo->rollBack();
        return $e->getMessage();
      }
    }

    public function top($task,$limit){
      $sql = "SELECT *  FROM `contest`.`queue` WHERE task = :task LIMIT $limit";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute(['task'=>$task]);
      $data = array();
      while($row = $stmt->fetch()){
        $data[] = $row->user_id;
      }
      return $data;
    }
	}

?>
