<?
/* контроллер для работы с каталогом */
require_once('../config/config.php');

if(isset($_POST["action"]) && $_POST["action"] == "show_more" && isset($_POST["page_number"])) {
    $count = LIMIT_ITEM_CATALOG;
    $page_number = (int) $_POST["page_number"];
    echo GetCatalogItems($sqlcon, $page_number, $count);
}