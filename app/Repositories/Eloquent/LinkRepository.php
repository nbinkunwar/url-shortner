<?php


namespace App\Repositories\Eloquent;


use App\Models\Link;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\LinkInterface;

class LinkRepository extends BaseRepository implements LinkInterface
{

    /**
     * LinkRepository constructor.
     * @param Link $model
     */
    public function __construct(Link $model)
    {
        parent::__construct($model);
    }

    /**
     * @param $shortUrl
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findByShortUrl($shortUrl)
    {
        return $this->findBy('short_url',$shortUrl);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function increaseClickCount($id)
    {
        $link = $this->model->find($id);
        return $link->fill(['clicks'=>$link->clicks+1])->save();
    }

    /**
     * @param array $searchData
     * @return mixed
     */
    public function getBySearch($searchData = [])
    {
        $curModel = $this->model;
        foreach ($searchData as $key=>$search)
        {
            $curModel = $curModel->where($key,'like','%'.$search.'%');
        }

        return $curModel->withTrashed()->paginate();
    }
}