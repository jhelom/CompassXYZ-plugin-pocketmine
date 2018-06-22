<?php
declare(strict_types=1);

namespace Jhelom\CompassXYZ;


use Jhelom\CompassXYZ\Libs\PluginMessages;

/**
 * Class Messages
 * @package Jhelom\CompassXYZ
 */
class Messages extends PluginMessages
{
    /**
     * @return string
     */
    public function north(): string
    {
        return $this->_get('north');
    }

    /**
     * @return string
     */
    public function northeast(): string
    {
        return $this->_get('northeast');
    }

    /**
     * @return string
     */
    public function northwest(): string
    {
        return $this->_get('northwest');
    }

    /**
     * @return string
     */
    public function east(): string
    {
        return $this->_get('east');
    }

    /**
     * @return string
     */
    public function west(): string
    {
        return $this->_get('west');
    }

    /**
     * @return string
     */
    public function south(): string
    {
        return $this->_get('south');
    }

    /**
     * @return string
     */
    public function southwest(): string
    {
        return $this->_get('southwest');
    }

    /**
     * @return string
     */
    public function southeast(): string
    {
        return $this->_get('southeast');
    }

    /**
     * @return string
     */
    public function commandDescription(): string
    {
        return $this->_get('command-description');

    }

    /**
     * @return string
     */
    public function commandUsage(): string
    {
        return $this->_get('command-usage');
    }

    /**
     * @return string
     */
    public function commandExecuteInGame(): string
    {
        return $this->_get('command-execute-in-game');
    }
}