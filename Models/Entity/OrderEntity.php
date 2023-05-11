<?php
class Order{
    private $id;
    private $orderName;
    private $orderDate;
    private $orderDescription;
    private $customerId;
    private $customerName;
    private $address;
    private $phoneNumber;
    private $totalSum;
    private $orderStatus;


    public function __construct($id, $orderName, $orderDate, $orderDescription, $customerId, $customerName, $address, $phoneNumber, $totalSum, $orderStatus ){
        if($id) $this->id = $id;
        $this->orderName = $orderName;
        $this->orderDate = $orderDate;
        $this->orderDescription = $orderDescription;
        $this->customerId = $customerId;
        $this->customerName = $customerName;
        $this->address = $address;
        $this->phoneNumber = $phoneNumber;
        $this->totalSum = $totalSum;
        $this->orderStatus = $orderStatus;
    }

    // get functions
    public function getOrderId(){
        return $this->id;
    }
    public function getOrderName(){
        return $this->orderName;
    }
    public function getOrderDate(){
        return $this->orderDate;
    }
    public function getOrderDescription(){
        return $this->orderDescription;
    }
    public function getCustomerId(){
        return $this->customerId;
    }
    public function getCustomerName(){
        return $this->customerName;
    }
    public function getAddress(){
        return $this->address;
    }
    public function getPhoneNumber(){
        return $this->phoneNumber;
    }
    public function getTotalSum(){
        return $this->totalSum;
    }
    public function getOrderStatus(){
        return $this->orderStatus;
    }

    //set functions
    public function setOrderId($id){
        $this->id = $id;
    }
    public function setOrderName($orderName){
        $this->orderName = $orderName;
    }
    public function setOrderDate($orderDate){
        $this->orderDate = $orderDate;
    }
    public function setOrderDescription($orderDescription){
        $this->orderDescription = $orderDescription;
    }
    public function setCustomerId($customerId){
        $this->customerId = $customerId;
    }

    public function setCustomerName($customerName){
        $this->customerName = $customerName;
    }
    public function setAddress($address){
        $this->address = $address;
    }
    public function setPhoneNumber($phoneNumber){
        $this->phoneNumber = $phoneNumber;
    }
    public function setTotalSum($totalSum){
        $this->totalSum = $totalSum;
    }
    public function setOrderStatus($orderStatus){
        $this->orderStatus = $orderStatus;
    }
}
?>
