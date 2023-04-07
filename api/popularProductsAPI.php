<?php

require_once("../Models/ProductModel.php");
header("Content-Type: application/json");

$model = new ProductModel();
$requestMethod = $_SERVER["REQUEST_METHOD"];

switch ($requestMethod) {
    case 'GET':
        $allProducts = $model->getAllproducts();
        $productObjectArray = array();
        $popularProducts = array();

        $number =  count($allProducts);

        $randomID=range(1,$number);
        shuffle($randomID);


        for ($x=0; $x< 10; $x++) {
          foreach ($allProducts as $product) {
            if ($product->getProductID() == $randomID[$x]) {
              array_push($popularProducts, $product);
            }
          }
        }

        // foreach ($popularProducts as $value) {
        //   echo $value->getProductName();
        // }
        // echo " ";

        foreach ($popularProducts as $product) {
          $productObj = array(
            "id"=>$product->getProductID(),
            "productName"=>$product->getProductName(),
            "description"=>$product->getProductDescription(),
            "price"=>$product->getProductPrice(),
            "productImageName"=>$product->getProductImageName()
          );
          array_push($productObjectArray,$productObj);
        }
        echo(json_encode($productObjectArray));
        break;
    case 'POST':
        $json = file_get_contents('php://input');
        // Converts it into a PHP object
        $data = json_decode($json);

        $productName = $data->productName;
        $description  = $data->description;
        $price = $data->price;
        $productImageName  = $data->productImageName;

        $model->insertProduct($productName, $description, $price, $productImageName);

        echo json_encode("Your product created succesfully!!!");
        break;
    default:
        echo json_encode("Something wrong!!!");
        break;
}




 ?>
