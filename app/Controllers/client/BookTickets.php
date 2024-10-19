<?php



class BookTickets extends Controller
{


    private $model;
    private $data = [];


    public function __construct()
    {
        $this->model = $this->model('HomeModel');
    }

    public function book($id_movie)
    {
        $this->data['sub']['text'] = "Chi tiết phim";
        $this->data['sub']['movieDetail'] = $this->model->getListTable('movie', "where id_movie=$id_movie");
        $this->data['sub']['listShowing'] = $this->model->getListTable('movie', "where status=1 and id_movie!=$id_movie");
        $this->data['sub']['listCinema'] = $this->model->getListTable('cinemas', "ORDER BY id_cinema asc");
        $id_cinema_default = isset($_GET['select-cinema']) ? $_GET['select-cinema'] : $this->data['sub']['listCinema'][0]['id_cinema'];
        $showtimes = $this->model->getListFromThreeTables('show_time', 'room', 'cinemas', 'id_room', 'id_cinema', "where cinemas.id_cinema=$id_cinema_default and id_movie=$id_movie");
        $showtimesByDate = [];
        foreach ($showtimes as $showtime) {
            $showtimesByDate[$showtime['show_date']][$showtime['projection_format']][] = $showtime;
        }
        $this->data['sub']['listShowTime'] = $showtimesByDate;
        $this->data['sub']['selectedCinema'] = $id_cinema_default;
        $this->data['sub']['cinemas'] = $this->model->getListTable('cinemas');
        $id_cinema = $_SESSION['id_cinema_customer'];
        $this->data['sub']['show_time'] = $this->model->getListFromTwoTables('show_time', 'room', 'id_room', "where room.id_cinema = $id_cinema and show_time.show_date >= now()");

        $this->data['content'] = 'home/BookTickets';
        $this->view("layout/client", $this->data);
    }
}
