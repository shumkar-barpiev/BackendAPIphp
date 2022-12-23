<?php
	class Comment{
		private $id;
		private $customerID;
		private $productID;
    private $commentBody;
		private $dateOfComment;

		public function __construct($id, $customerID, $productID, $commentBody, $dateOfComment){
			if($id) $this->id = $id;
			$this->customerID = $customerID;
			$this->productID = $productID;
      $this->commentBody = $commentBody;
			$this->dateOfComment = $dateOfComment;
		}

    // get functions
    public function getProductID(){
      return $this->id;
    }
    public function getCustomerId(){
      return $this->customerID;
    }
    public function getProductId(){
      return $this->productID;
    }
    public function getCommentBody(){
      return $this->commentBody;
    }
    public function getDateOfComment(){
      return $this->dateOfComment;
    }

    //set functions
    public function setId($id){
			$this->id = $id;
		}
    public function setCustomerID($customerID){
			$this->customerID = $customerID;
		}
    public function setProductID($productID){
			$this->productID = $productID;
		}
    public function setCommentBody($commentBody){
			$this->commentBody = $commentBody;
		}
    public function setDateOfComment($dateOfComment){
			$this->dateOfComment = $dateOfComment;
		}
	}
?>
