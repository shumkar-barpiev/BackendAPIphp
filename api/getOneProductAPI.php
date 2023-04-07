<?php

require_once("../Models/ProductModel.php");
header("Content-Type: application/json");

$model = new ProductModel();
$requestMethod = $_SERVER["REQUEST_METHOD"];

switch ($requestMethod) {
    case 'POST':
        $json = file_get_contents('php://input');
        // Converts it into a PHP object
        $data = json_decode($json);
        $id = $data->productId;
        // $id = $_POST['productId'];

        $product = $model->getProductById($id);

        $productObj = array(
          "id"=>$product->getProductID(),
          "productName"=>$product->getProductName(),
          "description"=>$product->getProductDescription(),
          "price"=>$product->getProductPrice(),
          "productImageName"=>$product->getProductImageName()
        );
        echo(json_encode($productObj));
        break;
    default:
        echo json_encode("Something wrong!!!");
        break;
}








 ?>
