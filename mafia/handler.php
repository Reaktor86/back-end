<?php

// Создадим сущность игрок. В этой сущности мы будем задачать имя игрока, тип игрока
// Создать сущность игра. В игре сделать метод раунда

require ('Player.php');
require ('Game.php');


try {
    $player1 = new Player('John', 'red');
    $player2 = new Player('Bob', 'black');
    $player3 = new Player('Mery', 'red');
    $player4 = new Player('Mery2', 'red');
    $player5 = new Player('Mery3', 'red');

    $objGame = new Game();
    $objGame->addPlayer($player1);
    $objGame->addPlayer($player2);
    $objGame->addPlayer($player3);
    $objGame->addPlayer($player4);
    $objGame->addPlayer($player5);

    $objGame->run();

    echo "<pre>";
    print_r($objGame->getGamePlayers());

}
catch (\Exception $e) {
   echo $e->getMessage();
}



