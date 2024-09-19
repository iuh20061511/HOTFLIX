<?php


class HomeModel
{

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
