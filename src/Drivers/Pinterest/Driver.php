<?php
namespace marvinosswald\Socialmedia\Drivers\Pinterest;

use Abraham\TwitterOAuth\TwitterOAuth;
use DirkGroenen\Pinterest\Pinterest;
use marvinosswald\Socialmedia\Contracts\DriverInterface;

/**
 * Class PinterestDriver
 * @package Marvinosswald\Socialmedia\Drivers\Pinterest
 */
class Driver implements DriverInterface
{
    /**
     * @var string
     */
    public $appId = '';
    /**
     * @var string
     */
    public $appSecret = '';
    /**
     * @var string
     */
    public $accessToken = '';
    /**
     * @var
     */
    public $pinterest;
    /**
     * @var string
     */
    public $defaultBoard = '';

    /**
     * Driver constructor.
     * @param bool $appId
     * @param bool $appSecret
     */
    public function __construct($appId = false, $appSecret = false, $accessToken = false, $defaultBoard = '')
    {
        $this->appId = $appId ?: env('PINTEREST_APP_ID');
        $this->appSecret = $appSecret ?: env('PINTEREST_APP_SECRET');
        $this->accessToken = $accessToken ?: env('PINTEREST_ACCESS_TOKEN');
        $this->defaultBoard = $defaultBoard ?: env('PINTEREST_DEFAULT_BOARD');

        $this->pinterest = new Pinterest($this->appId,$this->appSecret);
        $this->pinterest->auth->setOAuthToken($this->accessToken);
    }

    /**
     * @param $params
     * @return string
     */
    public function post($params)
    {
        $post = new Post($this->pinterest,$params);
        return $post->exec();
    }

    public function delete($id)
    {
        $post = Post::withId($this->pinterest,$id);
        return $post->delete();
    }
}