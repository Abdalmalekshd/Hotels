<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $pi=3.4;
        $r=5;
        if($r < $pi){
        $this->assertTrue(true);
    }else
    {
        $this->assertFalse(true);
    }

    }
}
