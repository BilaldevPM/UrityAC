<?php

declare(strict_types=1);

namespace OnlyJaiden\UrityAC;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;

use pocketmine\player\Player;

use pocketmine\event\Listener;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use OnlyJaiden\UrityAC\User;
use OnlyJaiden\UrityAC\Player\PlayerEvent;
use OnlyJaiden\UrityAC\Checks\Loader;

class Main extends PluginBase {
    use SingletonTrait;
    
    public function onLoad() : void {
        self::setInstance($this);
    }
    
    public function onEnable() : void {
        $loader = new Loader;
        $loader->LoadChecks();
        // Player Event Handler
        $this->registerEvents(new PlayerEvent());
    }
    
    public function registerEvents(Listener $listener) : void {
        $this->getServer()->getPluginManager()->registerEvents($listener, $this);
    }
    
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool {
        switch($command->getName()){
            case "alerts":
                if($sender->hasPermission("UrityAC.alerts")){
                    $config = Main::getInstance()->getConfig();
                    $user = new User;
                    $user->checkAlert($sender);
                } else {
                    $sender->sendMessage("You don't have permission to run this command!");
                }
            return true;
        }
      return true;
    }
}
