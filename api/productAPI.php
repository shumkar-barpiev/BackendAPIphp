<?php

require_once("../Models/ProductModel.php");
header("Content-Type: application/json");

$model = new ProductModel();
$requestMethod = $_SERVER["REQUEST_METHOD"];

switch ($requestMethod) {
    case 'GET':
        $allProducts = $model->getAllproducts();
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
    case 'POST':
        $json = file_get_contents('php://input');
        // Converts it into a PHP object
        $data = json_decode($json);

        $productName = $data->productName;
        $description  = $data->description;
        $price = $data->price;
        $productImageName  = $data->productImageName;

        $model->insertProduct($productName, $description, $price, $productImageName);

        echo json_encode("Your product created succesfully!!!");
        break;
    case 'DELETE':
        $json = file_get_contents('php://input');
        // Converts it into a PHP object
        $data = json_decode($json);

        $productID = $data->productId;

        $model->deleteProduct($productID);

        echo json_encode("Your product deleted succesfully!!!");
        break;
    default:
        echo json_encode("Something wrong!!!");
        break;
}
 ?>
