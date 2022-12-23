<?php

require_once("Config.php");
require_once("../Models/Entity/CommentEntity.php");
require_once("../Models/Entity/CustomerCommentEntity.php");
class CommentModel{
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

// Get all comments
	public function getAllComments(){
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

				if ($stmt -> prepare("SELECT * FROM `comment`")) {
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


//get product comments
public function getProductComment($productID){
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
			$stmt = $this->conn->prepare("SELECT user.userName,product.productName, product.productImageName,
 comment.commentBody, comment.dateOfComment FROM comment, user, product  WHERE comment.productId = ? AND user.userID = comment.customerId AND product.id = comment.productId;");
			$stmt->bind_param("i", $productID);
			$stmt->execute();


      // Bind result variables
      $stmt -> bind_result($userName, $productName, $productImageName, $commentBody, $dateOfComment);

      $comments = array();
      // Fetch value
      while ($stmt->fetch()) {
        $comments[] = new CustomerComment(
          $userName,
          $productName,
          $productImageName,
          $commentBody,
          $dateOfComment);
      }
      // Close statement
      $stmt -> close();
      $this->conn->close();

      return $comments;
}

}
 ?>
