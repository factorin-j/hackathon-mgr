<?php
class FeedController extends AppController
{
    public function post()
    {
        $message = Param::get("message");
        $location = Param::get("location");
        $token = $_SESSION['user']->getToken();
        $picture = Picture::get('picture');

        if (Param::get('post')) {
            $picture_path = Picture::getUploadPath($picture);
            if ($picture_path) {
                Picture::upload($picture, $picture_path);
            }

            $feed = new Feed();
            $feed->setMessage($message);
            $feed->setLocation($location);
            $feed->setToken($token);
            $feed->setPicture($picture_path);
            $feed->post();
        }

        $this->set(get_defined_vars());
    }

    public function vote()
    {
        $feed_id = Param::get("feed_id");
        $feed = Feed::get($feed_id);
        $user = $_SESSION['user'];

        if ($feed) {
            $vote_type = Param::get("type");
            $is_success = true;
            try {
                switch ($vote_type) {
                    case Feed::SCORE_POSITIVE:
                        Feed::voteByFeedId($feed->id, Feed::SCORE_POSITIVE, $user->getToken());
                        break;
                    case Feed::SCORE_NEGATIVE:
                        Feed::voteByFeedId($feed->id, Feed::SCORE_NEGATIVE, $user->getToken());
                        break;
                    default:
                        $is_success = false;
                }
            } catch (Exception $e) {
                $is_success = false;
            }
        }

        die(json_encode(array('is_success' => $is_success)));
    }

    public function block()
    {
        $feed_id = Param::get("feed_id");
        $feed = Feed::get($feed_id);
        $is_success = false;
        if ($feed && !BlockList::get($feed->token)) {
            $block_list = new BlockList();
            $block_list->setToken($feed->token);
            $block_list->store();
            $is_success = true;
        }

        die(json_encode(array('is_success' => $is_success)));
    }
}