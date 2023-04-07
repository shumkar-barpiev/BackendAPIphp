<?php
	class CustomerComment{
		private $customerName;
    private $customerImageName;
		private $commentBody;
		private $dateOfComment;

		public function __construct($customerName, $customerImageName, $commentBody, $dateOfComment){
			$this->customerName = $customerName;
			$this->customerImageName = $customerImageName;
      $this->commentBody = $commentBody;
			$this->dateOfComment = $dateOfComment;
		}

    // get functions
    public function getCustomerName(){
      return $this->customerName;
    }
    public function getCustomerImageName(){
      return $this->customerImageName;
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
    public function setCustomerImageName($customerImageName){
			$this->customerImageName = $customerImageName;
		}
    public function setCommentBody($commentBody){
			$this->commentBody = $commentBody;
		}
    public function setDateOfComment($dateOfComment){
			$this->dateOfComment = $dateOfComment;
		}
	}
?>
