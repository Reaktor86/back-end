<!--
1. Сделайте класс Worker, в котором будут следующие public поля - name (имя), age (возраст), salary (зарплата).
Создайте объект этого класса, затем установите поля в следующие значения (не в __construct, а для созданного
объекта) - имя 'Иван', возраст 25, зарплата 1000. Создайте второй объект этого класса,
установите поля в следующие значения - имя 'Вася', возраст 26, зарплата 2000.
Выведите на экран сумму зарплат Ивана и Васи. Выведите на экран сумму возрастов Ивана и Васи.-->

<?php

class Worker1
{
    public $name = '';
    public $age = 0;
    public $salary = 0;

    public function __construct($name, $age, $salary)
    {
        $this->name = $name;
        $this->age = $age;
        $this->salary = $salary;
    }
}

$obj1 = new Worker1('Иван', 25, 1000);
$obj2 = new Worker1('Вася', 26, 2000);
$salarySumm = $obj1->salary + $obj2->salary;
$ageSumm = $obj1->age + $obj2->age;

echo "Сумма зарплат: $salarySumm <br>Сумма возрастов: $ageSumm";
echo "<br><br>";

/*
2. Сделайте класс Worker, в котором будут следующие private поля - name (имя), age (возраст), salary (зарплата)
и следующие public методы setName, getName, setAge, getAge, setSalary, getSalary.
Создайте 2 объекта этого класса: 'Иван', возраст 25, зарплата 1000 и 'Вася', возраст 26, зарплата 2000.
Выведите на экран сумму зарплат Ивана и Васи. Выведите на экран сумму возрастов Ивана и Васи.
 */

class Worker2
{
    private $name = '';
    private $age = 0;
    private $salary = 0;

    public function __construct($name, $age, $salary)
    {
        $this->name = $name;
        $this->age = $age;
        $this->salary = $salary;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setAge($age)
    {
        if ($this->checkAge($age)) {
            $this->age = $age;
        }
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setSalary($salary)
    {
        $this->name = $salary;
    }

    public function getSalary()
    {
        return $this->salary;
    }

    private function checkAge($age)
    {
        if ($age >= 1 && $age <= 100) {
            return true;
        }
    }
}

$obj1 = new Worker2('Иван', 25, 1000);
$obj2 = new Worker2('Вася', 26, 2000);
$salarySumm = $obj1->getSalary() + $obj2->getSalary();
$ageSumm = $obj1->getAge() + $obj2->getAge();

echo "Сумма зарплат: $salarySumm <br>Сумма возрастов: $ageSumm";
echo "<br><br>";

/*
3. Дополните класс Worker из предыдущей задачи private методом checkAge,
который будет проверять возраст на корректность (от 1 до 100 лет).
Этот метод должен использовать метод setAge перед установкой нового возраста
(если возраст не корректный - он не должен меняться).
 */

$obj2->setAge(30);
echo "Новый возраст: " . $obj2->getAge() . "<br>";
$obj2->setAge(102);
echo "Новый возраст: " . $obj2->getAge() . "<br>";

