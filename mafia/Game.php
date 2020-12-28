<?php


class Game
{
    protected $players = [];

    public function __construct()
    {

    }

    public function getGamePlayers()
    {
        return $this->players;
    }

    public function addPlayer($objPlayer)
    {
        $this->players[] = $objPlayer;
    }

    protected function checkPlayers()
    {
        if (!empty($this->players)) {
            $countBlack = 0;
            $countRed = 0;
            foreach ($this->players as $item) {
                if (is_object($item) && $item instanceof Player) {
                    if ($item->getType() === 'red') {
                        $countRed++;
                    }
                    else {
                        $countBlack++;
                    }
                }
            }

            if ($countRed > $countBlack) {
                return true;
            }
            else {
                throw new Exception('Мафии слишком много. Игры не будет');
            }
        }
        else {
            throw new \Exception('Игра не состоиться. Игроков нет');
        }
    }

    protected function winnerCheck($arPlayers)
    {
        $countBlack = 0;
        $countRed = 0;
        foreach ($arPlayers as $item) {
            if (is_object($item) && $item instanceof Player) {
                if ($item->getType() === 'red') {
                    $countRed++;
                }
                else {
                    $countBlack++;
                }
            }
        }
        if ($countBlack === 0) {
            // победили горож
            return 1;
        }
        elseif ($countBlack < $countRed) {
            return 0;
        }
        elseif ($countBlack == $countRed) {
            return -1;
        }

    }

    public function run()
    {
        $check = $this->checkPlayers();
        $shufflePlayers = $this->players;
        shuffle($shufflePlayers);
        foreach ($shufflePlayers as $k => $item) {
            unset($shufflePlayers[$k]);
            //echo "<pre>";
            //print_r($shufflePlayers);
            $winner = $this->winnerCheck($shufflePlayers);
            //var_dump($winner);
            if ($winner === 0) {
                echo 'Игра ';
            }
            elseif ($winner === 1) {
                echo 'Горожани';
                break;
            }
            elseif ($winner === -1) {
                echo 'Мафия';
                break;
            }
            //
        }
    }
}