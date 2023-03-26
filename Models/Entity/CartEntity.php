<?php
	class Cart{
		private $id;
		private $cartName;
		private $customerId;

		public function __construct($id, $cartName, $customerId){
			if($id) $this->id = $id;
			$this->cartName = $cartName;
			$this->customerId = $customerId;
		}
    //get functions
    public function getCartID(){
      return $this->id;
    }
    public function getCartName(){
      return $this->cartName;
    }
    public function getCustomerId(){
      return $this->customerId;
    }

    //set functions
    public function setId($id){
			$this->id = $id;
		}
    public function setCartName($cartName){
			$this->cartName = $cartName;
		}
    public function setCustomerId($customerId){
			$this->customerId = $customerId;
		}
	}
?>
