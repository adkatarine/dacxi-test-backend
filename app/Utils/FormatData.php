<?php

namespace App\Utils;

class FormatData {

    /**
     * Recebe um array com o id das moedas e retorna elas em uma string separadas por virgula.
     *
     * @param  $coins
     * @return array
     */
    public static function implodeCoinsId($coins) {
        foreach ($coins as $coin) {
            $coins_id_name[] = $coin['coin_id'];
            $coins_id[$coin['coin_id']] = $coin['id'];
        }
        return array(implode(",", $coins_id_name), $coins_id);
    }


    /**
     * Recebe um response e retorna ela decodificada.
     *
     * @param  $object
     * @return array
     */
    public static function jsonDecodeResponse($object) {
        $response = (string)$object->getBody();
        return json_decode($response, true);
    }

    /**
     * Recebe um datetime e retorna um array com a data e hora separadas.
     *
     * @param  $datetime
     * @return array
     */
    public static function dateTime($datetime) {
        list($date, $time) = explode(" ", $datetime);
        return ['date' => $date, 'time' => $time];
    }
}
