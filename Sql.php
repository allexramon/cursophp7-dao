<?php 
//A class SQL herda da class PDO
class Sql extends PDO{
	private $conn;

	public function __construct(){
		$this->conn = new PDO("mysql:host=localhost; dbname=dbphp7", "root", "");
	}

	private function setParams($statment, $parameters= array()){

		foreach($parameters as $keys => $value){
			$this->setParam($key, $value);
		}

	}

	private function sertParam($statment, $key, $value){
		$statment->bindParam($key, $value);
	}

	public function query($rawQuery, $params = array()){
	
		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt;	
	}

	public function select($rawQuery, $params = array()):array{
		
		$stmt= $this->query($rawQuery, $params);

		return $stmt->fetchALL(PDO::FETCH_ASSOC);
	}
}


 ?>