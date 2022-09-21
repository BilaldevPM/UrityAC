<?php

declare(strict_types=1);

namespace OnlyJaiden\UrityAC;

use OnlyJaiden\UrityAC\libs\CortexPE\DiscordWebhookAPI\Embed;
use OnlyJaiden\UrityAC\libs\CortexPE\DiscordWebhookAPI\Message;
use OnlyJaiden\UrityAC\libs\CortexPE\DiscordWebhookAPI\Webhook;
use OnlyJaiden\UrityAC\User;
use OnlyJaiden\UrityAC\Main;
use pocketmine\Server;
use pocketmine\player\Player;

class Alert {
  private $count = [];

  public static function alert(string $cheat, Player $player) {
    foreach(Server::getInstance()->getOnlinePlayers() as $staff) {
      if($staff->hasPermission("UrityAC.alerts")) {
        if(isset($this->count[$player->getName()])) {
          User::getUser($staff, $cheat, $player);
          Alert::DiscordAlerts($cheat, $player);
        } else {
          new $count[$player->getName()] == 1;
          $player->sendMessage($this->count[$player->getName()]);

        }
        if($this->count[$player->getName()] == 3) {

        }
      }     
    }  
  }

  private static function DiscordAlerts(string $cheat, Player $player) {
    if(Main::getInstance()->getConfig()->get("webhook.enable") == false) return false;
    
    
    $embed = new Embed();
    $embed->setColor(1252377); 
    $embed->setTitle("Anti Cheat Detection!");
    $embed->addField("Player", $player->getName());
    $embed->addField("Ping", strval($player->getNetworkSession()->getPing()));
    $embed->addField("Detection", $cheat);
    $embed->setFooter("UrityAC v1.0.0");

    $message = new Message();
    $message->addEmbed($embed);

    $webhook = new Webhook(Main::getInstance()->getConfig()->get("webhook.url"));
    $webhook->send($message);
  }
}
