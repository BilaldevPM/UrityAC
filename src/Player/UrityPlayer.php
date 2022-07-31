<?php

namespace OnlyJaiden\UrityAC\Player;

use OnlyJaiden\UrityAC\Main;
use pocketmine\utils\Config;


class UrityPlayer{

    private $blockAbove = false;

    public function getPlayerBlockAbove() :bool{
        ruturn $this->blockAbove;
    }

    public function setPlayerBlockAbove(bool $info) :void{
        $this->blockAbove = $info;
    }

}