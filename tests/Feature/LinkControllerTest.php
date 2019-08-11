<?php

namespace Tests\Feature;

use App\Http\Controllers\Api\LinkController;
use App\Http\Requests\UrlShortenRequest;
use App\Repositories\Contracts\LinkInterface;
use App\Services\UrlShortnerService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LinkControllerTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testShorten()
    {
        
    }
}
