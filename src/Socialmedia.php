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
        'facebook' => 'marvinosswald\Socialmedia\Drivers\Facebook\Driver',
        'twitter' => 'marvinosswald\Socialmedia\Drivers\Twitter\Driver',
        'pinterest' => 'marvinosswald\Socialmedia\Drivers\Pinterest\Driver'
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

    /**
     * @param $params
     * @param array $drivers
     * @return array
     */
    public function post($params,$drivers=[])
    {
        return $this->execWithDrivers($drivers,'post',$params);
    }

    /**
     * @param $id
     * @param array $drivers
     * @return array
     */
    public function delete($id,$drivers=[])
    {
        return $this->execWithDrivers($drivers,'delete',$id);
    }

    /**
     * @param array $drivers
     * @param $method
     * @param $params
     * @return array
     */
    private function execWithDrivers($drivers=[],$method,$params)
    {
        $res = [];
        if (empty($drivers)){
            foreach ($this->availableDrivers as $short => $driver){
                $res[$short] = $driver->{$method}($params);
            }
        }else{
            foreach ($drivers as $short){
                $res[$short] = $this->availableDrivers[$short]->{$method}($params);
            }
        }
        return $res;
    }
}