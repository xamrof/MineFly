<?php

namespace formax;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;



class Loader extends PluginBase implements Listener
{
    protected $player;
    protected $flight;

    protected function onEnable(): void
    {
        $this->getLogger()->info('Plugin has been enabled');
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onChatEvent(PlayerChatEvent $sender): void
    {
        $this->player = $sender->getPlayer();
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {

        switch ($command->getName()) {
            case 'example':
                $sender->sendMessage('Hello' . $sender->getName() . "!");
                return true;
            case 'fly':
                if (!$sender->hasPermission('fly.system')) {
                    return true;
                }
                if ($this->player->getAllowFlight()) {
                    $this->player->setAllowFlight(false);
                    $this->player->setFlying(false);
                } else {
                    $this->player->setAllowFlight(true);
                }
                return true;
                break;
        }
    }
}
