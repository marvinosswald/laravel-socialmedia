<?php
namespace marvinosswald\Socialmedia;
use marvinosswald\Socialmedia\Contracts\DriverInterface as Driver;
use marvinosswald\Socialmedia\Drivers\Facebook\Driver as FacebookDriver;

/**
 * Class Socialmedia
 * @package Marvinosswald\Socialmedia
 */
class Socialmedia
{
    /**
     * Detector Drivers available and its shortcuts.
     * @var array
     */
    protected $drivers = [
        'facebook' => 'marvinosswald\Socialmedia\Drivers\Facebook\Driver'
    ];

    /**
     * @var array
     */
    protected $availableDrivers = [];

    /**
     * Socialmedia constructor.
     */
    public function __construct()
    {
        foreach ($this->drivers as $short => $driver) {
            $this->availableDrivers[$short] = new $driver();
        }
    }

    public function post($params)
    {
        $res = [];
        foreach ($this->availableDrivers as $short => $driver){
            $res[$short] = $driver->post($params);
        }
        return $res;
    }
}