<?php


namespace App\Repositories\Eloquent;


use App\Models\Link;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\LinkInterface;

class LinkRepository extends BaseRepository implements LinkInterface
{

    public function __construct(Link $model)
    {
        parent::__construct($model);
    }
}