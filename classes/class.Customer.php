<?php
include('functions.php');
class Customer{
	
	private $name;
	private $id;
	private $database;
	
	
	//new Customer('4',$database);
	public function __construct($customerID, $database){
		$this->id = $customerID;
		$this->database = $database;
		$this->getFromDatabase();
	}
	
	private function getFromDatabase(){
		//getCustomer(4,database);
		$customers = getCustomer($this->id,$this->database);
		$this->name = $customers[0]['name'];
	}
	
	public function getName(){
		return $this->name;
	}
	
}

?>