<?php

namespace {

	use CatPaw\Attributes\Inject;
	use CatPaw\CatPaw;
	use CatPaw\Configs\MainConfiguration;
	use CatPaw\Tools\Helpers\Route;

	function main(#[Inject] MainConfiguration $config): Generator {
		yield Route::get("/hello-world", fn() => "hello world");
		yield CatPaw::startWebServer($config);
	}
}