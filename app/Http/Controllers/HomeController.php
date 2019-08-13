<?php


namespace App\Http\Controllers;


use App\Repositories\Contracts\LinkInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    protected $linkInterface;
    public function __construct(LinkInterface $linkInterface)
    {
        $this->linkInterface = $linkInterface;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.app');
    }

    /**
     * @param Request $request
     * @param $shortUrl
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getLink(Request $request, $shortUrl)
    {
        $link = $this->linkInterface->findByShortUrl($shortUrl);
        if(!$link){
            abort(404);
        }
        if($link->deleted_at)
        {
            abort(410);
        }
        $this->linkInterface->increaseClickCount($link->id);
        return redirect()->to($link->long_url);
    }

}