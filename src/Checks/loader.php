<?php

namespace OnlyJaiden\UrityAC\Checks;

use pocketmine\event\Listener;

class loader implements Listener{

    public function onEnable() {
        $this->registerEvents(new Speed());
        $this->registerEvents(new Fly());
    }

    private function registerEvents(Listener $listener): void {
        $this->getServer()->getPluginManager()->registerEvents($listener, $this);
    }

}
