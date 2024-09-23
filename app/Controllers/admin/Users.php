<?php
class Users extends Controller
{

    private $model;
    private $validate;

    private $data = [];

    public function __construct()
    {
        $this->model = $this->model('AdminModel');
        $this->validate = new Validate();
    }

    public function index()
    {
        $this->data['sub']['title'] = "Trang Danh sách Nhân viên";

        $this->data['content'] = 'admin/users/listUser';
        $this->data['sub']['listStaff'] = $this->model->getListStaff();
        $this->view("layout/admin", $this->data);
    }

    public function listMembers()
    {
        $this->data['sub']['title'] = "Trang Danh sách Thành viên";

        $this->data['content'] = 'admin/users/listMember';
        $this->data['sub']['listMember'] = $this->model->getListMember();
        $this->view("layout/admin", $this->data);
    }

    public function addNewStaff()
    {
        $this->data['sub']['title'] = "Trang thêm mới nhân viên";

        $this->data['content'] = 'admin/users/addUser';
        $this->data['sub']['listRole'] = $this->model->getListTable('role');
        $this->data['sub']['listCinema'] = $this->model->getListTable('cinemas');

        if (isset($_POST['addUser'])) {
            $this->data['sub']['error']['email'] = $this->validate->checkEmail($_POST['email']);
            $this->data['sub']['error']['fullname'] = $this->validate->checkFullName($_POST['fullname']);
            $this->data['sub']['error']['birthday'] = $this->validate->checkDateOfBirth($_POST['birthday']);
            $this->data['sub']['error']['role'] = $this->validate->checkSelect($_POST['role']);
            $this->data['sub']['error']['cinema'] = $this->validate->checkSelect($_POST['cinema']);
            $this->data['sub']['error']['phone'] = $this->validate->checkPhone($_POST['phone']);

            if (array_filter($this->data['sub']['error']) == []) {
                $this->data['fullname'] = $_POST['fullname'];
                $this->data['email'] = $_POST['email'];
                $this->data['phone'] = $_POST['phone'];
                $this->data['role'] = $_POST['role'];
                $this->data['birthday'] = $_POST['birthday'];
                $this->data['cinema'] = $_POST['cinema'];
                $this->data['phone'] = $_POST['phone'];
                $this->data['password'] = '123456';
                $data = [
                    'email' => $_POST['email'],
                    'full_name' => $_POST['fullname'],
                    'phone' => $_POST['phone'],
                    'birthday' => $_POST['birthday'],
                    'gender' => $_POST['gender'],
                    'password' => password_hash('123456', PASSWORD_DEFAULT),
                    'id_cinema' => $_POST['cinema'],
                    'id_role' => $_POST['role'],
                ];

                $result = $this->model->InsertData('staff', $data);
                if ($result) {
                    echo "<script>alert('Đăng ký thành công')</script>";
                }
            }
        }

        $this->view("layout/admin", $this->data);

    }

    public function updateStaff($id_staff)
    {
        $this->data['sub']['title'] = "Cập nhật thông tin nhân viên";
        $this->data['sub']['infoStaff'] = $this->model->infoStaff($id_staff);
        $this->data['sub']['listCinema'] = $this->model->getListTable('cinemas');
        $this->data['sub']['listRole'] = $this->model->getListTable('role');

        if (isset($_POST['updateUser'])) {
            $this->data['sub']['error']['fullname'] = $this->validate->checkFullName($_POST['fullname']);
            $this->data['sub']['error']['birthday'] = $this->validate->checkDateOfBirth($_POST['birthday']);
            $this->data['sub']['error']['role'] = $this->validate->checkSelect($_POST['role']);
            $this->data['sub']['error']['cinema'] = $this->validate->checkSelect($_POST['cinema']);
            $this->data['sub']['error']['phone'] = $this->validate->checkPhone($_POST['phone'],true, false, $id_staff);

            if (array_filter($this->data['sub']['error']) == []) {
                $data = [
                    'full_name' => $_POST['fullname'],
                    'phone' => $_POST['phone'],
                    'birthday' => $_POST['birthday'],
                    'gender' => $_POST['gender'],
                    'id_cinema' => $_POST['cinema'],
                    'id_role' => $_POST['role'],
                ];

                $result = $this->model->updateData('staff', $data, "where id_staff = $id_staff");
                if ($result) {
                    echo "<script>alert('Cập nhật thành công')</script>";
                }
            }
        }

        $this->data['content'] = 'admin/users/updateUser';

        $this->view("layout/admin", $this->data);

    }

    public function deleteStaff()
    {
        $this->data['sub']['title'] = "Xóa nhân viên";
        if(isset($_POST['deleteUser'])){
            if (isset($_POST['id_staff'])) {
                $id_staff = $_POST['id_staff'];
                $result = $this->model->deleteData('staff', "where id_staff = $id_staff");
                    if ($result) {
                        echo "<script>alert('Xóa thành công')</script>";
                        $redirectUrl ="quan-ly-tai-khoan.html";
                        header("refresh:0.5; url=$redirectUrl");
                    }
            }
        }

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