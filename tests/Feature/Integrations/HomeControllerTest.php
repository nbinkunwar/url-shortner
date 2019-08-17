<?php

namespace Tests\Feature\Integrations;

use App\Models\Link;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeControllerTest extends TestCase
{

    /**
     * @test
     *
     * @covers ::getLink
     */
    public function it_throws_error_on_invalid_short_url()
    {
        $response = $this->get('/invalid_shorurl');
        $this->assertEquals(404,$response->getStatusCode());
    }

    /**
     * @test
     *
     * @covers ::getLink
     */
    public function it_throws_410_error_code_on_deleted_url()
    {
        $link = factory('App\Models\Link')->create([
            'long_url'=>'http://test.com/longtesturl',
            'deleted_at'=>now()
        ]);
        $response = $this->get('/'.$link->short_url);
        $this->assertEquals(410,$response->getStatusCode());
    }

    /**
     * @test
     *
     * @covers ::getLink
     */
    public function it_redirects_to_long_url()
    {
        $link = factory('App\Models\Link')->create([
            'long_url'=>'http://test.com/longtesturl'
        ]);
        $response = $this->get('/'.$link->short_url);
        $this->assertEquals(302,$response->getStatusCode());
    }
}
