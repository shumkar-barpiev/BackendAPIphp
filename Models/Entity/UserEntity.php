<?php
	class User{
		private $id;
		private $userName;
		private $email;
    private $password;
    private $isAdmin;
    private $lastActiveDate;
		private $phoneNumber;

		public function __construct($id, $userName, $email, $password, $isAdmin, $lastActiveDate,$phoneNumber){
			if($id) $this->id = $id;
			$this->userName = $userName;
			$this->email = $email;
			$this->password = $password;
      $this->isAdmin = $isAdmin;
      $this->lastActiveDate = $lastActiveDate;
			$this->phoneNumber = $phoneNumber;
		}

		// get functions
    public function getUserID(){
      return $this->id;
    }
    public function getUserName(){
      return $this->userName;
    }
    public function getEmail(){
      return $this->email;
    }
    public function getPassword(){
      return $this->password;
    }
    public function getIsAdmin(){
      return $this->isAdmin;
    }
    public function getLastActiveDate(){
      return $this->lastActiveDate;
    }
    public function getPhoneNumber(){
      return $this->phoneNumber;
    }

		//set functions
		public function setId($id){
			$this->id = $id;
		}
		public function setUserName($userName){
			$this->userName = $userName;
		}
		public function setUserEmail($email){
			$this->email = $email;
		}
		public function setUserPassword($password){
			$this->password = $password;
		}
		public function setIsAdmin($isAdmin){
			$this->isAdmin = $isAdmin;
		}
		public function setLastActiveDate($lastActiveDate){
			$this->lastActiveDate = $lastActiveDate;
		}
		public function setUserPhoneNumber($phoneNumber){
			$this->phoneNumber = $phoneNumber;
		}


	}
?>
