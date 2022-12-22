<?php

require_once("../Models/CategoryModel.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
$model = new CategoryModel();

$requestMethod = $_SERVER["REQUEST_METHOD"];

switch ($requestMethod) {
    case 'GET':
        $allCategories = $model->getAllcategories();
        $categoryObjectArray = array();

        foreach ($allCategories as $category) {
          $categoryObj = array(
            "id"=>$category->getCategoryID(),
            "categoryName"=>$category->getCategoryName(),
            "categoryImageName"=>$category->getCategoryImageName()
          );
          array_push($categoryObjectArray,$categoryObj);
        }
        echo(json_encode($categoryObjectArray));
        break;
    case 'POST':

        $json = file_get_contents('php://input');

        // Converts it into a PHP object
        $data = json_decode($json);

        $categoryName = $data->categoryName;
        $categoryImageName  = $data->categoryImageName;

        $model->insertCategory($categoryName, $categoryImageName);

        echo json_encode("category Created succesfully!!!");
        break;
    case 'PUT':
        echo "put";
        break;
    case 'DELETE':
        echo "delete";
        break;
    default:
        $response = $this->notFoundResponse();
        break;
}

 ?>
