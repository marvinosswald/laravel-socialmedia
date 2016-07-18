<?php

use \marvinosswald\Socialmedia\Facades\Socialmedia;

class TwitterTest extends Orchestra\Testbench\TestCase {
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

    public function testTwitterPost()
    {
        $message = 'Test Message';
        $post = Socialmedia::post([
            'message' => $message
        ],['twitter']);
        Socialmedia::delete($post['twitter'],['twitter']);
    }
}