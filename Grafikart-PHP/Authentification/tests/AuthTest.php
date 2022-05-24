<?php

use PHPUnit\Framework\TestCase;
use App\Auth;

class AuthTest extends TestCase {
    
    public function testLoginWithBadUsername() 
    {
        $pdo = new PDO("sqlite::memory", null, null, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
        $pdo->query('CREATE TABLE users (username TEXT, password TEXT )');
        for ($i=1; $i < 10; $i++) {
            $password = password_hash("user$i", PASSWORD_BCRYPT);
            $pdo->query("INSERT INTO users (username, password) VALUES ('user$i', 'user$i')");
        }
        $auth = new App\Auth($pdo, "/login");
        $this->assertNull($auth->login('aze', 'aze'));
    }

}