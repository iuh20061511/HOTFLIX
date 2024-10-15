<?php


class HomeModel extends Model
{
    private $model;
    public function __construct()
    {
        $this->model = new Model();
    }
    protected $table = 'product';

    public function getList()
    {
        $data = [
            'item 1',
            'item 2',
            'item 3'
        ];
        return $data;
    }

}
