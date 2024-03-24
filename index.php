<?php

namespace BeholderAction;

require_once 'vendor/autoload.php';

Config::init();
$app = new BeholderAction(Config::GROUP_ID, Config::ACCESS_TOKEN);
$app->listen();
