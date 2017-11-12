<?php

require_once(TOOLKIT . '/class.json.php');

Class geobytes_service_request {

    public static function ip_lookup($ip) {
        $location = 'http://getcitydetails.geobytes.com/GetCityDetails?fqcn=';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $location . $ip);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

        $data = curl_exec($ch);
        $request = curl_getinfo($ch);

        if ($request['http_code'] != 200) return null;

        return $data;
    }

}
