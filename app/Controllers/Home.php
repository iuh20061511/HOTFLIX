<?php

class Home extends Controller
{


    private $model;
    private $data = [];


    public function __construct()
    {
        $this->model = $this->model('HomeModel');
    }
    public function index()
    {

        $this->data['sub']['listShowing'] = $this->model->getListFromTwoTables('show_time', 'movie',  'id_movie', "WHERE show_time.show_date BETWEEN CURRENT_DATE AND DATE_ADD(CURRENT_DATE, INTERVAL 6 DAY)");
        $this->data['sub']['listComingSoon'] = $this->model->getListFromTwoTables('show_time', 'movie',  'id_movie', "WHERE show_time.show_date >= NOW() + INTERVAL 6 DAY");
        if (isset($_SESSION['is_login']['id_role']) && $_SESSION['is_login']['id_role'] == 1) {
            $id_customer = $_SESSION['is_login']['id_account'];
            $this->data['sub']['showtime_notifications'] = $this->model->getListTable('showtime_notifications', "where id_customer =  $id_customer");
        }


        if (isset($_POST['movie'])) {
            $data = [
                'id_movie' => $_POST['movie'],
                'id_customer' => $_SESSION['is_login']['id_account']
            ];
            $this->model->InsertData('showtime_notifications', $data);
        }
        $this->data['sub']['text'] = "Danh sách text";

        $this->data['content'] = 'home/homePage';

        $this->view("layout/client", $this->data);
    }



    public function movieDetail($id_movie)
    {
        $this->data['sub']['text'] = "Chi tiết phim";
        $this->data['sub']['movieDetail'] = $this->model->getListTable('movie', "where id_movie=$id_movie");
        $this->data['sub']['listShowing'] = $this->model->getListTable('movie', "where status=1 and id_movie!=$id_movie");
        $this->data['sub']['listCinema'] = $this->model->getListTable('cinemas', "ORDER BY id_cinema asc");
        // Kiểm tra xem có giá trị cinema từ GET không, nếu không thì lấy giá trị mặc định
        $showtimes = $this->model->getListFromThreeTables('room', 'show_time', 'movie', 'id_room', 'id_movie',  "WHERE show_time.show_date >= CURDATE() AND show_time.id_movie = $id_movie");

        $current_time = new DateTime();
        $new_array = [];

        foreach ($showtimes  as $item) {
            $show_time = new DateTime($item['show_date'] . ' ' . $item['start_time']);
            if ($show_time->getTimestamp() >= $current_time->getTimestamp() + 1.5 * 60 * 60) {
                $new_array[] = $item;
            }
        }
        $this->data['sub']['show_time'] = $new_array;

        $this->data['content'] = 'home/movieDetail';
        $this->view("layout/client", $this->data);
    }

    public function cinemaDetail($id_cinema)
    {
        $this->data['sub']['text'] = "Chi tiết rạp";
        $this->data['sub']['cinema'] = $this->model->getListTable('cinemas', "where id_cinema=$id_cinema");
        $this->data['sub']['listShowing'] = $this->model->getListTable('movie', "where status=1");
        $this->data['sub']['listMovie'] = $this->model->getListTable('movie', "order by id_movie desc");
        $folder = 'app/public/assets/img/cinema/' . $id_cinema; // Thư mục cần lấy danh sách file
        $this->data['sub']['listCinemaImage'] = array_map('basename', glob($folder . '/*'));
        // Kiểm tra id_rạp là chẵn hay lẻ
        // $is_even = ($id_cinema % 2 === 0);
        // $filteredFiles = array_filter($files, function($key) use ($is_even) {
        //     return ($is_even) ? ($key % 2 === 0) : ($key % 2 !== 0);
        // }, ARRAY_FILTER_USE_KEY);
        // $this->data['sub']['listCinemaImage'] = array_slice($filteredFiles, 0, 6);


        $this->data['content'] = 'home/cinemaDetail';
        $this->view("layout/client", $this->data);
    }

    public function promotion()
    {
        $this->data['sub']['text'] = "Chương trình khuyến mãi";
        $this->data['sub']['listMovie'] = $this->model->getListTable('movie', "order by id_movie desc");
        $this->data['sub']['listPromotion'] = $this->model->getListTable('promotion');


        $this->data['content'] = 'home/promotion';
        $this->view("layout/client", $this->data);
    }

    public function roomAgv()
    {
        $this->data['sub']['text'] = "Danh sách text";

        $this->data['content'] = 'home/room/roomAgv';

        $this->view("layout/client", $this->data);
    }

    public function roomBig()
    {
        $this->data['sub']['text'] = "Danh sách text";

        $this->data['content'] = 'home/room/roomBig';

        $this->view("layout/client", $this->data);
    }


    public function roomSmall()
    {
        $this->data['sub']['text'] = "Danh sách text";

        $this->data['content'] = 'home/room/roomSmall';

        $this->view("layout/client", $this->data);
    }

    public function roomVip()
    {
        $this->data['sub']['text'] = "Danh sách text";

        $this->data['content'] = 'home/room/roomVip';

        $this->view("layout/client", $this->data);
    }

    public function roomPrivate()
    {
        $this->data['sub']['text'] = "Danh sách text";

        $this->data['content'] = 'home/room/roomPrivate';

        $this->view("layout/client", $this->data);
    }

    public function book()
    {
        $this->data['sub']['text'] = "Danh sách text";

        $this->data['content'] = 'home/book';

        $this->view("layout/client", $this->data);
    }
    public function pay()
    {
        $this->data['sub']['text'] = "Danh sách text";

        $this->data['content'] = 'home/pay';

        $this->view("layout/client", $this->data);
    }

    public function error_404()
    {
        $this->view("errors/404");
    }
}
