<?php



class Product extends Controller
{
    private $data = [];
    private $model;

    public function __construct()
    {
        $this->model = $this->model('HomeModel');
    }

    public function index()
    {
        echo "sanpham";
    }

    public function list()
    {
        $this->data['d'] = 'okw';
        $this->data['sub']['con'] = $this->model->getList();
        $this->data['sub']['text'] = "Danh sách text";


        $this->data['content'] = 'home/homePage';

        $this->view("layout/client", $this->data);
    }

}