<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function test_basic_math(): void
    {
        $result = 2 + 2;
        $this->assertEquals(4, $result);
    }

    public function test_string_operations(): void
    {
        $string = "Laravel API";
        $this->assertStringContainsString("API", $string);
    }
}