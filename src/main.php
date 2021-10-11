<?php

namespace app;

use net\razshare\catpaw\attributes\sessions\Session;
use net\razshare\catpaw\tools\helpers\Route;
use function app\modules\test;

Route::get("/api/v1/test", function (
	#[Session] array &$session
){
	return test();
});