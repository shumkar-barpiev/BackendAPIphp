<?php

require_once("../Models/UserModel.php");

$model = new UserModel();
$requestMethod = $_SERVER["REQUEST_METHOD"];

switch ($requestMethod) {
    case 'GET':
        $all_Users = $model->getAllusers();
        $userObjectArray = array();

        header("Content-Type: application/json");

        foreach ($all_Users as $user) {
          $userObj = array(
            "id"=>$user->getUserID(),
            "userName"=>$user->getUserName(),
            "email"=>$user->getEmail(),
            "password"=>$user->getPassword(),
            "isAdmin"=>$user->getIsAdmin(),
            "lastActiveDate"=>$user->getLastActiveDate(),
            "phoneNumber"=>$user->getPhoneNumber()
          );
          array_push($userObjectArray,$userObj);
        }
        echo(json_encode($userObjectArray));
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
