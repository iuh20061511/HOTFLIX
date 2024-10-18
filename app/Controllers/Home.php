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
        // $this->data['sub']['con'] = $this->model->getList();
        $this->data['sub']['listComingSoon'] = $this->model->getListTable('movie', "where status=0");
        $this->data['sub']['listShowing'] = $this->model->getListTable('movie', "where status=1");
        $this->data['sub']['text'] = "Danh sách text";

        $this->data['content'] = 'home/homePage';

        $this->view("layout/client", $this->data);
    }

    public function detail($id, $a, $b)
    {
        echo $id;
        echo $a;
        echo $b;
        echo $_GET['a'];

    }

    public function movieDetail($id_movie)
    {
        $this->data['sub']['text'] = "Chi tiết phim";
        $this->data['sub']['movieDetail'] = $this->model->getListTable('movie', "where id_movie=$id_movie");
        $this->data['sub']['listShowing'] = $this->model->getListTable('movie', "where status=1 and id_movie!=$id_movie");
        $this->data['sub']['listCinema'] = $this->model->getListTable('cinemas', "ORDER BY id_cinema asc");
        // Kiểm tra xem có giá trị cinema từ GET không, nếu không thì lấy giá trị mặc định
        $id_cinema_default = isset($_GET['select-cinema']) ? $_GET['select-cinema'] : $this->data['sub']['listCinema'][0]['id_cinema'];
        // Lấy danh sách suất chiếu dựa trên rạp đã chọn
        $showtimes = $this->model->getListFromThreeTables('show_time', 'room', 'cinemas', 'id_room', 'id_cinema', "where cinemas.id_cinema=$id_cinema_default and id_movie=$id_movie");
        // Tổ chức suất chiếu theo ngày và định dạng
        $showtimesByDate = [];
        foreach ($showtimes as $showtime) {
            $showtimesByDate[$showtime['show_date']][$showtime['projection_format']][] = $showtime;
        }
        $this->data['sub']['listShowTime']= $showtimesByDate;
        $this->data['sub']['selectedCinema'] = $id_cinema_default;
        $this->data['content'] = 'home/movieDetail';
        $this->view("layout/client", $this->data);
    }

    public function cinemaDetail($id_cinema)
    {
        $this->data['sub']['text'] = "Chi tiết rạp";
        $this->data['sub']['cinema'] = $this->model->getListTable('cinemas', "where id_cinema=$id_cinema");
        $this->data['sub']['listShowing'] = $this->model->getListTable('movie', "where status=1");
        $this->data['sub']['listMovie'] = $this->model->getListTable('movie' , "order by id_movie desc");
        $folder = 'app/public/assets/img/cinema/'.$id_cinema; // Thư mục cần lấy danh sách file
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

}