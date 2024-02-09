<?php
require_once __DIR__.'/../vendor/autoload.php';

use EvolutionSDK\util\Config;
use EvolutionSDK\SDK;

$config = new Config();
$config->setApikey("XXXXXXXXXXX");
$config->setUrl("your-evolutionapi.com");

$sdkc = new SDK($config);
$res = $sdkc->create('teste');
var_dump($res);