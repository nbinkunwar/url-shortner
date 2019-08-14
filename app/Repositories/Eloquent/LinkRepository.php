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
        return $this->model->where('short_url',$shortUrl)->where('is_expired','!=',1)->withTrashed()->first();
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
        $page = request()->get('page');
        $itemsPerPage = request()->get('itemsPerPage');
        $curModel = $this->model;
        foreach ($searchData as $key=>$search)
        {
            $curModel = $curModel->where($key,'like','%'.$search.'%');
        }

        return $curModel->withTrashed()->paginate($itemsPerPage);
    }

    /**
     * @param $current_date_time
     * @return mixed
     */
    public function getExpirableLinks($current_date_time)
    {
        return $this->model->where('expire_at','<=',$current_date_time)->get();
    }

    /**
     * @param $current_date_time
     * @return mixed
     */
    public function setLinksExpired($current_date_time)
    {
        return $this->model->where('expire_at','<=',$current_date_time)->where('is_expired','!=',1)->update(['is_expired'=>1]);
    }
}