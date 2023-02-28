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
            "categoryImageName"=>$category->getCategoryImageName(),
            "categoryDescription"=>$category->getcategoryDescription()
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
        $categoryDescription  = $data->categoryDescription;

        $model->insertCategory($categoryName, $categoryImageName, $categoryDescription);

        echo json_encode("category Created succesfully!!!");
        break;
    case 'PUT':
        echo "put";
        break;
    case 'DELETE':
        echo "delete";
        break;
    default:
        echo json_encode("Something wrong!!!");
        break;
}

 ?>
