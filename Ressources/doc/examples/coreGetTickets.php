<?php

use BrunoDs\ItopClientBundle\RestClient\RequestOperation\Core\RequestOperationCoreGet;
use BrunoDs\ItopClientBundle\RestClient\RestClient;

$httpClient = new \GuzzleHttp\Client();
$baseUrl = 'http://localhost/itop/itop-github/webservices/rest.php';
$auth_user = 'api';
$auth_pwd = 'api';

$restClient = new RestClient($httpClient, $baseUrl, $auth_user, $auth_pwd);


$operation = new RequestOperationCoreGet(1, 'Ticket', '*');

$restResponse = $restClient->executeOperation($operation);


echo $restResponse->getHey();
echo '<br />';

echo $restResponse->asJson();
