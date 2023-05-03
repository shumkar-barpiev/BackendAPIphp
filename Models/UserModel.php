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
					  $stmt -> bind_result($id, $userName, $email, $password, $isAdmin, $lastActiveDate, $phoneNumber,$userImageName);

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
                $phoneNumber,
								$userImageName);
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
		  $stmt -> bind_result($id, $userName, $email, $password, $isAdmin, $lastActiveDate, $phoneNumber, $userImageName);
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
					$phoneNumber,
					$userImageName);
			}
			// Close statement
			$stmt -> close();
			$this->conn->close();

			return $users;
	}


//Craete user
public function insertUser(
	$userName,
	$userImageName,
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
			$stmt = $this->conn->prepare("INSERT INTO user (userName, email, password, isAdmin, lastActiveDate, phonenumber, userImageName)
			 VALUES (?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("sssisss", $uName, $eml, $pswd, $isAd, $ltActDt, $phNr, $uImageName);

			// set parameters and execute
			$uName = $userName;
			$uImageName = $userImageName;
			$eml = $email;
			$pswd = $password;
			$isAd = $isAdmin;
			$ltActDt = $lastActiveDate;
			$phNr = $phoneNumber;
			$stmt->execute();

			$stmt->close();
	$this->conn->close();
}





//Update user
	public function updateUser(
		$userId,
		$userName,
		$email,
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
		$stmt = $this->conn->prepare("UPDATE user SET userName = ?, email= ?, phoneNumber = ? WHERE id = ?;");
		$stmt->bind_param("sssi",$uName, $eml, $phNr, $uId);

		// set parameters and execute
		$uId = $userId;
		$uName = $userName;
		$eml = $email;
		$phNr = $phoneNumber;
		$stmt->execute();

		$stmt->close();
		$this->conn->close();
	}
}
 ?>
