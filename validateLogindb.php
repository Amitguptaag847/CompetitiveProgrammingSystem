<?php

	session_start();
	require_once('db.php');

	class LoginDb extends Database{

		function __construct(){
			parent::__construct();
		}

		public function setUserSession($admin_id){
		    $_SESSION['admin_id'] = $admin_id;
		}

		public function check($username,$password){
			$sql = "SELECT * FROM `contest`.`admin` WHERE username = :username";
			$stmt = $this->pdo->prepare($sql);
			$exe = [
				'username' => $username
			];
			$execution = $stmt->execute($exe);
      $row = $stmt->fetch();
      $dbPassword = $row->password;
      if(password_verify($password,$dbPassword)){
          $this->setUserSession($row->id);
          return true;
      } else {
        return false;
      }
		}
	}

?>
