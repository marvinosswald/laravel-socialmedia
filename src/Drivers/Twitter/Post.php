<?php
namespace marvinosswald\Socialmedia\Drivers\Twitter;

use Abraham\TwitterOAuth\TwitterOAuth;
use marvinosswald\Socialmedia\Contracts\PostInterface;

/**
 * Class Post
 * @package Marvinosswald\Socialmedia\Drivers\Twitter
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
     * Overwrites the title of the link preview.
     *
     * @var string
     */
    public $name = '';
    /**
     * Overwrites the caption under the title in the link preview.
     *
     * @var string
     */
    public $caption = '';
    /**
     * Overwrites the description in the link preview
     *
     * @var string
     */
    public $description = '';

    /**
     * Page ID of a location associated with this post. Either link, place, or message must be supplied.
     *
     * @var string
     */
    public $place = '';

    /**
     * Comma-separated list of user IDs of people tagged in this post. You cannot specify this field without also specifying a place.
     *
     * @var array
     */
    public $tags = [];

    /**
     * Determines the privacy settings of the post. If not supplied, this defaults to the privacy level granted to the app in the Login Dialog. This field cannot be used to set a more open privacy setting than the one granted.
     *
     * @var array
     */
    public $privacy = [
        'value' => '', /**enum{'EVERYONE', 'ALL_FRIENDS', 'FRIENDS_OF_FRIENDS', 'CUSTOM', 'SELF'}**/
        'allow' => '',
        'deny' => ''
    ];
    /**
     * @var array
     */
    public $targeting = [
        'countries' => false,
        'locales' => false,
        'regions' => false,
        'cities' => false
    ];
    /**
     * @var TwitterOAuth
     */
    protected $twitter;

    /**
     * Post constructor.
     * @param $twitter
     * @param array $params
     * @param bool $id
     */
    public function __construct($twitter,array $params=[])
    {
        $this->twitter = $twitter;
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
            return $this->twitter->post('statuses/update',$this->toArray())->id;
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
                $post = $this->twitter->post('statuses/destroy/'.$this->id);
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
            'status' => $this->message,
            'link' => $this->link,
            'picture' => $this->picture,
            'name' => $this->name,
            'caption' => $this->caption,
            'description' => $this->description,
            'place' => $this->place,
            'tags' => $this->tags,
            'privacy' => array_filter($this->privacy),
            'targeting' => array_filter($this->targeting)
        ]);
    }
}