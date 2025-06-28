<?php
namespace Tests;

use CatPaw\Core\Container;
use CatPaw\Core\Interfaces\EnvironmentInterface;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase {
    public function testApiPrefix():void {
        Container::loadDefaultProviders("Test");
        Container::run(function(EnvironmentInterface $env) {
            $env->load()->unwrap($error);
            $this->assertNull($error);
            $this->assertEquals("World", $env->get("name"));
        })->unwrap($error);
        $this->assertNull($error);
    }
}
