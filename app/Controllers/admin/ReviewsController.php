<?php
class ReviewsController extends Controller
{
    
    private $model;

    private $data = [];

    public function __construct()
    {
        $this->model = $this->model('HomeModel');
    }

    public function index()
    {
        $this->data['sub']['title'] = "Trang Admin";

        $this->data['content'] = 'admin/reviews/listReview';

        $this->view("layout/admin", $this->data);
    }

    public function ok()
    {

        echo "p";

    }

    public function pages()
    {


    }


}