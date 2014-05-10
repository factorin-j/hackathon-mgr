<?php

class Feed extends AppModel
{
    const SCORE_POSITIVE = 'positive';
    const SCORE_NEGATIVE = 'negative';
    const TYPE_USER = 'user';
    const TYPE_SYSTEM = 'system';

    public $id = null;
    public $message = null;
    public $picture = null;
    public $location = null;
    public $token = null;
    public $type = null;
    public $score = null;
    public $created = null;

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    public function setLocation($location)
    {
        $this->location = $location;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setScore($score)
    {
        $this->score = $score;
    }

    public function setCreated($created)
    {
        $this->created = $created;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public static function get($feed_id)
    {
        $db = DB::conn();
        $feed = $db->row('SELECT * FROM feed WHERE  id = ?', array($feed_id));
        return new self($feed);
    }

    public static function getAll()
    {
        $db = DB::conn();
        $feed_list = array();
        $feeds = $db->rows('SELECT *, feed.token FROM feed LEFT JOIN block_list ON block_list.token = feed.token WHERE block_list.token IS NULL ORDER BY created DESC');
        if ($feeds) {
            foreach ($feeds as $feed) {
                $feed_list[] = new self($feed);
            }
        }
        return $feed_list;
    }

    public static function getAllByRank()
    {
        $db = DB::conn();
        $feed_list = array();
        $feeds = $db->rows('SELECT *, feed.token, (score/POWER(((NOW()-created)/60)/60,1.8)) AS rank FROM feed LEFT JOIN block_list ON block_list.token = feed.token WHERE block_list.token IS NULL ORDER BY rank DESC');
        if ($feeds) {
            foreach ($feeds as $feed) {
                $feed_list[] = new self($feed);
            }
        }
        return $feed_list;
    }

    public static function voteByFeedId($feed_id, $vote_type, $token)
    {
        $db = DB::conn();
        $db->begin();

        try {
            $feed = self::get($feed_id);
            if (!$feed) {
                throw new Exception('Cannot find your specified news feed');
            }

            $vote_status = VoteStatus::get($feed->id, $token);
            if ($vote_status) {
                throw new Exception('User already voted on feed');
            }

            switch ($vote_type) {
                case self::SCORE_POSITIVE:
                    $score = $feed->score + 1;
                    break;
                case self::SCORE_NEGATIVE:
                    $score = $feed->score - 1;
                    break;
                default:
                    throw new Exception('Score type not set');
            }

            $db->update('feed', array('score' => $score), array('id' => $feed_id));

            $vote_status = new VoteStatus();
            $vote_status->setFeedId($feed_id);
            $vote_status->setToken($token);
            $vote_status->create();

            $db->commit();
        } catch (Exception $e) {
            $db->rollback();
            throw $e;
        }

        return $score;
    }

    public function post()
    {
        $db = DB::conn();
        $feed = array(
            'message' => $this->message,
            'picture' => $this->picture,
            'location' => $this->location,
            'token' => $this->token,
            'type' => self::TYPE_SYSTEM,
        );

        $db->insert('feed', $feed);
        return $feed;
    }
}