<?
require_once('../config/config.php');
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Каталог</title>
        <link rel="stylesheet" href="./css/style.css">
        <script type="text/javascript" src="../public/js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="../public/js/async.js"></script>
    </head>
    <body>
        <div class="container">
            <header>
                <? include "../template/header.php";?>
            </header>
            <ul class="authpanel">
                <?echo BuildAuthMenu($sqlcon);?>
            </ul>
            <ul class="breadcrumb">
                <li><a href="/">Главная</a></li>
                <li>Каталог</li>
            </ul>
            <main class="content">
                <p>Выберите интересующий вас товар:</p>
                <div class="catalog_list">
                    <?echo GetCatalogItems($sqlcon, 1, LIMIT_ITEM_CATALOG)?>
                </div>
            </main>
            <footer>
                <? include "../template/footer.php";?>
            </footer>
        </div>
    </body>
</html>