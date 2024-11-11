<?php
    class InforUser extends Controller
    {
        private $model;
        private $validate;
        private $accountmodel;
        private $giveTicket;

        private $data = [];

        public function __construct()
        {
            $this->model = $this->model('AccountModel');
            $this->validate = new Validate();
            $this->accountmodel = new AccountModel();
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
                            header("refresh:0.5; url=dang-xuat.html");
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
                    $invoice['show_date_default']=$infoShowtime[0]['show_date'];
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

            if (isset($_POST['giveTicket'])) {
                $email_sdt=$_POST['email_sdt'];
                $id_giveInvoice = $_POST['id_giveInvoice'];
                $member = $this->model->getListTable('customer', "where phone = '$email_sdt' or email = '$email_sdt'");
                $this->data['sub']['error']=[];
                if(empty($_POST['email_sdt'])){
                    $this->data['sub']['error']['email_sdt'] = 'Vui lòng nhập thông tin cần thiết!';
                }
                if(!empty($_POST['email_sdt'])&& !$member){
                        $this->data['sub']['error']['email_sdt'] = 'Không tìm thấy thành viên!';
                }
                if(empty($this->data['sub']['error'])){
                    $data = [
                        'id_customer' => $member[0]['id_customer']
                    ];
                    $result = $this->model->updateData('invoice', $data, "where id_invoice = $id_giveInvoice");
                    if ($result) {
                        $this->ticket['link_invoice'] = _LINK . "/in-ve-$id_giveInvoice.html";
                        $this->ticket['fullnameSender'] =$this->data['sub']['user'][0]['full_name'];
                        $this->ticket['emailReceiver'] = $member[0]['email'];
                        if ($_SESSION['is_login']['id_role'] == 1) {
                            $this->library("PHPMailer/sendmailGiveTicket.php", $this->ticket);
                            header("refresh:0.5; url=" . _LINK . "/lich-su-giao-dich.html");
                        }
                    }
                }
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
?>