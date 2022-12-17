<?php

namespace OnlyJaiden\UrityAC\Checks\Movement\Fly;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\player\Player;

use OnlyJaiden\UrityAC\Alert;

class FlyA implements Listener {

    public function FlyA(PlayerMoveEvent $event) {
        $player = $event->getPlayer();
        $pastPos = $event->getFrom();
        $newPos = $event->getTo();
        if(!$player->getAllowFlight() || !$player->isCreative() || !$player->isSpectator()) {
            if ($pastPos->getY() >= $newPos->getY()) {
                # code...
            }
        }
    }

}