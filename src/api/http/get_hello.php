<?php
namespace api\http;

use api\http\handlers\Hello;
use com\github\tncrazvan\catpaw\http\HttpEvent;
use com\github\tncrazvan\catpaw\http\HttpEventOnClose;

return fn(string $test,HttpEvent $e,HttpEventOnClose &$onClose) 
    => new Hello($test,$e,$onClose);