<?php

class DbManager
{

    //Database configuration
    //public $dbhost = '103.55.191.125';
    public $dbhost = 'localhost';
    public $dbport = '27017';
    public $dbid = 'root';
    public $dbpwd = 'hasy6604!!';
    public $conn;

    function __construct()
    {
        //Connecting to MongoDB
        try {
            //Establish database connection
            $this->conn = new MongoDB\Driver\Manager('mongodb://' . $this->dbid . ':' . $this->dbpwd . '@' . $this->dbhost . ':' . $this->dbport);
            //$this->conn = new MongoDB\Driver\Manager('mongodb://' .  $this->dbhost . ':' . $this->dbport);
        } catch (MongoDBDriverExceptionException $e) {
            echo $e->getMessage();
            echo nl2br("n");
        }
    }
    
    function getConnection()
    {
        return $this->conn;
    }
}
