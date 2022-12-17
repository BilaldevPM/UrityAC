<?php

namespace OnlyJaiden\UrityAC\Checks\Combat\Reach;

use pocketmine\event\Listener;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\player\Player;

use OnlyJaiden\UrityAC\Alert;

class ReachA implements Listener {

    public function EntityDamageByEntityEvent(EntityDamageByEntityEvent $event) {
        if (!$event->getEntity() instanceof Player) return;
        
    }


}