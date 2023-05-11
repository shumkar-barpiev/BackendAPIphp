<?php
header("Content-Type: application/json");
require_once("../Models/OrderModel.php");

$model = new OrderModel();
$requestMethod = $_SERVER["REQUEST_METHOD"];

switch ($requestMethod) {
    case 'GET':
        $allOrders = $model->getAllOrders();
        $orderObjectArray = array();

        foreach ($allOrders as $order) {
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
    case 'POST':

        $json = file_get_contents('php://input');
        // Converts it into a PHP object
        $data = json_decode($json);

        $orderName = $data->orderName;
        $orderDate = $data->orderDate;
        $orderDescription  = $data->orderDescription;
        $customerId = $data->customerId;
        $customerName  = $data->customerName;
        $address = $data->address;
        $phoneNumber  = $data->phoneNumber;
        $totalSum = $data->totalSum;
        $orderStatus  = $data->orderStatus;


        $model->insertOrder($orderName, $orderDate, $orderDescription, $customerId, $customerName, $address, $phoneNumber, $totalSum, $orderStatus);

        echo json_encode("Your order accepted succesfully!!!");
        break;
    default:
        echo json_encode("Something wrong!!!");
        break;
}








?>
