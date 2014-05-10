<?php
class GoogleUserInfo
{
    const GOOGLE_AUTH_URL = 'https://accounts.google.com/o/oauth2/auth';
    const GOOGLE_TOKEN_URL = 'https://accounts.google.com/o/oauth2/token';
    const GOOGLE_USERINFO_URL = 'https://www.googleapis.com/oauth2/v1/userinfo?access_token=';
    const GOOGLE_SCOPE_URL = 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile';

    public function getRequestCodeURL()
    {
        $params = array(
            "application_name" => APP_NAME,
            "response_type"    => "code",
            "client_id"        => GOOGLE_CLIENT_ID,
            "redirect_uri"     => GOOGLE_REDIRECT_URI,
            "scope"            => self::GOOGLE_SCOPE_URL,
            "access_type"      => "offline",
            "approval_prompt"  => "force",
            "hd"               => GOOGLE_ACCEPT_DOMAIN,
        );
        return self::GOOGLE_AUTH_URL . "?" . http_build_query($params);
    }

    public function getToken($code)
    {
        $params = array(
            "code"          => $code,
            "client_id"     => GOOGLE_CLIENT_ID,
            "client_secret" => GOOGLE_CLIENT_SECRET,
            "redirect_uri"  => GOOGLE_REDIRECT_URI,
            "grant_type"    => "authorization_code"
        );

        $curl = curl_init(self::GOOGLE_TOKEN_URL);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
        $response = json_decode($response);
        curl_close($curl);

        return $response->access_token;
    }

    public function getUserInfo($token)
    {
        $url = self::GOOGLE_USERINFO_URL . $token;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPGET, true);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
        $response = json_decode($response);
        curl_close($curl);

        return $response;
    }
}