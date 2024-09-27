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


    // public function checkEmailExistsEdit($email){
    //     $id_user = openssl_decrypt(base64_decode($_GET['id']), 'AES-128-ECB', 'Lampart');
    //     $user = $this->model->selectData( 'users','*' ,"id_user = $id_user");
    //     $emailAccount= $user[0]["email"];
    //     return $this->model->selectData(  'users', '*', "email = '$email' AND email != '$emailAccount'"
    //     );
    // }


}

?>