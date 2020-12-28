<?php


class Player
{
    protected $name = '';
    protected $type = '';
    protected $roles = [
        'red',
        'black'
    ];

    public function __construct($name, $type)
    {
        $this->name = $name;
        if (in_array($type, $this->roles)) {
            $this->type = $type;
        }
        else {
            throw new Exception('Неверный тип игрока');
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function getType()
    {
        return $this->type;
    }
}