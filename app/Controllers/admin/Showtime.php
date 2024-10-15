<?php
class Showtime extends Controller
{

    private $model;
    private $hander;

    private $data = [];

    public function __construct()
    {
        $this->model = $this->model('AdminModel');
        $this->hander = new Handler();
    }
    public function addShowTime()
    {
        $this->data['sub']['title'] = "Trang Admin";
        $this->data['sub']['listMovie'] = $this->model->getListTable('movie');
        $this->data['sub']['listMovie'] = $this->model->getListTable('movie');
        $id_cinema = $_SESSION['is_login']['id_cinema'];
        $this->data['sub']['listRoom'] = $this->model->getListTable('room', " where id_cinema =  $id_cinema ");




        if (isset($_SESSION['t2'])) {
            $t2 = date('Y-m-d', strtotime(str_replace('/', '-', $_SESSION['t2'])));
            $t3 = date('Y-m-d', strtotime(str_replace('/', '-', $_SESSION['t3'])));
            $t4 = date('Y-m-d', strtotime(str_replace('/', '-', $_SESSION['t4'])));
            $t5 = date('Y-m-d', strtotime(str_replace('/', '-', $_SESSION['t5'])));
            $t6 = date('Y-m-d', strtotime(str_replace('/', '-', $_SESSION['t6'])));
            $t7 = date('Y-m-d', strtotime(str_replace('/', '-', $_SESSION['t7'])));
            $t8 = date('Y-m-d', strtotime(str_replace('/', '-', $_SESSION['t8'])));

            if (!empty($_POST['movie']) && !empty($_POST['room'])) {
                $_SESSION['room'] = $_POST['room'];
                $_SESSION['movie'] = $_POST['movie'];
            }
            if (isset($_SESSION['room'])) {
                $id_room =  $_SESSION['room'];
            } else {
                $id_room = 0;
            }
            if (isset($_SESSION['movie'])) {
                $movie = $_SESSION['movie'];
                $values = explode(',', $movie);
                $id_movie = $values[0];
                $_SESSION['id_movie'] =  $id_movie;
                if (isset($values[1])) {
                    $duration = $values[1];
                    $duration = $this->hander->roundCustom($duration / 60) + 1;
                }
            }

            $show_t2  = $this->model->getListTable("show_time", "where show_date='$t2' and id_room= $id_room ");
            $show_t3 = $this->model->getListTable("show_time", "where show_date='$t3' and id_room= $id_room ");
            $show_t4  = $this->model->getListTable("show_time", "where show_date='$t4' and id_room= $id_room ");
            $show_t5  = $this->model->getListTable("show_time", "where show_date='$t5' and id_room= $id_room ");
            $show_t6  = $this->model->getListTable("show_time", "where show_date='$t6' and id_room= $id_room ");
            $show_t7  = $this->model->getListTable("show_time", "where show_date='$t7' and id_room= $id_room ");
            $show_t8 = $this->model->getListTable("show_time", "where show_date='$t8' and id_room= $id_room ");
            $lichPhim = [];

            $show_t_list = [
                't8' => $show_t8,
                't7' => $show_t7,
                't6' => $show_t6,
                't5' => $show_t5,
                't4' => $show_t4,
                't3' => $show_t3,
                't2' => $show_t2,
            ];

            foreach ($show_t_list as $key => $shows) {
                $lichPhim[$key] = [];
                foreach ($shows as $show) {
                    $lichPhim[$key][] = [
                        'batDau' => intval($show['start_time']) + substr($show['start_time'], 3, 2) / 60,
                        'ketThuc' => intval($show['end_time']) + substr($show['end_time'], 3, 2) / 60,
                    ];
                }
            }
            if (isset($duration)) {
                foreach ($lichPhim as $key => $lich) {
                    $this->data['sub']['time_' . $key] = $this->hander->timKhoangThoiGianKhaDung($lich, $duration);
                }
            }



            $this->data['sub']['show_time_t2']  =   $this->model->getListFromThreeTables("movie", "show_time", "room", "id_movie", "id_room", "where show_date='$t2' and room.id_room=$id_room AND room.id_cinema =  $id_cinema ORDER BY  start_time");
            $this->data['sub']['show_time_t3']  =   $this->model->getListFromThreeTables("movie", "show_time", "room", "id_movie", "id_room", "where show_date='$t3' and room.id_room=$id_room AND room.id_cinema =  $id_cinema ORDER BY  start_time");
            $this->data['sub']['show_time_t4']  =   $this->model->getListFromThreeTables("movie", "show_time", "room", "id_movie", "id_room", "where show_date='$t4' and room.id_room=$id_room AND room.id_cinema =  $id_cinema ORDER BY  start_time");
            $this->data['sub']['show_time_t5']  =   $this->model->getListFromThreeTables("movie", "show_time", "room", "id_movie", "id_room", "where show_date='$t5' and room.id_room=$id_room AND room.id_cinema =  $id_cinema ORDER BY  start_time");
            $this->data['sub']['show_time_t6']  =   $this->model->getListFromThreeTables("movie", "show_time", "room", "id_movie", "id_room", "where show_date='$t6' and room.id_room=$id_room AND room.id_cinema =  $id_cinema ORDER BY  start_time");
            $this->data['sub']['show_time_t7']  =   $this->model->getListFromThreeTables("movie", "show_time", "room", "id_movie", "id_room", "where show_date='$t7' and room.id_room=$id_room AND room.id_cinema =  $id_cinema ORDER BY  start_time");
            $this->data['sub']['show_time_t8']  =   $this->model->getListFromThreeTables("movie", "show_time", "room", "id_movie", "id_room", "where show_date='$t8' and room.id_room=$id_room AND room.id_cinema =  $id_cinema ORDER BY  start_time");

            if (isset($_POST['prev'])) {
                header("refresh:0; url=http://localhost/HOTFLIX/quan-ly-suat-chieu.html");
            } else if (isset($_POST['next'])) {
                header("refresh:0; url=http://localhost/HOTFLIX/quan-ly-suat-chieu.html");
            } else if (isset($_POST['current'])) {
                header("refresh:0; url=http://localhost/HOTFLIX/quan-ly-suat-chieu.html");
            }
        }
        $time = array();
        $show_date = '';
        if (isset($_POST['submit'])) {
            $i = 0;
            $insert_successful = false;
            foreach ($_POST as $index => $key) {
                if ($index != 'submit' && $index != 'date_time') {
                    $pending_time = $this->hander->splitInput($index);

                    if (count($pending_time) >= 2) {
                        $time['start_end'][$i][0] = $this->hander->convertToTime($pending_time[0]);
                        $time['start_end'][$i][1] = $this->hander->convertToTime($pending_time[1]);
                        $i++;
                    }
                }

                if ($index == 'date_time') {
                    $date = $_POST['date_time'];
                    $formatted_date = date('Y-m-d', strtotime(str_replace('/', '-', $date)));
                    $show_date = $formatted_date;
                }
            }
            foreach ($time['start_end'] as $time_slot) {
                $data = [
                    'show_date' => $show_date,
                    'id_movie' => $id_movie,
                    'id_room' => $id_room,
                    'projection_format' => $_POST['projection_format'],
                    'start_time' => $time_slot[0],
                    'end_time' => $time_slot[1]
                ];


                $result = $this->model->InsertData('show_time', $data);
                if ($result) {
                    $insert_successful = true;
                }
            }

            if ($insert_successful) {
                echo "<script>alert('Lên lịch bộ phim thành công!');</script>";
                $redirectUrl = "quan-ly-suat-chieu.html";
                header("refresh:0.5; url=$redirectUrl");
            };
        }


        $this->data['content'] = 'admin/showtime/add2';


        $this->view("layout/admin", $this->data);
    }


    public function deleteShowTime($id_showTime)
    {
        $result = $this->model->deleteData('show_time', "where id_showTime = $id_showTime");
        if ($result) {
            echo "<script>alert('Xóa thành công')</script>";
            $redirectUrl = "quan-ly-suat-chieu.html";
            header("refresh:0.5; url=$redirectUrl");
        }
    }
}
