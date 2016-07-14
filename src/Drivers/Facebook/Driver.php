<?php
namespace marvinosswald\Socialmedia\Drivers\Facebook;
use Facebook\Facebook;
use Facebook\FacebookRequest;
use marvinosswald\Socialmedia\Contracts\DriverInterface;

/**
 * Class FacebookDriver
 * @package Marvinosswald\Socialmedia\Drivers
 */
class Driver implements DriverInterface
{
    /**
     * @var string
     */
    public $app_id;
    /**
     * @var string
     */
    public $app_secret;
    /**
     * @var string
     */
    public $default_graph_version = 'v2.6';
    /**
     * @var string
     */
    public $default_access_token;
    /**
     * @var Facebook
     */
    public $fb;

    /**
     * FacebookDriver constructor.
     * @param bool $app_id
     * @param bool $app_secret
     * @param string $default_graph_version
     * @param bool $default_access_token
     */
    public function __construct($app_id = false, $app_secret = false, $default_graph_version = 'v2.6', $default_access_token = false)
    {
        $this->app_id = $app_id ?: env('FACEBOOK_APP_ID');
        $this->app_secret = $app_secret ?: env('FACEBOOK_APP_SECRET');
        $this->default_graph_version = $default_graph_version;
        $this->default_access_token = $default_access_token ?: env('FACEBOOK_ACCESS_TOKEN');
        
        $this->fb = new Facebook(array_filter([
            'app_id' =>  $this->app_id,
            'app_secret' =>  $this->app_secret,
            'default_graph_version' =>  $this->default_graph_version,
            'default_access_token' => $this->default_access_token
        ]));
    }

    /**
     * @param $params
     * @return string
     */
    public function post($params)
    {
        $post = new Post($this->fb,$params);
        return $post->exec();
    }

    public function delete($id)
    {
        try{
            return $this->fb->delete('/'.$id);
        }catch (Exception $e){
            return $e->getMessage();
        }
    }
}