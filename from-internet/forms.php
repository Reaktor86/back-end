<!--задание 1-->

<form>
    <input type="text" name="username" placeholder="Имя">
    <button type="submit">Отправить</button>
</form>

<?php

$name = $_REQUEST['username'];
if (isset($name)) {
    echo "Привет, " . $name;
}
echo "<br><br>";
?>

<!--задание 2-->

<form action="" method="GET">
    <input type="text" name="username" placeholder="Имя">
    <input type="text" name="age" placeholder="возраст">
    <textarea name="text"></textarea>
    <button type="submit" name="submit">Отправить</button>
</form>

<?php

if (isset($_REQUEST['submit'])) {
    $name = strip_tags($_REQUEST['username']);
    $age = strip_tags($_REQUEST['age']);
    $text = strip_tags($_REQUEST['text']);
    echo "Привет, $name, $age лет.<br>Твоё сообщение: $text";
}
echo "<br><br>";
?>

<!--задание 3-->

<?php

if (isset($_REQUEST['submit3'])) {
    $age = strip_tags($_REQUEST['age3']);
    echo "Возраст: $age";
} else {
    ?>
    <form action="" method="GET">
    <input type="text" name="age3" placeholder="возраст">
    <button type="submit" name="submit3">Отправить</button>
</form>
    <?php
}
echo "<br><br>";
?>

<!--задание 4-->

<form action="" method="GET">
    <input type="text" name="login4" placeholder="логин">
    <input type="password" name="pass4" placeholder="пароль">
    <button type="submit" name="submit4">OK</button>
</form>

<?php

if (isset($_REQUEST['submit4'])) {
    $login = "Test";
    $pass = "123";
    $loginEnter = trim($_REQUEST['login4']);
    $passEnter = trim($_REQUEST['pass4']);
    if ($login === $loginEnter && $pass === $passEnter) {
        echo "Доступ разрешен!";
    } else {
        echo "Доступ запрещен!";
    }
}

echo "<br><br>";
?>

<!--задание 5-->

<?php

$name5 = "логин";

if (isset($_REQUEST['submit5'])) {
    $name5 = $_REQUEST['name5'];
}
?>

<form action="" method="GET">
    <input type="text" name="name5" placeholder=<?=$name5?>>
    <button type="submit" name="submit5">OK</button>
</form>
