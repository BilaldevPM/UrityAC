<?php

namespace OnlyJaiden\UrityAC\Checks;

use pocketmine\event\Listener;
use OnlyJaiden\UrityAC\Main;
use OnlyJaiden\UrityAC\Checks\Combat\Reach\ReachA;
use OnlyJaiden\UrityAC\Checks\Movement\Fly\FlyA as FlyA;

class Loader {

    public static function LoadChecks() {
        Main::getInstance()->registerEvents(new ReachA());
        Main::getInstance()->registerEvents(new FlyA());
    }
}