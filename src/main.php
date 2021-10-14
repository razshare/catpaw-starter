<?php
use CatPaw\Tools\Helpers\Route;

function main(){
	yield Route::get("/hello-world", fn()=> "hello world");
}