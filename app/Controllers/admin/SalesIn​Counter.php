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
        $showtimes = $this->model->getListFromThreeTables('room', 'show_time', 'movie', 'id_room', 'id_movie',  "WHERE show_time.id_movie != 0 AND show_time.show_date >= CURDATE()");
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
