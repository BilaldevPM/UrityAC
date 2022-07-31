<?php

declare(strict_types=1);

namespace OnlyJaiden\UrityAC;

use OnlyJaiden\UrityAC\Checks\Movement\Speed;
use OnlyJaiden\UrityAC\Checks\Movement\Fly;
use OnlyJaiden\UrityAC\Checks\combat\AutoClicker;
use OnlyJaiden\UrityAC\User;
use pocketmine\utils\SingletonTrait;
use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class Main extends PluginBase{
    use SingletonTrait;
    
    public function onLoad(): void {
        self::setInstance($this);
    }
    
    public function onEnable(): void {
        // Movement checks
        $this->registerEvents(new Speed());
        $this->registerEvents(new Fly());
        $this->registerEvents(new AutoClicker());
    }
    
    private function registerEvents(Listener $listener): void {
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
