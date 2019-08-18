<?php

namespace Tests\Feature\Integrations;

use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Http\Request;
use Tests\ControllerTestCase;

class LinkControllerTest extends ControllerTestCase
{
    use InteractsWithDatabase;
    /**
     * @test
     *
     * @covers ::index
     */
    public function it_returns_all_links()
    {
        $request_mock = \Mockery::mock(Request::class);
        $this->app->instance(Request::class, $request_mock);
        $request_mock->shouldReceive('only')->andReturn([
        ]);
        $response = $this->withHeaders([
            'Authorization'=>'Bearer '.$this->getAuthUser(),
        ])->json('get','/api/v1/links');
        $this->assertEquals(200,$response->status());
    }

    /**
     * @test
     *
     * @covers ::delete
     */
    public function it_soft_deletes_link()
    {
        $link = factory('App\Models\Link')->create([
            'long_url'=>'http://test.com/longtesturl'
        ]);
        $response = $this->withHeaders([
            'Authorization'=>'Bearer '.$this->getAuthUser(),
        ])->deleteJson('/api/v1/links/'.$link->id);
        $this->assertSoftDeleted('links', $link->toArray());
    }

    /**
     * @test
     *
     * @covers ::shorten
     */
    public function it_throws_validation_exception_for_create_link_request()
    {
        $response = $this->json('post','/api/v1/shorten',[]);

        $this->assertEquals([
            'message'=>'The given data was invalid.',
            'errors' => [
                'long_url' => [
                    'The long url field is required.',
                ],
            ],
        ], json_decode($response->getContent(),1));

        $this->assertEquals(422,$response->status());
    }

    /**
     * @test
     *
     * @covers ::shorten
     *
     */
    public function it_throws_validation_exception_for_black_listed_url()
    {
        $response = $this->json('post','/api/v1/shorten',[
            'long_url'=>'http://invalid.com'
        ]);

        $this->assertEquals([
            'message'=>'The given data was invalid.',
            'errors' => [
                'long_url' => [
                    'This type of url is blacklisted.',
                ],
            ],
        ], json_decode($response->getContent(),1));

        $this->assertEquals(422,$response->status());

    }

    /**
     * @test
     *
     * @covers ::shorten
     */
    public function it_creates_link()
    {
        $requestData = [
            'long_url'=>'http://test.com/longtesturl123'
        ];
        $response = $this->json('post','/api/v1/shorten',$requestData);
        $this->assertDatabaseHas('links',$requestData);
        $this->assertEquals(200,$response->status());
    }


}
