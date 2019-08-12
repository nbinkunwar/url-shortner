<?php


namespace App\Repositories\Contracts;


interface LinkInterface
{

    /**
     * @param $shortUrl
     * @return mixed
     */
    public function findByShortUrl($shortUrl);

    /**
     * @param $id
     * @return mixed
     */
    public function increaseClickCount($id);

    /**
     * @param $searchData
     * @return mixed
     */
    public function getBySearch($searchData = []);
}