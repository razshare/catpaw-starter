<?php

namespace {

	use App\TestService;
	use CatPaw\Attributes\Inject;
	use CatPaw\CatPaw;
	use CatPaw\Configs\MainConfiguration;
	use CatPaw\Tools\Helpers\Route;

	function main(#[Inject] MainConfiguration $config): Generator {
		yield Route::get("/hello-world", fn(#[Inject] TestService $test) => $test->test());
		yield CatPaw::startWebServer($config);
	}
}