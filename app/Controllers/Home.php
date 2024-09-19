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
        $this->data['d'] = 'okw';
        $this->data['sub']['con'] = $this->model->getList();
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

    public function details()
    {
        $this->data['sub']['text'] = "Danh sách text";
        $this->data['content'] = 'home/detail';
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