<?php

require_once("Config.php");
require_once("../Models/Entity/CategoryEntity.php");
class CategoryModel{
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

	public function getAllcategories(){
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

				if ($stmt -> prepare("SELECT * FROM `category`")) {
					  // Execute query
					  $stmt -> execute();

					  // Bind result variables
					  $stmt -> bind_result($id, $categoryName, $categoryImageName);

						$categories = array();
					  // Fetch value
						while ($stmt->fetch()) {
							$categories[] = new Category(
								$id,
		            $categoryName,
		            $categoryImageName);
						}
					  // Close statement
					  $stmt -> close();
						$this->conn->close();

					  return $categories;
		   }
	}


}
 ?>
