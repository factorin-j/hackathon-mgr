<?php

class InquiryReport
{
    public static function doLog($id, $reply)
    {
        $con = DB::conn();
        $con->insert('inquiry_report', array(
            'inquiry_id' => $id,
            'reply' => $reply,
            'created' => date('Y-m-d H:i:s')
        ));
    }
}
