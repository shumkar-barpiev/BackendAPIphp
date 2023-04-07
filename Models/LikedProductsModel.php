<?php

require_once("Config.php");
require_once("../Models/Entity/ProductEntity.php");
class LikedProductsModel{
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



  // Get liked products by customer id
  	public function getLikedProductsByCustomerId($customerID){
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
          $stmt = $this->conn->prepare("SELECT * FROM product WHERE product.id in (SELECT productId
 FROM likedProducts WHERE likedProducts.customerId = ?);");
          $stmt->bind_param("i", $customerID);
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


// inserting the product into like products table
	public function insertLikedProducts($customerId, $productId){
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
				$stmt = $this->conn->prepare("INSERT INTO likedProducts (customerId, productId)
				 VALUES (?, ?)");
				$stmt->bind_param("ii", $cId, $pId);

				// set parameters and execute
				$cId = $customerId;
				$pId = $productId;

				$stmt->execute();

				$stmt->close();
		$this->conn->close();
	}

  // deleting the product from like products table
  	public function deleteLikedProducts($customerId, $productId){
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
  				$stmt = $this->conn->prepare("DELETE from likedProducts WHERE customerId = ? AND productId = ?;");
  				$stmt->bind_param("ii", $cId, $pId);

  				// set parameters and execute
  				$cId = $customerId;
  				$pId = $productId;

  				$stmt->execute();

  				$stmt->close();
  		$this->conn->close();
  	}




















}
 ?>
