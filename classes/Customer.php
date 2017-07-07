<?php

class Customer {
	
	public $id;
	public $firstName;
    public $lastName;
    public $accessLevel;
	
	public function __construct () {
		session_start();
		$this->id = NULL;
		$this->firstName = NULL;
        $this->lastName = NULL;
        $this->accessLevel = NULL;
	}
	
	public function loginCustomer($conn, $loginName, $loginPassword) {
	
		$query = "SELECT customer_id, access_level
				FROM customer
				WHERE login_name = ? AND login_password = ?
				LIMIT 1";        
		if($stmt = $conn->prepare($query)) {
			$stmt->bind_param('ss', $loginName, $loginPassword);
			$stmt->execute();
			$stmt->bind_result($this->id, $this->accessLevel);
			$stmt->execute();
            $stmt->fetch();            
			if($this->id) {
				$ensure_credentials = true;
			}
			$stmt->close();
		}
        else echo $conn->error;

		if($ensure_credentials) {			
			$_SESSION['customerId'] = $this->id;
            $_SESSION['accessLevel'] = $this->accessLevel;
            if ($this->accessLevel == 'admin') {
                header("location: index.php?task=admin");
            }
            else header("location: index.php");
		} 
		else return "Please enter a correct username and password";
		
	} 		

	
	function logOutCustomer() {
		if(isset($_SESSION['accessLevel'])) {
			unset($_SESSION['accessLevel']);
			
			if(isset($_COOKIE[session_name()])) 
				setcookie(session_name(), '', time() - 1000);
				session_destroy();								
		}
        header("location: index.php");
	}
	
	function getCustomer($conn, $id) {
		
		$query = "SELECT customer_id, first_name, last_name, access_level
				FROM customer WHERE customer_id = ? LIMIT 1";

		if($stmt = $conn->prepare($query)) {
			$stmt->bind_param('i', $id);
			$stmt->execute();
			$stmt->bind_result($this->id, $this->firstName, $this->lastName, $this->accessLevel);
			$stmt->execute();
            $stmt->fetch();
			$stmt->close();
            return $this;
		}
        else echo $conn->error;

	}
	

}