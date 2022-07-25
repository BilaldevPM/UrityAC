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

  public function alert(string $cheat, string $player): void {
    $config = Main::getInstance()->getConfig();
    $user = new User;
    foreach(Server::getInstance()->getOnlinePlayers() as $staff) {
      if($staff->hasPermission("UrityAC.alerts")) {
        $user->getUser($staff, $player, $cheat);
      }     
    }  
    $this->DiscordAlerts($cheat, $player);
  }

  private function DiscordAlerts(string $cheat, string $player): void {
    $config = Main::getInstance()->getConfig();
    if(!$config->get("webhook.enable")) {
        return;
    }

    $embed = new Embed();
    $embed->setColor(1252377); 
    $embed->setTitle("AntiCheat Alerts");
    $embed->addField("Player", $player);
    $embed->addField("Detection", $cheat);
    $embed->setFooter("UrityAC v1.0.0");

    $message = new Message();
    $message->addEmbed($embed);

    $webhook = new Webhook($config->get("webhook.url"));
    $webhook->send($message);
  }
}
