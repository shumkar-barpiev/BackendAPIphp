<?php

require_once("../Models/CategoryModel.php");

$model = new CategoryModel();

$allCategories = $model->getAllcategories();
$categoryObjectArray = array();

header("Content-Type: application/json");

foreach ($allCategories as $category) {
  $categoryObj = array(
    "id"=>$category->getCategoryID(),
    "categoryName"=>$category->getCategoryName(),
    "categoryImageName"=>$category->getCategoryImageName()
  );
  array_push($categoryObjectArray,$categoryObj);
}
echo(json_encode($categoryObjectArray));

 ?>
