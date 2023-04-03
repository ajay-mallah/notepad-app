<?php 

namespace App\Classes;

use Dotenv\Repository\Adapter\EnvConstAdapter;
use Dotenv\Repository\Adapter\PutenvAdapter;
use Dotenv\Repository\RepositoryBuilder;
use Dotenv\Dotenv;

/**
 * Fetches Environment variables.
 */
Class EnvHandler {

    protected $server;
    protected $username;
    protected $database;
    protected $password;
    protected $apiKey;


    protected function loadEnv() {
        $repository = RepositoryBuilder::createWithNoAdapters()
            ->addAdapter( EnvConstAdapter::class)
            ->addWriter( PutenvAdapter::class)
            ->immutable()
            ->make();
        $dotenv = Dotenv::create( $repository, __DIR__ );
        $dotenv->load();

        // Grabbing data from environment variable.
        $this->server = $_ENV['DB_SERVER'];
        $this->username = $_ENV['DB_USERNAME'];
        $this->database = $_ENV['DB_DATABASE'];
        $this->password = $_ENV['DB_PASSWORD'];
    }
}