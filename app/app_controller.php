<?php
class AppController extends Controller
{
    public $default_view_class = 'AppLayoutView';
    public function dispatchAction()
    {
        try {
            parent::dispatchAction();
        } catch (Exception $e) {
            $this->set('exception', $e);
            $this->render('error/display');
        }
    }
}
