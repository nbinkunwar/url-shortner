<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UrlShortenRequest;
use App\Services\UrlShortnerService;
use Illuminate\Http\Request;
use App\Http\Resources\Links as LinkResource;

class LinkController extends Controller
{
    protected $shortenService;

    /**
     * LinkController constructor.
     * @param UrlShortnerService $shortenService
     */
    public function __construct(UrlShortnerService $shortenService)
    {
        $this->shortenService = $shortenService;
    }

    /**
     * @param UrlShortenRequest $request
     * @return LinkResource
     * @throws \Exception
     */
    public function shorten(UrlShortenRequest $request)
    {
        $link = $this->shortenService->shorten($request->long_url,$request->expire_at);
        return new LinkResource($link);
//        return response()->json($short_url->toArray());
//        return response()->json(['short_uri'=>$short_url]);
    }

}