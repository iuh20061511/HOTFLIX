<?php
    class Rent_room extends Controller
    {
        private $model;
        private $validate;
        private $accountmodel;

        private $data = [];
        public function __construct()
        {
            $this->model = $this->model('AccountModel');
            $this->validate = new Validate();
            $this->accountmodel = new AccountModel();
        }

        public function index()
        {
            $this->data['sub']['title'] = "Trang thuê phòng";
            $this->data['sub']['listCinema'] = $this->model->getListTable('cinemas');
            if(isset($_SESSION['is_login']['id_account'])){
                if(isset($_POST['select_cinema']) && !empty($_POST['select_cinema'])){
                    $this->data['sub']['listRoom'] = $this->model->getListFromTwoTables('room','room_type','id_roomType'," WHERE id_cinema = '".$_POST['select_cinema']."'");
                }
                if (isset($_POST['continueChooseTime'])) {
                    $this->data['sub']['error']['dateRent'] = $this->validate->checkRoomRentDate($_POST['dateRent']);
                    $this->data['sub']['error']['room'] = $this->validate->checkSelect($_POST['room']);
                    if(array_filter($this->data['sub']['error']) == []){
                        $_SESSION['cinemaRent'] = $_POST['select_cinema'];
                        $_SESSION['dateRent'] = $_POST['dateRent'];
                        $_SESSION['roomRent'] = $_POST['room'];
                        $redirectUrl = "chon-khung-gio-thue.html";
                        header("refresh:0.5; url=$redirectUrl");
                    }
                }
            }else{
                $redirectUrl = _LINK."/dang-nhap.html";
                header("refresh:0.5; url=$redirectUrl");
            }

            $this->data['content'] = 'client/rent_room/chooseCinema';
            $this->view("layout/client", $this->data);
        }

        public function chooseTime_room(){
            $this->data['sub']['title'] = "Chọn khung giờ thuê";

            // Kiểm tra và lấy các giá trị từ session
            if (isset($_SESSION['cinemaRent'], $_SESSION['dateRent'], $_SESSION['roomRent'])) {
                $this->data['sub']['cinemaName'] = $this->model->getListTable('cinemas', " WHERE id_cinema = '".$_SESSION['cinemaRent']."'");
                $this->data['sub']['dateRent'] = $_SESSION['dateRent'];
                $roomRent = $this->model->getListTable('room', " WHERE id_room = '".$_SESSION['roomRent']."'");
                $this->data['sub']['roomRent']=$roomRent;

                $listShow = $this->model->getListTable('show_time', " WHERE id_room = '".$_SESSION['roomRent']."' AND show_date = '".$_SESSION['dateRent']."'");
                $this->data['sub']['showTimes'] = $listShow;
                $this->data['sub']['times'] = [
                    ['label' => '8:00 - 9:00', 'value' => '08:00:00-09:00:00'],
                    ['label' => '9:00 - 10:00', 'value' => '09:00:00-10:00:00'],
                    ['label' => '10:00 - 11:00', 'value' => '10:00:00-11:00:00'],
                    ['label' => '11:00 - 12:00', 'value' => '11:00:00-12:00:00'],
                    ['label' => '12:00 - 13:00', 'value' => '12:00:00-13:00:00'],
                    ['label' => '13:00 - 14:00', 'value' => '13:00:00-14:00:00'],
                    ['label' => '14:00 - 15:00', 'value' => '14:00:00-15:00:00'],
                    ['label' => '15:00 - 16:00', 'value' => '15:00:00-16:00:00'],
                    ['label' => '16:00 - 17:00', 'value' => '16:00:00-17:00:00'],
                    ['label' => '17:00 - 18:00', 'value' => '17:00:00-18:00:00'],
                    ['label' => '18:00 - 19:00', 'value' => '18:00:00-19:00:00'],
                    ['label' => '19:00 - 20:00', 'value' => '19:00:00-20:00:00'],
                    ['label' => '20:00 - 21:00', 'value' => '20:00:00-21:00:00'],
                    ['label' => '21:00 - 22:00', 'value' => '21:00:00-22:00:00'],
                    ['label' => '22:00 - 23:00', 'value' => '22:00:00-23:00:00'],
                ];
                //Tính toán tiền
                $roomType = $roomRent[0]['id_roomType']; // Lấy loại phòng
                $pricePerHour = 0;
                switch ($roomType) {
                    case '1':
                        $pricePerHour = 800000;
                        break;
                    case '2':
                        $pricePerHour = 400000;
                        break;
                    case '3':
                        $pricePerHour = 500000;
                        break;
                    case '4':
                        $pricePerHour = 600000;
                        break;
                    case '5':
                        $pricePerHour = 700000;
                        break;
                    default:
                        $pricePerHour = 0;
                        break;
                }
                $this->data['sub']['pricePerHour'] = $pricePerHour;

                if(isset($_POST['continuePay'])){
                    if(empty($_POST['timeRent']) || empty($_POST['selectedTime'])){
                        $this->data['sub']['error']['timeRent'] = 'Vui lòng chọn thời gian thuê phòng!';
                    }else{
                        $this->data['sub']['error'] = [];
                    }
                    if (array_filter($this->data['sub']['error']) == []) {
                        $timeParts = explode('-', $_POST['selectedTime']);
                        $data = [
                            'show_date' => $_POST['dateTime'],
                            'start_time' => $timeParts[0],
                            'end_time' => $timeParts[1],
                            'id_room' => $_POST['idRoom'],
                        ];
                        $result = $this->model->InsertData('show_time', $data);
                        if ($result) {
                            echo "<script>alert('Thuê phòng chiếu thành công')</script>";
                            $redirectUrl = "chon-rap-phong-chieu.html";
                            header("refresh:0.5; url=$redirectUrl");
                        }
                    }
                }
            } else {
                $redirectUrl ="chon-rap-phong-chieu.html";
                header("refresh:0.5; url= $redirectUrl");
            }

            // Hiển thị view của trang chọn khung giờ
            $this->data['content'] = 'client/rent_room/chooseTime';
            $this->view("layout/client", $this->data);
        }
    }
?>