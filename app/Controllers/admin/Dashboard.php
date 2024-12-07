<?php
class Dashboard extends Controller
{

    private $model;

    private $data = [];


    public function __construct()
    {
        $this->model = $this->model('AdminModel');
    }
    public function index()
    {
        $this->data['sub']['title'] = "Trang Admin Dashboard";
        $invoice_ticket_month = $this->getMonthlyTicketRevenue();
        $invoice_room_month  = $this->getMonthlyRoomRevenue();
        $invoice_ticket_week = $this->getWeeklyTicketRevenue();
        $invoice_room_week  = $this->getWeeklyRoomRevenue();
        $this->data['sub']['invoice_month'] = $invoice_ticket_month + $invoice_room_month;
        $this->data['sub']['invoice_week'] =  $invoice_ticket_week +  $invoice_room_week;


        $this->data['content'] = 'admin/dashboard/dashboard';

        $this->view("layout/admin", $this->data);
    }

    public function getMonthlyTicketRevenue()
    {
        $invoice = $this->model->getListFromTwoTablesByCol(
            'SUM(final_total) AS total_ticket',
            'invoice',
            'show_time',
            'id_showTime',
            'WHERE YEAR(show_time.show_date) = YEAR(CURDATE())  AND MONTH(show_time.show_date) = MONTH(CURDATE()) GROUP BY  MONTH(show_time.show_date) ORDER BY MONTH(show_time.show_date)'

        );
        return !empty($invoice[0]['total_ticket']) ? $invoice[0]['total_ticket'] : 0;
    }

    public function getMonthlyRoomRevenue()
    {
        $invoice_roomPrivate = $this->model->getListTableByCol('invoice_room_private', 'SUM(price) AS total_roomPrivate', 'WHERE YEAR(show_date) = YEAR(CURDATE()) AND MONTH(show_date) = MONTH(CURDATE()) GROUP BY  MONTH(show_date) ORDER BY MONTH(show_date)');
        $invoice_room = $this->model->getListTableByCol('invoice_room', 'SUM(final_total) AS total_room', 'WHERE YEAR(date_rent) = YEAR(CURDATE()) AND MONTH(date_rent) = MONTH(CURDATE()) GROUP BY  MONTH(date_rent) ORDER BY MONTH(date_rent)');

        $total_roomPrivate = !empty($invoice_roomPrivate) ? $invoice_roomPrivate[0]['total_roomPrivate'] : 0;
        $total_room = !empty($invoice_room) ? $invoice_room[0]['total_room'] : 0;
        $invoice = $total_roomPrivate + $total_room;
        return $invoice;
    }

    public function getWeeklyTicketRevenue()
    {
        $invoice = $this->model->getListFromTwoTablesByCol(
            'SUM(final_total) AS total_ticket',
            'invoice',
            'show_time',
            'id_showTime',
            'WHERE YEAR(show_time.show_date) = YEAR(CURDATE())  AND WEEK(show_time.show_date, 1) = WEEK(CURDATE(), 1) GROUP BY WEEK(show_time.show_date, 1) ORDER BY WEEK(show_time.show_date, 1)'
        );

        return !empty($invoice[0]['total_ticket']) ? $invoice[0]['total_ticket'] : 0;
    }

    public function getWeeklyRoomRevenue()
    {

        $invoice_roomPrivate = $this->model->getListTableByCol(
            'invoice_room_private',
            'SUM(price) AS total_roomPrivate',
            'WHERE YEAR(show_date) = YEAR(CURDATE()) AND WEEK(show_date, 1) = WEEK(CURDATE(), 1) GROUP BY WEEK(show_date, 1) ORDER BY WEEK(show_date, 1)'
        );

        $invoice_room = $this->model->getListTableByCol(
            'invoice_room',
            'SUM(final_total) AS total_room',
            'WHERE YEAR(date_rent) = YEAR(CURDATE()) AND WEEK(date_rent, 1) = WEEK(CURDATE(), 1) GROUP BY WEEK(date_rent, 1) ORDER BY WEEK(date_rent, 1)'
        );
        $total_roomPrivate = !empty($invoice_roomPrivate) ? $invoice_roomPrivate[0]['total_roomPrivate'] : 0;
        $total_room = !empty($invoice_room) ? $invoice_room[0]['total_room'] : 0;
        $invoice = $total_roomPrivate + $total_room;
        return $invoice;
    }
}
