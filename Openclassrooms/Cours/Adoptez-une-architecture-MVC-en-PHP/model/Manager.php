<?php

class Manager
{
    protected function dbConnect()
    {
        $db = new PDO('mysql:host=127.0.0.1;dbname=blog;charset=utf8', 'user', 'password');
        return $db;
    }
}