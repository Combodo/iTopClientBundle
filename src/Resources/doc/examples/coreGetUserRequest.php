<?php

require_once __DIR__ . '/../../../../vendor/autoload.php';

use Combodo\ItopClientBundle\RestClient\RequestOperation\Core\RequestOperationCoreGet;
use Combodo\ItopClientBundle\RestClient\RestClient;

$httpClient = new \GuzzleHttp\Client();
$baseUrl = 'http://localhost/itop/itop-github/webservices/rest.php';
$auth_user = 'api';
$auth_pwd = 'api';

$restClient = new RestClient($httpClient, $baseUrl, $auth_user, $auth_pwd, []);

$operation = new RequestOperationCoreGet(101, 'UserRequest', 'ref, org_id');

$restResponse = $restClient->executeOperation($operation);

var_dump($restResponse->search('objects.*.fields.ref'));
