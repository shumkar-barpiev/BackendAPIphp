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
	public function getAllproducts(){
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

				if ($stmt -> prepare("SELECT * FROM `product`")) {
					  // Execute query
					  $stmt -> execute();

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


//Craete product
public function insertProduct(
	$productName,
	$description,
	$price,
	$productImageName
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
			$stmt = $this->conn->prepare("INSERT INTO product (productName, description, price, productImageName)
			 VALUES (?, ?, ?, ?)");
			$stmt->bind_param("ssds", $pName, $dscpn, $prc, $pImageName);

			// set parameters and execute
			$pName = $productName;
			$dscpn = $description;
			$prc = $price;
			$pImageName = $productImageName;
			$stmt->execute();

			$stmt->close();
	$this->conn->close();
}

//get product by id
public function getProductById($productId){
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

		if ($stmt -> prepare("SELECT * FROM `product` WHERE `id` = ?")) {
			$stmt->bind_param('d', $productId);

			// Execute query
			$stmt -> execute();

			// Bind result variables
			$stmt -> bind_result($id, $productName, $description, $price, $productImageName);

			$stmt->fetch();

			$product = new Product($id, $productName, $description, $price, $productImageName);

			// Close statement
			$stmt -> close();
			$this->conn->close();

			return $product;
		}
		else{
			$message = "Ooopps! Something gone wrong!";
			return $message;
	}
}


// delete the product
public function deleteProduct($productId){
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

	if ($stmt -> prepare("DELETE FROM product WHERE product.id = ?")) {

		$stmt->bind_param('d', $productId);

		// Execute query
		$stmt -> execute();

		if($stmt->error){
			$message = "Ooopps! Something gone wrong!";
		}
		else{
			$message = $stmt->affected_rows;
		}
		// Close statement
		$stmt -> close();
		$this->conn->close();

		return $message;
	}
	else{
		$message = "Ooopps! Something gone wrong!";
		return $message;
	}
}



}
 ?>
