<?php

namespace OnlyJaiden\UrityAC\Checks\Movement;

// pocketmine.
use pocketmine\math\Vector3;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\player\GameMode;
use pocketmine\Server;
use pocketmine\player\Player;
// custom.
use OnlyJaiden\UrityAC\Alert;
use OnlyJaiden\UrityAC\User;

class Speed implements Listener{

    public function __construct(Analyzer $ana)
  {
    $this->MaxSpeed = 0.0;
    $this->configspeed = Main::getInstance()->getConfig()->get("speed.max");
  }
    public function PlayerMove(PlayerMoveEvent $event) {
        $config = Main::getInstance()->getConfig();
        $player = $event->getPlayer();
        $u = new User;

        if ($player->getAllowFlight() == true) return;
        if ($config->get("speed.enable") == false) return;

        if ($player->getGamemode()->equals(GameMode::CREATIVE())) return;
        if ($player->getGamemode()->equals(GameMode::SPECTATOR())) return;

        if ($u->AbovePlayer() == false) {
            $this->MaxSpeed = ($this->configspeed)*1.25;
        } else {
            $this->MaxSpeed;
        }
    }
}