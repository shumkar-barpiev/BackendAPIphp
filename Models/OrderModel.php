<?php

require_once("Config.php");
require_once("../Models/Entity/UserEntity.php");
class OrderModel{
    private $conn;

    public function getConn(){
        return $this->conn;
    }

    public function connectDB(){
        $conf = new Config();

        $this->conn = new mysqli(
            $conf->getHost(),
            $conf->getUserName(),
            $conf->getUserPass(),
            $conf->getDBName()
        );
        // Check connection
        if ($this->conn->connect_error) {
            $this->conn->close();
            return "Connection failed";
        }
        $this->conn->close();
        return "Connected succesfully!!!";
    }

// Get all orders
    public function getAllOrders(){
        $conf = new Config();

        $this->conn = new mysqli(
            $conf->getHost(),
            $conf->getUserName(),
            $conf->getUserPass(),
            $conf->getDBName()
        );
        // Check connection
        if ($this->conn->connect_error) {
            $this->conn->close();
            return "Connection failed";
        }

        $stmt = $this->conn -> stmt_init();

        if ($stmt -> prepare("SELECT * FROM `orders`")) {
            // Execute query
            $stmt -> execute();

            // Bind result variables
            $stmt -> bind_result($orderId, $orderName, $orderDate, $orderDescription, $customerId, $customerName, $address, $phoneNumber, $totalSum, $orderStatus);

            $orders = array();
            // Fetch value
            while ($stmt->fetch()) {
                $orders[] = new Order(
                    $orderId,
                    $orderName,
                    $orderDate,
                    $orderDescription,
                    $customerId,
                    $customerName,
                    $address,
                    $phoneNumber,
                    $totalSum,
                    $orderStatus);
            }
            // Close statement
            $stmt -> close();
            $this->conn->close();

            return $orders;
        }
    }


//Create order
    public function insertOrder(
        $orderName,
        $orderDate,
        $orderDescription,
        $customerId,
        $customerName,
        $address,
        $phoneNumber,
        $totalSum,
        $orderStatus
    ){
        $conf = new Config();

        $this->conn = new mysqli(
            $conf->getHost(),
            $conf->getUserName(),
            $conf->getUserPass(),
            $conf->getDBName()
        );
        // Check connection
        if ($this->conn->connect_error) {
            $this->conn->close();
            return "Connection failed";
        }

        // prepare and bind
        $stmt = $this->conn->prepare("INSERT INTO orders (orderName, orderDate, orderDescription, customerId, customerName, address, phoneNumber, totalSum, orderStatus)
			 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssisssss", $orderName, $orderDate, $orderDescription, $customerId, $customerName, $address, $phoneNumber, $totalSum, $orderStatus);

        $stmt->execute();

        $stmt->close();
        $this->conn->close();
    }


//Update status order
    public function updateStatusOrder(
        $orderId,
        $orderStatus
    ){
        $conf = new Config();

        $this->conn = new mysqli(
            $conf->getHost(),
            $conf->getUserName(),
            $conf->getUserPass(),
            $conf->getDBName()
        );
        // Check connection
        if ($this->conn->connect_error) {
            $this->conn->close();
            return "Connection failed";
        }

        // prepare and bind
        $stmt = $this->conn->prepare("UPDATE orders SET orderStatus = ? WHERE orderId = ?;");
        $stmt->bind_param("si",$orderStatus, $orderId);

        $stmt->execute();

        $stmt->close();
        $this->conn->close();
    }
}
?>
