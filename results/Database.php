<?php


class Database{

    public $connection;

    public function connect_db(){

        $this->connection = mysqli_connect('localhost', 'root', '', 'agriculture_db');

        if(mysqli_connect_error()){
            die("Database Connection Failed" . mysqli_connect_error() . mysqli_connect_errno());
        }

    }

    public function input_field($var){

        $return = mysqli_real_escape_string($this->connection, $var);
        return $return;

    }

}

$database = new Database();
$database->connect_db();