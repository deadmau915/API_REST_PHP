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
//generate the response assuming that the request is correct
switch ( strtoupper( $_SERVER['REQUEST_METHOD']) )  {
    case 'GET':
        echo json_encode( $books );
        # code...
        break;
    
    case 'POST':
        # code...
        break;

    case 'PUT':
        # code...
        break;

    case 'DELETE':
        # code...
        break;
}