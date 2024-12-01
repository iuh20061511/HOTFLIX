<?php
class ChangeTickets extends Controller
{
    private $model;


    private $data = [];
    private $ticket = [];



    public function __construct()
    {
        $this->model = $this->model('AccountModel');
    }

    public function selectSeat()
    {
        if (isset($_POST['sub_change'])) {
            $id_showTime = $_POST['id_showTime'];
            $id_invoice = $_POST['id_invoice'];
            $id_showTime_old = $_POST['id_showTime_old'];
            $show_time = $this->model->getListTable("show_time", "WHERE id_showTime=$id_showTime");

            $id_movie = $show_time[0]['id_movie'];
            $this->data['sub']['id_movie'] = $id_movie;
            $this->data['sub']['id_showTime_old'] = $id_showTime_old;
            $this->data['sub']['id_showTime'] = $id_showTime;
            $id_room = $show_time[0]['id_room'];
            $this->data['sub']['id_room'] =  $id_room;
            $rooms = $this->model->getListTable('room');
            $this->data['sub']['seats_buy'] = $this->model->getListTable("seats", "WHERE id_showTime=$id_showTime");
            $this->data['sub']['id_invoice'] = $id_invoice;
            $this->data['sub']['movie'] = $this->model->getListFromTwoTables('movie', 'show_time', 'id_movie', "where show_time.id_movie = $id_movie and show_time.id_showTime  =  $id_showTime");
            $this->data['sub']['cinema'] = $this->model->getListFromTwoTables('room', 'cinemas', 'id_cinema', "where room.id_room = $id_room");
            foreach ($rooms as $room) {
                if ($room['id_room'] == $id_room) {
                    if ($room['id_roomType'] == 1) {
                        $this->data['content'] = 'home/changeTickets/roomVip';
                    } elseif ($room['id_roomType'] == 2) {
                        $this->data['content'] = 'home/changeTickets/roomSmall';
                    } elseif ($room['id_roomType'] == 3) {
                        $this->data['content'] = 'home/changeTickets/roomAgv';
                    } elseif ($room['id_roomType'] == 4) {
                        $this->data['content'] = 'home/changeTickets/roomBig';
                    }
                }
            }

            $this->data['sub']['text'] = "Danh sách text";
            $this->view("layout/client", $this->data);
        } else {
            $url = _LINK;
            echo "<script>window.location.href = '$url/lich-su-giao-dich.html';</script>";
        }
    }

    public function handleShowTime()
    {
        $id_invoice = $_POST['id_invoice'];
        $invoice = $this->model->getListFromThreeTables('invoice', 'invoice_detail', 'tickets', "id_invoice", "id_ticket", "WHERE invoice.id_invoice = $id_invoice");
        $id_showTime_old = $_POST['id_showTime_old'];
        $showtime_old =   $this->model->getListFromThreeTables('show_time', 'tickets', 'seats', "id_showTime", "id_seat", "WHERE show_time.id_showTime = $id_showTime_old");
        $id_showTime = $_POST['id_showtime'];
        $showtime =  $this->model->getListTable("show_time", "WHERE id_showTime=$id_showTime");

        $data_invoice = [
            'create_date' => date('Y-m-d H:i:s')
        ];

        $this->model->updateData('invoice', $data_invoice, "where id_invoice = '$id_invoice';");

        $id_tickets_old = array();
        $id_seats_old = array();
        foreach ($showtime_old as $show) {
            $id_seats_old[] = $show['id_seat'];
            $id_tickets_olds[] = array(
                'id_ticket' => $show['id_ticket'],
                'qrcode' => $show['qrcode']
            );
        }


        $hold_expiry =   $showtime[0]['show_date'] . ' ' . $showtime[0]['end_time'];

        foreach ($_POST['seat'] as $key => $seat) {
            if (is_array($seat) && isset($seat['price'])) {
                $seat_change[] = array(
                    'seat' => $key,
                    'price' => $seat['price']
                );
            }
        }

        $seat_update = array();
        foreach ($seat_change as $seat) {
            $data_seats = [
                'location' => $seat['seat'],
                'price' => $seat['price'],
                'id_room' => $_POST['id_room'],
                'id_showTime' => $_POST['id_showtime'],
                'hold_expiry' => $hold_expiry
            ];

            foreach ($id_seats_old as $id_seat) {
                if (!in_array($id_seat, array_column($seat_update, 'id_seat')) && !in_array($data_seats, array_column($seat_update, 'data'))) {
                    $seat_update[] = [
                        'id_seat' => $id_seat,
                        'data' => $data_seats
                    ];
                }
            }
        }


        foreach ($seat_update as $seup) {
            $id_seat = $seup['id_seat'];
            $data_seats_update = $seup['data'];
            $this->model->updateData('seats', $data_seats_update, "where id_seat = '$id_seat';");
        }

        foreach ($id_tickets_olds as $id_tickets_old) {
            $qr  = $id_tickets_old['qrcode'];
            $path = dirname(__DIR__, 2) . "/public/QR/image/$qr";
            if (file_exists($path)) {
                unlink($path);
            }
        }

        foreach ($id_tickets_olds as $id_tickets_old) {
            $id_showtime =  $_POST['id_showtime'];
            $id_ticket = $id_tickets_old['id_ticket'];
            $tickets_new =  $this->model->getListTable("tickets", "WHERE id_ticket=$id_ticket");
            $id_seat = $tickets_new[0]['id_seat'];
            $name = date("Y-m-d-h-i-s") . '_' . "$id_showtime" . "_$id_seat" . '.png';
            $data_ticketQR_update = [
                'id_showTime' => $_POST['id_showtime'],
                'qrcode' =>  $name
            ];
            // -------------------------QR-----------------------
            $this->library("PHPQR/qrlib.php");

            $text = _LINK . "/kiem-tra-ve-$id_seat-$id_showtime.html";
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

            $this->model->updateData('tickets', $data_ticketQR_update, "where id_seat = '$id_seat'");

            $this->ticket['link_ticket'][$id_ticket] = _LINK . "/ve-da-dat-$id_ticket.html";
        }

        $data_status_exchange = [
            'status_exchange' => 1
        ];
        $this->model->updateData('invoice', $data_status_exchange, "where id_invoice  = '$id_invoice'");

        $this->ticket['invoice'] =  _LINK . "/in-ve-$id_invoice.html";

        $this->library("PHPMailer/sendMailChangeTicket.php", $this->ticket);




        $this->data['content'] = 'home/changeTickets/infoChange';
        $this->data['sub']['text'] = "Danh sách text";
        $this->view("layout/client", $this->data);
    }
}
