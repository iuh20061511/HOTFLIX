<?php
class Controller extends Validate
{

    public function model($model)
    {
        require_once "./app/Models/" . $model . ".php";
        return new $model;
    }



    public function view($view, $data = [])
    {
        extract($data); //Đổi key mảng thành biến
        require_once "./app/Views/" . $view . ".php";
    }



    public function library($library, $data = [])
    {
        extract($data);
        require_once "./app/Library/" . $library;
    }
}
