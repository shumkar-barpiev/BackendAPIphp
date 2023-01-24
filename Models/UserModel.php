<?php

require_once("Config.php");
require_once("../Models/Entity/UserEntity.php");
class UserModel{
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

// Get all users
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

	// Get one user
	public function getOneUser($email, $password){
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

			$stmt -> prepare("SELECT * FROM user as users WHERE users.email = ? AND users.password = ?");
			$stmt->bind_param("ss", $eml, $pswd);

			$eml = $email;
			$pswd = $password;
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


//Craete user
public function insertUser(
	$userName,
	$email,
	$password,
	$isAdmin,
	$lastActiveDate,
	$phoneNumber
){
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

			// prepare and bind
			$stmt = $this->conn->prepare("INSERT INTO user (userName, email, password, isAdmin, lastActiveDate, phonenumber)
			 VALUES (?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("sssiss", $uName, $eml, $pswd, $isAd, $ltActDt, $phNr);

			// set parameters and execute
			$uName = $userName;
			$eml = $email;
			$pswd = $password;
			$isAd = $isAdmin;
			$ltActDt = $lastActiveDate;
			$phNr = $phoneNumber;
			$stmt->execute();

			$stmt->close();
	$this->conn->close();
}

}
 ?>
