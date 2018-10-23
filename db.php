<?php

	class Database{
		private $db_user;
		private $db_pass;
		private $db_host;
		private $db_name;
		private $charset;
		protected $pdo;

		function __construct(){
			$this->db_user = "root";
			$this->db_pass = "";
			$this->db_host = "localhost";
			$this->db_name = "contest";
			$this->charset = "utf8mb4";

			try{
				$dsn = "mysql:host".$this->db_host.";dbname=".$this->db_name.";charset=".$this->charset.";";
				$this->pdo =new PDO($dsn,$this->db_user,$this->db_pass);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_OBJ);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
			} catch(PDOException $e) {
				echo "Database Connection Failed!!!! ".$e->getMessage();
			}
		}
	}
?>
