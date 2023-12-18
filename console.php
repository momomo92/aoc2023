#!/usr/bin/env php
<?php
require_once __DIR__ . '/vendor/autoload.php';

use Console\AocCommand;
use Symfony\Component\Console\Application;

$app = new Application();
$app -> add(new AocCommand());
$app->run();