<?php

use \marvinosswald\Socialmedia\Facades\Socialmedia;

class FacebookTest extends Orchestra\Testbench\TestCase {
    protected function getPackageProviders($app)
    {
        return ['marvinosswald\Socialmedia\Providers\SocialmediaServiceProvider'];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Socialmedia' => 'marvinosswald\Socialmedia\Facades\Socialmedia'
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        if (file_exists (__DIR__."/../.env")){
            $dotenv = new Dotenv\Dotenv(__DIR__."/../");
            $dotenv->load();
        }
    }
    
    public function testFacebookPost()
    {
        $params = [
            'message' => 'Message in a bottle',
            'link' => 'http://google.com',
            'picture' => 'http://placehold.it/200/400',
            'name' => 'The one who must not be named',
            'caption' => 'What an caption',
            'description' => 'Description',
            'place' => '',
            'tags' => ['bottle'],
            'targeting' => ['locales' => 5]
        ];
        $post = Socialmedia::post($params,['facebook']);
        // Create a client with a base URI
        $client = new GuzzleHttp\Client(['base_uri' => 'https://graph.facebook.com/v2.6/']);
        $res = json_decode($client->request('GET', $post['facebook']->id."?access_token=".env('FACEBOOK_ACCESS_TOKEN'))->getBody());

        $this->assertEquals('Message in a #bottle',$res->message);
        Socialmedia::delete($res->id,["facebook"]);
    }
}