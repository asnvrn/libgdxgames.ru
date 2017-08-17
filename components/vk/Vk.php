<?php

namespace app\components\vk;

class Vk
{

    private $config = [
        'VK_APP_SECRET'         => 'GR5mN5LaOqYIw6UgmxTT',
        'VK_APP_ID'             => '5929489',
        'DISPLAY'               => 'page',
        'REDIRECT_URI'          => 'https://libgdxgames.ru/login',
        'SCOPE'                 => array('notify'),
        'RESPONSE_TYPE'         => 'code',
        'VK_API_VERSION'        => '5.63',
        'VK_URI_AUTH'           => 'https://oauth.vk.com/authorize?client_id={CLIENT_ID}&display={DISPLAY}&redirect_uri={REDIRECT_URI}&scope={SCOPE}&response_type={RESPONSE_TYPE}&v={VK_API_VERSION}',
        'VK_URI_ACCESS_TOKEN'   => 'https://oauth.vk.com/access_token?client_id={CLIENT_ID}&client_secret={APP_SECRET}&redirect_uri={REDIRECT_URI}&code={CODE}',
        'VK_URI_METHOD'         => 'https://api.vk.com/method/{METHOD_NAME}?{PARAMETERS}&access_token={ACCESS_TOKEN}&v={VK_API_VERSION}'
    ];

    private static $_instance = null;
    private $access_token;
    public $id_vk;
    public $first_name;
    public $last_name;
    public $photo_50;
    public $photo_400;


    /**
     * @return Vk|null
     */
    static public function instance() {
        if(is_null(self::$_instance))
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * @return string
     *
     * Генерирует ссылку для перехода к авторизации
     */
    public function get_link_login()
    {
        $array = array(
            '{CLIENT_ID}'       => $this->config['VK_APP_ID'],
            '{DISPLAY}'         => $this->config['DISPLAY'],
            '{REDIRECT_URI}'    => $this->config['REDIRECT_URI'],
            '{SCOPE}'           => implode(',',$this->config['SCOPE']),
            '{RESPONSE_TYPE}'   => $this->config['RESPONSE_TYPE'],
            '{VK_API_VERSION}'  => $this->config['VK_API_VERSION']
        );
        return strtr($this->config['VK_URI_AUTH'], $array);
    }


    // Получение ACCESS TOKEN для дальнейших выполнения запросов к API
    private function get_access_token()
    {
        if(!isset($_GET['code'])){
            $code = 0;
        } else {
            $code = $_GET['code'];
        }

        $array = array(
            '{CLIENT_ID}' => $this->config['VK_APP_ID'],
            '{APP_SECRET}' => $this->config['VK_APP_SECRET'],
            '{REDIRECT_URI}' => $this->config['REDIRECT_URI'],
            '{CODE}' => $code
        );

        $url = strtr($this->config['VK_URI_ACCESS_TOKEN'],$array);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $json = curl_exec($ch);

        curl_close($ch);

        $result = json_decode($json);

        if(isset($result->error))
        {
            return FALSE;
        }else{
            $this->access_token = $result->access_token;
            $this->id_vk = $result->user_id;
            return TRUE;
        }
    }

    // Проверка авторизован или нет
    public function logged_in()
    {
        return $this->get_user();
    }

    // Есть ли пользователь ВК в сессии
    private function get_user()
    {
        // TODO
        return TRUE;
    }


    // Авторизация
    public function login()
    {
        if($this->get_access_token()) {
            $this->get_user();
            $result = $this->api('users.get', array('user_ids' => $this->id_vk, 'fields' => 'first_name,last_name,photo_50,photo_200'));
            $this->first_name = $result[0]->first_name;
            $this->last_name = $result[0]->last_name;
            $this->photo_50 = $result[0]->photo_50;
            $this->photo_400 = $result[0]->photo_200;

          return true;
        } else {
            return false;
        }
    }

    // id пользователя ВК
    public function get_user_id()
    {
        return $this->id_vk;
    }

    // имя пользователя ВК
    public function get_first_name()
    {
        return $this->first_name;
    }

    // фамилия пользователя ВК
    public function get_last_name()
    {
        return $this->last_name;
    }

    // фото 50х50px пользователя ВК
    public function get_photo_50()
    {
        return $this->photo_50;
    }

    // фото 200х200px пользователя ВК
    public function get_photo_400()
    {
        return $this->photo_400;
    }


    // Сброс авторизации ВК
    public function logout()
    {
        // TODO
    }

    // Метод для обращения к API
    public function api($method = FALSE, $parametrs = array())
    {
        $array = array(
            '{METHOD_NAME}' => $method,
            '{PARAMETERS}' => $this->attr($parametrs),
            '{ACCESS_TOKEN}' => $this->access_token,
            '{VK_API_VERSION}'  => $this->config['VK_API_VERSION']
        );
        $url = strtr($this->config['VK_URI_METHOD'],$array);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $json = curl_exec($ch);

        curl_close($ch);

        $result = json_decode($json);

        if(isset($result->response))
        {
            return $result->response;
        }else{
            return null;
        }
    }

    private function attr($array = array())
    {
        $params = '';
        if(!empty($array))
        {
            foreach($array as $key=>$val)
            {
                $params .= $key.'='.$val.'&';
            }
        }
        return substr($params,0,-1);
    }

}