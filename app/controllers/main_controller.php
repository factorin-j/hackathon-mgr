<?php
class MainController extends AppController
{
    public function index()
    {
        if (isset($_SESSION['user'])) {
            redirect(url('main/home'));
        }

        $this->set(get_defined_vars());
    }

    public function home()
    {
        if (!isset($_SESSION['user'])) {
            redirect(url('main/index'));
        }

        if (Param::get('rank')) {
            $is_rank = true;
            $feeds = Feed::getAllByRank();
        } else {
            $is_rank = false;
            $feeds = Feed::getAll();
        }

        $this->set(get_defined_vars());
    }

    public function logout()
    {
        unset($_SESSION['user']);
        redirect(url('main/index'));
    }

    public function oauth()
    {
        $google = new GoogleUserInfo();
        $code = Param::get('code');
        $token = Param::get('token');

        if ($code) {
            $token = $google->getToken($code);
            redirect(url('main/oauth', array('token' => $token)));
        } elseif ($token) {
            $userinfo = $google->getUserInfo($token);
            $user = new User();
            $user->setEmail($userinfo->email);
            $user->create();
            $_SESSION['user'] = $user;
            redirect(url('main/home'));
        } else {
            $request_code_url = $google->getRequestCodeURL();
            redirect($request_code_url);
        }
    }
}