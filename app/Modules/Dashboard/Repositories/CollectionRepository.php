<?php

namespace App\Modules\Dashboard\Repositories;

use App\Http\Repositories\CommonRepository;
use App\Models\Collection;

class CollectionRepository extends CommonRepository
{
    public $model;

    /**
     * CollectionRepository constructor.
     */
    public function __construct()
    {
        $this->model = new Collection();
        parent::__construct($this->model);
    }
}
