<?php

namespace {

    use CatPaw\Web\Attribute\Http\StartWebServer;
    use CatPaw\Web\Utility\Route;

	#[StartWebServer]
	function main() {
		Route::get("/plain", fn() => "this is plain text.");
		echo Route::describe();
	}
}