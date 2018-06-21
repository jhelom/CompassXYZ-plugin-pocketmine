<?php
declare(strict_types=1);

namespace Jhelom\CompassXYZ;


use Jhelom\Core\PluginMessages;

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
        return $this->_getMessage('north');
    }

    /**
     * @return string
     */
    public function northeast(): string
    {
        return $this->_getMessage('northeast');
    }

    /**
     * @return string
     */
    public function northwest(): string
    {
        return $this->_getMessage('northwest');
    }

    /**
     * @return string
     */
    public function east(): string
    {
        return $this->_getMessage('east');
    }

    /**
     * @return string
     */
    public function west(): string
    {
        return $this->_getMessage('west');
    }

    /**
     * @return string
     */
    public function south(): string
    {
        return $this->_getMessage('south');
    }

    /**
     * @return string
     */
    public function southwest(): string
    {
        return $this->_getMessage('southwest');
    }

    /**
     * @return string
     */
    public function southeast(): string
    {
        return $this->_getMessage('southeast');
    }

    /**
     * @return string
     */
    public function commandDescription(): string
    {
        return $this->_getMessage('command-description');

    }

    /**
     * @return string
     */
    public function commandUsage(): string
    {
        return $this->_getMessage('command-usage');
    }

    /**
     * @return string
     */
    public function commandExecuteInGame(): string
    {
        return $this->_getMessage('command-execute-in-game');
    }
}