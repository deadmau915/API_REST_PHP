<?php
//available resources
$allowedResourceTypes = [
    'books',
    'authors',
    'genres'
];

$resourceType = $_GET['resource_type'];

//validate that the resource is available
if ( !in_array( $resourceType, $allowedResourceTypes ) ) {
    die;
}

//define the resources
$books = [
    1 => [
        'tittle' => 'gone with the wind',
        'id_author' => 2,
        'id_genre' => 2
    ],
    2 => [
        'tittle' => 'the Iliad',
        'id_author' => 1,
        'id_genre' => 1
    ],
    3 => [
        'tittle' => 'the odyssey',
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
        # code...
        break;
}