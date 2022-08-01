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
use OnlyJaiden\UrityAC\Main;
use OnlyJaiden\UrityAC\Alert;
use OnlyJaiden\UrityAC\User;
use OnlyJaiden\UrityAC\Player\UrityPlayer;

class Speed implements Listener{

    public function PlayerMove(PlayerMoveEvent $event) {
        $config = Main::getInstance()->getConfig();
        $player = $event->getPlayer();
        $data = new UrityPlayer;

        if ($config->get("speed.enable") == false) return;

        if (
            $player->getAllowFlight() || 
            $player->isSurvival() ||
            $data->getPlayerBlockAbove() ||
            $data->getPlayerBlockFast()
        ) return;

        $x = $event->getFrom()->getX() - $event->getTo()->getX();
        $y = $event->getFrom()->getY() - $event->getTo()->getY();
        $z = $event->getFrom()->getZ() - $event->getTo()->getZ();

        $player->sendMessage('Vector3= '.Vector3($x, $y, $z));
        $player->sendMessage('X= '.abs($x));
        $player->sendMessage('Z= '.abs($z));
    }
}
