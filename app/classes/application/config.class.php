<?php

namespace application;

class Config
{
    /**
     * @var array $config Config array
     */
    private $config = [];

    /**
     * Config constructor.
     * @param string $file The filename
     */
    public function __construct($file)
    {
        $config = include __DIR__ . '/../../config/' . $file;

        $this->config = $config;
    }

    /**
     * Magic Setter
     *
     * @param mixed $key The key to set
     * @param mixed $value The value to set
     */
    public function __set($key, $value)
    {
        $this->config[$key] = $value;
    }

    /**
     * Magic Getter
     *
     * @param mixed $key The key to get
     * @return mixed
     */
    public function __get($key)
    {
        if(isset($this->config[$key])) {
            return $this->config[$key];
        } else {
            return null;
        }
    }

    /**
     * Magic isset
     *
     * @param mixed $key The key to check
     * @return bool True if set
     */
    public function __isset($key)
    {
        return isset($this->config[$key]);
    }

    /**
     * Magic unset
     *
     * @param mixed $key The Key to unset
     */
    public function __unset($key)
    {
        unset($this->config[$key]);
    }
}