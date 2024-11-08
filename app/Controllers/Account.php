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
                        $_SESSION['is_login']['id_cinema'] = $user['id_cinema'];
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
        session_destroy();
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
                $token = bin2hex(random_bytes(32));
                $data = [
                    'email' => $_POST['email'],
                    'full_name' => $_POST['name'],
                    'phone' => $_POST['phone'],
                    'birthday' => $_POST['birthday'],
                    'gender' => $_POST['gender'],
                    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                    'id_rank' => 1,
                    'id_role' => 1,
                    'status' => 0,
                    'reset_token' => "$token",
                    'token_expiration' => date("Y-m-d H:i:s", strtotime('+6 hours')),

                ];

                $result = $this->model->InsertData('customer', $data);
                if ($result) {
                    $email = $_POST['email'];
                    require_once __DIR__ . '/../Library/PHPMailer/sendmailRegister.php';
                    return $this->view('account/notifyRegister');
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
                            'reset_token' => '',
                            'token_expiration' => ''
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

    public function verify()
    {
        $checktoken = $this->accountmodel->checkToken($_GET['token']);
        if ($checktoken) {
            $updates = [
                'reset_token' => '',
                'token_expiration' => '',
                'status' => 1
            ];
            $result = $this->accountmodel->verifyAccount($updates, $_GET['token']);
            if ($result) {
                header("refresh:0; url=dang-nhap.html");
            }
        } else {
            return $this->view('errors/403', $this->data);
        }
    }

    public function profileInfo() {
        $this->data['sub']['title'] = "Trang thông tin người dùng";

        // Kiểm tra đăng nhập
        if (isset($_SESSION['is_login']['id_account'])) {
            $id_account = $_SESSION['is_login']['id_account'];
            $table = ($_SESSION['is_login']['id_role'] == 1) ? 'customer' : 'staff';

            // Lấy thông tin người dùng
            $this->data['sub']['user'] = $this->model->getListTable($table, "where id_{$table} = $id_account");
            // Xử lý cập nhật thông tin cá nhân
            if (isset($_POST['updateInfor'])) {
                $this->data['sub']['error']['fullname'] = $this->validate->checkFullName($_POST['fullname']);
                $this->data['sub']['error']['phone'] = $this->validate->checkPhone($_POST['phone'], true, false, $id_account);
                if (empty(array_filter($this->data['sub']['error']))) {
                    $data = [
                        'full_name' => $_POST['fullname'],
                        'phone' => $_POST['phone'],
                        'gender' => $_POST['gender'],
                    ];
                    $result = $this->model->updateData($table, $data, "where id_{$table} = $id_account");
                    if ($result) {
                        echo "<script>alert('Cập nhật thông tin cá nhân thành công');</script>";
                        header("refresh:0.5; url=thong-tin-tai-khoan.html");
                        exit();
                    }
                }
            }
            // Xử lý đổi mật khẩu
            if (isset($_POST['changePassword'])) {
                $oldPassword = $this->data['sub']['user'][0]['password'];
                $this->data['sub']['error']['oldpass'] = $this->validate->checkOldPassword($_POST['oldpass'], $oldPassword);
                $this->data['sub']['error']['newPassword'] = $this->validate->checkNewPassword($_POST['newPassword'], $oldPassword);
                $this->data['sub']['error']['confirmPassword'] = $this->validate->confirmPassword($_POST['confirmPassword'], $_POST['newPassword']);
                if (empty(array_filter($this->data['sub']['error']))) {
                    $data = [
                        'password' => password_hash($_POST['newPassword'], PASSWORD_DEFAULT),
                    ];
                    $result = $this->model->updateData($table, $data, "where id_{$table} = $id_account");
                    if ($result) {
                        echo "<script>alert('Đổi mật khẩu thành công, vui lòng đăng nhập lại');</script>";
                        $this->logout();
                    }
                }
            }
        } else {
            header("refresh:0.5; url=" . _LINK . "/dang-nhap.html");
            exit();
        }
        $this->data['content'] = 'client/profile';
        $this->view("layout/client", $this->data);
    }

    public function transaction(){
        $this->data['sub']['title'] = "Lịch sử giao dịch";
        if (isset($_SESSION['is_login']['id_account'])) {
            $id_account = $_SESSION['is_login']['id_account'];
            $table = ($_SESSION['is_login']['id_role'] == 1) ? 'customer' : 'staff';
            // Lấy thông tin người dùng
            $this->data['sub']['user'] = $this->model->getListTable($table, "where id_{$table} = $id_account");

            $invoices = $this->model->getListFromTwoTables('invoice','invoice_detail','id_invoice', "where id_customer = $id_account ORDER BY invoice_detail.id_invoice DESC" );
            $this->data['sub']['invoices']=[];
            foreach ($invoices as $item) {
                $id_invoice = $item['id_invoice'];
                // Nếu chưa tồn tại id_invoice trong mảng kết quả thì khởi tạo
                if (!isset($this->data['sub']['invoices'][$id_invoice])) {
                    // Sao chép thông tin chung của hóa đơn vào phần tử mới
                    $this->data['sub']['invoices'][$id_invoice] = [
                        'id_invoice' => $item['id_invoice'],
                        'id_customer' => $item['id_customer'],
                        'create_date' => $item['create_date'],
                        'total_amount' => $item['total_amount'],
                        'discount_total' => $item['discount_total'],
                        'final_total' => $item['final_total'],
                        'payment_method' => $item['payment_method'],
                        'name_customer' => $name_customer,
                        'tickets' => [],
                        'items' => [],
                    ];
                }
                // Nạp dữ liệu cho vé hoặc item ngay trong vòng lặp này
                if (!empty($item['id_ticket'])) {
                    $id_ticket = $item['id_ticket'];
                    $ticketDetails = $this->model->getListFromTwoTables('tickets', 'seats', 'id_seat', "where id_ticket='$id_ticket'");
                    $this->data['sub']['invoices'][$id_invoice]['tickets'][] = [
                        'id_ticket' => $item['id_ticket'],
                        'quantity' => $item['quantity'],
                        'location' => $ticketDetails[0]['location'],
                        'check_in' => $ticketDetails[0]['check_in'],
                        'qrcode' => $ticketDetails[0]['qrcode'],
                        'id_showTime' => $ticketDetails[0]['id_showTime'],
                        'id_room' => $ticketDetails[0]['id_room'],
                        'price' => $ticketDetails[0]['price'],
                    ];
                }
                if (!empty($item['id_item'])) {
                    $id_item = $item['id_item'];
                    $itemDetails = $this->model->getListTable('menu_items', "where id_item='$id_item'");
                    $this->data['sub']['invoices'][$id_invoice]['items'][] = [
                        'id_item' => $item['id_item'],
                        'quantity' => $item['quantity'],
                        'item_name' => $itemDetails[0]['item_name'],
                        'price' => $itemDetails[0]['price'],
                        'description' => trim($itemDetails[0]['description']),
                        'image' => $itemDetails[0]['image'],
                    ];
                }
            }
            //Nạp thông tin chung
            foreach ($this->data['sub']['invoices'] as &$invoice) {
                // Kiểm tra nếu tồn tại vé trong hóa đơn
                if (!empty($invoice['tickets'])) {
                    // Lấy vé đầu tiên
                    $firstTicket = $invoice['tickets'][0];
                    $id_room = $firstTicket['id_room'];
                    $id_showTime = $firstTicket['id_showTime'];
                    $infoCinema = $this->model->getListFromTwoTables('room','cinemas','id_cinema', "where id_room = $id_room" );
                    $infoShowtime = $this->model->getListFromTwoTables('show_time','movie','id_movie', "where id_showTime = $id_showTime" );
                    $invoice['show_date']= $this->model->convertDayToVietnamese($infoShowtime[0]['show_date']);
                    $invoice['movie_name']=$infoShowtime[0]['movie_name'];
                    $invoice['poster']=$infoShowtime[0]['poster'];
                    $invoice['start_time']=$infoShowtime[0]['start_time'];
                    $invoice['end_time']=$infoShowtime[0]['end_time'];
                    $invoice['format']=$infoShowtime[0]['projection_format'];
                    $invoice['room_name']=$infoCinema[0]['room_name'];
                    $invoice['cinema_name']=$infoCinema[0]['cinema_name'];
                    $invoice['address']=$infoCinema[0]['address'];
                }
            }

            //danh sách thuê phòng
            $this->data['sub']['listInvoiceRoom'] = $this->model->getListFromThreeTables('invoice_room','room','room_type','id_room','id_roomType', "where id_customer = $id_account ORDER BY invoice_room.id_invoiceRoom DESC" );
            foreach ($this->data['sub']['listInvoiceRoom'] as &$invoice) {
                $id_cinema = $invoice['id_cinema'];
                $InfoCinema = $this->model->getListTable('cinemas', "where id_cinema = $id_cinema");
                $invoice['cinema_name'] = $InfoCinema[0]['cinema_name'] ?? 'Unknown';
                $invoice['date_rent'] = $this->accountmodel->convertDayToVietnamese( $invoice['date_rent']);
            }
        }
        else {
            header("refresh:0.5; url=" . _LINK . "/dang-nhap.html");
            exit();
        }

        $this->data['content'] = 'client/transaction';
        $this->view("layout/client", $this->data);
    }
}
