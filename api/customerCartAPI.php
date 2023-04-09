<?php
header("Content-Type: application/json");
require_once("../Models/customerCartModel.php");

$model = new CartModel();
$requestMethod = $_SERVER["REQUEST_METHOD"];

switch ($requestMethod) {
    case 'GET':
      $customerCarts = $model->getAllCarts();
      $cartObjectArray = array();

      foreach ($customerCarts as $cart) {
        $cartObj = array(
          "id"=>$cart->getCartID(),
          "cartName"=>$cart->getCartName(),
          "customerId"=>$cart->getCustomerId()
        );
        array_push($cartObjectArray,$cartObj);
      }
      echo(json_encode($cartObjectArray));

      break;

    case 'POST':
      $json = file_get_contents('php://input');
      // Converts it into a PHP object
      $data = json_decode($json);

      $customerId = $data->customerId;

      $customerCarts = $model->getCart($customerId);
      $cartObjectArray = array();

      foreach ($customerCarts as $cart) {
        $cartObj = array(
          "id"=>$cart->getCartID(),
          "cartName"=>$cart->getCartName(),
          "customerId"=>$cart->getCustomerId()
        );
        array_push($cartObjectArray,$cartObj);
      }
      echo(json_encode($cartObjectArray));

      break;
    case 'DELETE':
      $json = file_get_contents('php://input');
      // Converts it into a PHP object
      $data = json_decode($json);

      $cartId = $data->cartId;
      $productId = $data->productId;

      $model->deleteCartItem($cartId, $productId);
      echo "cart item deleted succesfully!";
      break;
    default:
      echo json_encode("Something wrong!!!");
      break;
}

 ?>
