<?php

/**
 * @link http://www.java4game.net/
 * @copyright Copyright (c) 2015 JAVA4GAME
 * @author Andrey Svetashov
 */

namespace app\components\gp;

class Gp
{

    public static $type = [
        'Аркады',
        'Викторины',
        'Головоломки',
        'Гонки',
        'Казино',
        'Казуальные',
        'Карточные',
        'Музыка',
        'Настольные игры',
        'Обучающие',
        'Приключения',
        'Ролевые',
        'Симуляторы',
        'Словесные игры',
        'Спортивные игры',
        'Стратегии',
        'Экшен',
    ];

    /**
     * @param $url
     *
     * @return array|bool
     */
    public static function getData($url){

        if($url === null){
            return false;
        }

        $html = null;
        $game_name = null;
        $screenshot1 = null;
        $screenshot2 = null;
        $dev_name = null;
        $game_icon = null;
        $game_type = null;
        $game_video = null;
        $game_description = null;

        $session = curl_init();
        curl_setopt($session, CURLOPT_URL, $url);
        curl_setopt($session, CURLOPT_HTTPHEADER, array(
            "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36",
            "Accept-Language: ru-RU,ru;q=0.8,en-US;q=0.6,en;q=0.4"
        ));
        curl_setopt($session, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($session, CURLOPT_CONNECTTIMEOUT, 5);
        $html = curl_exec($session);
        curl_close($session);

        // Название игры
        preg_match('/(<div class="id-app-title" tabindex="0">)(.+)(<\/div>)/U', $html, $game_name);

        // Первый скриншот
        preg_match('/(expand-to="full-screenshot-0"\s+src="\/\/)(.+)(=)/U', $html, $screenshot1);

        // Второй скриншот
        preg_match('/(expand-to="full-screenshot-1"\s+src="\/\/)(.+)(=)/U', $html, $screenshot2);

        // Имя разработчика
        preg_match('/(<span itemprop="name">)(.+)(<\/span>)/U', $html, $dev_name);

        // Иконка
        preg_match('/(<img class="cover-image"\s+src="\/\/)(.+)(=)/U', $html, $game_icon);

        // Жанр игры
        preg_match('/(<span itemprop="genre">)(.+)(<\/span>)/U', $html, $game_type);

        // Описание игры
        preg_match('/(<div jsname="C4s9Ed">)(.+)(<\/div>)/U', $html, $game_description);

        // Видео
        preg_match('/(url="https:\/\/www.youtube.com\/embed\/)(.+)(\?)/U', $html, $game_video);

        if(empty($game_name[2]) || empty($screenshot1[2]) || empty($screenshot2[2]) || empty($dev_name[2]) || empty($game_icon[2]) || empty($game_type[2])){
            return false;
        }

        //$_type = mb_strtolower($game_type[2], 'utf-8');
        $id_game_type = array_search($game_type[2], self::$type) + 1;
        if($id_game_type === null) {
            return false;
        }

        if(empty($game_video[2])) {
            $game_video = null;
        }

        return [
            'game_name' => $game_name[2],
            'screenshot1' => $screenshot1[2],
            'screenshot2' => $screenshot2[2],
            'dev_name' => $dev_name[2],
            'game_icon' => $game_icon[2],
            'game_type' => $id_game_type,
            'game_video' => $game_video[2],
            'game_description' => $game_description[2],
        ];

    }
}