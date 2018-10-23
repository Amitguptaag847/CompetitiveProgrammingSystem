<?php

  require_once "db.php";

  class LoadSubmissions extends Database{
    function __construct(){
      parent::__construct();
    }

    public function getData(){
      $sql = "SELECT * FROM `contest`.`user`";
      $stmt = $this->pdo->query($sql);
      $data = $stmt->fetchAll();
      return json_encode($data);
    }

    public function getUserData($user_id){
      $sql = "SELECT * FROM `contest`.`user` WHERE id = :id";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute(['id'=>$user_id]);
      $row = $stmt->fetch();
      return $row;
    }

    public function updateUserData($user_id,$data){
      $this->pdo->beginTransaction();
      try {
        $sql = "UPDATE `contest`.`user` SET status1 = :status1 , status2 = :status2 , status3 = :status3 , points = :points WHERE id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['status1'=>$data['status1'],'status2'=>$data['status2'],'status3'=>$data['status3'],'points'=>$data['points'],'user_id'=>$user_id]);

        $this->pdo->commit();
        return true;
      } catch (PDOException $e) {
        $this->pdo->rollBack();
        return $e->getMessage();
      }
    }
  }

?>
