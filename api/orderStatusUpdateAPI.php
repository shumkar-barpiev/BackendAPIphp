<?php
header("Content-Type: application/json");
require_once("../Models/OrderModel.php");

$model = new OrderModel();
$requestMethod = $_SERVER["REQUEST_METHOD"];

switch ($requestMethod) {
    case 'POST':

        $json = file_get_contents('php://input');
        // Converts it into a PHP object
        $data = json_decode($json);

        $orderId = $data->orderId;
        $orderStatus  = $data->orderStatus;


        $model->updateStatusOrder($orderId, $orderStatus);

        echo json_encode("Your order status updated succesfully !!!");
        break;
    default:
        echo json_encode("Something wrong!!!");
        break;
}








?>
