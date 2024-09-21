<?php
class Rooms extends Controller
{

    private $model;

    private $data = [];

    public function __construct()
    {
        $this->model = $this->model('HomeModel');
    }
    public function index()
    {
        $this->data['sub']['title'] = "Trang Admin";

        $this->data['content'] = 'admin/rooms/listRoom';

        $this->view("layout/admin", $this->data);

    }

    public function new($id)
    {

        echo $id;

    }

    public function ok()
    {

        echo "p";

    }

    public function pages()
    {


    }


}