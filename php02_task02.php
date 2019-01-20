<?
echo "Для проверки домашнего задания необходимо проверить исходник файла<br>";
/*
1. Создать структуру классов ведения товарной номенклатуры.
а) Есть абстрактный товар.
б) Есть цифровой товар, штучный физический товар и товар на вес.
в) У каждого есть метод подсчета финальной стоимости.
г) У цифрового товара стоимость постоянная – дешевле штучного товара в два раза. У штучного товара обычная стоимость, у весового – в зависимости от продаваемого количества в килограммах. У всех формируется в конечном итоге доход с продаж.
д) Что можно вынести в абстрактный класс, наследование?
*/

abstract class AbstractItem {
	/* свойства абстрактного класса Товар*/
	public $item_id;
	public $item_name;
	protected static $total_income;

	/*методы абстрактного класса Товар*/
	abstract public function addNewItem($item_id, $item_name);
	abstract public function removeItem ($item_id);
	abstract public function getTotalIncome();
	abstract protected function __construct();
}

/* общий товар для хранения общей суммы дохода */
class Item {
	/* свойства абстрактного класса Товар*/
	public $item_id;
	public $item_name;
	protected static $total_income;

	/*реализация методов класса Товар*/
	public function addNewItem($item_id, $item_name) {
		echo "Добавление нового товара<br>";
	}

	public function removeItem ($item_id) {
		echo "Удаление товара<br>";
	}
	public function getTotalIncome() {
		return self::$total_income;
	}
	public function __construct() {
		$total_income = 0;
	}
}


/* штучный физический товар */
class ItemPiece extends Item {
	public function CalculateIncome($price){
		parent::$total_income += $price;
	}

}

/* цифровой товар */
class ItemDigital extends ItemPiece {
	public function CalculateIncome($price){
		parent::$total_income += $price/2;
	}
}

/* товар на вес */
class ItemWeight extends Item {
	public $weight;
	public function CalculateIncome($price) {
		parent::$total_income += $this->weight*$price;
	}	
}

echo "1) создаем объекты <br>";
$item_piece = new ItemPiece();
$item_digital = new ItemDigital();
$item_weight = new ItemWeight();

echo "2) задаем стоимость для штучного товара = 10 у.е.<br>";
$item_piece->CalculateIncome(10);

echo "3) задаем стоимость для цифрового товара = 10/2 у.е.<br>";
$item_digital->CalculateIncome(10);

echo "4) задаем вес для товара на вес в килограммах = 2 кг и вычисляем стоимость 2 кг за 10 у.е.<br>";
$item_weight->weight = 2;
$item_weight->CalculateIncome(10);

echo "5) Общая стоимость = " . $item_digital->getTotalIncome() . " у.е.";