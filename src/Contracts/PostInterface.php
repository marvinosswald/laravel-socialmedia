<?php
namespace marvinosswald\Socialmedia\Contracts;

/**
 * Class DriverInterface
 * @package Marvinosswald\Socialmedia\Contracts
 */
interface PostInterface
{
    /**
     * @return string POSTID
     */
    public function exec();
}