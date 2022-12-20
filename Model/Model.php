<?php

require_once("Config.php");
require_once("../Model/Entity/UserEntity.php");
class Model{
	private $conn;

	public function getConn(){
		return $this->conn;
	}

	public function connectDB(){
		$conf = new Config();

		$this->conn = new mysqli(
				$conf->getHost(),
				$conf->getUserName(),
				$conf->getUserPass(),
				$conf->getDBName()
			);
			// Check connection
			if ($this->conn->connect_error) {
				$this->conn->close();
			  return "Connection failed";
			}
			$this->conn->close();
			return "Connected succesfully!!!";
	}

	public function getAllusers(){
			$conf = new Config();

			$this->conn = new mysqli(
					$conf->getHost(),
					$conf->getUserName(),
					$conf->getUserPass(),
					$conf->getDBName()
				);
				// Check connection
				if ($this->conn->connect_error) {
					$this->conn->close();
				  return "Connection failed";
				}

				$stmt = $this->conn -> stmt_init();

				if ($stmt -> prepare("SELECT * FROM `user`")) {
					  // Execute query
					  $stmt -> execute();

					  // Bind result variables
					  $stmt -> bind_result($id, $userName, $email, $password, $isAdmin, $lastActiveDate, $phoneNumber);

						$users = array();
					  // Fetch value
						while ($stmt->fetch()) {
							$users[] = new User(
								$id,
		            $userName,
		            $email,
		            $password,
		            $isAdmin,
                $lastActiveDate,
                $phoneNumber);
						}
					  // Close statement
					  $stmt -> close();
						$this->conn->close();

					  return $users;
		   }
	}


}
 ?>
