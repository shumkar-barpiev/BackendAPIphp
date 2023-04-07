<?php
	class CustomerCommentForAdmin{
		private $customerName;
    private $productName;
    private $productImageName;
		private $commentBody;
		private $dateOfComment;

		public function __construct($customerName, $productName, $productImageName, $commentBody, $dateOfComment){
			$this->customerName = $customerName;
      $this->productName = $productName;
			$this->productImageName = $productImageName;
      $this->commentBody = $commentBody;
			$this->dateOfComment = $dateOfComment;
		}

    // get functions
    public function getCustomerName(){
      return $this->customerName;
    }
    public function getProductName(){
      return $this->productName;
    }
    public function getProductImageName(){
      return $this->productImageName;
    }
    public function getCommentBody(){
      return $this->commentBody;
    }
    public function getDateOfComment(){
      return $this->dateOfComment;
    }

    //set functions
    public function setCustomerName($customerName){
			$this->customerName = $customerName;
		}
    public function setProductName($productName){
			$this->productName = $productName;
		}
    public function setProductImageName($productImageName){
			$this->productImageName = $productImageName;
		}
    public function setCommentBody($commentBody){
			$this->commentBody = $commentBody;
		}
    public function setDateOfComment($dateOfComment){
			$this->dateOfComment = $dateOfComment;
		}
	}
?>
