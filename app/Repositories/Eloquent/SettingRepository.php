<?php


namespace App\Repositories\Eloquent;


use App\Models\Setting;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\SettingInterface;

class SettingRepository extends BaseRepository implements SettingInterface
{

    /**
     * SettingRepository constructor.
     * @param Setting $model
     */
    public function __construct(Setting $model)
    {
        parent::__construct($model);
    }

    /**
     * @param string $pattern
     * @return mixed
     */
    public function changeUrlBlockPattern($pattern = '')
    {
        return $this->model->where('key','url_black_list_pattern')->update(['value'=>$pattern]);
    }

}