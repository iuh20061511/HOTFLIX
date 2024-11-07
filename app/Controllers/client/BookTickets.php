<?php



class BookTickets extends Controller
{


    private $model;
    private $accountmodel;
    private $data = [];
    private $ticket = [];


    public function __construct()
    {
        $this->model = $this->model('HomeModel');
        $this->accountmodel = $this->model('AccountModel');
        $currentTime = date('Y-m-d H:i:s');
        $this->model->deleteData('seats', "where hold_expiry <= '$currentTime' AND status = 0 ");
    }

    public function book($id_movie)
    {
        $this->data['sub']['text'] = "Chi tiết phim";
        $this->data['sub']['movieDetail'] = $this->model->getListTable('movie', "where id_movie=$id_movie");
        $this->data['sub']['listShowing'] = $this->model->getListTable('movie', "where status=1 and id_movie!=$id_movie");
        $this->data['sub']['listCinema'] = $this->model->getListTable('cinemas', "ORDER BY id_cinema asc");
        $id_cinema_default = isset($_GET['select-cinema']) ? $_GET['select-cinema'] : $this->data['sub']['listCinema'][0]['id_cinema'];
        $showtimes = $this->model->getListFromThreeTables('show_time', 'room', 'cinemas', 'id_room', 'id_cinema', "where cinemas.id_cinema=$id_cinema_default and id_movie=$id_movie");
        $showtimesByDate = [];
        foreach ($showtimes as $showtime) {
            $showtimesByDate[$showtime['show_date']][$showtime['projection_format']][] = $showtime;
        }
        $this->data['sub']['listShowTime'] = $showtimesByDate;
        $this->data['sub']['selectedCinema'] = $id_cinema_default;
        $this->data['sub']['cinemas'] = $this->model->getListTable('cinemas');
        if (isset($_GET['id_cinema'])) {
            $id_cinema = $_GET['id_cinema'];
        } else {
            $id_cinema = $_SESSION['id_cinema_customer'];
        }
        $day = $_GET['day'];
        $this->data['sub']['show_time'] = $this->model->getListFromThreeTables('room', 'show_time', 'movie', 'id_room', 'id_movie', "where room.id_cinema = $id_cinema and show_time.show_date= '$day' and show_time.id_movie= $id_movie");
        $this->data['content'] = 'home/BookTickets';
        $this->view("layout/client", $this->data);
    }


    public function selectSeat()
    {
        $rooms = $this->model->getListTable('room');
        $id_movie = $_GET['id_movie'];
        $this->data['sub']['id_movie'] = $id_movie;

        $id_showTime = $_GET['id_showTime'];
        $this->data['sub']['id_showTime'] = $id_showTime;
        $id_room = $_GET['id_room'];
        $this->data['sub']['id_room'] =  $id_room;
        $this->data['sub']['seats_buy'] = $this->model->getListTable("seats", "WHERE id_showTime=$id_showTime");

        $this->data['sub']['movie'] = $this->model->getListFromTwoTables('movie', 'show_time', 'id_movie', "where show_time.id_movie = $id_movie and show_time.id_showTime  =  $id_showTime");
        $this->data['sub']['cinema'] = $this->model->getListFromTwoTables('room', 'cinemas', 'id_cinema', "where room.id_room = $id_room");
        foreach ($rooms as $room) {
            if ($room['id_room'] == $_GET['id_room']) {
                if ($room['id_roomType'] == 1) {
                    $this->data['content'] = 'home/room/roomVip';
                } elseif ($room['id_roomType'] == 2) {
                    $this->data['content'] = 'home/room/roomSmall';
                } elseif ($room['id_roomType'] == 3) {
                    $this->data['content'] = 'home/room/roomAgv';
                } elseif ($room['id_roomType'] == 4) {
                    $this->data['content'] = 'home/room/roomBig';
                }
            }
        }

        if (isset($_POST['btn_inforCus'])) {
            $info = $_POST['info'];
            $customer = $this->model->getListTable("customer", "WHERE phone= '$info' OR email = '$info'");
            if ($customer) {
                $this->data['sub']['check'] = true;
                $_SESSION['infor_id_customer'] =  $customer[0]['id_customer'];
            } else {
                $this->data['sub']['error'] = "Thông tin sai hoặc khách hàng chưa đăng ký tài khoản";
            }
        }

        $this->data['sub']['text'] = "Danh sách text";
        $this->view("layout/client", $this->data);
    }


    public function chooseFood()
    {

        if (isset($_POST['seat'])) {

            $this->data['content'] = 'home/book';
            $this->data['sub']['text'] = "Danh sách text";
            $this->data['sub']['movie_name']  = $_POST['movie_name'];
            $this->data['sub']['image']  = $_POST['image'];
            $this->data['sub']['cinema']  = $_POST['cinema'];
            $this->data['sub']['projection_format']  = $_POST['projection_format'];
            $this->data['sub']['time']  = $_POST['time'];
            $this->data['sub']['total']  = $_POST['total'];
            $this->data['sub']['id_showtime']  = $_POST['id_showtime'];
            $this->data['sub']['id_movie']  = $_POST['id_movie'];
            $this->data['sub']['id_room']  = $_POST['id_room'];

            $total =  $this->data['sub']['total'];
            $this->data['sub']['items']  = $this->model->getListTable('menu_items');
            $filteredData = [];
            foreach ($_POST['seat'] as $key => $value) {
                if (is_string($key)) {
                    $filteredData[$key] = $value;
                }
            }
            foreach ($filteredData as $seat => $value) {
                $data = [
                    'location' => $seat,
                    'id_room' => $_POST['id_room'],
                    'hold_expiry' => date("Y-m-d H:i:s", strtotime("+6 minutes")),
                    'id_showTime' => $_POST['id_showtime'],
                    'price' => $value['price'],
                    'status' => 0

                ];

                $this->model->InsertData('seats', $data);
            }

            $seats = '';
            foreach ($filteredData as $seat => $value) {
                $seats .= $seat . ', ';
            }

            $this->data['sub']['seats']  = $seats;

            $this->view("layout/client", $this->data);
        } else {
            $redirectUrl = "chon-ghe.html";
            header("refresh:0.5; url=$redirectUrl");
        }
    }


    public function pay()
    {

        $this->data['sub']['id_showtime']  = $_POST['id_showtime'];
        $this->data['sub']['id_movie']  = $_POST['id_movie'];
        $this->data['sub']['id_room']  = $_POST['id_room'];
        $this->data['sub']['movie_name']  = $_POST['movie_name'];
        $this->data['sub']['image']  = $_POST['image'];
        $this->data['sub']['cinema']  = $_POST['cinema'];
        $this->data['sub']['projection_format']  = $_POST['projection_format'];
        $this->data['sub']['time']  = $_POST['time'];
        $this->data['sub']['seats']  = $_POST['seats'];
        $this->data['sub']['total']  = $_POST['total'];
        $this->data['sub']['item']  = $_POST['item'];

        $seats = explode(', ', rtrim($_POST['seats'], ', '));

        $id_showTime = $_POST['id_showtime'];

        foreach ($seats as $seat) {
            $res = $this->model->getListTable('seats', "WHERE location = '$seat' AND id_showTime = $id_showTime");
            if (!$res) {
                $redirectUrl = _LINK;
                header("refresh:0; url=$redirectUrl");
            }
        }


        $this->data['content'] = 'home/pay';
        $this->view("layout/client", $this->data);
    }

    public function proceedPay()
    {

        $check = false;

        $seats = explode(', ', rtrim($_POST['seats'], ', '));
        $id_room = $_POST['id_room'];
        $id_showtime = $_POST['id_showtime'];
        foreach ($seats as $seat) {
            $res = $this->model->getListTable('seats', "WHERE location = '$seat' AND id_showTime = $id_showtime");
            if (!$res) {
                $redirectUrl = _LINK;
                header("refresh:0; url=$redirectUrl");
                $check =  false;
            } else {
                $check = true;
            }
        }
        if ($check == true) {
            $seat_array = array();
            $id_seat = array();
            $i = 0;
            foreach ($seats as $seat) {
                $seat_array[] = $this->model->getListTable('seats', "where location = '$seat' and id_room = $id_room");
                $id_seat[] = $seat_array[$i][0]['id_seat'];
                $i++;
            }

            $id_tickets = array();
            $moneyNumber = (int)str_replace(['.', ' ₫'], '', $_POST['total']);
            $id_showtime = $_POST['id_showtime'];
            $showtime = $this->model->getListTable('show_time', "where id_showtime = $id_showtime ");
            $date = $showtime[0]['show_date'] . ' ' . $showtime[0]['end_time'];


            $_SESSION['payment_data'] = [
                'id_seat' => $id_seat,
                'id_showtime' => $id_showtime,
                'id_tickets' => $id_tickets,
                'date' => $date,
                'moneyNumber' => $moneyNumber,
                'invoice_data' => array_merge(
                    [
                        'create_date' => date('Y-m-d H:i:s'),
                        'total_amount' => $moneyNumber,
                        'discount_total' => 1,
                        'final_total' => $moneyNumber * 1,
                        'payment_method' => ($_SESSION['is_login']['id_role'] == 1) ? 'Online' : 'Tại quầy',
                    ],
                    isset($_SESSION['is_login']['id_role']) && $_SESSION['is_login']['id_role'] == 1
                        ? ['id_customer' => $_SESSION['is_login']['id_account']]
                        : (isset($_SESSION['infor_id_customer'])
                            ? ['id_customer' => $_SESSION['infor_id_customer']]
                            : [])
                ),
                'id_items' => $_POST['id_item']
            ];



            $this->data['moneyNumber'] =  $moneyNumber;

            if (isset($_POST['payment'])) {

                if ($_POST['payment'] == 'momo') {
                    $this->library('PayOnline/QRmomo.php', $this->data);
                } elseif ($_POST['payment'] == 'ATM') {
                    $this->library('PayOnline/Momo.php', $this->data);
                }
            }

            $redirectUrl = "thanh-toan-thanh-cong.html";
            header("refresh:0.5; url=$redirectUrl");
        }
    }


    public function success()
    {

        if (isset($_SESSION['payment_data'])) {
            $payment_data = $_SESSION['payment_data'];
            $id_seat = $payment_data['id_seat'];
            $id_showtime = $payment_data['id_showtime'];
            $id_tickets = $payment_data['id_tickets'];
            $date = $payment_data['date'];
            $invoice_data = $payment_data['invoice_data'];
            $id_items = $payment_data['id_items'];
            foreach ($id_seat as $id) {
                $name = date("Y-m-d-h-i-s") . '_' . "$id_showtime" . "_$id" . '.png';
                $data = [
                    'id_seat' => $id,
                    'id_showtime' => $id_showtime,
                    'qrcode' => "$name"
                ];
                $hold_expiry = [
                    'hold_expiry' => $date,
                    'status' => 1
                ];

                $this->model->InsertData('tickets', $data);
                unset($_SESSION['infor_id_customer']);

                // -------------------------QR-----------------------
                $this->library("PHPQR/qrlib.php");

                $text = _LINK . "/kiem-tra-ve-$id-$id_showtime.html";
                $path = dirname(__DIR__, 2) . '/public/QR/image/';
                $qr = $path . $name;

                // Tạo QR code
                QRcode::png($text, $qr, 'H', 10, 2);


                $user_image_path = dirname(__DIR__, 2) . '/public/QR/image/' . $name;

                if (!file_exists(dirname($user_image_path))) {
                    mkdir(dirname($user_image_path), 0777, true);
                }

                // Sao chép file QR code
                if (file_exists($qr)) {
                    copy($qr, $user_image_path);
                } else {
                    echo "Không tìm thấy file QR để sao chép.";
                }
                // -------------------------QR-----------------------

                $id_tickets[] = $this->model->getInsertId();
                $this->model->updateData('seats', $hold_expiry, "where id_seat  = $id");
            }

            $this->model->InsertData('invoice', $invoice_data);
            $id_invoice = $this->model->getInsertId();
            $this->ticket['invoice'] =  _LINK . "/hoa-don-$id_invoice.html";


            foreach ($id_tickets as $id) {
                $data = [
                    'id_invoice' => $id_invoice,
                    'id_ticket' => $id,
                    'quantity' => 1,
                ];

                $this->ticket['link_ticket'][$id] = _LINK . "/ve-da-dat-$id.html";




                $this->model->InsertData('invoice_detail', $data);
            }
            if ($_SESSION['is_login']['id_role'] == 1) {
                $this->library("PHPMailer/sendmailTicket.php", $this->ticket);
            }

            foreach ($id_items as $id => $quantity) {
                $data = [
                    'id_invoice' => $id_invoice,
                    'id_item' => $id,
                    'quantity' => $quantity,
                ];
                $this->model->InsertData('invoice_detail', $data);
            }

            unset($_SESSION['payment_data']);
            if ($_SESSION['is_login']['id_role'] == 1) {
                $this->data['content'] = 'home/paySuccess';
                $this->data['sub']['infor']  = "Thông báo thành công";
                $this->view("layout/client", $this->data);
            } else {
                echo "<script>alert('Đặt vé thành công')</script>";
?>
                <script>
                    window.location.href = "dat-ve.html";
                </script>
<?php
            }
        } else {
            echo "Thất bại";
        }
    }


    public function QR($id_seat, $id_showTime)
    {
        $ticket = $this->model->getListFromThreeTables("seats", "tickets", "show_time", "id_seat", "id_showTime", "WHERE tickets.id_seat = $id_seat AND tickets.id_showTime = $id_showTime");

        $id_movie = $ticket[0]['id_movie'];
        $moives = $this->model->getListTable('movie', "where id_movie = $id_movie");
        $movie_name = $moives[0]['movie_name'];
        $movie_image = $moives[0]['poster'];



        $id_room =  $ticket[0]['id_room'];
        $rooms = $this->model->getListTable('room', "where id_room = $id_room");
        $room = $rooms[0]['room_name'];


        $id_cinema = $rooms[0]['id_cinema'];
        $cinemas = $this->model->getListTable("cinemas", "where id_cinema = $id_cinema");
        $cinema_name =  $cinemas[0]['cinema_name'];

        $name =  $ticket[0]['qrcode'];

        $file = _WEB_ROOT . "/public/QR/image/" . $name;
        $seat = $ticket[0]['location'];
        $time = $ticket[0]['show_date'];
        $start_time = $ticket[0]['start_time'];
        $end_time = $ticket[0]['start_time'];
        $duration =  $moives[0]['duration'];

        $this->data = [
            'id_ticket' => $ticket[0]['id_ticket'],
            'file' => $file,
            'seat' =>  $seat,
            'time' => $time,
            'start_time' => $start_time,
            'room' => $room,
            'cinema_name' => $cinema_name,
            'movie_name' => $movie_name,
            'movie_image' => $movie_image,
            'end_time' => $end_time,
            'duration' => $duration,
            'checkIn' =>  $ticket[0]['check_in']

        ];

        if (isset($_POST['checkIn'])) {

            $id_ticket = $_POST['id_ticket'];
            $data = [
                'check_in' => 1
            ];
            $this->model->updateData('tickets', $data, "where id_ticket  = $id_ticket");
        }
        $library = "PHPQR/render/qr.php";
        $this->library($library, $this->data);
    }

    public function PDF($id_ticket)
    {

        $this->data['ticket'] = $this->model->getListFromThreeTables("seats", "tickets", "show_time", "id_seat", "id_showTime", "WHERE tickets.id_ticket= $id_ticket");
        $id_showTime = $this->data['ticket'][0]['id_showTime'];
        $movieData = $this->model->getListFromThreeTables("movie", "show_time", "room", "id_movie", "id_room", "WHERE show_time.id_showTime= $id_showTime");
        $this->data['ticket'] = array_merge($this->data['ticket'], $movieData);
        $id_cinema = $movieData[0]['id_cinema'];
        $cinema = $this->model->getListTable('cinemas', "where id_cinema = $id_cinema");
        $this->data['ticket'] = array_merge($this->data['ticket'], $cinema);



        $this->library("PDF/vendor/autoload.php");

        $this->library("PDF/file/invoice.php", $this->data);
    }

    public function PDFTotalInvoice($id_invoice)
    {
        $this->data['invoice'][0] = $this->model->getListFromThreeTables("invoice", "invoice_detail", "menu_items", "id_invoice", "id_item", "WHERE invoice.id_invoice = $id_invoice");
        $id_customer = $this->data['invoice'][0][0]['id_customer'];

        $customer = $this->model->getListTable('customer', "where id_customer = $id_customer");
        $this->data['invoice'] = array_merge($this->data['invoice'], $customer);






        $this->library("PDF/vendor/autoload.php");

        $this->library("PDF/file/total_invoice.php", $this->data);
    }

    public function PDFInvoiceDetails($id_invoice)
    {
            $invoice = $this->model->getListFromTwoTables('invoice','invoice_detail','id_invoice', "where invoice.id_invoice = $id_invoice ORDER BY invoice_detail.id_invoice DESC" );
            $id_customer=$invoice[0]['id_customer'];
            $customer = $this->model->getListTable('customer',"where id_customer = $id_customer" );

            // Khởi tạo mảng lưu trữ hóa đơn
            $this->data['invoice'] = [
                'id_invoice' => $invoice[0]['id_invoice'],
                'create_date' => $invoice[0]['create_date'],
                'total_amount' => $invoice[0]['total_amount'],
                'discount_total' => $invoice[0]['discount_total'],
                'final_total' => $invoice[0]['final_total'],
                'payment_method' => $invoice[0]['payment_method'],
                'full_name' => $customer[0]['full_name'],
                'email' => $customer[0]['email'],
                'phone' => $customer[0]['phone'],
                'tickets' => [],
                'items' => []
            ];

            // Phân loại vào 'tickets' hoặc 'items' và nạp thông tin trực tiếp
            foreach ($invoice as $item) {
                if (!empty($item['id_ticket'])) {
                    // Lấy chi tiết của vé
                    $id_ticket = $item['id_ticket'];
                    $ticketDetails = $this->model->getListFromTwoTables('tickets', 'seats', 'id_seat', "where id_ticket='$id_ticket'");

                    // Thêm vào danh sách vé và nạp chi tiết
                    $this->data['invoice']['tickets'][] = [
                        'id_ticket' => $item['id_ticket'],
                        'quantity' => $item['quantity'],
                        'location' => $ticketDetails[0]['location'] ?? null,
                        'check_in' => $ticketDetails[0]['check_in'] ?? null,
                        'qrcode' => $ticketDetails[0]['qrcode'] ?? null,
                        'id_showTime' => $ticketDetails[0]['id_showTime'] ?? null,
                        'id_room' => $ticketDetails[0]['id_room'] ?? null,
                        'price' => $ticketDetails[0]['price'] ?? null,
                    ];
                }

                if (!empty($item['id_item'])) {
                    // Lấy chi tiết của item
                    $id_item = $item['id_item'];
                    $itemDetails = $this->model->getListTable('menu_items', "where id_item='$id_item'");

                    // Thêm vào danh sách items và nạp chi tiết
                    $this->data['invoice']['items'][] = [
                        'id_item' => $item['id_item'],
                        'quantity' => $item['quantity'],
                        'item_name' => $itemDetails[0]['item_name'] ?? null,
                        'price' => $itemDetails[0]['price'] ?? null,
                    ];
                }
            }

            // Nạp thông tin chung cho hóa đơn từ vé đầu tiên
            if (!empty($this->data['invoice']['tickets'])) {
                $firstTicket = $this->data['invoice']['tickets'][0];
                $id_room = $firstTicket['id_room'];
                $id_showTime = $firstTicket['id_showTime'];
                $infoCinema = $this->model->getListFromTwoTables('room', 'cinemas', 'id_cinema', "where id_room = $id_room");
                $infoShowtime = $this->model->getListFromTwoTables('show_time', 'movie', 'id_movie', "where id_showTime = $id_showTime");
                $this->data['invoice']['show_date'] = $this->accountmodel->convertDayToVietnamese($infoShowtime[0]['show_date']);
                $this->data['invoice']['movie_name'] = $infoShowtime[0]['movie_name'];
                $this->data['invoice']['start_time'] = $infoShowtime[0]['start_time'];
                $this->data['invoice']['end_time'] = $infoShowtime[0]['end_time'];
                $this->data['invoice']['format'] = $infoShowtime[0]['projection_format'];
                $this->data['invoice']['duration'] = $infoShowtime[0]['duration'];
                $this->data['invoice']['room_name'] = $infoCinema[0]['room_name'];
                $this->data['invoice']['cinema_name'] = $infoCinema[0]['cinema_name'];
                $this->data['invoice']['address'] = $infoCinema[0]['address'];
            }

        $this->library("PDF/vendor/autoload.php");

        $this->library("PDF/file/invoice_details.php", $this->data);
    }

    public function book_ticket()
    {
        $this->data['sub']['show_time'] = $this->model->getListFromThreeTables('room', 'show_time', 'movie', 'id_room', 'id_movie');
        $this->data['content'] = 'home/bookTicket';
        $this->data['sub']['cinemas'] = $this->model->getListTable('cinemas');
        $this->view("layout/client", $this->data);
    }
}
