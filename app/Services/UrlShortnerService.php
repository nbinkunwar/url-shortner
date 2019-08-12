<?php


namespace App\Services;


use App\Repositories\Contracts\LinkInterface;
use Illuminate\Support\Str;

class UrlShortnerService
{

    protected $longUrl;
    protected $expire_at;
    protected $linkRepository;
    public function __construct(LinkInterface $linkRepository)
    {
        $this->linkRepository = $linkRepository;
    }

    /**
     * @param $longUrl
     * @param null $expire_at
     * @return string
     * @throws \Exception
     */
    public function shorten($longUrl, $expire_at = null)
    {
        $this->longUrl = $longUrl;
        $this->expire_at = $expire_at;
        if($is_shortened = $this->canBeShortened())
        {
            return  $is_shortened;
        }

        $short_url = $this->shortenUrl();
        $this->linkRepository->fillAndSave(['long_url'=>$longUrl,'short_url'=>$short_url,'expire_at'=>$this->expire_at]);
        return $this->getFormat().'/'.$short_url;

    }


    /**
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    protected function getFormat()
    {
        return url('/');
    }

    /**
     * @throws \Exception
     */
    protected function canBeShortened()
    {
        return $this->linkRepository->findBy('long_url',$this->longUrl);
    }

    /**
     * @return string
     */
    protected function shortenUrl()
    {
        $short_url = Str::random(6);
        $url_exists = $this->linkRepository->findBy('short_url',$short_url);
        if($url_exists){
            $this->shortenUrl();
        }
        return $short_url;
    }

}