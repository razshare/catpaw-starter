<?php

namespace App;
use CatPaw\Attributes\Service;

#[Service]
class TestService {
	public function test():string{
		return 'hello world';
	}
}