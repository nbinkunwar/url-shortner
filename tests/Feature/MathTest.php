<?php

namespace Tests\Feature;

use App\Services\Math;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MathTest extends TestCase
{
    /**
     * @test
     *
     * @return ::to_base
     */

    public function it_converts_base_10_to_62_string()
    {
        $response = Math::to_base(100);
        $this->assertEquals('1C',$response);
    }

    /**
     * @test
     *
     * @covers ::to_base_10
     *
     */
    public function it_converts_base_62_to_10_string()
    {
        $response = Math::to_base_10('1C');
        $this->assertEquals('100',$response);
    }

}
