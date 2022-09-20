<?php

namespace OnlyJaiden\UrityAC\Checks\Movement\Speed;

use pocketmine\Server;
use pocketmine\block\BlockLegacyIds;
use pocketmine\player\Player;
use pocketmine\math\Vector3;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\Listener;
use pocketmine\entity\effect\VanillaEffects;

use OnlyJaiden\UrityAC\Main;
use OnlyJaiden\UrityAC\Alert;

class SpeedA implements Listener{

    public function PlayerMoveEvent(PlayerMoveEvent $event) 
    {
        $config = Main::getInstance()->getConfig();
        $player = $event->getPlayer();

        if ($config->get('Speed.Enabled') == false) return;
        
        $player->sendMessage($this->getPlayerEffect($player->getEffects()));
        
        if ($player->getAllowFlight() == true || $this->getPlayerBlockAbove($player) == 1 || $this->getPlayerBlockBelow($player) == 1 || $this->getPlayerEffect($player->getEffects())) return;
        
        $deltaX = $event->getTo()->getX() - $event->getFrom()->getX();
        $deltaZ = $event->getTo()->getZ() - $event->getFrom()->getZ();
        $deltaXZ = hypot($deltaX, $deltaZ);
        
        $prediction = $deltaXZ * floatval(0.91) + floatval(0.0259);
        $accuracy = ($deltaXZ - $prediction);
        
        
        if ($accuracy >= 0.001 && $deltaXZ >= 0.7) return Alert::alert("Speed A", $player);
    }
    
    private function getPlayerBlockAbove(Player $player) 
    {
        $block = $player->getWorld()->getBlock($player->getPosition()->add(0, 2, 0))->getId();
        if ($block == BlockLegacyIds::AIR) {
            return 0;
        } else {
            return 1;
        }
    }
    
    private function getPlayerBlockBelow(Player $player) 
    {
        $posX = $player->getPosition()->x;
        $posY = $player->getPosition()->y - 1;
        $posZ = $player->getPosition()->z;
        $pos = new Vector3($posX, $posY, $posZ);
        $block = $player->getWorld()->getBlock($pos)->getId();
        if ($block == BlockLegacyIds::ICE || $block == BlockLegacyIds::BLUE_ICE || $block == BlockLegacyIds::PACKED_ICE || $block == BlockLegacyIds::FROSTED_ICE) {
            return 1;
        } else {
            return 0;
        }
    }
    private function getPlayerEffect($effect) 
    {
        if ($effect === VanillaEffects::SPEED()){
            return 1;
        } else {
            return 0;
        }
    }
}
