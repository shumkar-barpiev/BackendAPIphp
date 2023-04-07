<?php

require_once("../Models/LikedProductsModel.php");
header("Content-Type: application/json");

$model = new LikedProductsModel();
$requestMethod = $_SERVER["REQUEST_METHOD"];

switch ($requestMethod) {
    case 'POST':
        $json = file_get_contents('php://input');
        $data = json_decode($json);

        $customerID = $data->customerId;
        $productID = $data->productId;

        $model->deleteLikedProducts($customerID, $productID);

        echo json_encode("Deleted succesfully!!!");

        break;
    default:
        echo json_encode("Something wrong!!!");
        break;
}
 ?>
