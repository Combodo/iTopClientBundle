<?php

require_once __DIR__.'/../../../vendor/autoload.php';

use BrunoDs\ItopClientBundle\RestClient\RequestOperation\Core\RequestOperationCoreGet;
use BrunoDs\ItopClientBundle\RestClient\RestClient;

$httpClient = new \GuzzleHttp\Client();
$baseUrl = 'http://localhost/itop/itop-github/webservices/rest.php';
$auth_user = 'api';
$auth_pwd = 'api';

$restClient = new RestClient($httpClient, $baseUrl, $auth_user, $auth_pwd, ['Cookie' => 'XDEBUG_SESSION=XDEBUG_ECLIPSE;']);


$operation = new RequestOperationCoreGet(101, 'UserRequest', 'ref, org_id');

$restResponse = $restClient->executeOperation($operation);



echo $restResponse->asJson();

var_dump($restResponse->asArray());

var_dump($restResponse->search('objects.*.fields'));

var_dump($restResponse->searchOne('objects.*.fields'));

