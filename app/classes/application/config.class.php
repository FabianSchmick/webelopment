<?php

namespace application;

class Config
{
    /*
     * Array with config
     */
    private $config;

    // Constructor
    public function __construct($file)
    {
        $config = include __DIR__ . '/../../config/' . $file;

        $this->config = $config;
    }

    public function __set($key, $value)
    {
        $this->config[$key] = $value;
    }

    public function __get($key)
    {
        if(isset($this->config[$key])) {
            return $this->config[$key];
        } else {
            return null;
        }
    }

    public function __isset($key)
    {
        return isset($this->config[$key]);
    }

    public function __unset($key)
    {
        unset($this->config[$key]);
    }
}