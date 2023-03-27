<?php

require_once("../Models/customerCartModel.php");
header("Content-Type: application/json");

$model = new CartModel();
$requestMethod = $_SERVER["REQUEST_METHOD"];

switch ($requestMethod) {
    case 'POST':
        $json = file_get_contents('php://input');
        $data = json_decode($json);

        $cartName = $data->cartName;
        $customerId = $data->customerId;

        $allProducts = $model->insertCart($cartName, $customerId);

        echo(json_encode("Cart of Customer created succesfully!!!"));

        break;
    default:
        echo json_encode("Something wrong!!!");
        break;
}
 ?>
