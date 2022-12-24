<?php
header("Content-Type: application/json");
require_once("../Models/CommentModel.php");

$model = new CommentModel();
$requestMethod = $_SERVER["REQUEST_METHOD"];

switch ($requestMethod) {
    case 'POST':
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $productId = $data->productId;
        // $productId = $_POST['productId'];

          $allProductComments = $model->getProductComment($productId);
          $commentObjectArray = array();

          foreach ($allProductComments as $comment) {
            $commentObj = array(
              "customerName"=>$comment->getCustomerName(),
              "productName"=>$comment->getProductName(),
              "productImageName"=>$comment->getProductImageName(),
              "commentBody"=>$comment->getCommentBody(),
              "dateOfComment"=>$comment->getDateOfComment()
            );
            array_push($commentObjectArray,$commentObj);
          }
          echo(json_encode($commentObjectArray));

        break;
    default:
        echo json_encode("Something wrong!!!");
        break;
}

 ?>
