<?php



class Account extends Controller
{

    private $model;
    private $validate;
    private $accountmodel;

    private $data = [];


    public function __construct()
    {
        $this->model = $this->model('AccountModel');
        $this->validate = new Validate();
        $this->accountmodel = new AccountModel();
    }

    public function login()
    {
        if (isset($_POST['btn_signin'])) {

            $this->data['error']['empty'] = $this->validate->checkEmpty($_POST['email'], $_POST['password']);

            if ($this->data['error']['empty'] == '') {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $user = $this->accountmodel->checkLogin($email, $password);

                if ($user) {
                    $_SESSION['is_login'] = true;
                    $_SESSION['is_login'] = [];
                    if ($user['id_role'] == 1) {
                        $_SESSION['is_login']['id_account'] = $user['id_customer'];
                        $_SESSION['is_login']['id_point'] = $user['points'];
                        $_SESSION['is_login']['id_rank'] = $user['id_rank'];
                    } else {
                        $_SESSION['is_login']['id_account'] = $user['id_staff'];
                    }

                    $_SESSION['is_login']['fullname'] = $user['full_name'];
                    $_SESSION['is_login']['email'] = $user['email'];
                    $_SESSION['is_login']['phone'] = $user['phone'];
                    $_SESSION['is_login']['birthday'] = $user['birthday'];
                    $_SESSION['is_login']['password'] = $user['password'];
                    $_SESSION['is_login']['gender'] = $user['gender'];
                    $_SESSION['is_login']['id_role'] = $user['id_role'];
                    $_SESSION['is_login']['name_role'] = $user['name_role'];
                    header("Location: trang-chu.html");
                    exit;
                }

                if (!$user) {
                    $this->data['error']['dangnhap'] = 'Email hoặc mật khẩu không chính xác!';
                }
            }
        }


        return $this->view('account/login', $this->data);
    }

    function logout()
    {
        unset($_SESSION['is_login']);
        $redirectUrl = _LINK;
        header("refresh:0; url=$redirectUrl");

    }

    public function register()
    {
        if (isset($_POST['btn_register'])) {
            $this->data['error']['email'] = $this->validate->checkEmail($_POST['email']);
            $this->data['error']['name'] = $this->validate->checkFullName($_POST['name']);
            $this->data['error']['birthday'] = $this->validate->checkDateOfBirth($_POST['birthday']);
            $this->data['error']['phone'] = $this->validate->checkPhone($_POST['phone']);
            $this->data['error']['gender'] = $this->validate->checkGender($_POST['gender']);
            $this->data['error']['password'] = $this->validate->checkPassword($_POST['password']);
            $this->data['error']['confirm_password'] = $this->validate->confirmPassword($_POST['confirm_password'], $_POST['password']);

            if (array_filter($this->data['error']) == []) {
                $data = [
                    'email' => $_POST['email'],
                    'full_name' => $_POST['name'],
                    'phone' => $_POST['phone'],
                    'birthday' => $_POST['birthday'],
                    'gender' => $_POST['gender'],
                    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                    'id_rank' => 1,
                    'id_role' => 1,
                    'status' => 0
                ];

                $result = $this->model->InsertData('customer', $data);
                if ($result) {
                    echo "<script>alert('đăng ký thành công')</script>";
                }
            }
        }
        return $this->view('account/register', $this->data);
    }

    public function forgot()
    {
        if (isset($_POST['submit'])) {

            $email = $_POST['email'];
            $this->data['error']['email'] = $this->validate->checkEmail($email, false, true);
            if (array_filter($this->data['error']) == []) {
                $user = $this->accountmodel->checkEmail($email);
                if ($user) {
                    $token = bin2hex(random_bytes(32));
                    $updates = [
                        'reset_token' => "$token",
                        'token_expiration' => date("Y-m-d H:i:s", strtotime('+15 minutes'))
                    ];
                    $result = $this->accountmodel->updateToken($updates, $email);
                    if ($result) {
                        require_once __DIR__ . '/../Library/PHPMailer/sendmail.php';
                        $this->data['result']['success'] = "Email đã được gửi, vui lòng kiểm tra email !";
                    }
                } else {
                    $this->data['error']['email'] = "email không tồn tại";
                }
            }


        }
        return $this->view('account/forgotPassword', $this->data);
    }


    public function reset()
    {
        $checktoken = $this->accountmodel->checkToken($_GET['token']);
        if ($checktoken) {
            if (isset($_POST['submit'])) {
                $this->data['error']['password'] = $this->validate->checkPassword($_POST['password']);
                $this->data['error']['confirmPassword'] = $this->validate->confirmPassword($_POST['confirmPassword'], $_POST['password']);
                if (array_filter($this->data['error']) == []) {

                    if ($_POST['csrf_token'] == $_SESSION['csrf_token']) {
                        $updates = [
                            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                            'reset_token' => ''
                        ];
                        $result = $this->accountmodel->resetPassword($updates, $_GET['token']);
                        if ($result) {
                            echo "<script>alert('Khôi phục mật khẩu thành công! Vui lòng đăng nhập lại');</script>";
                            header("refresh:0; url=dang-nhap.html");

                        } else {
                            echo "<script>alert('Khôi phục mật khẩu thất bại !);</script>";

                        }
                    } else {
                        echo "<script>alert('Yêu cầu không hợp lệ.');</script>";

                    }
                }
            }
            return $this->view('account/resetPassword', $this->data);

        } else {
            return $this->view('errors/403', $this->data);

        }

    }

}