<?php
namespace app;

use net\razshare\catpaw\tools\helpers\Route;
use function app\modules\test;

Route::get("/api/v1/test",function(){
    return test();
});