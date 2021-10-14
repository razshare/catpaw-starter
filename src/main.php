<?php

namespace App;

use CatPaw\Attributes\Sessions\Session;
use CatPaw\Tools\Helpers\Route;
use function App\Modules\test;

Route::get("/hello-world", fn()=> "hello world");