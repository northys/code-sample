<?php

declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

$configurator = new Nette\Configurator();

$configurator->enableTracy(__DIR__.'/../log');

$configurator->setTimeZone('Europe/Prague');
$configurator->setTempDirectory(__DIR__.'/../temp');

$configurator->addConfig(__DIR__.'/config/config.neon');
$configurator->addConfig(__DIR__.'/config/config.local.neon');

return $configurator->createContainer();
