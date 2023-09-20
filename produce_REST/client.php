<?php

$ch = curl_init( $argv[1] );
curl_setopt(
    $ch,
    CURLOPT_RETURNTRANSFER,
    true
);

$response = curl_exec( $ch );
$httpCode = curl_getinfo( $ch, CURLINFO_HTTP_CODE );

switch ($httpCode) {
    case 200:
        echo 'OK';
        break;
    case 400:
        echo 'Incorrect Request';
        break;
    case 404:
        echo 'Not Found';
        break;
    case 500:
        echo 'Server Error';
        break;
    default:
        echo 'Unknown Error';
        break;
}