<?php

require_once("Config.php");
require_once("../Models/Entity/CartEntity.php");
require_once("../Models/Entity/ProductEntity.php");
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


	// Creating new cart
	public function insertCart($cartName, $customerId){
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
				$stmt = $this->conn->prepare("INSERT INTO cart (cartName, customerId)
				 VALUES (?, ?)");
				$stmt->bind_param("si", $cName, $cId);

				// set parameters and execute
				$cName = $cartName;
				$cId = $customerId;

				$stmt->execute();

				$stmt->close();
		$this->conn->close();
	}


	// Insert cart item
	public function insertCartItem($cartId, $productId){
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
				$stmt = $this->conn->prepare("INSERT INTO cart_item (cartId, productId)
					VALUES (?, ?)");
				$stmt->bind_param("ii", $cId, $pId);

				// set parameters and execute

				$cId = $cartId;
				$pId = $productId;

				$stmt->execute();

				$stmt->close();
		$this->conn->close();
	}

	// Delete cart item
	public function deleteCartItem($cartId, $productId){
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
				$stmt = $this->conn->prepare("DELETE FROM cart_item WHERE cart_item.cartId = ? AND cart_item.productId = ?;");
				$stmt->bind_param("ii", $cId, $pId);

				// set parameters and execute

				$cId = $cartId;
				$pId = $productId;

				$stmt->execute();

				$stmt->close();
		$this->conn->close();
	}

	// Get all Carts
	public function getAllCarts(){
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
				$stmt = $this->conn->prepare("SELECT * FROM cart");

				$stmt->execute();

				// Bind result variables
				$stmt -> bind_result($id, $cartName, $customerId);

				$carts = array();
				// Fetch value
				while ($stmt->fetch()) {
					$carts[] = new Cart(
						$id,
						$cartName,
						$customerId);
				}
				// Close statement
				$stmt -> close();
				$this->conn->close();

				return $carts;
	}



  // Get Customer Cart
    public function getCart($customerId){
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
          $stmt = $this->conn->prepare("SELECT * FROM cart WHERE customerId = ? ");
          $stmt->bind_param("i", $customerId);
          $stmt->execute();

          // Bind result variables
          $stmt -> bind_result($id, $cartName, $customerId);

          $carts = array();
          // Fetch value
          while ($stmt->fetch()) {
            $carts[] = new Cart(
              $id,
              $cartName,
              $customerId);
          }
          // Close statement
          $stmt -> close();
          $this->conn->close();

          return $carts;
    }




  // Get all products in customer Cart
  	public function getProductsByCartId($cartId){
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
          $stmt = $this->conn->prepare("SELECT * FROM product WHERE id IN (SELECT productId FROM cart_item WHERE cartId = ?);");
          $stmt->bind_param("d", $cartId);
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
