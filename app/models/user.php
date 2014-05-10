<?php
class User extends AppModel
{
    private $email = null;

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getToken()
    {
        return md5($this->email);
    }

    public function hasEmail()
    {
        return !!$this->email;
    }

    public function create()
    {
        DB::conn()->query("INSERT IGNORE INTO user (email) VALUES (?)", array($this->email));
    }
}