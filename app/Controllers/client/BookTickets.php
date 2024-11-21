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
        $this->model->deleteData('invoice_room_private', "where hold_expiry <= '$currentTime' AND 	is_paid = 0 ");

        if (isset($_SESSION['back']['seat'])) {
            $location =  $_SESSION['back']['seat'];
            $id_showtime = $_SESSION['back']['id_showtime'];
            $seat =   $this->model->getListTable('seats', "where location= '$location' AND id_showTime = $id_showtime ");
        }
        if (empty($seat)) {
            unset($_SESSION['hold_expiry_location']);
            unset($_SESSION['back']);
        }

        $this->model->deleteData('invoice_room_private', "where hold_expiry <= '$currentTime' AND is_paid = 0 ");
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

        $new_array = array();
        $show = $this->model->getListFromThreeTables('room', 'show_time', 'movie', 'id_room', 'id_movie', "where room.id_cinema = $id_cinema and show_time.show_date= '$day' and show_time.id_movie= $id_movie and show_time.show_date >= CURDATE()");

        $current_time = new DateTime();
        $new_array = [];
        foreach ($show  as $item) {
            $show_time = new DateTime($item['show_date'] . ' ' . $item['start_time']);
            if ($show_time->getTimestamp() >= $current_time->getTimestamp() + 1.5 * 60 * 60) {
                $new_array[] = $item;
            }
        }

        $this->data['sub']['show_time'] = $new_array;

        $this->data['content'] = 'home/BookTickets';
        $this->view("layout/client", $this->data);
    }


    public function selectSeat($id_showTime)
    {

        $show_time = $this->model->getListTable("show_time", "WHERE id_showTime=$id_showTime");

        $id_movie = $show_time[0]['id_movie'];
        $this->data['sub']['id_movie'] = $id_movie;
        $this->data['sub']['id_showTime'] = $id_showTime;
        $id_room = $show_time[0]['id_room'];
        $this->data['sub']['id_room'] =  $id_room;
        $rooms = $this->model->getListTable('room');
        $this->data['sub']['seats_buy'] = $this->model->getListTable("seats", "WHERE id_showTime=$id_showTime");

        $this->data['sub']['movie'] = $this->model->getListFromTwoTables('movie', 'show_time', 'id_movie', "where show_time.id_movie = $id_movie and show_time.id_showTime  =  $id_showTime");
        $this->data['sub']['cinema'] = $this->model->getListFromTwoTables('room', 'cinemas', 'id_cinema', "where room.id_room = $id_room");
        foreach ($rooms as $room) {
            if ($room['id_room'] == $id_room) {
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


        if (isset($_POST['refreshTicket'])) {
            if (isset($_SESSION['cancel']['seat'])) {
                foreach ($_SESSION['cancel']['seat'] as $location) {
                    $this->model->deleteData('seats', "WHERE location = '$location' AND id_showTime = $id_showTime");
                }
                unset($_SESSION['hold_expiry_id_showTime']);
                unset($_SESSION['hold_expiry_location']);
                unset($_SESSION['cancel']['seat']);
                header("Refresh:0");
            }
        }

        $this->data['sub']['text'] = "Danh sách text";
        $this->view("layout/client", $this->data);
    }


    public function chooseFood()
    {
        $_SESSION['currentURL'] =  _URL_;


        if (isset($_POST['seat'])) {

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
            $id_showTime =  $_POST['id_showtime'];
            foreach ($filteredData as $seat => $value) {
                $data = [
                    'location' => $seat,
                    'id_room' => $_POST['id_room'],
                    'hold_expiry' => date("Y-m-d H:i:s", strtotime("+6 minutes")),
                    'id_showTime' => $_POST['id_showtime'],
                    'price' => $value['price'],
                    'status' => 0

                ];

                $checkSeats = $this->model->getListTable('seats', "WHERE location = '$seat' AND id_showTime = $id_showTime");
                if ($checkSeats) {
                    echo "<script>alert('Lỗi vui lòng đặt lại')</script>";
                    echo "<script type='text/javascript'>window.history.back();</script>";
                    die();
                } else {

                    $this->model->InsertData('seats', $data);
                }


                $_SESSION['cancel']['seat'][] = $seat;
                $_SESSION['back']['seat'] = $seat;
                $this->data['sub']['hold_chairs']  = $this->model->getListTable('seats', "WHERE location = '$seat' AND id_showTime = $id_showTime");
            }

            $seats = '';
            foreach ($filteredData as $seat => $value) {
                $seats .= $seat . ', ';
            }

            $this->data['sub']['seats']  = $seats;


            $this->library("Pusher/vendor/autoload.php");

            $options = array(
                'cluster' => 'ap1',
                'useTLS' => true
            );
            $pusher = new Pusher\Pusher(
                '9b780886dd99c5bc8616',
                '493f567787b71d528c2a',
                '1898906',
                $options
            );

            $data_pusher['location'] = $seats;
            $data_pusher['id_showTime']  = $id_showTime;

            $pusher->trigger('my-channel', 'my-event', $data_pusher);
            $this->data['content'] = 'home/chooseFood';

            $this->view("layout/client", $this->data);
        } else {
            $redirectUrl = "404.html";
            header("refresh:0.1; url=$redirectUrl");
        }
    }

    public function backChooseFood()
    {
        $this->data['sub']['text'] = "Chọn món ăn";
        $this->data['sub']['items']  = $this->model->getListTable('menu_items');
        $id_showTime = $_SESSION['back']['id_showtime'];
        $seat = $_SESSION['back']['seat'];
        $this->data['sub']['hold_chairs']  = $this->model->getListTable('seats', "WHERE location = '$seat' AND id_showTime = $id_showTime");

        $this->data['content'] = 'home/back/chooseFood';


        $this->view("layout/client", $this->data);
    }

    public function pay()
    {
        $_SESSION['currentURL'] =  _URL_;



        if (isset($_POST['id_showtime'])) {

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
            if (isset($_POST['item'])) {
                $this->data['sub']['item']  = $_POST['item'];
            }
            $promotions  = $this->model->getListTable('promotion');
            if (isset($_POST['promoCode'])) {
                $checkpromoCode = false;
                foreach ($promotions as $pro) {
                    if ($_POST['promoCode'] == $pro['promotion_code']) {
                        $checkpromoCode = true;
                        if ($pro['discount_type']  == 2) {
                            $total_promotion =  intval(preg_replace('/[^\d]/', '', $_POST['total'])) - $pro['discount_value'];
                            $this->data['sub']['discount']  = number_format($pro['discount_value'], 0, '', '.') . ' ₫';
                            $formatted_price = number_format($total_promotion, 0, '', '.') . ' ₫';
                            $this->data['sub']['total_after_discount']  = $formatted_price;
                            break;
                        } else {
                            $total_promotion =  intval(preg_replace('/[^\d]/', '', $_POST['total'])) * (100 - $pro['discount_value']) / 100;
                            $this->data['sub']['discount']  =  number_format(intval(preg_replace('/[^\d]/', '', $_POST['total'])) - $total_promotion, 0, '', '.') . ' ₫';
                            $formatted_price = number_format($total_promotion, 0, '', '.') . ' ₫';
                            $this->data['sub']['total_after_discount']  = $formatted_price;
                            break;
                        }
                    }
                }
                if ($checkpromoCode) {
                    $this->data['sub']['check_promotions_true']  = "Áp dụng mã giảm giá thành công !";
                } else {
                    $this->data['sub']['check_promotions']  = "Không tìm thấy mã giảm giá";
                }
            }

            $seats = explode(', ', rtrim($_POST['seats'], ', '));

            $id_showTime = $_POST['id_showtime'];

            foreach ($seats as $seat) {
                $_SESSION['back']['seat'] = $seat;
                $this->data['sub']['hold_chairs']  = $this->model->getListTable('seats', "WHERE location = '$seat' AND id_showTime = $id_showTime");
                if (!$this->data['sub']['hold_chairs']) {
                    $redirectUrl = _LINK;
                    header("refresh:0; url=$redirectUrl");
                }
            }

            $this->data['content'] = 'home/pay';
            $this->view("layout/client", $this->data);
        } else {
            $redirectUrl = "404.html";
            header("refresh:0.1; url=$redirectUrl");
        }
    }

    public function backPay()
    {
        $promotions  = $this->model->getListTable('promotion');

        if (isset($_POST['promoCode'])) {
            $checkpromoCode = false;
            foreach ($promotions as $pro) {
                if ($_POST['promoCode'] == $pro['promotion_code']) {
                    $checkpromoCode = true;
                    if ($pro['discount_type']  == 2) {
                        $total_promotion =  intval(preg_replace('/[^\d]/', '', $_SESSION['back']['total'])) - $pro['discount_value'];
                        $_SESSION['back']['total_discount']  = number_format($pro['discount_value'], 0, '', '.') . ' ₫';
                        $formatted_price = number_format($total_promotion, 0, '', '.') . ' ₫';
                        $_SESSION['back']['total_after_discount']  = $formatted_price;
                        break;
                    } else {
                        $total_promotion =  intval(preg_replace('/[^\d]/', '', $_SESSION['back']['total'])) * (100 - $pro['discount_value']) / 100;
                        $_SESSION['back']['total_discount']  =  number_format(intval(preg_replace('/[^\d]/', '', $_SESSION['back']['total'])) - $total_promotion, 0, '', '.') . ' ₫';
                        $formatted_price = number_format($total_promotion, 0, '', '.') . ' ₫';
                        $_SESSION['back']['total_after_discount']  = $formatted_price;
                        break;
                    }
                }
            }
            if ($checkpromoCode) {
                $this->data['sub']['check_promotions_true']  = "Áp dụng mã giảm giá thành công !";
            } else {
                $this->data['sub']['check_promotions']  = "Không tìm thấy mã giảm giá";
            }
        }

        $seat =  $_SESSION['back']['seat'];
        $id_showTime = $_SESSION['back']['id_showtime'];
        $this->data['sub']['hold_chairs']  = $this->model->getListTable('seats', "WHERE location = '$seat' AND id_showTime = $id_showTime");
        $this->data['content'] = 'home/back/pay';
        $this->view("layout/client", $this->data);
    }

    public function cancelSeat()
    {
        $id_showTime = $_SESSION['back']['id_showtime'];
        foreach ($_SESSION['cancel']['seat'] as $location) {
            $this->model->deleteData('seats', "WHERE location = '$location' AND id_showTime = $id_showTime");
        }
        unset($_SESSION['hold_expiry_id_showTime']);
        unset($_SESSION['hold_expiry_location']);
        unset($_SESSION['cancel']['seat']);

        echo '<script>window.location.href = "/";</script>';
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
            $moneyNumber = (int)str_replace(['.', ' ₫'], '', $_POST['total_after_discount']);
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
                        'discount_total' => (int)str_replace(['.', ' ₫'], '', $_POST['discount']),
                        'final_total' => $moneyNumber * 1,
                        'payment_method' => ($_SESSION['is_login']['id_role'] == 1) ? 'Online' : 'Tại quầy',
                    ],
                    isset($_SESSION['is_login']['id_role']) && $_SESSION['is_login']['id_role'] == 1
                        ? ['id_customer' => $_SESSION['is_login']['id_account']]
                        : (isset($_SESSION['infor_id_customer'])
                            ? ['id_customer' => $_SESSION['infor_id_customer']]
                            : [])
                )
            ];

            if (isset($_POST['id_item'])) {
                $_SESSION['payment_data']['id_items'] = $_POST['id_item'];
            }


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
            if (isset($payment_data['id_items'])) {
                $id_items = $payment_data['id_items'];
            }
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
            $this->ticket['invoice'] =  _LINK . "/in-ve-$id_invoice.html";


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

            if (isset($id_items)) {
                foreach ($id_items as $id => $quantity) {
                    $data = [
                        'id_invoice' => $id_invoice,
                        'id_item' => $id,
                        'quantity' => $quantity,
                    ];
                    $this->model->InsertData('invoice_detail', $data);
                }
            }

            unset($_SESSION['payment_data']);
            unset($_SESSION['hold_expiry_id_showTime']);
            unset($_SESSION['hold_expiry_location']);
            unset($_SESSION['cancel']['seat']);
            if ($_SESSION['is_login']['id_role'] == 1) {
                $this->data['content'] = 'home/paySuccess';
                $this->data['sub']['infor']  = "Thông báo thành công";
                $this->view("layout/client", $this->data);
            } else {
                echo "<script>alert('Đặt vé thành công')</script>";
                echo "<script>window.location.href = 'dat-ve.html';</script>";
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

        $exit = false;

        if (!empty($_SESSION['is_login']['id_role']) && $_SESSION['is_login']['id_role'] == 5) {
            $data = ['check_in' => 1];
            $check = $this->model->getListTable('tickets', "where id_seat = '$id_seat' AND id_showTime = $id_showTime");

            if ($check[0]['check_in'] == 0) {
                $this->data['check'] = $this->model->updateData('tickets', $data, "where id_seat = '$id_seat' AND id_showTime = $id_showTime") ? 1 : 0;
                $exit = true;
            }
        }
        if (!$exit) {
            $check = $this->model->getListTable('tickets', "where id_seat = '$id_seat' AND id_showTime = $id_showTime");
            $this->data['check'] = ($check[0]['check_in'] == 1) ? 2 : 0;
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
        if (isset($this->data['invoice'][0])) {
            $this->data['invoice'][0] = $this->model->getListFromTwoTables("invoice", "invoice_detail", "id_invoice", "WHERE invoice.id_invoice = $id_invoice");
        }
        $id_customer = $this->data['invoice'][0][0]['id_customer'];

        $customer = $this->model->getListTable('customer', "where id_customer = $id_customer");
        $this->data['invoice'] = array_merge($this->data['invoice'], $customer);






        $this->library("PDF/vendor/autoload.php");

        $this->library("PDF/file/total_invoice.php", $this->data);
    }

    public function PDFInvoiceDetails($id_invoice)
    {
        $invoice = $this->model->getListFromTwoTables('invoice', 'invoice_detail', 'id_invoice', "where invoice.id_invoice = $id_invoice ORDER BY invoice_detail.id_invoice DESC");
        $id_customer = $invoice[0]['id_customer'];
        $customer = $this->model->getListTable('customer', "where id_customer = $id_customer");

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
        $showtimes = $this->model->getListFromThreeTables('room', 'show_time', 'movie', 'id_room', 'id_movie',  "WHERE show_time.show_date >= CURDATE()");

        $current_time = new DateTime();
        $new_array = [];

        foreach ($showtimes  as $item) {
            $show_time = new DateTime($item['show_date'] . ' ' . $item['start_time']);
            if ($show_time->getTimestamp() >= $current_time->getTimestamp() + 1.5 * 60 * 60) {
                $new_array[] = $item;
            }
        }

        $this->data['sub']['show_time'] = $new_array;

        $this->data['content'] = 'home/bookTicket';
        $this->data['sub']['cinemas'] = $this->model->getListTable('cinemas');
        $this->view("layout/client", $this->data);
    }

    public function chooseTimeRoomPrivate()
    {

        $this->data['sub']['cinemas']  = $this->model->getListTable('cinemas');

        if (isset($_GET['id_cinema'])) {
            $id_cinema =  $_GET['id_cinema'];
            $this->data['sub']['rooms'] = $this->model->getListTable('room', "WHERE id_roomType = 5 AND id_cinema = $id_cinema");
            $this->data['sub']['room_order'] = $this->model->getListFromThreeTables('invoice_room_private', "room", "cinemas", "id_room", "id_cinema", "WHERE cinemas.id_cinema = $id_cinema ");
        }
        $this->data['content'] = 'home/chooseTimeRoomPrivate';
        $this->view("layout/client", $this->data);
    }

    public function bookPrivateRoom($id_room)
    {
        $this->data['sub']['movies'] = $this->model->getListTable('movie');
        if (isset($_POST['movieSelect'])) {
            $id_movie = $_POST['movieSelect'];
            $this->data['sub']['id_room'] = $id_room;
            $this->data['sub']['info_movie'] = $this->model->getListTable('movie', "WHERE id_movie = $id_movie");
        }
        $this->data['content'] = 'home/room/roomPrivate';
        $this->view("layout/client", $this->data);
    }

    public function chooseFoodForPrivate()
    {


        if (isset($_POST['movieSelect'])) {

            $data = [
                'id_customer' => $_SESSION['is_login']['id_account'],
                'show_date' =>  $_POST['date'],
                'time' => $_POST['time'],
                'id_room' => $_POST['id_room'],
                'id_movie' => $_POST['movieSelect'],
                'hold_expiry' => date("Y-m-d H:i:s", strtotime("+6 minutes")),
                'is_paid' => 0
            ];
            $show_date = $_POST['date'];
            $time = $_POST['time'];
            $id_room =  $_POST['id_room'];

            $room_pusher =  $this->model->getListTable('room', "WHERE id_room =  $id_room");
            $id_cinema_pusher = $room_pusher[0]['id_cinema'];
            $_SESSION['pusher']['pri']['id_room'] = $id_room;
            $_SESSION['pusher']['pri']['show_date'] = $show_date;
            $_SESSION['pusher']['pri']['time'] = $time;
            $_SESSION['pusher']['pri']['id_cinema'] = $id_cinema_pusher;



            $checkInvoice = $this->model->getListTable('invoice_room_private', "WHERE show_date = '$show_date' AND time = '$time' AND id_room =  $id_room ");
            $day = date('Y-m-d');
            if ($checkInvoice) {
                echo "<script>alert('Lỗi vui lòng đặt lại')</script>";
                echo "<script>window.location.href = 'chon-thoi-gian-dat-phong.html?day=$day';</script>";
                die();
            } else {
                $this->model->InsertData('invoice_room_private', $data);
            }


            $_SESSION['invoice_room_private'] = $this->model->getInsertId();
            $id_movie =  $_POST['movieSelect'];
            $this->data['sub']['items']  = $this->model->getListTable('menu_items');
            $this->data['sub']['movie']  = $this->model->getListTable('movie', "WHERE id_movie = $id_movie ");
            $this->data['content'] = 'home/chooseFoodForPrivate';
            $this->view("layout/client", $this->data);
        } else {
            $redirectUrl = "404.html";
            header("refresh:0.1; url=$redirectUrl");
        }
    }

    public function payRoomPrivate()
    {
        $this->data['sub']['movie']  = $this->model->getListTable('movie');
        $id_InvoiceRoomPrivate  =   $_SESSION['invoice_room_private'];
        $this->data['sub']['InvoiceRoomPrivate'] = $this->model->getListTable('invoice_room_private', "WHERE id_InvoiceRoomPrivate  = $id_InvoiceRoomPrivate");

        $this->data['content'] = 'home/payRoomPrivate';

        $this->view("layout/client", $this->data);
    }

    public function checkPayRoomPrivate()
    {
        if (isset($_POST['payment'])) {
            $_SESSION['roomPrivate']['hold_expiry'] = (new DateTime($_POST['date'] . ' ' . $_POST['time']))->format('Y-m-d H:i:s');
            $_SESSION['roomPrivate']['price'] = (int) str_replace(['.', ' ₫'], '', $_POST['total']);

            if (isset($_POST['id_item'])) {
                $_SESSION['id_itemRomPrivate'] = $_POST['id_item'];
            }
            $this->data['total']  = $_POST['total'];

            if ($_POST['payment'] == 'momo') {
                $this->library('PayOnline/QRmomoPrivate.php', $this->data);
            } elseif ($_POST['payment'] == 'ATM') {
                $this->library('PayOnline/MomoRoomPrivate.php', $this->data);
            } elseif ($_POST['payment'] == 'vnpay') {
                $this->library('PayOnline/VNPayRoomPrivate.php', $this->data);
            }
        }
    }




    public function  PaySucessRoomPrivate()
    {

        foreach ($_SESSION['id_itemRomPrivate'] as $item => $quantity) {
            $data = [
                'id_InvoiceRoomPrivate' => $_SESSION['invoice_room_private'],
                'id_item' => $item,
                'quantity' => $quantity,
            ];
            $this->model->InsertData('invoice_detail_private', $data);
        }
        $id_InvoiceRoomPrivate  = $_SESSION['invoice_room_private'];

        $this->data['invoice_url'] = _LINK . "/hoa-don-phong-rieng-$id_InvoiceRoomPrivate.html";
        $this->library('PHPMailer/sendmailinvoiceRoomPrivate.php', $this->data);


        $id_paid = [
            'is_paid' => 1,
            'price' => $_SESSION['roomPrivate']['price'],
            'hold_expiry' =>  $_SESSION['roomPrivate']['hold_expiry']
        ];

        $this->model->updateData('invoice_room_private', $id_paid, "WHERE id_InvoiceRoomPrivate = $id_InvoiceRoomPrivate");

        $this->library("Pusher/vendor/autoload.php");

        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        $pusher = new Pusher\Pusher(
            '9b780886dd99c5bc8616',
            '493f567787b71d528c2a',
            '1898906',
            $options
        );

        $data_pusher['time'] = $_SESSION['pusher']['pri']['time'];
        $data_pusher['show_date']  = $_SESSION['pusher']['pri']['show_date'];
        $data_pusher['id_room']  =  $_SESSION['pusher']['pri']['id_room'];
        $data_pusher['id_cinema']  = $_SESSION['pusher']['pri']['id_cinema'];

        $pusher->trigger('my-channel', 'my-event', $data_pusher);

        $this->data['sub']['text'] = "Thanh toán thành công";
        $this->data['content'] = 'home/paySuccessRoomPrivate';
        $this->view("layout/client", $this->data);
    }

    public function PDFTotalInvoicePrivate($id_invoicePrivate)
    {
        $this->data['info_invoice'] = $this->model->getListFromThreeTables('customer', 'invoice_room_private', 'room', 'id_customer', 'id_room', "WHERE id_InvoiceRoomPrivate = '$id_invoicePrivate'");
        $id_cinema = $this->data['info_invoice'][0]['id_cinema'];
        $this->data['cinema'] = $this->model->getListTable('cinemas', "where id_cinema =  $id_cinema");

        $this->data['items'] = $this->model->getListFromTwoTables('menu_items', 'invoice_detail_private', 'id_item', "WHERE invoice_detail_private.id_InvoiceRoomPrivate = '$id_invoicePrivate'");
        $this->library("PDF/vendor/autoload.php");

        $this->library("PDF/file/total_invoice_private.php", $this->data);
    }
}
