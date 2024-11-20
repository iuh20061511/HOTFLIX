<?php
    class ExchangeGifts extends Controller{
        private $model;
        private $validate;

        private $data = [];

        public function __construct()
        {
            $this->model = $this->model('AccountModel');
            $this->validate = new Validate();
        }

        public function index()
        {
            // Thiết lập thông tin cơ bản
            $this->data['sub']['title'] = "Đổi quà";
            $id_account = $_SESSION['is_login']['id_account'];

            // Lấy thông tin người dùng và danh sách quà tặng
            $this->data['sub']['user'] = $this->model->getListTable('customer', "where id_customer = $id_account");
            $this->data['sub']['listGift'] = $this->model->getListTable('gifts', "where type = 'quà'");
            usort($this->data['sub']['listGift'], function ($a, $b) {
                return (int)$a['point'] - (int)$b['point'];
            });

            if(isset($_POST['btnSubmitExchange'])){
                $id_gift = $_POST['id_giftExchanged'];
                $pointGift = $_POST['point_giftExchanged'];
                $currentPoint = $this->data['sub']['user'][0]['points'];
                $updatePoint = $currentPoint - $pointGift;
                $data = [
                    'points' => $updatePoint
                ];
                $result1=$this->model->updateData('customer', $data, "where id_customer = $id_account");
                $dataGift = [
                    'id_customer' => $id_account,
                    'id_gift' => $id_gift,
                    'status' => 0,
                ];
                $result2=$this->model->InsertData('gift_details', $dataGift);
                if($result1 && $result2){
                    echo "<script>alert('Đổi quà thành công, vui lòng kiểm tra trong danh sách quà của bạn.')</script>";
                    $redirectUrl = "doi-qua.html";
                    header("refresh:0.5; url=$redirectUrl");
                }else{
                    echo "<script>alert('Đổi quà không thành công.')</script>";
                }
            }

            // Thiết lập nội dung view
            $this->data['content'] = 'client/exchangegifts';
            $this->view("layout/client", $this->data);
        }


    }
?>