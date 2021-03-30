<?php
include "connexion.php";

class EDatabase {
	private static $objInstance;

	private function __construct() {}

	private function __clone() {}
	
	public static function getInstance() {
		if(!self::$objInstance){
			try{
					
				$dsn = EDB_DBTYPE.':host='.DB_HOST.';port='.EDB_PORT.';dbname='.EDB_DBNAME;
			   	self::$objInstance = new PDO($dsn, DB_USER, EDB_PASS, array('charset'=>'utf8'));
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

	public function startTransaction()
    {
        DBConnection::getConnection()->beginTransaction();
    }

    public function rollback()
    {
        try {
            DBConnection::getConnection()->rollback();
        } catch (\Throwable $th) {
        }
    }

    public function commit()
    {
        try {
            DBConnection::getConnection()->commit();
        } catch (\Throwable $th) {
        }
        
    }
}
