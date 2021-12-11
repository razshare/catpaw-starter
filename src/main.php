<?php

namespace {

	use CatPaw\CatPaw;
	use CatPaw\Configs\MainConfiguration;
	use CatPaw\Tools\Helpers\Route;

	function main(MainConfiguration $config): Generator {
		yield CatPaw::startWebServer($config);
		
		yield Route::get("/hello", fn() => "hello world");

		echo Route::describe();
	}
}