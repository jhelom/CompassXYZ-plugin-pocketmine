<?php
declare(strict_types=1);

namespace Jhelom\CompassXYZ\Services;


use Jhelom\CompassXYZ\Main;
use Jhelom\Core\StringFormat;
use pocketmine\Player;

class CompassService
{
    private $main;
    /** @var Player[] */
    private $players = [];

    private $directionTable = [];

    public function __construct(Main $main)
    {
        $this->main = $main;

        $this->directionTable = [
            [
                22.5,
                67.5,
                $this->main->getMessages()->northeast()
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

    public function addPlayer(Player $player): void
    {
        $key = $player->getLowerCaseName();
        $this->players[$key] = $player;
    }

    public function removePlayer(Player $player): void
    {
        $key = $player->getLowerCaseName();
        unset($this->players[$key]);
    }

    public function sendXYZ(): void
    {
        foreach ($this->players as $name => $player) {
            $x = $player->getFloorX();
            $y = $player->getFloorY();
            $z = $player->getFloorZ();
            $direction = $this->getDirection($player->getYaw());
            $s = StringFormat::format("{0}\nX:{1}, Y:{2}, Z:{3}", $direction, $x, $y, $z);
            //$player->sendTip($s);
            $player->sendPopup($s);
        }
    }

    public function getDirection(float $deg): string
    {
        $deg %= 360;

        foreach ($this->directionTable as $item) {
            if ($item[0] <= $deg && $deg < $item[1]) {
                return $item[2];
            }
        }

        return $this->main->getMessages()->west();
    }
}