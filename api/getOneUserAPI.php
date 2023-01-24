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

        $email  = $data->email;
        $password = $data->password;

        $user = $model->getOneUser($email, $password);

        break;
    default:
        echo json_encode("Something wrong!!!");
        break;
}








 ?>
