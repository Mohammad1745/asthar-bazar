<?php

namespace App\Console\Repositories;

use App\Http\Repositories\CommonRepository;
use App\Models\CollectionItem;

class CollectionItemRepository extends CommonRepository
{
    public $model;

    /**
     * CollectionItemRepository constructor.
     */
    public function __construct()
    {
        $this->model = new CollectionItem();
        parent::__construct($this->model);
    }
}
