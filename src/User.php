<?php

namespace OnlyJaiden\UrityAC;

use OnlyJaiden\UrityAC\Main;
use pocketmine\utils\Config;
use pocketmine\player\Player;


class User{
    public $User = [];
    
    public static function checkAlert(Player $player) : void{
        $config = new Config('plugin_data/UrityAC/'."user.yml", Config::YAML);
        $new = Main::getInstance()->getConfig();
        if($config->get($player->getName()) == true) {
            $config->set($player->getName(), false);
            $player->SendMessage($new->get("Prefix")." Your alerts are now ENABLED!");
        } elseif($config->get($player->getName()) == false) {
            $config->set($player->getName(), true);
            $player->SendMessage($new->get("Prefix")." Your alerts are now DISABLED!");
        }
        $config->save();
        
    }
    
    public static function getUser(Player $staff, string $cheat, Player $player) : void{
        $name = $player->getName();
         $config = new Config('plugin_data/UrityAC/'."user.yml", Config::YAML);
         $new = Main::getInstance()->getConfig();
         if($config->get($staff->getName()) == false) {
             $staff->SendMessage($new->get("Prefix")." $name has been using $cheat.");
         }
    }

}