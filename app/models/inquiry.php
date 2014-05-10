<?php

class Inquiry extends AppModel
{
    public $email;
    public $phone;
    public $message;
    public $is_solved;
    public $created;
    public $updated;

    public static function get($id)
    {
        $con = DB::conn();
        $inquiry = $con->row('SELECT * FROM inquiry WHERE id = ?', array($id));
        return (!$inquiry) ? null : $inquiry;
    }

    public static function getListAll()
    {
        $con = DB::conn();
        $list = $con->rows('SELECT * FROM inquiry ORDER BY created DESC');
        return (!$list) ? null : $list;
    }

    public static function resolve($id)
    {
        $con = DB::conn();
        $con->update('inquiry', array('is_solved' => 1, 'updated' => date('Y-m-d H:i:s')), array('id' => $id));
    }
}
