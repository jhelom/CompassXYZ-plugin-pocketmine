<?php
declare(strict_types=1);

namespace Jhelom\CompassXYZ;


use Jhelom\CompassXYZ\Commands\XYZCommand;
use Jhelom\CompassXYZ\Services\CompassService;
use Jhelom\Core\CommandInvoker;
use Jhelom\Core\ISupportedLanguage;
use Jhelom\Core\PluginBaseEx;
use Jhelom\Core\StringFormat;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemHeldEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\item\Item;


/**
 * Class Main
 * @package Jhelom\CompassXYZ
 */
class Main extends PluginBaseEx implements Listener
{
    const INTERVAL_MIN = 1;
    const INTERVAL_MAX = 1200;
    const INTERVAL_DEFAULT = 10;

    private const PLUGIN_UPDATE_URL = 'https://github.com/jhelom/CompassXYZ-plugin-pocketmine/releases';

    /** @var Messages */
    private $messages;

    /** @var CompassService */
    private $compassService;
    private $task;

    public function onEnable()
    {
        parent::onEnable();

        $this->saveDefaultConfig();
        $this->reloadConfig();


        $this->messages = new Messages($this, $this->getAvailableMessageFilePath());
        $this->compassService = new CompassService($this);

        $this->task = new TimerTask($this);

        // TODO: scheduler
        $interval = $this->getInterval();

        if (method_exists($this, 'getScheduler')) {
            $this->getScheduler()->scheduleDelayedRepeatingTask($this->task, $interval, $interval);
        } else {
            $this->getLogger()->debug('Scheduler = Server');
            /** @noinspection PhpUndefinedMethodInspection */
            $this->getServer()->getScheduler()->scheduleDelayedRepeatingTask($this->task, $interval, $interval);
        }

        // register
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    private function getInterval(): int
    {
        $interval = $this->getConfig()->get('interval');

        if (is_null($interval)) {
            return self::INTERVAL_DEFAULT;
        }

        if (!is_numeric($interval)) {
            return self::INTERVAL_DEFAULT;
        }

        return max(self::INTERVAL_MIN, min(self::INTERVAL_MAX, intval($interval)));
    }

    /**
     * @return Messages
     */
    public function getMessages(): Messages
    {
        return $this->messages;
    }

    public function onPlayerItemHeldEvent(PlayerItemHeldEvent $event)
    {
        $item = $event->getItem();
        $itemId = $item->getId();

        $this->getLogger()->debug(StringFormat::format('item={0}, id={1}, damage={2}, ', $item->getName(), $item->getId(), $item->getDamage()));

        $player = $event->getPlayer();

        if ($itemId === Item::COMPASS) {
            $this->getCompassService()->addPlayer($player);
        } else {
            $this->getCompassService()->removePlayer($player);
        }

    }

    public function getCompassService(): CompassService
    {
        return $this->compassService;
    }

    public function onPlayerQuit(PlayerQuitEvent $event)
    {
        $this->getCompassService()->removePlayer($event->getPlayer());
    }

    /**
     * @return CommandInvoker[]
     */
    protected function setupCommands(): array
    {
        return [
            new XYZCommand($this)
        ];
    }

    /**
     * @return string[]
     */
    protected function getSupportedLanguages(): array
    {
        return [
            ISupportedLanguage::ENGLISH,
            ISupportedLanguage::JAPANESE
        ];
    }

    /**
     * @return string|null
     */
    protected function getPluginUpdateUrl(): ?string
    {
        return self::PLUGIN_UPDATE_URL;
    }
}

