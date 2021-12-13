<?php

class database
{
    // These variables will help to connect with database
    private $hostname = "localhost";
    private $username = "test";
    private $password = "test";
    private $dbname = "RandomBandzDev";




    // This $link variable is a part of database class which will help to run all the query
    protected $link;

    public function __construct()
    {
        $this->connection();
    }

    public function connection()
    {

        // This function will help you connect with the database
        $this->link = mysqli_connect($this->hostname, $this->username, $this->password, $this->dbname); //connected with database

        if ($this->link) {
            // echo "connected";
        } else {
            echo "not connected";
        }

    }
}

$obj = new database; //database class object
