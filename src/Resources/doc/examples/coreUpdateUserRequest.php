<?php

require_once __DIR__ . '/../../../../vendor/autoload.php';

use Combodo\ItopClientBundle\RestClient\RequestOperation\Core\RequestOperationCoreUpdate;
use Combodo\ItopClientBundle\RestClient\RestClient;

$httpClient = new \GuzzleHttp\Client();
$baseUrl = 'http://localhost/itop/itop-github/webservices/rest.php';
$auth_user = 'api';
$auth_pwd = 'api';

$restClient = new RestClient($httpClient, $baseUrl, $auth_user, $auth_pwd, ['Cookie' => 'XDEBUG_SESSION=XDEBUG_ECLIPSE;']);

$operation = new RequestOperationCoreUpdate(
    101,
    'UserRequest',
    'ref, title',
    'test of client',
    [
        'title' => 'Modified on '.date('Y-m-d h:i:s'),
    ]
);

$restResponse = $restClient->executeOperation($operation);

echo $restResponse->asJson();
