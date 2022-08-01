<?php

namespace OnlyJaiden\UrityAC\Player;
// Server
use pocketmine\event\Listener;
use pocketmine\Server;
use pocketmine\block\BlockLegacyIds as BlockIds;
use pocketmine\block\Block;
use pocketmine\math\Vector3;
use pocketmine\world\World;
// Player
use pocketmine\event\player\PlayerMoveEvent;
// Custom
use OnlyJaiden\UrityAC\Player\UrityPlayer;

class PlayerEvent implements Listener{

    public function onPlayerMove(PlayerMoveEvent $event): void{
        $player = $event->getPlayer();
        $blockAbovePlayer = new UrityPlayer;

        $level = $player->getWorld();
        $posX = $player->getPosition()->x;
        $posY = $player->getPosition()->y + 2;
        $posZ = $player->getPosition()->z;

        $pos = new Vector3($posX, $posY, $posZ);
        $block = $level->getBlock($pos)->getId();
        if ($block != BlockIds::AIR) {
            $blockAbovePlayer->setPlayerBlockAbove(true);
        } else {
            $blockAbovePlayer->setPlayerBlockAbove(false);
        }
    }

    public function AlsoPlayermMovemebt(PlayerMoveEvent $event): void{
        $player = $event->getPlayer();
        $Urity = new UrityPlayer;

        $level = $player->getWorld();
        $posX = $player->getPosition()->x;
        $posY = $player->getPosition()->y;
        $posZ = $player->getPosition()->z;

        $pos = new Vector3($posX, $posY, $posZ);
        $block = $level->getBlock($pos)->getId();
        if ($block == BlockIds::ICE || $block == BlockIds::BLUE_ICE || $block == BlockIds::PACKED_ICE || $block == BlockIds::FROSTED_ICE) {
            $Urity->setPlayerBlockFast(true);
        } else {
            $Urity->setPlayerBlockFast(false);
        }
    }
}