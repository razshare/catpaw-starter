<?php
namespace scripts\ccli;

chdir(dirname(__FILE__).'/../..');
require_once './vendor/autoload.php';

use net\razshare\catpaw\tools\helpers\Factory;
use React\EventLoop\Factory as EventLoopFactory;
use React\EventLoop\LoopInterface;

Factory::setObject(LoopInterface::class,EventLoopFactory::create());

Factory::setConstructorInjector(CCli::class,fn()=>[array_splice($argv,1)]);

Factory::make(CCli::class);