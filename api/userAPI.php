<?php
header("Content-Type: application/json");
require_once("../Models/UserModel.php");

$model = new UserModel();
$requestMethod = $_SERVER["REQUEST_METHOD"];

switch ($requestMethod) {
    case 'GET':
        $allUsers = $model->getAllusers();
        $userObjectArray = array();

        foreach ($allUsers as $user) {
          $userObj = array(
            "id"=>$user->getUserID(),
            "userName"=>$user->getUserName(),
            "email"=>$user->getEmail(),
            "password"=>$user->getPassword(),
            "isAdmin"=>$user->getIsAdmin(),
            "lastActiveDate"=>$user->getLastActiveDate(),
            "phoneNumber"=>$user->getPhoneNumber(),
            "userImageName"=>$user->getUserImageName(),
          );
          array_push($userObjectArray,$userObj);
        }
        echo(json_encode($userObjectArray));
        break;
    case 'POST':

        $json = file_get_contents('php://input');
        // Converts it into a PHP object
        $data = json_decode($json);

        $userName = $data->userName;
        $userImageName = $data->userImageName;
        $email  = $data->email;
        $password = $data->password;
        $isAdmin  = $data->isAdmin;
        $lastActiveDate = $data->lastActiveDate;
        $phoneNumber  = $data->phoneNumber;


        $model->insertUser($userName, $userImageName, $email, $password, $isAdmin, $lastActiveDate, $phoneNumber);

        echo json_encode("Your account created succesfully!!!");
        break;
    default:
        echo json_encode("Something wrong!!!");
        break;
}








 ?>
