<?php

require_once("../Models/customerCartModel.php");
header("Content-Type: application/json");

$model = new CartModel();
$requestMethod = $_SERVER["REQUEST_METHOD"];

switch ($requestMethod) {
    case 'POST':
        $json = file_get_contents('php://input');
        $data = json_decode($json);

        $cartId = $data->cartId;
        $productId = $data->productId;

        $model->insertCartItem($cartId, $productId);

        echo(json_encode("Product added to Cart succesfully!!!"));

        break;
    default:
        echo json_encode("Something wrong!!!");
        break;
}
 ?>
