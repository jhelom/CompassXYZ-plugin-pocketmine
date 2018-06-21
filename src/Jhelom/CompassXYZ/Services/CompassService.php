<?php
declare(strict_types=1);

namespace Jhelom\CompassXYZ\Services;


use Jhelom\CompassXYZ\Main;
use Jhelom\Core\StringFormat;
use pocketmine\math\Vector3;
use pocketmine\Player;

/**
 * Class CompassService
 * @package Jhelom\CompassXYZ\Services
 */
class CompassService
{
    /** @var Main */
    private $main;

    /** @var Player[] */
    private $players = [];
    private $cache = [];

    private $directionTable = [];

    /**
     * CompassService constructor.
     * @param Main $main
     */
    public function __construct(Main $main)
    {
        $this->main = $main;

        $this->directionTable = [
            [
                22.5,
                67.5,
                $this->main->getMessages()->northwest()
            ],
            [
                67.5,
                112.5,
                $this->main->getMessages()->north()
            ],
            [
                112.5,
                157.5,
                $this->main->getMessages()->northeast()
            ],
            [
                157.5,
                202.5,
                $this->main->getMessages()->east()
            ],
            [
                202.5,
                247.5,
                $this->main->getMessages()->southeast()
            ],
            [
                247.5,
                292.5,
                $this->main->getMessages()->south()
            ],
            [
                292.5,
                337,
                $this->main->getMessages()->southwest()
            ]
        ];
    }

    /**
     * @param Player $player
     */
    public function togglePlayer(Player $player): void
    {
        $key = $player->getLowerCaseName();

        if (array_key_exists($key, $this->players)) {
            $this->removePlayer($player);
        } else {
            $this->addPlayer($player);
        }
    }

    /**
     * @param Player $player
     */
    public function removePlayer(Player $player): void
    {
        $key = $player->getLowerCaseName();
        unset($this->players[$key]);
        unset($this->cache[$key]);
    }

    /**
     * @param Player $player
     */
    public function addPlayer(Player $player): void
    {
        $key = $player->getLowerCaseName();
        $this->players[$key] = $player;
    }

    private const LOCATION_FORMAT = "{0}\nX:{1} Y:{2} Z:{3}";

    public function sendToPlayerAll(): void
    {
        foreach ($this->players as $name => $player) {
            $s = StringFormat::format(self::LOCATION_FORMAT,
                $this->getDirection($player->getYaw()),
                $player->getFloorX(),
                $player->getFloorY(),
                $player->getFloorZ());

            $key = $player->getLowerCaseName();
            $this->cache[$key] = $s;

            $player->sendPopup($s);
        }
    }

    /**
     * @param Player $player
     * @param Vector3 $location
     */
    public function sendToPlayer(Player $player, Vector3 $location): void
    {
        $key = $player->getLowerCaseName();

        if (!array_key_exists($key, $this->players)) {
            return;
        }

        $s = StringFormat::format(self::LOCATION_FORMAT,
            $this->getDirection($player->getYaw()),
            $location->getFloorX(),
            $location->getFloorY(),
            $location->getFloorZ());

        if (array_key_exists($key, $this->cache)) {
            if ($this->cache[$key] === $s) {
                return;
            }
        }

        $this->cache[$key] = $s;
        $player->sendPopup($s);
    }

    /**
     * @param float $degrees
     * @return string
     */
    public function getDirection(float $degrees): string
    {
        $degrees %= 360;

        foreach ($this->directionTable as $item) {
            if ($item[0] <= $degrees && $degrees < $item[1]) {
                return $item[2];
            }
        }

        return $this->main->getMessages()->west();
    }
}