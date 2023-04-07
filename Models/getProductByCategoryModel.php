<?php

require_once("Config.php");
require_once("../Models/Entity/ProductEntity.php");
class ProductModel{
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

// Get all products
	public function getProductsByCategory($categoryID){
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
        $stmt = $this->conn->prepare("SELECT * FROM product WHERE product.id IN (SELECT productID FROM categoryProducts
 WHERE categoryProducts.categoryID = ?);");
        $stmt->bind_param("i", $categoryID);
        $stmt->execute();

			  // Bind result variables
			  $stmt -> bind_result($id, $productName, $description, $price, $productImageName);

				$products = array();
			  // Fetch value
				while ($stmt->fetch()) {
					$products[] = new Product(
						$id,
            $productName,
            $description,
            $price,
            $productImageName);
				}
			  // Close statement
			  $stmt -> close();
				$this->conn->close();

			  return $products;

	}








}
 ?>
