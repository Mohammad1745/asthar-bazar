<?php

namespace App\Modules\News\Repositories;

use App\Http\Repositories\CommonRepository;
use App\Models\News;

class NewsRepository extends CommonRepository
{
    public $model;

    /**
     * NewsRepository constructor.
     */
    public function __construct()
    {
        $this->model = new News();
        parent::__construct($this->model);
    }
}
