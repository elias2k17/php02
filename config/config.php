<?
/*
навешиваем создание сессии
*/
session_start();

/*http path config*/
define('SITE_ROOT', "../");
define('WWW_ROOT', SITE_ROOT . 'public/');
define("DOMAIN", "php02");

/*DB config*/
define("DB_SERVER","localhost");
define("DB_USER", "root");
define("DB_PASS","");
define("DB_NAME","laptopsheaven_shop");

/*FS config*/
define("IMG_DIR", WWW_ROOT . "item_img/");
define('LIB_DIR', SITE_ROOT . 'model');

/*Security config*/
define("USER_SALT", "12345");

/* limit number of item in catalog*/
define("LIMIT_ITEM_CATALOG", 6);
require_once(LIB_DIR . '/lib_load.php');