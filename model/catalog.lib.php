<?
/* для работы с каталогом товаров */
function GetNumberNotArchiveItems($sqlcon) {
	$sql_str = "SELECT * FROM item WHERE item.`item_isarchive` = 0";
	$result = mysqli_query($sqlcon, $sql_str);
	if ($result) {
		return mysqli_num_rows($result);
	} else {
		ShowMessage("Ошибка получения списка товаров: " . mysqli_error($sqlcon));
		return 0;
	}
}

function GetCatalogItems ($sqlcon, $page_number, $count) {
	$number_item = GetNumberNotArchiveItems($sqlcon);
	$offset = ($page_number - 1) * $count;
	#ShowMessage("number_item = " . $number_item . " page_number = " . $page_number . " offset = " . $offset . " count = " . $count);
	if ($number_item > 0) {
		$sql_str = "SELECT * FROM item JOIN item_img ON item_img.`id_img_item` = item.`id_img_item` 
				WHERE item.`item_isarchive` = 0 LIMIT $offset, $count";
		$result = mysqli_query($sqlcon, $sql_str);
		if ($result) {
			$items = "";
 			while($row = mysqli_fetch_assoc($result)) {
 				$items .= "<div class='catalog_item'>";
 				$items .= "<a href='item.php?id=".$row["id_item"]."'>";
 				$items .= "<img class='catalog_img' src='" . $row["img_min"] . "' alt='" . $row["item_name"] . "'>";
 				$items .= "</a><div>" . $row["item_name"] . "</div><div>Цена: " . $row["item_price"] ."</div></div>";
 			}
 			if ($number_item > $page_number*$count) {
 				$items .= "<div id='show_more' class='button_show_more'><button type='button' onclick='click_on_show_more()'>Показать еще...</button></div>";
 			}
			return $items;
		} else {
			ShowMessage("Ошибка получения списка товаров: " . mysqli_error($sqlcon));
			exit();
		}
	} else {
		return "<p>Список товаров пуст</p>";
	}
}
