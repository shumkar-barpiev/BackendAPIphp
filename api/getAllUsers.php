<?php

require_once("../Model/Model.php");

$model = new Model();

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

 ?>
