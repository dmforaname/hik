<?php

namespace App\Repositories\Api;

use App\Models\Item;
use App\Repositories\BaseRepository;

class ItemRepository extends BaseRepository
{
    protected $model;

    /**
     * Repository constructor.
     *
     * @param Item $mod
     */
    public function __construct(Item $mod)
    {
        $this->model = $mod;
    }
}
