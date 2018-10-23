<?php

	session_start();
	require_once('db.php');

	class StartContest extends Database{

		function __construct(){
			parent::__construct();
		}

		public function setUserCookie($email,$phonenumber,$fullname,$department,$question1,$question2,$question3,$start,$ending_time){
			$sql = "SELECT * FROM `contest`.`user` WHERE email = :email AND phonenumber = :phonenumber AND fullname = :fullname AND department = :department";
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute(['email'=>$email,'phonenumber'=>$phonenumber,'fullname'=>$fullname,'department'=>$department]);
			while($row = $stmt->fetch()){

				if($row->start == $start){
					$endingFake = time()+3600000;
					$_SESSION['adminPermission'] = "false";
					setcookie("user_id",$row->id,$endingFake);
	      	setcookie("ending_time",$ending_time,$endingFake);
	      	setcookie("question1",$question1,$endingFake);
	      	setcookie("question2",$question2,$endingFake);
	      	setcookie("question3",$question3,$endingFake);
				}
			}
		}

		public function start($fullname,$phonenumber,$department,$email,$collegename,$year,$question1,$question2,$question3){
			$start = time();
			$end = $start+3600;
			$this->pdo->beginTransaction();
			try {
				$sql = "INSERT INTO `contest`.`user` (fullname,collegename,year,department,email,phonenumber,start,end,question1,question2,question3) VALUES (:fullname, :collegename, :year, :department, :email, :phonenumber, :start, :endd, :question1, :question2, :question3)";
				$stmt = $this->pdo->prepare($sql);
				$exe = [
					'fullname' => $fullname,
					'collegename' => $collegename,
					'year' => $year,
					'department' => $department,
					'email' => $email,
					'phonenumber' => $phonenumber,
					'start' => $start,
					'endd' => $end,
					'question1' => $question1,
					'question2' => $question2,
					'question3' => $question3
				];
				$execution = $stmt->execute($exe);
				$this->pdo->commit();
				$this->setUserCookie($email,$phonenumber,$fullname,$department,$question1,$question2,$question3,$start,$end);
				return true;
			} catch(PDOException $e) {
				$this->pdo->rollBack();
        return $e->getMessage();
			}
		}
	}

?>
