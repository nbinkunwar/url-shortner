<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UrlShortenRequest;
use App\Repositories\Contracts\LinkInterface;
use App\Services\UrlShortnerService;
use App\Http\Resources\Links as LinkResource;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    protected $shortenService;
    protected $linkInterface;

    /**
     * LinkController constructor.
     * @param UrlShortnerService $shortenService
     */
    public function __construct(UrlShortnerService $shortenService,LinkInterface $link)
    {
        $this->shortenService = $shortenService;
        $this->linkInterface = $link;
    }

    /**
     * @param Request $request
     * @return LinkResource
     */
    public function index(Request $request)
    {
        $links = $this->linkInterface->getBySearch($request->only(['short_url','long_url']));
        return new LinkResource($links);
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
    }

    public function delete($id)
    {
        if ($this->linkInterface->remove($id))
        {
            return response()->json(['message'=>'Data Deleted Successfully']);
        }
        return response()->json(['message'=>'Something went wrong'],400);
    }


}