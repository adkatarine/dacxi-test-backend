<?php

namespace App\Utils;

class FormatData {

    public static function implodeCoinsId($coins_id) {
        foreach ($coins_id as $coin) {
            $coins[] = $coin['id'];
        }
        return implode(",", $coins);
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
