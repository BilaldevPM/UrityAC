<?php

namespace OnlyJaiden\UrityAC\Checks\Movement;

// pocketmine
use pocketmine\math\Vector3;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\player\GameMode;
use pocketmine\Server;
use pocketmine\player\Player;
// custom
use OnlyJaiden\UrityAC\Alert;
use OnlyJaiden\UrityAC\User;
use OnlyJaiden\UrityAC\Player\player;

class Speed implements Listener{

    public function __construct() {
    $this->MaxSpeed = 0.0;
    $this->configspeed = Main::getInstance()->getConfig()->get("speed.max");
}
    public function PlayerMove(PlayerMoveEvent $event) {
        $config = Main::getInstance()->getConfig();
        $player = $event->getPlayer();
        $data = new player;

        if ($config->get("speed.enable") == false) return;

        if (
            $player->getAllowFlight() || 
            $player->isSurvival() ||
            $data->getPlayerBlockAbove()
        ) return;
    }
}