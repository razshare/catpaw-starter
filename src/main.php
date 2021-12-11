<?php

namespace {

	use CatPaw\CatPaw;
	use CatPaw\Configs\MainConfiguration;
	use CatPaw\Tools\Helpers\Route;

	function main(MainConfiguration $config): Generator {
		yield CatPaw::startWebServer($config);

		yield Route::get("/plain", fn() => "this is plain text.");

		echo Route::describe();
	}
}