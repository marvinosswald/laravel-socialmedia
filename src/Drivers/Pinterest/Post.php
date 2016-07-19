<?php
namespace marvinosswald\Socialmedia\Drivers\Pinterest;

use Abraham\TwitterOAuth\TwitterOAuth;
use DirkGroenen\Pinterest\Pinterest;
use marvinosswald\Socialmedia\Contracts\PostInterface;

/**
 * Class Post
 * @package Marvinosswald\Socialmedia\Drivers\Pinterest
 */
class Post implements PostInterface{
    /**
     * @var string|int
     */
    public $id;
    /**
     * The main body of the post, otherwise called the status message. Either link, place, or message must be supplied.
     *
     * @var string
     */
    public $message = '';

    /**
     * The URL of a link to attach to the post. Either link, place, or message must be supplied. Additional fields associated with link are shown below.
     *
     * @var string
     */
    public $link = '';
    /**
     * Determines the preview image associated with the link.
     *
     * @var string
     */
    public $picture = '';
    /**
     * Board reference like <username>/<boardname>
     *
     * @var string
     */
    public $board = '';
    /**
     * @var Pinterest
     */
    protected $pinterest;

    /**
     * Post constructor.
     * @param $pinterest
     * @param array $params
     */
    public function __construct($pinterest,array $params=[])
    {
        $this->pinterest = $pinterest;
        if (!empty($params)){
            foreach ($params as $key => $value){
                if (gettype($value) == gettype($this->{$key})){
                    $this->{$key} = $value;
                }
            }
        }
    }

    /**
     * @param $driver
     * @param $id
     * @param array $params
     * @return Post
     */
    public static function withId($driver,$id,array $params=[])
    {
        $i = new self($driver,$params);
        $i->id = $id;
        return $i;
    }
    /**
     * @return string
     */
    public function exec()
    {
        try{
            return $this->pinterest->pins->create($this->toArray());
        }catch (Exception $e){
            return $e->getMessage();
        }

    }

    /**
     * @return array|object|string
     */
    public function delete()
    {
        if($this->id){
            try{
                $post = $this->pinterest->pins->delete($this->id);
                return $post;
            }catch (Exception $e){
                return $e->getMessage();
            }
        }else{
            return "Post id not set";
        }
    }
    public function toArray()
    {
        return array_filter([
            'note' => $this->message,
            'link' => $this->link,
            base64_decode($this->picture,true) ? 'image_base64': 'image_url' => $this->picture,
            'board' => $this->board ?: $this->pinterest->defaultBoard
        ]);
    }
}