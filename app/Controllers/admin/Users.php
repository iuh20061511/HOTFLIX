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

        $itemsPerPage = 5;
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;


        $totalStaff = count($this->model->getListTable('staff'));
        $condition = '';
        if (isset($_GET['role'])) {
            if ($_GET['role'] != 0) {
                $role = $_GET['role'];
                $condition = "WHERE staff.id_role  = $role";
                $totalStaff = count($this->model->getListTable('staff',  $condition));
            }
        }
        $totalPages = ceil($totalStaff / $itemsPerPage);


        $offset = ($currentPage - 1) * $itemsPerPage;

        $this->data['sub']['listStaff'] = $this->model->getListStaff("$condition LIMIT 5 OFFSET $offset");
        $this->data['sub']['listCinema'] = $this->model->getListTable('cinemas');


        foreach ($this->data['sub']['listStaff'] as &$staff) {
            if ($staff['id_cinema'] === null) {
                $staff['cinema_name'] = 'Hệ thống Rạp';
            } else {
                $cinemaName = null;
                foreach ($this->data['sub']['listCinema'] as $cinema) {
                    if ($cinema['id_cinema'] == $staff['id_cinema']) {
                        $cinemaName = $cinema['cinema_name'];
                    }
                }

                $staff['cinema_name'] = $cinemaName ? $cinemaName : 'Rạp không xác định';
            }
        }

        $this->data['sub']['pagination'] = [
            'totalPages' => $totalPages,
            'currentPage' => $currentPage,
            'itemsPerPage' => $itemsPerPage,
            'totalStaff' => $totalStaff,
        ];

        $this->data['content'] = 'admin/users/listUser';
        $this->view("layout/admin", $this->data);
    }


    public function listMembers()
    {
        $this->data['sub']['title'] = "Trang Danh sách Thành viên";
        // Thiết lập phân trang
        $itemsPerPage = 5; // Số nhân viên trên mỗi trang
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Trang hiện tại, mặc định là 1

        // Tổng số nhân viên và tính tổng số trang
        $totalStaff = count($this->model->getListTable('customer')); // Hàm để đếm tổng số nhân viên
        $totalPages = ceil($totalStaff / $itemsPerPage);

        // Lấy danh sách nhân viên theo trang hiện tại
        $offset = ($currentPage - 1) * $itemsPerPage;
        $this->data['sub']['listMember'] = $this->model->getListMember("LIMIT 5 OFFSET $offset");

        // Thêm thông tin phân trang vào $this->data để sử dụng trong view
        $this->data['sub']['pagination'] = [
            'totalPages' => $totalPages,
            'currentPage' => $currentPage,
            'itemsPerPage' => $itemsPerPage,
            'totalStaff' => $totalStaff,
        ];

        $this->data['content'] = 'admin/users/listMember';
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
            if ($_POST['role'] != 2 && $_POST['role'] != 6) {
                $this->data['sub']['error']['cinema'] = $this->validate->checkSelect($_POST['cinema']);
            }
            $this->data['sub']['error']['phone'] = $this->validate->checkPhone($_POST['phone']);

            if (array_filter($this->data['sub']['error']) == []) {
                $data = [
                    'email' => $_POST['email'],
                    'full_name' => $_POST['fullname'],
                    'phone' => $_POST['phone'],
                    'birthday' => $_POST['birthday'],
                    'gender' => $_POST['gender'],
                    'password' => password_hash('123456', PASSWORD_DEFAULT),
                    'id_role' => $_POST['role'],
                    'status' => 1
                ];

                if ($_POST['role'] != 2 && $_POST['role'] != 6) {
                    $data['id_cinema'] = $_POST['cinema'];
                }

                $result = $this->model->InsertData('staff', $data);
                if ($result) {
                    echo "<script>alert('Thêm nhân viên thành công')</script>";
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
            if ($_POST['role'] != 2 && $_POST['role'] != 6) {
                $this->data['sub']['error']['cinema'] = $this->validate->checkSelect($_POST['cinema']);
            }
            $this->data['sub']['error']['phone'] = $this->validate->checkPhone($_POST['phone'], true, false, $id_staff);

            if (array_filter($this->data['sub']['error']) == []) {
                $data = [
                    'full_name' => $_POST['fullname'],
                    'phone' => $_POST['phone'],
                    'birthday' => $_POST['birthday'],
                    'gender' => $_POST['gender'],
                    'id_role' => $_POST['role'],
                ];

                if ($_POST['role'] != 2 && $_POST['role'] != 6) {
                    $data['id_cinema'] = $_POST['cinema'];
                } elseif ($_POST['role'] == 2 || $_POST['role'] == 6) {
                    $data['id_cinema'] = NULL;
                }
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
        if (isset($_POST['deleteUser'])) {
            if (isset($_POST['id_staff'])) {
                $id_staff = $_POST['id_staff'];
                $result = $this->model->deleteData('staff', "where id_staff = $id_staff");
                if ($result) {
                    echo "<script>alert('Xóa thành công')</script>";
                    $redirectUrl = "quan-ly-tai-khoan.html";
                    header("refresh:0.5; url=$redirectUrl");
                }
            }
        }
    }
}
