<?php

require_once("../Models/getProductByCategoryModel.php");
header("Content-Type: application/json");

$model = new ProductModel();
$requestMethod = $_SERVER["REQUEST_METHOD"];

switch ($requestMethod) {
    case 'POST':
        $json = file_get_contents('php://input');
        $data = json_decode($json);

        $categoryID = $data->categoryID;
      
        $allProducts = $model->getProductsByCategory($categoryID);

        $productObjectArray = array();

        foreach ($allProducts as $product) {
          $productObj = array(
            "id"=>$product->getProductID(),
            "productName"=>$product->getProductName(),
            "description"=>$product->getProductDescription(),
            "price"=>$product->getProductPrice(),
            "productImageName"=>$product->getProductImageName()
          );
          array_push($productObjectArray,$productObj);
        }
        echo(json_encode($productObjectArray));

        break;
    default:
        echo json_encode("Something wrong!!!");
        break;
}
 ?>
