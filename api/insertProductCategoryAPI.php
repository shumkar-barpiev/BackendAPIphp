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

        $productId = $data->productId;
        $categoryId  = $data->categoryId;

        $model->insertProductCategory($productId, $categoryId);

        echo json_encode("Your product category inserted succesfully!!!");
        break;

    default:
        echo json_encode("Something wrong!!!");
        break;
}
?>
