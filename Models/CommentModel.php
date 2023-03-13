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

//get product comments for customer
public function getProductCommentCustomer($productID){
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
			$stmt = $this->conn->prepare("SELECT user.userName,user.userImageName,
 comment.commentBody, comment.dateOfComment FROM comment, user, product  WHERE comment.productId = ? AND user.id = comment.customerId AND product.id = comment.productId;");
			$stmt->bind_param("i", $productID);
			$stmt->execute();


      // Bind result variables
      $stmt -> bind_result($userName, $customerImageName, $commentBody, $dateOfComment);

      $comments = array();
      // Fetch value
      while ($stmt->fetch()) {
        $comments[] = new CustomerComment(
          $userName,
          $customerImageName,
          $commentBody,
          $dateOfComment);
      }
      // Close statement
      $stmt -> close();
      $this->conn->close();

      return $comments;
}



//get product comments for admin
public function getProductCommentAdmin($productID){
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
			$stmt = $this->conn->prepare("SELECT user.userName,
 comment.commentBody, comment.dateOfComment FROM comment, user, product  WHERE comment.productId = ? AND user.userID = comment.customerId AND product.id = comment.productId;");
			$stmt->bind_param("i", $productID);
			$stmt->execute();


      // Bind result variables
      $stmt -> bind_result($userName, $commentBody, $dateOfComment);

      $comments = array();
      // Fetch value
      while ($stmt->fetch()) {
        $comments[] = new CustomerComment(
          $userName,
          $commentBody,
          $dateOfComment);
      }
      // Close statement
      $stmt -> close();
      $this->conn->close();

      return $comments;
}

//Save comment of customer
public function saveComment(
	$customerID,
	$productID,
	$commentBody,
	$dateOfComment
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
			$stmt = $this->conn->prepare("INSERT INTO comment (customerId, productId, commentBody, dateOfComment)
			 VALUES (?, ?, ?, ?)");
			$stmt->bind_param("iiss", $cID, $pID, $cmBody, $date);

			// set parameters and execute
			$cID = $customerID;
			$pID = $productID;
			$cmBody = $commentBody;
			$date = $dateOfComment;
			$stmt->execute();

			$stmt->close();
	$this->conn->close();
}




}
 ?>
