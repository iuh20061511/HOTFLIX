<?php
class Showtime extends Controller
{

    private $model;

    private $data = [];

    public function __construct()
    {
        $this->model = $this->model('AdminModel');
    }
    public function addShowTime()
    {
        $this->data['sub']['title'] = "Trang Admin";
        $this->data['sub']['listMovie'] = $this->model->getListTable('movie');
        $this->data['sub']['listMovie'] = $this->model->getListTable('movie');
        $id_cinema = $_SESSION['is_login']['id_cinema'];
        $this->data['sub']['listRoom'] = $this->model->getListTable('room', "Where id_cinema =  $id_cinema ");

        if (isset($_POST['movie'])) {

            $values = explode(',', $_POST['movie']);
            $id_movie = $values[0];
            $duration = $values[1];
            $duration = roundCustom($duration / 60) + 1;


            $showtime = $this->model->getListTable('show_time');


            $time1 = new DateTime($showtime[0]['start_time']);
            $start = new DateTime($_POST['start_date']);
            $end = new DateTime($_POST['finish_date']);
            if ($time1 >= $start && $time1 <= $end) {
                $batdau = ($t = new DateTime($showtime['start_time']))->format('H') + $t->format('i') / 60;
                $kethuc = ($t = new DateTime($showtime['finish_time']))->format('H') + $t->format('i') / 60;

                $lichPhim = [
                    ['batDau' => $batdau, 'ketThuc' => $kethuc],  // Phim 1: 8h - 10h

                ];
                echo "<pre>";
                print_r($lichPhim);

            }
        }

        $this->data['content'] = 'showtime/add';


        $this->view("layout/admin", $this->data);
    }

}
function roundCustom($number)
{

    if (floor($number) == $number) {
        return $number;
    }

    $integerPart = floor($number);
    $fraction = $number - $integerPart;

    if ($fraction < 0.5) {
        return $integerPart + 0.5;
    } elseif ($fraction > 0.5) {
        return ceil($number);
    } else {
        return $number;
    }
}

