<?php

namespace App\Modules\Dashboard\Repositories;

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

    /**
     * @param $where
     * @return mixed
     */
    public function itemDetails($where)
    {
        return CollectionItem::select([
            'collection_items.id as id',
            'collections.id as collection_id',
            'collections.title as collection_title',
            'collection_items.expires_at as expires_at',
        ])
            ->leftjoin('collections', ['collection_items.collection_id' => 'collections.id'])
            ->where($where)
            ->first();
    }
}
