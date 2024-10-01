<?php

class ValidateCheck extends Model
{
    private $model;
    public function __construct()
    {
        $this->model = new Model();
    }

    public function checkPhoneExists($phone)
    {
        $customerResult = $this->model->getListTable('customer', "where phone = '$phone'");
        $staffResult = $this->model->getListTable('staff', "where phone = '$phone'");
        if($customerResult){
            return true;
        }else if($staffResult){
            return true;
        }
        return false;
    }

    public function checkPhoneExistsEdit($phone,$id_user)
    {
        $customer = $this->model->getListTable('customer', "where id_customer = '$id_user'");
        $staff = $this->model->getListTable('staff', "where id_staff = '$id_user'");

        if ($customer) {
            $phoneAccount = $customer[0]["phone"];
        } else if ($staff) {
            $phoneAccount = $staff[0]["phone"];
        } else {
            return false;
        }

        // Kiểm tra số điện thoại có tồn tại trong cả hai bảng, nhưng bỏ qua số cũ
        $customerResult = $this->model->getListTable('customer', "where phone = '$phone' AND phone != '$phoneAccount'");
        $staffResult = $this->model->getListTable('staff', "where phone = '$phone' AND phone != '$phoneAccount'");

        // Nếu số điện thoại đã tồn tại trong bất kỳ bảng nào
        if (!empty($customerResult) || !empty($staffResult)) {
            return true;
        }

    // Không có số điện thoại trùng lặp
    return false;
    }

    public function checkCinemaExist($cinema_name)
    {
        $result = $this->model->getListTable('cinemas', "WHERE cinema_name LIKE '%$cinema_name%' LIMIT 1");

        if (!empty($result)) {
            return "Tên rạp phim này đã được sử dụng!";
        }

        return '';
    }

    public function checkNameCinemaExistsEdit($name_cinema,$id_cinema)
    {
        $cinema = $this->model->getListTable('cinemas', "where id_cinema = '$id_cinema'");

        if ($cinema) {
            $cinemaAccount = $cinema[0]["cinema_name"];
        } else {
            return false;
        }

        // Kiểm tra số tên rập có tồn tại, nhưng bỏ qua tên cũ
        $cinemaResult = $this->model->getListTable('cinemas', "where cinema_name = '$name_cinema' AND cinema_name != '$cinemaAccount'");

        // Nếu tên đã tồn tại
        if (!empty($cinemaResult)) {
            return true;
        }

    // Không có số điện thoại trùng lặp
    return false;
    }

    public function checkMovieExist($movie_name)
    {
        $result = $this->model->getListTable('movie', "WHERE movie_name LIKE '%$movie_name%' LIMIT 1");

        if (!empty($result)) {
            return "Tên bộ phim này đã được sử dụng!";
        }

        return '';
    }

    public function checkNameMovieExistsEdit($name_movie,$id_movie)
    {
        $movie = $this->model->getListTable('movie', "where id_movie = '$id_movie'");

        if ($movie) {
            $movieAccount = $movie[0]["movie_name"];
        } else {
            return false;
        }

        // Kiểm tra số tên rập có tồn tại, nhưng bỏ qua tên cũ
        $movieResult = $this->model->getListTable('movie', "where movie_name = '$name_movie' AND movie_name != '$movieAccount'");

        // Nếu tên đã tồn tại
        if (!empty($movieResult)) {
            return true;
        }

    // Không có số điện thoại trùng lặp
    return false;
    }

    public function checkEmailExists($email)
    {
        $customerResult = $this->model->getListTable('customer', "where email = '$email'");
        $staffResult = $this->model->getListTable('staff', "where email = '$email'");

        if($customerResult){
            return true;
        }else if($staffResult){
            return true;
        }
            return false;
    }

    public function checkRoomOfCinemaExist($room_name, $id_cinema, $id_room='',$isEdit=false)
    {
        if($isEdit){
            $room = $this->model->getListTable('room', "where id_cinema=$id_cinema and id_room='$id_room'");
            if($room){
                $roomNameOld = $room[0]["room_name"];
                if (strcasecmp($room_name, $roomNameOld) != 0) {
                    $roomResult = $this->model->getListTable('room', "where id_cinema='$id_cinema' AND room_name = '$room_name' AND room_name != '$roomNameOld'");
                    if (!empty($roomResult)) {
                        return "Tên phòng đã được sử dụng cho rạp này!";
                    }
                }
            }
        }else{
            $room = $this->model->getListTable('room', "where id_cinema=$id_cinema and room_name='$room_name'");
            if($room){
                return "Tên phòng đã được sử dụng cho rạp bạn chọn!";
            }
        }
        return '';
    }

    public function checkItemExist($item_name)
    {
        $result = $this->model->getListTable('menu_items', "WHERE item_name LIKE '%$item_name%' LIMIT 1");

        // Nếu tìm thấy kết quả, trả về thông báo, ngược lại trả về chuỗi rỗng
        if (!empty($result)) {
            return "Tên mặt hàng này đã được sử dụng!";
        }

        return '';
    }

    public function checkNameItemExistsEdit($item_name,$id_item)
    {
        $item = $this->model->getListTable('menu_items', "where id_item = '$id_item'");

        if ($item) {
            $itemName = $item[0]["item_name"];
        } else {
            return false;
        }

        // Kiểm tra số tên rập có tồn tại, nhưng bỏ qua tên cũ
        $itemResult = $this->model->getListTable('menu_items', "where item_name = '$item_name' AND item_name != '$itemName'");

        // Nếu tên đã tồn tại
        if (!empty($itemResult)) {
            return true;
        }

    // Không có số điện thoại trùng lặp
    return false;
    }

}

?>