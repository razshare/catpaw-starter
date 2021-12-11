<?php

namespace {

	use App\TestService;
	use CatPaw\CatPaw;
	use CatPaw\Configs\MainConfiguration;
	use CatPaw\Tools\Helpers\Route;

	function main(MainConfiguration $config): Generator {
		yield CatPaw::startWebServer($config);
		yield Route::get("/hello-world", fn(TestService $test) => $test->test());

		echo Route::describe();
	}
}