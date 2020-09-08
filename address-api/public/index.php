<?php

header("Access-Control-Allow-Origin: *");

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->addErrorMiddleware(true,true,false);

// Function for string formatting for address to replace " " - %20, "." - %2E, "," - %2C
function reformat_string($str){
    // Seperating by ","
    $tmp = explode(',', $str);
    // for every value of tmp
    foreach($tmp as $k=>$v){
        // replacing "." and " " by %2E and %20
        $tmp[$k] = str_replace('.', '%2E', str_replace(' ', '%20', trim($v)));
    }
    // returning string by joinig with %2C = ","
    return join('%2C', $tmp);
}

function get_address($address){
    // Using "here's" Geocode API. It takes in an address and provids all the other information for that address
    // Link for Geocode doc: https://developer.here.com/documentation/geocoding-search-api/dev_guide/topics/endpoint-geocode-brief.html 
    // TODO:Replace API_KEY with.
    $API_KEY = "REPLACE THIS WITH API KEY";
    // Reformatting the address string to fit the URL. 
    // the Geocode API can accept spaces and dots, but PHP's show "bad URL" error, hence the reformatting
    $address = reformat_string($address);
    // URL construction
    $url = "https://geocode.search.hereapi.com/v1/geocode?q=" . $address . "&apiKey=" . $API_KEY;
    // json response from url
    $resp = json_decode(file_get_contents($url), true);
    // Getting relevant data.
    $data = array(
        "house-number"=>$resp['items'][0]['address']['houseNumber'],
        "street"=>$resp['items'][0]['address']['street'],
        "city"=>$resp['items'][0]['address']['city'],
        "state"=>$resp['items'][0]['address']['state'],
        "country"=>$resp['items'][0]['address']['countryName'],
        "postal-code"=>$resp['items'][0]['address']['postalCode'],
    );
    // return json data
    return json_encode($data);
}


$app->get('/api/{address_str}', function (Request $request, Response $response, array $args) {
    // Getting the argrments
    $address_str = $args['address_str'];
    // Getting data from get_address function
    $data = get_address($address_str);
    // Write to the response body
    $response->getBody()->write($data);
    // Returning the data
    return $response->withHeader('Content-Type', 'application/json');

});

$app->run();