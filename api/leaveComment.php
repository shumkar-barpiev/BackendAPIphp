<?php
header("Content-Type: application/json");
require_once("../Models/CommentModel.php");

$model = new CommentModel();
$requestMethod = $_SERVER["REQUEST_METHOD"];

switch ($requestMethod) {
    case 'POST':
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        
        $customerID = $data->customerID;
        $productID  = $data->productID;
        $commentBody = $data->commentBody;
        $dateOfComment  = $data->dateOfComment;

        // $customerID = $_POST['customerID'];
        // $productID  = $_POST['productID'];
        // $commentBody = $_POST['commentBody'];
        // $dateOfComment  = $_POST['dateOfComment'];

        $model->saveComment($customerID,	$productID,	$commentBody,	$dateOfComment);
      break;
    default:
        echo json_encode("Something wrong!!!");
        break;
}

 ?>
