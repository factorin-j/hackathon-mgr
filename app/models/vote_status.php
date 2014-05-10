<?php
class VoteStatus extends AppModel
{
    public $feed_id = null;
    public $token = null;

    public function setFeedId($feed_id)
    {
        $this->feed_id = $feed_id;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public static function get($feed_id, $token)
    {
        return DB::conn()->row("SELECT * FROM vote_status WHERE feed_id = ? AND token = ?", array($feed_id, $token));
    }

    public function create()
    {
        DB::conn()->insert('vote_status', array('feed_id' => $this->feed_id, 'token' => $this->token));
    }
}