<?php

namespace Altum\Db;

class Db {

     public static $db;
    public static function initialize() {
        
        self::$db 		= NewADOConnection('mysqli');
		if (!self::$db->Connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME)){
			die( mysql_error() . ' Error while connecting to Database Server');
		}
        $ADODB_FETCH_MODE 	= ADODB_FETCH_ASSOC;
        
        return self::$db;
    } 
    
    

}