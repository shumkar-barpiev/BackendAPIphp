<?php
	class Category{
		private $id;
		private $categoryName;
		private $categoryImageName;
		private $categoryDescription;

		public function __construct($id, $categoryName, $categoryImageName, $categoryDescription){
			if($id) $this->id = $id;
			$this->categoryName = $categoryName;
			$this->categoryImageName = $categoryImageName;
			$this->categoryDescription = $categoryDescription;
		}
    //get functions
    public function getCategoryID(){
      return $this->id;
    }
    public function getCategoryName(){
      return $this->categoryName;
    }
    public function getCategoryImageName(){
      return $this->categoryImageName;
    }

		public function getcategoryDescription(){
      return $this->categoryDescription;
    }

    //set functions
    public function setId($id){
			$this->id = $id;
		}
    public function setCategoryName($categoryName){
			$this->categoryName = $categoryName;
		}
    public function setCategoryImageName($categoryImageName){
			$this->categoryImageName = $categoryImageName;
		}
		public function setcategoryDescription($categoryDescription){
			$this->categoryDescription = $categoryDescription;
		}
	}
?>
