<?php
class BlockList extends AppModel
{
    public $token = null;

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function store()
    {
        DB::conn()->insert("block_list", array('token' => $this->token));
    }

    public static function get($token)
    {
        return DB::conn()->row("SELECT * FROM block_list WHERE token = ?", array($token));
    }
}