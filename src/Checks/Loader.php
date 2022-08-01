<?php

namespace OnlyJaiden\UrityAC\Checks;

use pocketmine\event\Listener;
use OnlyJaiden\UrityAC\Main;
use OnlyJaiden\UrityAC\Checks\Movement\Speed;
use OnlyJaiden\UrityAC\Checks\Movement\Fly;

class Loader {

    public function LoadChecks() {
        $register = new Main;
        $register->registerEvents(new Speed());
        $register->registerEvents(new Fly());
    }


}
