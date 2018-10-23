<?php

	session_start();
	require_once('db.php');

	class LoginDb extends Database{

		function __construct(){
			parent::__construct();
		}

		public function setUserSession($admin_id){
		    $_SESSION['admin_id'] = $user_id;
		}

		public function insert($username,$password){
      $has_pass = password_hash($password,PASSWORD_BCRYPT);
			$sql = "INSERT INTO `contest`.`admin` (username,password) VALUES ( :username, :password)";
			$stmt = $this->pdo->prepare($sql);
			$exe = [
				'username' => $username,
        'password' => $has_pass
			];
			$execution = $stmt->execute($exe);
		}

	}

?>
