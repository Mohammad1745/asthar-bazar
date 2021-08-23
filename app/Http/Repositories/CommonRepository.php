<?php


namespace App\Http\Repositories;


class CommonRepository
{
    private $model;

    /**
     * CommonRepository constructor.
     * @param $model
     */
    protected function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->model->create($data);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function insert($data)
    {
        return $this->model->insert($data);
    }

    /**
     * @param $where
     * @param $data
     * @return mixed
     */
    public function updateOrCreate($where, $data)
    {
        return $this->model->updateOrCreate($where, $data);
    }

    /**
     * @param $where
     * @param $data
     * @return mixed
     */
    public function update($where, $data)
    {
        return $this->model->where($where)->update($data);
    }

    /**
     * @param $where
     * @return mixed
     */
    public function deleteWhere($where)
    {
        return $this->model->where($where)->delete();
    }

    /**
     * @param $where
     * @return mixed
     */
    public function whereFirst($where)
    {
        return $this->model->where($where)->first();
    }

    /**
     * @param $where
     * @return mixed
     */
    public function whereLast($where)
    {
        return $this->model->where($where)->orderBy('id', 'desc')->first();
    }

    /**
     * @param $field
     * @param $array
     * @return mixed
     */
    public function whereIn($field, $array)
    {
        return $this->model->whereIn($field, $array)->get();
    }

    /**
     * @param $field
     * @param $array
     * @return mixed
     */
    public function whereNotIn($field, $array)
    {
        return $this->model->whereNotIn($field, $array)->get();
    }

    /**
     * @param $where
     * @param $field
     * @param string $order
     * @return mixed
     */
    public function orderByWhere($where, $field, $order='ASC')
    {
        return $this->model->where($where)->orderBy($field, $order)->get();
    }

    /**
     * @param $where
     * @param $field
     * @return mixed
     */
    public function groupByWhere($where, $field)
    {
        return $this->model->where($where)->get()->groupBy($field);
    }

    /**
     * @param $where
     * @return mixed
     */
    public function getWhere($where)
    {
        return $this->model->where($where)->get();
    }

    /**
     * @param $where
     * @param $quantity
     * @return mixed
     */
    public function getRandomlyWhere($where, $quantity)
    {
        return $this->model->where($where)->inRandomOrder()->limit($quantity)->get();
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * @return mixed
     */
    public function getAllQuery()
    {
        return $this->model->query();
    }

    /**
     * @param $where
     * @return mixed
     */
    public function getWhereQuery($where)
    {
        return $this->model->where($where);
    }

    /**
     * @param $where
     * @return mixed
     */
    public function countWhere($where)
    {
        return $this->model->where($where)->count();
    }

    /**
     * @param $field
     * @param $array
     * @return mixed
     */
    public function countWhereIn($field, $array)
    {
        return $this->model->whereIn($field, $array)->count();
    }

    /**
     * @param $where
     * @param $field
     * @return mixed
     */
    public function sumWhere($where, $field)
    {
        return $this->model->where($where)->sum($field);
    }

    /**
     * @param $where
     * @param $field
     * @return mixed
     */
    public function maxWhere($where, $field)
    {
        return $this->model->where($where)->max($field);
    }

    /**
     * @param $where
     * @param $field
     * @return mixed
     */
    public function pluckWhere($where, $field) {
        return $this->model->where($where)->pluck($field);
    }

    /**
     * @return mixed
     */
    public function paginate() {
        return $this->model->paginate(PAGINATE_MEDIUM);
    }

    /**
     * @param $where
     * @return mixed
     */
    public function paginateWhere($where) {
        return $this->model->where($where)->paginate(PAGINATE_SMALL);
    }

    /**
     * @param $field
     * @param $array
     * @return mixed
     */
    public function paginateWhereIn($field, $array)
    {
        return $this->model->whereIn($field, $array)->paginate(PAGINATE_MEDIUM);
    }
}
