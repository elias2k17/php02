<?
/*
1. Придумать класс, который описывает любую сущность из предметной области интернет-магазинов: продукт, ценник, посылка и т.п.
2. Описать свойства класса из п.1 (состояние).
3. Описать поведение класса из п.1 (методы).
*/

class Item {
	/* свойства класса Товар*/
	# ID товара в системе
	public $item_id;
	# наименование товара
	public $item_name;
	# ID категория товара
	public $item_category_id;
	# ID типа товара - цифровой/материальный
	public $item_type_id;
	# цена за единицу
	public $item_unit_price;
	# вес товара
	public $item_weight;
	# короткое описание товара
	public $item_desc_short;
	# подробное описание товара
	public $item_desc_full;
	# остаток на складе
	public $item_balance;

	/*методы класса Товар*/
	public function addNewItem($item_id, $item_name) {
		echo "Добавление нового товара<br>";
	}

	public function updateItem ($item_id, $item_name, $item_category_id, $item_type_id) {
		echo "Обновление параметров товара<br>";
	}

	public function removeItem ($item_id) {
		echo "Удаление товара<br>";
	}

	public function checkItemBalance($item_id) {
		echo "Проверка остатка на складе<br>";
	}
}

/*
4. Придумать наследников класса из п.1. Чем они будут отличаться?
*/

# Наследник ноутбук
class ItemLaptop extends Item {
	# добавляем тип батареии
	public $itemLaptop_battery_type;
	# разрешение экрана ноутбука
	public $itemLaptop_resolution;
	# добавляем название процессора
	public $itemLaptop_cpu_name;


	public function setItemLaptopBatteryType($item_id, $itemLaptop_battery_type) {
		echo "Добавление типа батареи для ноутбука<br>";
	}

	public function setItemLaptopResolution($item_id, $itemLaptop_resolution) {
		echo "Добавление разрешения экрана для ноутбука<br>";
	}

	public function setItemLaptopCpuName($item_id, $itemLaptop_cpu_name) {
		echo "Добавление названия процессора для ноутбука<br>";
	}
}

# Наследник товара - программное обеспечение
class ItemSoftware extends Item {
	# добавляем тип ПО
	public $itemSoftware_type;

	public function setItemSoftwareType($item_id, $itemSoftware_type) {
		echo "Добавление типа программного обеспечения<br>";
	}
}

# Наследник товара - смартфон
class ItemSmartphone extends Item {
	# добавляем тип 
	public $itemSmartphone_diagonal;

	public function setItemSmartphoneDiagonal($item_id, $itemSmartphone_diagonal) {
		echo "Добавление диагонали экрана смартфона<br>";
	}
}

/*

5. Дан код:

class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
$a1 = new A();
$a2 = new A();
$a1->foo();
$a2->foo();
$a1->foo();
$a2->foo();

Что он выведет на каждом шаге? Почему?
*/


class A {
	public function foo() {
		static $x = 0;
		echo ++$x;
	}
}

$a1 = new A();
$a2 = new A();
# выведет 1, т.к. при первом вызове функции foo, значение $x = 0
$a1->foo();
# выведет 2, из-за ключевого слова static значение $x будет сохранено с предыдущего вызова и будет инкрементировано, даже не смотря на то, что $a2 является другим экземпляром
$a2->foo();
# выведет 3, та же причина, что и на предыдущем шаге
$a1->foo();
# выведет 4, та же причина, что и на предыдущем шаге
$a2->foo();

/*
Немного изменим п.5:

class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A {
}
$a1 = new A();
$b1 = new B();
$a1->foo(); 
$b1->foo(); 
$a1->foo(); 
$b1->foo();

6. Объясните результаты в этом случае.
*/

class AA {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class BB extends AA {
	//
}

$a1 = new AA();
$b1 = new BB();
# выведет 1, т.к. при первом вызове функции foo, значение $x = 0
$a1->foo();
# выведет 1, т.к. $b1 является наследником класса AA и при первом вызове функции foo, значение $x = 0
$b1->foo();
# выведет 2, из-за ключевого слова static значение $x будет сохранено с предыдущего вызова и будет инкрементировано
$a1->foo();
# выведет 2, та же причина, что и на предыдущем шаге
$b1->foo();


/*
7. *Дан код:

class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A {
}
$a1 = new A;
$b1 = new B;
$a1->foo(); 
$b1->foo(); 
$a1->foo(); 
$b1->foo(); 

Что он выведет на каждом шаге? Почему?
*/


class AAA {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class BBB extends AAA {
}
$a1 = new AAA;
$b1 = new BBB;
# выведет то же самое, что и в п.6
# скобки нужны для того, чтобы передавать значения конструктору класса __construct(...)
# поскольку конструктор класса не объявлен, то это никак не влияет на выполнение кода
$a1->foo(); 
$b1->foo(); 
$a1->foo(); 
$b1->foo(); 