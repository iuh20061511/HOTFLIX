<?php
class UsersController extends Controller
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

        $this->data['content'] = 'admin/users/listUser';

        $this->view("layout/admin", $this->data);
    }


    public function addNewUser()
    {
        $this->data['sub']['title'] = "Trang thêm mới nhân viên";

        $this->data['content'] = 'admin/users/addUser';

        $this->view("layout/admin", $this->data);

    }

    public function updateUser()
    {

        $this->data['sub']['title'] = "Trang thêm mới nhân viên";

        $this->data['content'] = 'admin/users/updateUser';

        $this->view("layout/admin", $this->data);

    }

    public function ok()
    {

        echo "p";

    }

    public function pages()
    {


    }


}