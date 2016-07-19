<?php

use \marvinosswald\Socialmedia\Facades\Socialmedia;

class PinterestTest extends Orchestra\Testbench\TestCase {
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

    public function testPinterestPost()
    {
        $params = [
            'message' => 'Test Pin',
            'link' => 'http://google.com',
            'picture' => 'http://placehold.it/300/400',
            'board' => 'marivnosswald/reiseziele'
        ];
        $post = Socialmedia::post($params,['pinterest']);
        Socialmedia::delete($post['pinterest']->id,['pinterest']);
    }
}