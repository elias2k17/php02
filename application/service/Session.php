<?php

namespace application\service;

class Session {
    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) { 
            session_start();
        }
    }

    public function __isset($key)
    {
        return isset($_SESSION[$key]);
    }

    public function __get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
    }
	
    public function __set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function destroy() {
        unset($_SESSION);
        if (session_status() == PHP_SESSION_ACTIVE) { 
            session_destroy(); 
            return TRUE;
        }
        return FALSE;
    }
}