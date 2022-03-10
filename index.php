<?php

require __DIR__ . '/vendor/autoload.php';

(new \DotEnv\DotEnv(__DIR__ . '/.env'))->load();


$app = new \App\App();

$app->exportAndDump();

