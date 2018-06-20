<?php
declare(strict_types=1);

namespace Jhelom\CompassXYZ\Commands;


use Jhelom\Core\CommandArguments;
use Jhelom\Core\CommandInvoker;
use pocketmine\command\CommandSender;
use pocketmine\plugin\Plugin;

class XYZCommand extends CommandInvoker
{
    private const COMMAND_NAME = 'xyz';

    public function __construct(Plugin $plugin)
    {
        parent::__construct(self::COMMAND_NAME, $plugin);
    }

    /**
     * @param CommandSender $sender
     * @param CommandArguments $args
     * @return bool
     */
    protected function onInvoke(CommandSender $sender, CommandArguments $args): bool
    {
        // TODO: Implement onInvoke() method.
        return true;
    }
}