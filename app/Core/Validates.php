<?php

class Validate extends ValidateCheck
{

    public function checkPhone($phone)
    {
        if (empty($phone)) {
            return "Vui lòng nhập số điện thoại!";
        }
        if (!preg_match("/^0\d{9}$/", $phone)) {
            return "Số điện thoại phải bắt đầu từ số 0 và có 10 chữ số!";
        }
        $exists = $this->checkPhoneExists($phone);
        if ($exists) {
            return "Số điện thoại đã tồn tại!";
        }
        return '';
    }


    public function checkFullName($fullName)
    {

        if (empty($fullName)) {
            return "Tên đầy đủ không được để trống!";
        } elseif (strlen($fullName) < 2) {
            return "Tên đầy đủ phải có ít nhất 2 ký tự!";
        }

        return '';
    }


    public function checkEmail($email, $edit = false, $isForgot = false)
    {
        if (empty($email)) {
            return "Email không được để trống!";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Email không hợp lệ, vui lòng nhập lại!";
        }

        $exists = $this->checkEmailExists($email);
        if ($exists) {
            return "Email đã tồn tại!";
        }

        return '';
    }
    public function checkDateOfBirth($date)
    {
        if (empty($date)) {
            return "Vui lòng nhập ngày sinh !";

        } else {
            $born_date = new DateTime($date);
            $current_date = new DateTime();
            if ($born_date > $current_date) {
                return "Ngày sinh phải nhỏ hơn ngày hiện tại !";
            } else {
                return '';
            }
        }
    }


    function checkGender($gender)
    {
        if (empty($gender)) {
            return " Vui lòng chọn giới tính !";
        } else {
            return '';
        }
    }


    function checkPassword($password)
    {
        if (empty($password)) {
            return " Vui lòng nhập mật khẩu !";

        } else {
            if (strlen($password) < 6) {
                return " Mật khẩu phải có ít nhất 6 kí tự !";
            } else {
                return '';
            }
        }
    }

    function confirmPassword($confirm_password, $password)
    {
        if (empty($confirm_password)) {
            return " Vui lòng nhập lại mật khẩu !";
        } else {
            if ($confirm_password != $password) {
                return " Mật khẩu không khớp !";
            } else {
                return '';
            }
        }
    }

    function checkEmpty($string1, $string2){
        if (empty($string1) || empty($string2)) {
            return "Vui lòng nhập đầy đủ thông tin!";
        }else{
            return '';
        }
    }
}


?>