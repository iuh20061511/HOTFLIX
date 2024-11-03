<?php
class Search extends Controller
{

    private $model;
    private $accountmodel;
    private $data = [];

    public function __construct()
    {
        $this->model = $this->model('AccountModel');
        $this->validate = new Validate();
        // $this->accountmodel = new AccountModel();
    }

    public function index()
    {
        $this->data['sub']['title'] = "Trang tra cứu thông tin vé";
        if(isset($_GET['search_ticket']) && !empty($_GET['search_ticket'])){
            $search_ticket = htmlspecialchars($_GET['search_ticket'], ENT_QUOTES, 'UTF-8');
            $member = $this->model->getListTable('customer', "where phone = '$search_ticket' or email = '$search_ticket'");
            $id_account = $member[0]['id_customer'];
            $this->data['sub']['infoMember']= $this->model->getListTable('customer', "where id_customer = '$id_account'");
            $name_customer = $this->data['sub']['infoMember'][0]['full_name'];
            //Danh sách vé
            $listTicket = $this->model->getListFromTwoTables('invoice','invoice_detail','id_invoice', "where id_customer = $id_account ORDER BY invoice_detail.id_invoice DESC" );

            foreach ($listTicket as $item) {
                $id_invoice = $item['id_invoice'];
                // Nếu chưa tồn tại id_invoice trong mảng kết quả thì khởi tạo
                if (!isset($this->data['sub']['listTicket'][$id_invoice])) {
                    // Sao chép thông tin chung của hóa đơn vào phần tử mới
                    $this->data['sub']['listTicket'][$id_invoice] = [
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
                // Phân loại vào mảng tickets hoặc items dựa trên giá trị id_ticket và id_item
                if (!empty($item['id_ticket'])) {
                    $this->data['sub']['listTicket'][$id_invoice]['tickets'][] = [
                        'id_ticket' => $item['id_ticket'],
                        'quantity' => $item['quantity'],
                    ];
                }

                if (!empty($item['id_item'])) {
                    $this->data['sub']['listTicket'][$id_invoice]['items'][] = [
                        'id_item' => $item['id_item'],
                        'quantity' => $item['quantity'],
                    ];
                }
            }
            //Nạp thông tin cho từng item chọn
            foreach ($this->data['sub']['listTicket'] as &$invoice) {
                foreach ($invoice['items'] as &$item) {
                    // Lấy id_item để truy vấn thông tin chi tiết
                    $id_item = $item['id_item'];
                    $itemDetails = $this->model->getListTable('menu_items', "where id_item='$id_item'");
                    $item['item_name'] = $itemDetails[0]['item_name'];
                    $item['price'] = $itemDetails[0]['price'];
                    $item['description'] = trim($itemDetails[0]['description']);
                    $item['image'] = $itemDetails[0]['image'];
                }
            }
            //Nạp thông tin cho từng vé
            foreach ($this->data['sub']['listTicket'] as &$invoice) {
                foreach ($invoice['tickets'] as &$ticket) {
                    $id_ticket = $ticket['id_ticket'];
                    $ticketDetails = $this->model->getListFromTwoTables('tickets','seats', 'id_seat', "where id_ticket='$id_ticket'");
                    $ticket['location'] = $ticketDetails[0]['location'];
                    $ticket['status'] = $ticketDetails[0]['status'];
                    $ticket['qrcode'] = $ticketDetails[0]['qrcode'];
                    $ticket['id_showTime'] = $ticketDetails[0]['id_showTime'];
                    $ticket['id_room'] = $ticketDetails[0]['id_room'];
                }
            }
            //Nạp thông tin chung
            foreach ($this->data['sub']['listTicket'] as &$invoice) {
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

            //Danh sách thuê phòng
            $this->data['sub']['listInvoiceRoom'] = $this->model->getListFromThreeTables('invoice_room','room','room_type','id_room','id_roomType', "where id_customer = $id_account ORDER BY invoice_room.id_invoiceRoom DESC" );
            foreach ($this->data['sub']['listInvoiceRoom'] as &$invoice) {
                $id_cinema = $invoice['id_cinema'];
                $InfoCinema = $this->model->getListTable('cinemas', "where id_cinema = $id_cinema");
                $invoice['cinema_name'] = $InfoCinema[0]['cinema_name'] ?? 'Unknown';
                $invoice['date_rent'] = $this->model->convertDayToVietnamese($invoice['date_rent']);
            }
        }

        $this->data['content'] = 'admin/search/ticketSearch';

        $this->view("layout/client", $this->data);

    }


}