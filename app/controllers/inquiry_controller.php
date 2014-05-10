<?php

class InquiryController extends AppController
{
    public function index()
    {
        $id = Param::get('id');
        $list = Inquiry::getListAll();

        $inquiry = null;
        if ($id) {
            $inquiry = Inquiry::get($id);
        }

        $this->set(get_defined_vars());
    }

    public function reply()
    {
        $id = Param::get('id');
        $reply = Param::get('reply');
        if (!$id) {
            throw new AppException('Please specify an id');
        }

        $con = DB::conn();
        $con->begin();
        try {
            $inquiry = Inquiry::get($id);
            Mail::send($inquiry->email, $inquiry->id, $reply);
            InquiryReport::doLog($inquiry->id, $reply);
            Inquiry::resolve($inquiry->id);
        } catch (Exception $e) {
            $con->rollback();
            throw $e;
        }
    }
}
