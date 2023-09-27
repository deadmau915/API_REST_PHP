<?php
// AUTHENTICATION VIA HTTP
/* $user = array_key_exists( 'PHP_AUTH_USER', $_SERVER) ? $_SERVER['PHP_AUTH_USER'] : '';
$pwd = array_key_exists( 'PHP_AUTH_PW', $_SERVER) ? $_SERVER['PHP_AUTH_PW'] : '';

if ( $user !== 'mauro' || $pwd !== '1234' ) {
    die;
} */
////////////////////////////

// AUTHENTICATION VIA HMAC
/* if (
    !array_key_exists('HTTP_X_HASH', $_SERVER) ||
    !array_key_exists('HTTP_X_TIMESTAMP', $_SERVER) ||
    !array_key_exists('HTTP_X_UID', $_SERVER)
) {
    die;
}

list( $hash, $uid, $timestamp) = [
    $_SERVER['HTTP_X_HASH'], $_SERVER['HTTP_X_UID'], $_SERVER['HTTP_X_TIMESTAMP']
];

$secret = 'secreto';

$newHash = sha1($uid.$timestamp.$secret);

if ($newHash !== $hash) {
    die;
} */
////////////////////////////

// AUTHENTICATION VIA TOKEN
/* if ( !array_key_exists( 'HTTP_X_TOKEN', $_SERVER ) ) {
    die;
}

$url = 'http://localhost:8001';
$ch = curl_init( $url );
curl_setopt(
    $ch,
    CURLOPT_HTTPHEADER,
    [
        "X-Token: {$_SERVER['HTTP_X_TOKEN']}"
    ]
);
curl_setopt(
    $ch,
    CURLOPT_RETURNTRANSFER,
    true
);

$ret = curl_exec( $ch );

if ( $ret !== 'true' ) {
    die;
} */
/////////////////////////////

//available resources
$allowedResourceTypes = [
    'books',
    'authors',
    'genres'
];

$resourceType = $_GET['resource_type'];

//validate that the resource is available
if ( !in_array( $resourceType, $allowedResourceTypes ) ) {
    http_response_code(400);
    die;
}

//define the resources
$books = [
    1 => [
        'title' => 'gone with the wind',
        'id_author' => 2,
        'id_genre' => 2
    ],
    2 => [
        'title' => 'the Iliad',
        'id_author' => 1,
        'id_genre' => 1
    ],
    3 => [
        'title' => 'the odyssey',
        'id_author' => 1,
        'id_genre' => 1
    ],
];

header('Content-Type: application/json');

//set the Id os the searche resource
$resourceId = array_key_exists('resource_id', $_GET) ? $_GET['resource_id'] : '';

//generate the response assuming that the request is correct
switch ( strtoupper( $_SERVER['REQUEST_METHOD']) )  {
    case 'GET':
        if ( empty( $resourceId ) ) {
            echo json_encode( $books );
        } else {
            if ( array_key_exists($resourceId, $books) ) {
                echo json_encode( $books[$resourceId] );
            } else {
                http_response_code(404);
            }
        }
        break;
    
    case 'POST':
        $json = file_get_contents('php://input');
        $books[] = json_decode( $json, true );
        //echo array_keys($books)[count($books)-1];
        echo json_encode($books);
        break;

    case 'PUT':
        if ( !empty($resourceId) && array_key_exists($resourceId, $books)) {
            //we take the raw data
            $json = file_get_contents('php://input');
            $books[ $resourceId ] = json_decode( $json, true );
            //echo array_keys($books)[count($books)-1];
            echo json_encode($books);
        }
        break;

    case 'DELETE':
        //check the resource's exitence
        if ( !empty($resourceId) && array_key_exists($resourceId, $books)) {
            //delete the resource
            unset( $books[$resourceId] );
        }
        echo json_encode( $books );
        break;
}