<?php

namespace Jhelom\CompassXYZ;


use Jhelom\Core\PluginMessages;

class Messages extends PluginMessages
{
    public function north(): string
    {
        return $this->_getMessage('north');
    }

    public function northeast(): string
    {
        return $this->_getMessage('northeast');
    }

    public function northwest(): string
    {
        return $this->_getMessage('northwest');
    }

    public function east(): string
    {
        return $this->_getMessage('east');
    }

    public function west(): string
    {
        return $this->_getMessage('west');
    }

    public function south(): string
    {
        return $this->_getMessage('south');
    }

    public function southwest(): string
    {
        return $this->_getMessage('southwest');
    }

    public function southeast(): string
    {
        return $this->_getMessage('southeast');
    }
}