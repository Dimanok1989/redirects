<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{

    /**
     * Метод кодирования идентификатора в котороткую ссылку
     *
     * @param int $id
     * @return string
     */
    public static function decToLink(Int $id) : string
    {

        $digits = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $link = '';

        do {
            $dig = $id % 62;
            $link = $digits[$dig].$link;
            $id = floor($id / 62);
        } while ($id != 0);

        return $link;

    }
    
    /**
     * Метод декодирования короткой ссылки в идентификатор
     *
     * @param string $link
     * @return int
     */
    public static function linkToDec(String $link) : int
    {

        $digits = [
            '0' => 0,  '1' => 1,  '2' => 2,  '3' => 3,  '4' => 4,  '5' => 5,  '6' => 6,  '7' => 7,  '8' => 8,  '9' => 9,
            'a' => 10, 'b' => 11, 'c' => 12, 'd' => 13, 'e' => 14, 'f' => 15, 'g' => 16, 'h' => 17, 'i' => 18, 'j' => 19,
            'k' => 20, 'l' => 21, 'm' => 22, 'n' => 23, 'o' => 24, 'p' => 25, 'q' => 26, 'r' => 27, 's' => 28, 't' => 29,
            'u' => 30, 'v' => 31, 'w' => 32, 'x' => 33, 'y' => 34, 'z' => 35, 'A' => 36, 'B' => 37, 'C' => 38, 'D' => 39,
            'E' => 40, 'F' => 41, 'G' => 42, 'H' => 43, 'I' => 44, 'J' => 45, 'K' => 46, 'L' => 47, 'M' => 48, 'N' => 49,
            'O' => 50, 'P' => 51, 'Q' => 52, 'R' => 53, 'S' => 54, 'T' => 55, 'U' => 56, 'V' => 57, 'W' => 58, 'X' => 59,
            'Y' => 60, 'Z' => 61
        ];
        
        $id = 0;

        for ($i = 0; $i < strlen($link); $i++) {
            $id += $digits[$link[(strlen($link) - $i - 1)]] * pow(62, $i);
        }

        return $id;

    }

    /**
     * Определение хоста из ссылки
     * 
     * @param string|null $url
     * @return string|null
     */
    public function getUrlHost($url = null) {

        if (!$url)
            return null;

        return parse_url($url, PHP_URL_HOST);

    }

    /**
     * Определение параметров запроса из ссылки
     * 
     * @param string|null $url
     * @param bool $json Вывести в формате json-строки
     * @return array|null
     */
    public function getUrlQuery($url = null, $json = false) {

        if (!$url)
            return null;

        if (!$query = parse_url($url, PHP_URL_QUERY))
            return null;

        $params = [];        
        $query = explode("&", $query);

        if (is_array($query)) {

            foreach ($query as $row) {

                $row = explode("=", $row);

                if (isset($row[0]) AND isset($row[1]))
                    $params[$row[0]] = $row[1];

            }

        }

        if ($json)
            return \json_encode($params, JSON_UNESCAPED_UNICODE);

        return $params;

    }

}
