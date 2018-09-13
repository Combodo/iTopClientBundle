<?php

require_once __DIR__.'/../../../vendor/autoload.php';

use BrunoDs\ItopClientBundle\RestClient\RequestOperation\Core\RequestOperationCoreGet;
use BrunoDs\ItopClientBundle\RestClient\RequestOperation\Core\RequestOperationCoreUpdate;
use BrunoDs\ItopClientBundle\RestClient\RestClient;

$httpClient = new \GuzzleHttp\Client();
$baseUrl = 'http://localhost/itop/itop-github/webservices/rest.php';
$auth_user = 'api';
$auth_pwd = 'api';

$restClient = new RestClient($httpClient, $baseUrl, $auth_user, $auth_pwd, ['Cookie' => 'XDEBUG_SESSION=XDEBUG_ECLIPSE;']);


$aFields = [
    'title' => 'Modified on '.date('Y-m-d h:i:s'),
];

$operation = new RequestOperationCoreUpdate(101, 'UserRequest', 'ref, title', $aFields, 'test of client');

$restResponse = $restClient->executeOperation($operation);

echo $restResponse->asJson(JSON_PRETTY_PRINT);

echo "\n";