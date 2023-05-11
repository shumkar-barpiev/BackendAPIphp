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

        $customerId = $data->customerId;

        $customerOrders = $model->getCustomerOrders($customerId);
        $orderObjectArray = array();

        foreach ($customerOrders as $order) {
            $orderObj = array(
                "orderId"=>$order->getOrderId(),
                "orderName"=>$order->getOrderName(),
                "orderDate"=>$order->getOrderDate(),
                "orderDescription"=>$order->getOrderDescription(),
                "customerId"=>$order->getCustomerId(),
                "customerName"=>$order->getCustomerName(),
                "address"=>$order->getAddress(),
                "phoneNumber"=>$order->getPhoneNumber(),
                "totalSum"=>$order->getTotalSum(),
                "orderStatus"=>$order->getOrderStatus()
            );
            array_push($orderObjectArray,$orderObj);
        }
        echo(json_encode($orderObjectArray));
        break;
    default:
        echo json_encode("Something wrong!!!");
        break;
}

?>
