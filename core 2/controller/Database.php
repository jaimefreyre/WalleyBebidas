<?php
class Database {
	public static $db;
	public static $con;
	function Database(){
		// $this->user="pma";$this->pass="";$this->host="localhost";$this->ddbb="inventiolite";
		// $this->user="pma";$this->pass="";$this->host="localhost";$this->ddbb="inventiolite";
		$this->user="conur93_JaimeFreyre";$this->pass="zakkiev924";$this->host='127.0.0.1';$this->ddbb="conur93_inventario";$this->port=3306;
	}

	function connect(){
		$con = new mysqli($this->host,$this->user,$this->pass,$this->ddbb, $this->port);
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
