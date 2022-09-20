<?php

namespace OnlyJaiden\UrityAC\Checks;

use pocketmine\event\Listener;
use OnlyJaiden\UrityAC\Main;
use OnlyJaiden\UrityAC\Checks\Movement\Speed\SpeedA;
use OnlyJaiden\UrityAC\Checks\Movement\Fly;

class Loader {

    public static function LoadChecks() {
        Main::getInstance()->registerEvents(new Fly());
        Main::getInstance()->registerEvents(new SpeedA());
    }
}