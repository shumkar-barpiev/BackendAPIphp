<?php
header("Content-Type: application/json");
require_once("../Models/CommentModel.php");

$model = new CommentModel();
$requestMethod = $_SERVER["REQUEST_METHOD"];

switch ($requestMethod) {
    case 'POST':
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $commentProductId = $data->commentProductId;
        // $id = $_POST['commentProductId'];

        if ($commentProductId){
          $allProductComments = $model->getProductComment($id);
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
        }else{
          $customerID = $data->customerID;
          $productID  = $data->productID;
          $commentBody = $data->commentBody;
          $dateOfComment  = $data->dateOfComment;

          // $customerID = $_POST['customerID'];
          // $productID  = $_POST['productID'];
          // $commentBody = $_POST['commentBody'];
          // $dateOfComment  = $_POST['dateOfComment'];

          $model->saveComment($customerID,	$productID,	$commentBody,	$dateOfComment);
        }

        break;
    default:
        echo json_encode("Something wrong!!!");
        break;
}








 ?>
