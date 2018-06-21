<?php
declare(strict_types=1);

namespace Jhelom\CompassXYZ\Commands;


use Jhelom\CompassXYZ\Main;
use Jhelom\Core\CommandArguments;
use Jhelom\Core\CommandInvoker;
use pocketmine\command\CommandSender;
use pocketmine\Player;


/**
 * Class XYZCommand
 * @package Jhelom\CompassXYZ\Commands
 */
class XYZCommand extends CommandInvoker
{
    private const COMMAND_NAME = 'xyz';

    /** @var Main */
    private $main;

    /**
     * XYZCommand constructor.
     * @param Main $main
     */
    public function __construct(Main $main)
    {
        parent::__construct(self::COMMAND_NAME, $main);
        $this->main = $main;
        $this->setUsage($this->main->getMessages()->commandUsage());
        $this->setDescription($this->main->getMessages()->commandDescription());
        $this->setPermission('jhelom.command.xyz');
    }

    /**
     * @param CommandSender $sender
     * @param CommandArguments $args
     * @return bool
     */
    protected function onInvoke(CommandSender $sender, CommandArguments $args): bool
    {
        if ($sender instanceof Player) {
            $value = $args->getBool();
            $service = $this->main->getCompassService();

            if (is_null($value)) {
                $service->togglePlayer($sender);
            } else if ($value === true) {
                $service->addPlayer($sender);
            } else if ($value === false) {
                $service->removePlayer($sender);
            }
        } else {
            $sender->sendMessage($this->main->getMessages()->commandExecuteInGame());
        }

        return true;
    }
}