<?php
class Cinemas extends Controller
{

    private $model;
    private $validate;
    private $data = [];

    public function __construct()
    {
        $this->model = $this->model('AdminModel');
        $this->validate = new Validate();
    }
    public function index()
    {
        $this->data['sub']['title'] = "Trang Quản lý rạp";

        $this->data['content'] = 'admin/cinemas/listCinema';
        $this->data['sub']['listCinema'] = $this->model->getListTable('cinemas');
        $this->data['sub']['listRoom'] = $this->model->getListRoom();

        $this->view("layout/admin", $this->data);

    }

    public function addNewCinema()
    {
        $this->data['sub']['title'] = "Trang thêm mới rạp phim";

        $this->data['content'] = 'admin/cinemas/addCinema';

        if (isset($_POST['addCinema'])) {
            if(!empty($_POST['cinema_name']) && strlen($_POST['cinema_name'])>=3){
                $this->data['sub']['error']['cinema_name'] = $this->validate->checkCinemaExist($_POST['cinema_name']);
            }else{
                $this->data['sub']['error']['cinema_name'] = $this->validate->checkFullName($_POST['cinema_name']);
            }
            $this->data['sub']['error']['contact'] = $this->validate->checkPhone($_POST['contact']);
            if(empty($_POST['number_address']) || empty($_POST['street_address']) || empty($_POST['ward_address'])) {
                $this->data['sub']['error']['address'] = "Vui lòng nhập đầy đủ địa chỉ!";
            }

            if (array_filter($this->data['sub']['error']) == []) {
                $address = "Số ".$_POST['number_address'].", Đường ".$_POST['street_address'].", P.".$_POST['ward_address'].", ".$_POST['district_address'].", ".$_POST['city_address'];
                $data = [
                    'cinema_name' => $_POST['cinema_name'],
                    'contact' => $_POST['contact'],
                    'address' => $address,
                    'status'=>1
                ];

                $result = $this->model->InsertData('cinemas', $data);
                if ($result) {
                    echo "<script>alert('Thêm rạp mới thành công')</script>";
                    $redirectUrl ="quan-ly-rap-phim.html";
                    header("refresh:0.5; url=$redirectUrl");
                }
            }
        }

        $this->view("layout/admin", $this->data);

    }

    public function updateCinema($id_cinema)
    {
        $this->data['sub']['title'] = "Trang thêm mới rạp phim";
        $this->data['sub']['listCinema'] = $this->model->getListTable('cinemas',"where id_cinema=".$id_cinema);


        $cinema = $this->model->getListTable('cinemas',"where id_cinema=".$id_cinema);
        $this->data['sub']['address_old'] = $this->model->splitAddress($cinema[0]['address']);

        if (isset($_POST['updateCinema'])) {
            if(!empty($_POST['cinema_name']) && strlen($_POST['cinema_name'])>=3){
                if($this->validate->checkNameCinemaExistsEdit($_POST['cinema_name'], $id_cinema)){
                    $this->data['sub']['error']['cinema_name'] = "Tên rạp phim này đã được sử dụng!";
                }
            }else{
                $this->data['sub']['error']['cinema_name'] = $this->validate->checkFullName($_POST['cinema_name']);
            }
            $this->data['sub']['error']['contact'] = $this->validate->checkPhone($_POST['contact']);
            if(empty($_POST['number_address']) || empty($_POST['street_address']) || empty($_POST['ward_address'])) {
                $this->data['sub']['error']['address'] = "Vui lòng nhập đầy đủ địa chỉ!";
            }

            if (array_filter($this->data['sub']['error']) == []) {
                $address = "Số ".$_POST['number_address'].", Đường ".$_POST['street_address'].", P.".$_POST['ward_address'].", ".$_POST['district_address'].", ".$_POST['city_address'];
                $data = [
                    'cinema_name' => $_POST['cinema_name'],
                    'contact' => $_POST['contact'],
                    'address' => $address,
                ];

                $result = $this->model->updateData('cinemas', $data, "where id_cinema = $id_cinema");
                if ($result) {
                    echo "<script>alert('Cập nhật thành công thông tin rạp')</script>";
                    $redirectUrl ="quan-ly-rap-phim.html";
                    header("refresh:0.5; url=$redirectUrl");
                }
            }
        }


        $this->data['content'] = 'admin/cinemas/updateCinema';
        $this->view("layout/admin", $this->data);
    }

    public function deleteCinema()
    {
        $this->data['sub']['title'] = "Xóa rạp phim";
        if(isset($_POST['deleteCinema'])){
            if (isset($_POST['id_cinema'])) {
                $id_cinema = $_POST['id_cinema'];
                $deleteStaff = $this->model->deleteData('staff', "where id_cinema = $id_cinema");
                $deleteRoom = $this->model->deleteData('room', "where id_cinema = $id_cinema");
                if($deleteStaff &&  $deleteRoom){
                    $result = $this->model->deleteData('cinemas', "where id_cinema = $id_cinema");
                    if ($result) {
                        echo "<script>alert('Xóa rạp phim thành công')</script>";
                        $redirectUrl ="quan-ly-rap-phim.html";
                        header("refresh:0.5; url=$redirectUrl");
                    }
                }
            }
        }
        $this->view("layout/admin", $this->data);
    }

    public function addNewRoomForCinema(){
        $this->data['sub']['title'] = "Thêm phòng cho rạp phim";
        $this->data['sub']['listTypeRoom'] = $this->model->getListTable('room_type');
        $this->data['sub']['listCinema'] = $this->model->getListTable('cinemas');

        if (isset($_POST['addRoom'])) {
            $this->data['sub']['error']['cinema'] = $this->validate->checkSelect($_POST['cinema']);
            $this->data['sub']['error']['type_room'] = $this->validate->checkSelect($_POST['type_room']);
            if($_POST['cinema']!=0 && strlen($_POST['room_name'])>=3){
                $this->data['sub']['error']['room_name'] = $this->validate->checkRoomOfCinemaExist($_POST['room_name'], $_POST['cinema']);
            }else{
                $this->data['sub']['error']['room_name'] = $this->validate->checkFullName($_POST['room_name']);
            }

            if (array_filter($this->data['sub']['error']) == []) {
                if($_POST['type_room']==1){
                    $number_seat = 48;
                }else if($_POST['type_room']==2){
                    $number_seat = 175;
                }else if($_POST['type_room']==3){
                    $number_seat = 250;
                }else if($_POST['type_room']==4){
                    $number_seat = 358;
                }else{
                    $number_seat = 1;
                }
                $data = [
                    'room_name' => $_POST['room_name'],
                    'number_seat' => $number_seat,
                    'id_roomType' => $_POST['type_room'],
                    'id_cinema' => $_POST['cinema'],
                    'status'=>1
                ];

                $result = $this->model->InsertData('room', $data);
                if ($result) {
                    echo "<script>alert('Thêm phòng chiếu mới thành công')</script>";
                    $redirectUrl ="them-phong-chieu.html";
                    header("refresh:0.5; url=$redirectUrl");
                }
            }



        }
        $this->data['content'] = 'admin/cinemas/addRoomForCinema';
        $this->view("layout/admin", $this->data);
    }


    public function updateRoomForCinema($id_room){
        $this->data['sub']['title'] = "Cập nhật phòng cho rạp phim";
        $this->data['sub']['listRoom'] = $this->model->getListTable('room', "where id_room=".$id_room);
        $room = $this->model->getListTable('room', "where id_room=".$id_room);
        $id_cinema = $room[0]['id_cinema'];
        $this->data['sub']['listTypeRoom'] = $this->model->getListTable('room_type');
        $this->data['sub']['cinema'] = $this->model->getListTable('cinemas', "where id_cinema=".$id_cinema);
        $this->data['sub']['listCinema'] = $this->model->getListTable('cinemas');

        if (isset($_POST['updateRoom'])) {
            if($_POST['cinema']!=0 && strlen($_POST['room_name'])>=3){
                $this->data['sub']['error']['room_name'] = $this->validate->checkRoomOfCinemaExist($_POST['room_name'], $_POST['cinema'],$id_room,true);
            }else{
                $this->data['sub']['error']['room_name'] = $this->validate->checkFullName($_POST['room_name']);
            }

            if (array_filter($this->data['sub']['error']) == []) {
                if($_POST['type_room']==1){
                    $number_seat = 48;
                }else if($_POST['type_room']==2){
                    $number_seat = 175;
                }else if($_POST['type_room']==3){
                    $number_seat = 250;
                }else if($_POST['type_room']==4){
                    $number_seat = 358;
                }else{
                    $number_seat = 1;
                }
                $data = [
                    'room_name' => $_POST['room_name'],
                    'number_seat' => $number_seat,
                    'id_roomType' => $_POST['type_room'],
                    'id_cinema' => $_POST['cinema'],
                    'status'=>1
                ];

                $result = $this->model->updateData('room', $data, "where id_room = $id_room");
                if ($result) {
                    echo "<script>alert('Cập nhật thành công thông tin phòng chiếu')</script>";
                    $redirectUrl ="quan-ly-rap-phim.html";
                    header("refresh:0.5; url=$redirectUrl");
                }
            }
        }


        $this->data['content'] = 'admin/cinemas/updateRoomForCinema';
        $this->view("layout/admin", $this->data);
    }


    public function deleteRooomForCinema(){
        $this->data['sub']['title'] = "Xóa phòng chiếu";
        if(isset($_POST['deleteRoom'])){
            if (isset($_POST['id_room'])) {
                $id_room = $_POST['id_room'];
                $result = $this->model->deleteData('room', "where id_room = $id_room");
                    if ($result) {
                        echo "<script>alert('Xóa phòng chiếu thành công')</script>";
                        $redirectUrl ="quan-ly-rap-phim.html";
                        header("refresh:0.5; url=$redirectUrl");
                    }
            }
        }
        $this->view("layout/admin", $this->data);
    }



}