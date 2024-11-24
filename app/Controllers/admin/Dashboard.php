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

        if (isset($_POST['week'])) {
            $this->data['sub']['total_revenue'] = $this->getWeeklyTicketRevenue()['total_revenue'];
            $this->data['sub']['weeklyRevenueRate'] = $this->getWeeklyTicketRevenue()['weeklyRevenueRate'];

            $this->data['sub']['total_revenue_month'] = $this->getMothTicketRevenue()['total_revenue_month'];
            $this->data['sub']['monthlyRevenueRate'] = $this->getMothTicketRevenue()['monthlyRevenueRate'];
        }
        $this->data['sub']['calculateMovieRevenue'] = $this->calculateMovieRevenue();
        $this->data['content'] = 'admin/dashboard/dashboard';

        $this->view("layout/admin", $this->data);
    }

    public function getWeeklyTicketRevenue()
    {
        $WeeklyRevenue = array();
        if (isset($_POST['week'])) {
            list($year, $week) = explode("-W", $_POST['week']);

            $start_date = date("Y-m-d", strtotime("{$year}W" . str_pad($week, 2, "0", STR_PAD_LEFT)));
            $end_date = date("Y-m-d", strtotime("{$start_date} +6 days"));

            $start_date_previous_week = date("Y-m-d", strtotime("{$start_date} -7 days"));
            $end_date_previous_week = date("Y-m-d", strtotime("{$end_date} -7 days"));

            $invoice = $this->model->getListTableByCol('invoice', 'SUM(final_total) AS total_revenue', "WHERE create_date BETWEEN '$start_date' AND '$end_date'");
            $invoice_previous_week = $this->model->getListTableByCol('invoice', 'SUM(final_total) AS total_revenue', "WHERE create_date BETWEEN '$start_date_previous_week' AND '$end_date_previous_week'");

            if ($invoice_previous_week[0]['total_revenue'] > 0) {
                $weeklyRevenueRate = (($invoice[0]['total_revenue'] / $invoice_previous_week[0]['total_revenue']) * 100) - 100;
            } else {
                $weeklyRevenueRate = 100;
            }

            $WeeklyRevenue['total_revenue'] = $invoice[0]['total_revenue'] ?? 0;
            $WeeklyRevenue['weeklyRevenueRate'] = round($weeklyRevenueRate);

            return $WeeklyRevenue;
        }
        return false;
    }

    public function getMothTicketRevenue()
    {
        $MonthlyRevenue = array();
        if (isset($_POST['week'])) {
            list($year, $week) = explode("-W", $_POST['week']);

            $start_date = date("Y-m-01", strtotime("{$year}-W" . str_pad($week, 2, "0", STR_PAD_LEFT)));
            $end_date = date("Y-m-t", strtotime($start_date));

            $start_date_previous_month = date("Y-m-01", strtotime("{$start_date} -1 month"));
            $end_date_previous_month = date("Y-m-t", strtotime("{$end_date} -1 month"));

            $invoice = $this->model->getListTableByCol('invoice', 'SUM(final_total) AS total_revenue', "WHERE create_date BETWEEN '$start_date' AND '$end_date'");
            $invoice_previous_month = $this->model->getListTableByCol('invoice', 'SUM(final_total) AS total_revenue', "WHERE create_date BETWEEN '$start_date_previous_month' AND '$end_date_previous_month'");

            if ($invoice_previous_month[0]['total_revenue'] > 0) {
                $monthlyRevenueRate = (($invoice[0]['total_revenue'] / $invoice_previous_month[0]['total_revenue']) * 100) - 100;
            } else {
                $monthlyRevenueRate = 100;
            }


            $MonthlyRevenue['total_revenue_month'] = $invoice[0]['total_revenue'] ?? 0;
            $MonthlyRevenue['monthlyRevenueRate'] = round($monthlyRevenueRate);

            return $MonthlyRevenue;
        }

        return false;
    }


    public function calculateMovieRevenue()
    {
        $MovieRevenue = $this->model->getListFromThreeTablesByCol(
            'movie.movie_name, SUM(invoice.final_total) AS total_revenue, COUNT(show_time.id_movie) AS total_movie',
            'invoice',
            'show_time',
            'movie',
            'id_showTime',
            'id_movie',
            'GROUP BY movie.movie_name'
        );

        return $MovieRevenue;
    }
}
