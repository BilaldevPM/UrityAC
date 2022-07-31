<?php

namespace OnlyJaiden\UrityAC;

use OnlyJaiden\UrityAC\Main;
use pocketmine\utils\Config;
use pocketmine\player\Player;


class User{
    public $User = [];
    
    public function checkAlert(Player $player) : void{
        $config = new Config('plugin_data/UrityAC/'."user.yml", Config::YAML);
        $new = Main::getInstance()->getConfig();
        if($config->get($player->getName()) == true) {
            $config->set($player->getName(), false);
            $player->SendMessage($new->get("AntiCheat.prefix")." Your alerts are now ENABLED!");
        } elseif($config->get($player->getName()) == false) {
            $config->set($player->getName(), true);
            $player->SendMessage($new->get("AntiCheat.prefix")." Your alerts are now DISABLED!");
        }
        $config->save();
        
    }
    
    public function getUser(Player $staff, string $cheat, string $player) : void{
         $config = new Config('plugin_data/UrityAC/'."user.yml", Config::YAML);
         $new = Main::getInstance()->getConfig();
         if($config->get($staff->getName()) == false) {
             $staff->SendMessage($new->get("AntiCheat.prefix")." $player has been using $cheat.");
         }
    }

    public function AbovePlayer(Player $player) : bool {

        $level = $player->getWorld();
        $posX = $player->getPosition()->x;
        $posY = $player->getPosition()->y + 2;
        $posZ = $player->getPosition()->z;

        for ($xidx = $posX-1; $xidx <= $posX+1; $xidx = $xidx + 1)
        {
          for ($zidx = $posZ-1; $zidx <= $posZ+1; $zidx = $zidx + 1)
          {
            $pos   = new Vector3($xidx, $posY, $zidx);
            $block = $level->getBlock($pos)->getId();
            if ($block != BlockIds::AIR)
            {
              return false;
            }
          }
        }
        return true;
      }

}