<?php



class BookTickets extends Controller
{


    private $model;
    private $data = [];
    private $ticket = [];


    public function __construct()
    {
        $this->model = $this->model('HomeModel');
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

            foreach ($_POST['seat'] as $seat) {
                $data = [
                    'location' => $seat,
                    'id_room' => $_POST['id_room'],
                    'hold_expiry' => date("Y-m-d H:i:s", strtotime("+6 minutes")),
                    'id_showTime' => $_POST['id_showtime'],
                    'status' => 0

                ];
                $this->model->InsertData('seats', $data);
            }

            $seats = '';
            foreach ($_POST['seat'] as $seat) {
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

    public function momoPay()
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
                'invoice_data' => [
                    'id_customer' => $_SESSION['is_login']['id_account'],
                    'create_date' => date('Y-m-d H:i:s'),
                    'total_amount' => $moneyNumber,
                    'discount_total' => 1,
                    'final_total' => $moneyNumber * 1,
                    'payment_method' => 'Online',
                ],
                'id_items' => $_POST['id_item']
            ];

            $this->data['moneyNumber'] =  $moneyNumber;
            $this->library('PayOnline/Momo.php', $this->data);
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
            $moneyNumber = $payment_data['moneyNumber'];
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

                // -------------------------QR-----------------------
                $this->library("PHPQR/qrlib.php");

                $text = _LINK . "/kiem-tra-ve-$id-$id_showtime.html";
                $path = dirname(__DIR__, 2) . '/public/QR/image/';
                $qr = $path . $name;

                // Tạo QR code
                QRcode::png($text, $qr, 'H', 10, 2);

                // Đường dẫn đích cho file được sao chép
                $user_image_path = dirname(__DIR__, 2) . '/public/QR/image/' . $name; // Thêm '/' trước tên file

                // Kiểm tra và tạo thư mục nếu không tồn tại
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


            foreach ($id_tickets as $id) {
                $data = [
                    'id_invoice' => $id_invoice,
                    'id_ticket' => $id,
                    'quantity' => 1,
                ];

                $this->ticket['link_ticket'][$id] = _LINK . "/ve-cua-da-dat-$id.html";


                $this->model->InsertData('invoice_detail', $data);
            }
            $this->library("PHPMailer/sendmailTicket.php", $this->ticket);

            foreach ($id_items as $id => $quantity) {
                $data = [
                    'id_invoice' => $id_invoice,
                    'id_item' => $id,
                    'quantity' => $quantity,
                ];
                $this->model->InsertData('invoice_detail', $data);
            }

            unset($_SESSION['payment_data']);

            $this->data['content'] = 'home/paySuccess';
            $this->data['sub']['infor']  = "Thông báo thành công";
            $this->view("layout/client", $this->data);
        } else {
            echo "Thất bại.";
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
}
