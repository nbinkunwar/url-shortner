<?php

namespace Tests\Feature\Integrations;

use App\Http\Requests\UrlShortenRequest;
use App\Http\Resources\Links;
use App\Models\Link;
use App\Repositories\Contracts\LinkInterface;
use App\Repositories\Eloquent\LinkRepository;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Request;
use Mockery\Mock;
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
    public function it_deletes_link()
    {
        $link = factory('App\Models\Link')->create();
        $this->withHeaders([
            'Authorization'=>'Bearer '.$this->getAuthUser(),
        ])->json('delete','/api/v1/delete/'.$link->id);
        $this->assertSoftDeleted('links', $link->toArray());
    }


}
