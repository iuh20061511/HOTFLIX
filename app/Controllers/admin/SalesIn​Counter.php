<?php
class SalesIn​Counter extends Controller
{

    private $model;

    private $data = [];

    public function __construct()
    {
        $this->model = $this->model('HomeModel');
    }

    public function index()
    {
        $showtimes = $this->model->getListFromThreeTables(
            'room',
            'show_time',
            'movie',
            'id_room',
            'id_movie',
            "WHERE show_time.id_movie != 0 AND show_time.show_date >= CURDATE() AND
            STR_TO_DATE(CONCAT(show_time.show_date, ' ', show_time.start_time), '%Y-%m-%d %H:%i:%s') > CONVERT_TZ(NOW(), 'SYSTEM', 'Asia/Ho_Chi_Minh')
            ORDER BY show_time.start_time ASC"
        );
        $showTimesByCinema = array();
        foreach ($showtimes  as $item) {
            if ($item['id_cinema'] == $_SESSION['is_login']['id_cinema']) {
                $showTimesByCinema[] = $item;
            }
        }


        $this->data['sub']['showTimesByCinema'] = $showTimesByCinema;

        $this->data['content'] = 'admin/SalesCounter/Sales';

        $this->view("layout/admin", $this->data);
    }
}
