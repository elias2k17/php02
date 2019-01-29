<?php

namespace application\service;

class Service {
    private static $_registry = null;

    public static function get($index)
    {
        if(isset(self::$_registry[$index]))
        {
            return self::$_registry[$index];
        }
	}
	
    public static function getAuthData()
    {
        if(isset(self::$_registry["customer_id"]))
        {
            return ["customer_id"=>self::$_registry["customer_id"], 
                "customer_login"=>self::$_registry["customer_login"],
                "customer_admin"=>self::$_registry["customer_admin"]
            ];
        }
    }

	public static function set($index, $value)
    {
        self::$_registry[$index] = $value;
    }	

    public static function config()
    {
        if(isset(self::$_registry["config"]))
        {
            return self::$_registry["config"];
        }
	}
	
    public static function view()
    {
        if(isset(self::$_registry["view"]))
        {
            return self::$_registry["view"];
        }
	}
	
    public static function request()
    {
        if(isset(self::$_registry["request"]))
        {
            return self::$_registry["request"];
        }
	}	
	
}