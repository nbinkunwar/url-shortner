<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UrlShortenRequest;
use App\Services\UrlShortnerService;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function shorten(UrlShortenRequest $request)
    {
        $short_url = $this->shortenService->shorten($request->long_uri,$request->expire_at);
//        return response()->json($short_url->toArray());
        return response()->json(['short_uri'=>$short_url]);
    }

}