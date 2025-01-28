<?php

require_once __DIR__.'/../../DatabaseConnector.php';

class Repository
{
    protected DatabaseConnector $database;

    public function __construct()
    {
        // TODO DatabaseConnector should be singleton
        $this->database = new DatabaseConnector();
    }
}