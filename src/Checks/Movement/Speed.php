<?php

namespace OnlyJaiden\UrityAC\Checks\Movement;

use pocketmine\math\Vector3;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\Server;
use pocketmine\player\Player;
use OnlyJaiden\UrityAC\Alert;
use OnlyJaiden\UrityAC\User;

class Speed implements Listener{
    public function onPacket(PacketReceiveEvent $e, User $user) {
        if(!$e->equals(MovePlayerPacket))
            return;
            $player = $e->getPlayer();
        $dist = hypot($player->velocity->getX(), $player->velocity->getZ());
        $lastDist = hypot($player->lastVelocity->getX(), $player->lastVelocity->getZ());

        $diff = abs($dist - $lastDist);

        if($diff == 0
                && !$player->getPlayer()->getAllowFlight()
                && $dist > User::getBaseMovementSpeed($player)
                && $player->groundTicks > 2) {
            $report->alert("Speed", $player->getName());
        }
    }
}