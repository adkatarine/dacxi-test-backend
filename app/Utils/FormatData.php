<?php

namespace App\Utils;

class FormatData {

    public static function implodeCoinsId($coins) {
        foreach ($coins as $coin) {
            $coins_id_name[] = $coin['coin_id'];
            $coins_id[$coin['coin_id']] = $coin['id'];
        }
        return array(implode(",", $coins_id_name), $coins_id);
    }

    public static function jsonDecodeResponse($object) {
        $response = (string)$object->getBody();
        return json_decode($response, true);
    }

    public static function dateTime($datetime) {
        list($date, $time) = explode(" ", $datetime);
        return ['date' => $date, 'time' => $time];
    }
}
