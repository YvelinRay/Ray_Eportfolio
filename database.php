<?php
include "connexion.php";

class EDatabase {
	private static $objInstance;

	private function __construct() {}

	private function __clone() {}
	
	public static function getInstance() {
		if(!self::$objInstance){
			try{
				$dsn = DB_DBTYPE.':host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_DBNAME;
			   	self::$objInstance = new PDO($dsn, DB_USER, DB_PASS, array('charset'=>'utf8'));
				self::$objInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}catch(PDOException $e ){
				echo "EDatabase Error: ".$e;
			}
		}
		return self::$objInstance;
	}
	final public static function __callStatic( $chrMethod, $arrArguments ) {
		$objInstance = self::getInstance();
		return 	call_user_func_array(array($objInstance, $chrMethod), $arrArguments);
	} 
}
