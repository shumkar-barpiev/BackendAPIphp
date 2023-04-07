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

// Getting all Categories
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
					  $stmt -> bind_result($id, $categoryName, $categoryImageName, $categoryDescription);

						$categories = array();
					  // Fetch value
						while ($stmt->fetch()) {
							$categories[] = new Category(
								$id,
		            $categoryName,
		            $categoryImageName,
								$categoryDescription);
						}
					  // Close statement
					  $stmt -> close();
						$this->conn->close();

					  return $categories;
		   }
	}


// Creating new category
	public function insertCategory($categoryName, $categoryImageName, $categoryDescription){
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
				$stmt = $this->conn->prepare("INSERT INTO category (categoryName, categoryImageName, categoryDescription)
				 VALUES (?, ?, ?)");
				$stmt->bind_param("sss", $cName, $cImageName, $cDescription);

				// set parameters and execute
				$cName = $categoryName;
				$cImageName = $categoryImageName;
				$cDescription = $categoryDescription;

				$stmt->execute();

				$stmt->close();
		$this->conn->close();
	}




















}
 ?>
