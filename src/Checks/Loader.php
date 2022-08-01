<?php

namespace OnlyJaiden\UrityAC\Checks;

use pocketmine\event\Listener;

class Loader {

    public function LoadChecks() {
        $this->registerEvents(new Speed());
        $this->registerEvents(new Fly());
    }

    private function registerEvents(Listener $listener): void {
        $this->getServer()->getPluginManager()->registerEvents($listener, $this);
    }

}
