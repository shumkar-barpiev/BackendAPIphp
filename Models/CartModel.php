<?php

require_once("Config.php");
class CartModel{
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

//Craete product
public function createCustomerCart(
	$cartName,
	$customerID
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
			$stmt = $this->conn->prepare("INSERT INTO cart (cartName, customerID)
			 VALUES (?, ?)");
			$stmt->bind_param("sd", $cName, $cID);

			// set parameters and execute
			$cName = $cartName;
			$cID = $customerID;
			$stmt->execute();

			$stmt->close();
	$this->conn->close();
}


}
 ?>
