<?php

declare(strict_types=1);

namespace OnlyJaiden\UrityAC;

use pocketmine\utils\SingletonTrait;
use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\Internet;

use OnlyJaiden\UrityAC\Checks\Loader;
use OnlyJaiden\UrityAC\User;

class Main extends PluginBase{
    use SingletonTrait;
    
    public function onLoad(): void {
        self::setInstance($this);
        $config = Main::getInstance()->getConfig();
        $this->saveDefaultConfig();
        $json = Internet::getURL('https://raw.githubusercontent.com/BilaldevPM/PM-AntiCheat/main/README.md');
        $version = json_decode($json->getBody(), true);
        if("0.7.0" !== $version)
        {
            $this->getLogger()->info($version);
            $this->getLogger()->info("is outdated. https://poggit.pmmp.io/p/UrityAC/");
        }
    }
    
    public function onEnable(): void {
        // Movement checks
        Loader::LoadChecks();
    }
    
    public function registerEvents(Listener $listener): void {
        $this->getServer()->getPluginManager()->registerEvents($listener, $this);
    }
    
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
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
