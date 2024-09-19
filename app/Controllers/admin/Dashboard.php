<?php




class Dashboard extends Controller
{
    private $model;

    private $data = [];


    public function __construct()
    {
        // echo 'oooksowjoejd';
    }
    public function index()
    {
        $this->data['sub']['title'] = "Trang Admin Dashboard";

        $this->data['content'] = 'admin/dashboard/dashboard';

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