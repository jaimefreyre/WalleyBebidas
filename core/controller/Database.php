<?php
class Database {
	public static $db;
	public static $con;
	function Database(){
		// Modo Local
		// $this->user="pma";$this->pass="";$this->host="localhost";$this->ddbb="inventiolite";
		// $this->user="pma";$this->pass="";$this->host='localhost';$this->ddbb="conur93_inv_walley";
		
		// Modo Remoto
		$this->user="conur93_JaimeFreyre";$this->pass="zakkiev924";$this->host='127.0.0.1';$this->ddbb="conur93_inv_walley";$this->port=3306;
	}

	function connect(){
		// Modo Remoto
		// $con = new mysqli($this->host,$this->user,$this->pass,$this->ddbb, $this->port);
		
		//Modo Local
		$con = new mysqli($this->host,$this->user,$this->pass,$this->ddbb);
		
		$con->query("set sql_mode=''");
		return $con;
	}

	public static function getCon(){
		if(self::$con==null && self::$db==null){
			self::$db = new Database();
			self::$con = self::$db->connect();
		}
		return self::$con;
	}
	
}
?>
