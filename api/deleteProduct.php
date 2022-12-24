<?php

require_once("../Models/ProductModel.php");

$model = new ProductModel();
$requestMethod = $_SERVER["REQUEST_METHOD"];

switch ($requestMethod) {
    case 'POST':
        $json = file_get_contents('php://input');
        // Converts it into a PHP object
        $data = json_decode($json);

        // $id = $data->productId;
        $id = $_POST['productId'];


        $model->deleteProduct($id);

        echo json_encode("Your product deleted succesfully!!!");
        break;
    default:
        echo json_encode("Something wrong!!!");
        break;
}








 ?>
