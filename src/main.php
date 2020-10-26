<?php

use com\github\tncrazvan\catpaw\tools\helpers\Route;

Route::get("/home",                     require './api/http/get_home.php');
Route::post("/file-old/{filename}",      require './api/http/post_file_old.php');
Route::post("/file/{filename}",          require './api/http/post_file.php');
Route::get("/hello/{test}",             require './api/http/get_hello.php');
Route::get("/templating/{username}",    require './api/http/templating.php');

//Route::notFound(fn()=>"page not found, sorry");

Route::forward('/upload/{filename}', '/asd/{filename}');
Route::forward('/upload-old/{filename}', '/asd-old/{filename}');

return [
    "port" => 80,
    "webRoot" => "../public",
    "sessionName" => "../_SESSION",
    "asciiTable" => true,
    "httpMtu" => 1024 * 1024,
    "httpMaxBodyLength" => 1024 * 1024 * 1024 * 20,
];