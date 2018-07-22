<?php
declare(strict_types=1);

namespace Jhelom\CompassXYZ\Commands;


use Jhelom\CompassXYZ\Libs\CommandArguments;
use Jhelom\CompassXYZ\Libs\PluginCommandEx;
use Jhelom\CompassXYZ\Main;
use pocketmine\command\CommandSender;
use pocketmine\Player;


/**
 * Class XYZCommand
 * @package Jhelom\CompassXYZ\Commands
 */
class XYZCommand extends PluginCommandEx
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
     * @return void
     */
    public function onInvoke(CommandSender $sender, CommandArguments $args): void
    {
        if ($sender instanceof Player) {
            $value = $args->getBool();
            $service = $this->main->getCompassService();

            if (is_null($value)) {
                $service->setOnOff($sender, !$service->getOnOff($sender));
                $service->togglePlayer($sender);
            } else if ($value === true) {
                $service->setOnOff($sender, true);
            } else if ($value === false) {
                $service->setOnOff($sender, false);
            }
        } else {
            $sender->sendMessage($this->main->getMessages()->commandExecuteInGame());
        }
    }
}