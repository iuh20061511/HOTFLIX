<?php
class InforUser extends Controller
{
    private $model;
    private $validate;
    private $accountmodel;
    private $giveTicket;

    private $data = [];
    private $ticket = [];


    public function __construct()
    {
        $this->model = $this->model('AccountModel');
        $this->validate = new Validate();
        $this->accountmodel = new AccountModel();
    }

    public function profileInfo()
    {
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



    public function transaction()
    {
        $this->data['sub']['title'] = "Lịch sử giao dịch";
        if (isset($_SESSION['is_login']['id_account'])) {
            $id_account = $_SESSION['is_login']['id_account'];
            $table = ($_SESSION['is_login']['id_role'] == 1) ? 'customer' : 'staff';
            // Lấy thông tin người dùng
            $this->data['sub']['user'] = $this->model->getListTable($table, "where id_{$table} = $id_account");

            $invoices = $this->model->getListFromTwoTables('invoice', 'invoice_detail', 'id_invoice', "where id_customer = $id_account ORDER BY invoice_detail.id_invoice DESC");
            $this->data['sub']['invoices'] = [];
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
            foreach ($this->data['sub']['invoices'] as $index => $invoice) {
                if (!empty($invoice['tickets'])) {
                    $firstTicket = $invoice['tickets'][0];
                    $id_room = $firstTicket['id_room'];
                    $id_showTime = $firstTicket['id_showTime'];
                    $infoCinema = $this->model->getListFromTwoTables('room', 'cinemas', 'id_cinema', "where id_room = $id_room");
                    $infoShowtime = $this->model->getListFromTwoTables('show_time', 'movie', 'id_movie', "where id_showTime = $id_showTime");
                    $id_roomType = $this->model->getListTable('room', "where id_room=" . $infoShowtime[0]['id_room'])[0]['id_roomType'];

                    $this->data['sub']['invoices'][$index]['show_date'] = $this->model->convertDayToVietnamese($infoShowtime[0]['show_date']);
                    $this->data['sub']['invoices'][$index]['movie_name'] = $infoShowtime[0]['movie_name'];
                    $this->data['sub']['invoices'][$index]['poster'] = $infoShowtime[0]['poster'];
                    $this->data['sub']['invoices'][$index]['id_movie'] = $infoShowtime[0]['id_movie'];
                    $this->data['sub']['invoices'][$index]['id_roomType'] = $id_roomType;
                    $this->data['sub']['invoices'][$index]['id_showTime'] = $infoShowtime[0]['id_showTime'];
                    $this->data['sub']['invoices'][$index]['start_time'] = $infoShowtime[0]['start_time'];
                    $this->data['sub']['invoices'][$index]['end_time'] = $infoShowtime[0]['end_time'];
                    $this->data['sub']['invoices'][$index]['format'] = $infoShowtime[0]['projection_format'];
                    $this->data['sub']['invoices'][$index]['room_name'] = $infoCinema[0]['room_name'];
                    $this->data['sub']['invoices'][$index]['cinema_name'] = $infoCinema[0]['cinema_name'];
                    $this->data['sub']['invoices'][$index]['address'] = $infoCinema[0]['address'];
                    $this->data['sub']['invoices'][$index]['double_seat_price'] = $infoShowtime[0]['double_seat_price'];
                    $this->data['sub']['invoices'][$index]['single_seat_price'] = $infoShowtime[0]['single_seat_price'];
                    $this->data['sub']['invoices'][$index]['vip_seat_price'] = $infoShowtime[0]['vip_seat_price'];
                    $this->data['sub']['invoices'][$index]['show_date_default'] = $infoShowtime[0]['show_date'];
                }
            }


            //danh sách thuê phòng
            $this->data['sub']['listInvoiceRoom'] = $this->model->getListFromThreeTables('invoice_room', 'room', 'room_type', 'id_room', 'id_roomType', "where id_customer = $id_account ORDER BY invoice_room.id_invoiceRoom DESC");
            foreach ($this->data['sub']['listInvoiceRoom'] as &$invoice) {
                $id_cinema = $invoice['id_cinema'];
                $InfoCinema = $this->model->getListTable('cinemas', "where id_cinema = $id_cinema");
                $invoice['cinema_name'] = $InfoCinema[0]['cinema_name'] ?? 'Unknown';
                $invoice['date_rent'] = $this->accountmodel->convertDayToVietnamese($invoice['date_rent']);
            }

            if (isset($_POST['giveTicket'])) {
                $email_sdt = $_POST['email_sdt'];
                $id_giveInvoice = $_POST['id_giveInvoice'];
                $member = $this->model->getListTable('customer', "where phone = '$email_sdt' or email = '$email_sdt'");
                $this->data['sub']['error'] = [];
                if (empty($_POST['email_sdt'])) {
                    $this->data['sub']['error']['email_sdt'] = 'Vui lòng nhập thông tin cần thiết!';
                }
                if (!empty($_POST['email_sdt']) && !$member) {
                    $this->data['sub']['error']['email_sdt'] = 'Không tìm thấy thành viên!';
                }
                if (empty($this->data['sub']['error'])) {
                    $data = [
                        'id_customer' => $member[0]['id_customer']
                    ];
                    $result = $this->model->updateData('invoice', $data, "where id_invoice = $id_giveInvoice");
                    if ($result) {
                        $this->ticket['link_invoice'] = _LINK . "/in-ve-$id_giveInvoice.html";
                        $this->ticket['fullnameSender'] = $this->data['sub']['user'][0]['full_name'];
                        $this->ticket['emailReceiver'] = $member[0]['email'];
                        if ($_SESSION['is_login']['id_role'] == 1) {
                            $this->library("PHPMailer/sendmailGiveTicket.php", $this->ticket);
                            header("refresh:0.5; url=" . _LINK . "/lich-su-giao-dich.html");
                        }
                    }
                }
            }
        } else {
            header("refresh:0.5; url=" . _LINK . "/dang-nhap.html");
            exit();
        }

        $this->getShowtimeList($id_movie = 0, $id_showTime, $double_seat_price = null, $single_seat_price = null, $vip_seat_price = null);
        $this->data['content'] = 'client/transaction';
        $this->view("layout/client", $this->data);
    }


    public function getShowtimeList($id_movie, $id_showTime, $double_seat_price = null, $single_seat_price = null, $vip_seat_price = null)
    {
        $data =  $this->model->getListFromThreeTables(
            'show_time',
            'room',
            'cinemas',
            'id_room',
            'id_cinema',
            "where show_time.id_movie = $id_movie AND 
        show_time.show_date > NOW() AND 
        show_time.id_showTime != $id_showTime AND
        show_time.double_seat_price = '$double_seat_price' AND
        show_time.single_seat_price = '$single_seat_price' AND
        show_time.vip_seat_price = '$vip_seat_price'
        ORDER BY show_date ASC, start_time ASC"
        );

        foreach ($data as $key => $value) {
            $id_showTime = $value['id_showTime'];
            $id_room = $value['id_room'];

            $rooms =   $this->model->getListFromTwoTables('room', 'room_type', 'id_roomType', "where room.id_room = $id_room");
            $seats =   $this->model->getListFromThreeTables('seats', 'room', 'room_type', 'id_room', 'id_roomType', "WHERE seats.id_showTime = $id_showTime");
            $totalSeatsSold = 0;

            foreach ($seats  as  $seat) {
                $totalSeatsSold++;
            }
            if (!empty($seats)) {
                $seatSaleRatio = $totalSeatsSold . '/' . $seats[0]['number_seat'];
            } else {
                $seatSaleRatio = 0 . '/' . $rooms[0]['number_seat'];
            }
            $data[$key]['seat'] = $seatSaleRatio;
        }
        return $data;
    }

    public function getListMyGift(){
        $this->data['sub']['title'] = "Danh sách quà tặng của tôi";
        $id_account = $_SESSION['is_login']['id_account'];
        // Lấy thông tin người dùng
        $this->data['sub']['user'] = $this->model->getListTable('customer', "where id_customer = $id_account");
        $pagination = $this->getPaginatedGifts($id_account, 4); // 4 items per page
        $this->data['sub']['listGiftDetails'] = $pagination['listGiftDetails'];
        $this->data['sub']['pagination'] = $pagination['pagination'];

        $this->data['content'] = 'client/myListGift';
        $this->view("layout/client", $this->data);
    }

    private function getPaginatedGifts($id_account, $itemsPerPage)
        {
            $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $offset = ($currentPage - 1) * $itemsPerPage;

            // Tính tổng số quà và số trang
            $totalGifts = count($this->model->getListFromTwoTables(
                'gift_details',
                'gifts',
                'id_gift',
                "where id_customer = $id_account ORDER BY id_giftDetails DESC"
            ));
            $totalPages = ceil($totalGifts / $itemsPerPage);

            // Lấy danh sách quà tặng theo trang
            $listGiftDetails = $this->model->getListFromTwoTables(
                'gift_details',
                'gifts',
                'id_gift',
                "where id_customer = $id_account ORDER BY id_giftDetails DESC LIMIT $itemsPerPage OFFSET $offset"
            );

            return [
                'listGiftDetails' => $listGiftDetails,
                'pagination' => [
                    'totalPages' => $totalPages,
                    'currentPage' => $currentPage,
                    'itemsPerPage' => $itemsPerPage,
                    'totalGifts' => $totalGifts,
                ],
            ];
        }
}
