<?php

use com\github\tncrazvan\catpaw\attributes\Body;
use com\github\tncrazvan\catpaw\attributes\Consumes;
use com\github\tncrazvan\catpaw\attributes\sessions\Session;
use com\github\tncrazvan\catpaw\tools\helpers\Route;

Route::post(
    "/",
    #[Consumes("application/json")]
    function(
        #[Session]
        array &$session, 
        #[Body]
        array $body
    ){
    //update the user's username
    $session["username"] = $body["username"];
});