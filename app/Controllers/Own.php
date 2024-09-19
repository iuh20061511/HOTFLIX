<?php



class Own extends Controller
{

    private $model;

    private $data = [];


    public function __construct()
    {
        $this->model = $this->model('HomeModel');
    }
    public function index()
    {
        echo "ok";
    }

    public function detail($id, $a, $b)
    {
        echo $id;
        echo $a;
        echo $b;
        echo $_GET['a'];

    }

    public function details()
    {
        echo "ok";
    }



}