<?php
namespace api\http;

return function (array &$session):string{
    $session['time'] = time();
    return "you have a session now!";
};