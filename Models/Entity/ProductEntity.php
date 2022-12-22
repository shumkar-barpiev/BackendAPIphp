<?php
	class Product{
		private $id;
		private $productName;
		private $description;
    private $price;
		private $productImageName;

		public function __construct($id, $productName, $description, $price, $productImageName){
			if($id) $this->id = $id;
			$this->productName = $productName;
			$this->description = $description;
      $this->price = $price;
			$this->productImageName = $productImageName;
		}

    // get functions
    public function getProductID(){
      return $this->id;
    }
    public function getProductName(){
      return $this->productName;
    }
    public function getProductDescription(){
      return $this->description;
    }
    public function getProductPrice(){
      return $this->price;
    }
    public function getProductImageName(){
      return $this->productImageName;
    }

    //set functions
    public function setId($id){
			$this->id = $id;
		}
    public function setProductName($productName){
			$this->productName = $productName;
		}
    public function setProductDescription($description){
			$this->description = $description;
		}
    public function setProductPrice($price){
			$this->price = $price;
		}
    public function setProductImageName($productImageName){
			$this->productImageName = $productImageName;
		}
	}
?>
