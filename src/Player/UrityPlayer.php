<?php

namespace OnlyJaiden\UrityAC\Player;

use OnlyJaiden\UrityAC\Main;
use pocketmine\utils\Config;


class UrityPlayer{

    private $blockAbove = false;
    private $isBlockBelowFast = false;

    public function getPlayerBlockAbove() :bool{
        return $this->blockAbove;
    }

    public function setPlayerBlockAbove(bool $info) :void{
        $this->blockAbove = $info;
    }

    public function getPlayerBlockFast() :bool{
        return $this->isBlockBelowFast;
    }

    public function setPlayerBlockFast(bool $info) :void{
        $this->isBlockBelowFast = $info;
    }
}