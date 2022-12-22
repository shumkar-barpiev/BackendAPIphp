<?php
	class Category{
		private $id;
		private $categoryName;
		private $categoryImageName;

		public function __construct($id, $categoryName, $categoryImageName){
			if($id) $this->id = $id;
			$this->categoryName = $categoryName;
			$this->categoryImageName = $categoryImageName;
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
	}
?>
