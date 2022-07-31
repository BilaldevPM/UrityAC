<?php

namespace OnlyJaiden\UrityAC\Checks\combat;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\network\mcpe\protocol\InventoryTransactionPacket;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pocketmine\network\mcpe\protocol\ServerboundPacket;
use pocketmine\network\mcpe\protocol\types\inventory\UseItemOnEntityTransactionData;
use pocketmine\network\mcpe\protocol\types\LevelSoundEvent;
use OnlyJaiden\UrityAC\Alert;
use OnlyJaiden\UrityAC\Main;

class AutoClicker implements Listener{

    private int $maxCps;
    private int $cps;
    private int $resetCpsAt;

    public function init(): void{
        $config = Main::getInstance()->getConfig();
        $this->maxCps = (int) $config->get("MaxCPS");
    }

    public function isEnabled(): bool{
        $config = Main::getInstance()->getConfig();
        return (bool) $config->get("AutoClicker", true);
    }

    public function inbound(ServerboundPacket $packet): void{
        if(($packet instanceof InventoryTransactionPacket && $packet->trData instanceof UseItemOnEntityTransactionData) || ($packet instanceof LevelSoundEventPacket && $packet->sound === LevelSoundEvent::ATTACK_NODAMAGE)) {
            $this->cps++;
            if(($tick = $this->getTick()) > $this->resetCpsAt + 20) {
                $this->resetCpsAt = $tick;
                if(($cps = $this->cps) >= $this->maxCps) {
                    $report = new Alert;
                    $report->alert("AutoClicker CPS: $cps", $player->getName());
                }
                $this->cps = 0;
            }
        }
    }

}