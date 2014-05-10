<?php 
class connection
{
	private $localhost="Localhost";
	private $username="root";
	private $pass="";
	private $db="matrix_db";
	private $connect;
	public function __construct()
	{
		
	}
	
	function connect()
	{
		$this->connect=new mysqli($this->localhost,$this->username,$this->pass,$this->db)or 
		exit("can not connect to the database");
		
		return $this->connect;
	}
}

?>