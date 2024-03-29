<?php
header("Content-Type: application/json");
require_once("../Models/UserModel.php");

$model = new UserModel();
$requestMethod = $_SERVER["REQUEST_METHOD"];

switch ($requestMethod) {
    case 'POST':

        $json = file_get_contents('php://input');
        // Converts it into a PHP object
        $data = json_decode($json);

        $userId = $data->userId;

        $userName = $data->userName;
        $email  = $data->email;
        $password = $data->password;
        $phoneNumber  = $data->phoneNumber;


        $model->updateUser($userId, $userName, $email, $phoneNumber);


        $allUsers = $model->getOneUser($email, $password);
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
    default:
        echo json_encode("Something wrong!!!");
        break;
}

?>
