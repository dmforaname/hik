<?php

namespace App\Repositories\Api;

use App\Models\Menu;
use App\Repositories\BaseRepository;

class MenuRepository extends BaseRepository
{
    protected $model;

    /**
     * Repository constructor.
     *
     * @param  Menu  $model
     */
    public function __construct(Menu $mod)
    {
        $this->model = $mod;
    }

    public function getSelect($select)
    {
        return Menu::where('category',$select)->get();
    }
}
