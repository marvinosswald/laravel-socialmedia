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
        $message = 'Test Message';
        $post = Socialmedia::post([
            'message' => $message
        ],['facebook']);
        // Create a client with a base URI
        $client = new GuzzleHttp\Client(['base_uri' => 'https://graph.facebook.com/v2.6/']);
        $res = json_decode($client->request('GET', $post['facebook']->id."?access_token=".env('FACEBOOK_ACCESS_TOKEN'))->getBody());

        $this->assertEquals($message,$res->message);
        Socialmedia::delete($res->id,["facebook"]);

    }
}