<?php

namespace App;

class ApiWiki
{
    protected $endPoint = "https://ru.wikipedia.org/w/api.php";


    public function query(array $params = []) : array
    {
        $url = $this->endPoint . "?" . http_build_query( $params );

        $ch = curl_init( $url );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $output = curl_exec( $ch );
        curl_close( $ch );

        $result = json_decode( $output, true );

        return $result;
    }

    
}