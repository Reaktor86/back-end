<?php
// тема: генерация формы с помощью php

/*
Реализовать класс для генерации веб-формы (тэг <form>).
Класс должен позволить сгенерировать форму со всеми элементами (input, textarea, select, button).
Также должна быть возможность задать основные атрибуты формы method и  action
 */
require ("pract6-builder.php");

$obj = new FormBuilder();
$obj->createInput([
    "name" => "comment",
    "type" => "text",
    "placeholder" => "комментарий",
]);
$obj->createInput();
$obj->createTextarea([
    "name" => "textarea",
    "placeholder" => "здесь много букв",
]);
$obj->createSelect(
    [
        "Расход",
        "Доход",
        "Тест"
    ],
    [
        "name" => "select",
    ]
);
$obj->createButton([
    "type" => "submit",
], "Отправить");

$obj->createForm("#", "POST");

?>

<!--образец формы-->

<form action="#" method="post">
    <p>ОБРАЗЕЦ</p>
    <select name="select">
        <option>Расход</option>
        <option>Доход</option>
    </select>
    <input name="comment" type="text" placeholder="комментарий">
    <input name="sum" type="text" placeholder="сумма">
    <textarea name="textarea" placeholder="здесь много букв"></textarea>
    <button type="submit">ОК</button>
</form>

<div>
    <p>ЗДЕСЬ ГЕНЕРИРОВАННАЯ ФОРМА</p>
    <? $obj->getHtml();?>
</div>

<?php
echo '<br><br>';

// добавлялка игроков в команду

$com = new Command();
$com->addPlayer("Олег");
$com->addPlayer("Вася");
$com->addPlayer("Елена");
$com->addPlayer("Ольга");
$com->addPlayer("Гена");

?>

<div>
    <?=$com->getCommand()?>
</div>
