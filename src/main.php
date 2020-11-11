<?php

use api\http\handlers\Hello;
use com\github\tncrazvan\catpaw\tools\helpers\Route;

Route::get("/home",                      require './api/http/get_home.php');
Route::post("/file-old/{filename}",      require './api/http/post_file_old.php');
Route::post("/file/{filename}",          require './api/http/post_file.php');
Route::make("/hello",             Hello::class);
Route::get("/templating/{username}",     require './api/http/templating.php');

//By default, a 404 response will serve 
//the "./index.php" or "./index.html" files.
//You can customize this behaviour by using Route::notFound().
//Route::notFound(fn()=>"page not found, sorry");

Route::forward('/upload/{filename}', '/asd/{filename}');
Route::forward('/upload-old/{filename}', '/asd-old/{filename}');

return [
    "port" => 80,
    "webRoot" => "../public",
    "sessionName" => "../_SESSION",
    "asciiTable" => false,
    "httpMtu" => 1024 * 1024,
    "httpMaxBodyLength" => 1024 * 1024 * 1024 * 20,
];