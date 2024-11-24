<?php

class AccountModel extends Model
{
    private $model;
    public function __construct()
    {
        $this->model = new Model();
        $this->delAccountNoVerify();
    }

    public function checkPhoneExists($phone)
    {
        return $this->model->getListTable('customer', "where phone = $phone");

    }

    public function checkLogin($email, $password)
    {
        $customerResult = $this->model->getListTable('customer', "where email = '$email' and status = 1");
        $staffResult = $this->model->getListTable('staff', "where email = '$email' and status = 1");

        if ($customerResult) {
            $customer = $customerResult[0];
            if (password_verify($password, $customer['password'])) {
                $name_role = $this->model->getListTable('role', "where id_role =" . $customer['id_role']);
                $customer['name_role'] = $name_role[0]['name_role'];
                return $customer;
            }
        }
        if ($staffResult) {
            $staff = $staffResult[0];
            if (password_verify($password, $staff['password'])) {
                if($staff['id_role'] == 3 || $staff['id_role'] == 4 || $staff['id_role'] == 5){
                    $name_cinema = $this->model->getListTable('cinemas', "where id_cinema =" . $staff['id_cinema']);
                    $staff['name_cinema'] = $name_cinema[0]['cinema_name'] ?? 'Toàn rạp';
                }
                $name_role = $this->model->getListTable('role', "where id_role =" . $staff['id_role']);
                $staff['name_role'] = $name_role[0]['name_role'];
                return $staff;
            }
        }

        return false;

    }
    public function checkEmail($email)
    {
        $customer = $this->model->getListTable('customer', "where email = '$email'");
        $staff = $this->model->getListTable('staff', "where email = '$email'");

        if (!empty($customer) || !empty($staff)) {
            return true;
        }

        return false;
    }


    public function updateToken($updates, $email)
    {
        $customer = $this->model->getListTable('customer', "where email = '$email'");
        $staff = $this->model->getListTable('staff', "where email = '$email'");
        if (!empty($customer)) {
            return $this->model->updateData('customer', $updates, "where email = '$email'");
        }
        if (!empty($staff)) {
            return $this->model->updateData('staff', $updates, "where email = '$email'");
        }


    }

    public function checkToken($token)
    {
        $customer = $this->model->getListTable('customer', "where reset_token = '$token'");
        $staff = $this->model->getListTable('staff', "where reset_token = '$token'");
        if (!empty($customer) || !empty($staff)) {
            return true;
        }

        return false;


    }
    public function resetPassword($updates, $token)
    {
        $customer = $this->model->getListTable('customer', "where reset_token = '$token'");
        $staff = $this->model->getListTable('staff', "where reset_token = '$token'");
        if (!empty($customer)) {
            return $this->model->updateData('customer', $updates, "where reset_token = '$token'");
        }
        if (!empty($staff)) {
            return $this->model->updateData('staff', $updates, "where reset_token = '$token'");
        }


    }

    public function verifyAccount($updates, $token)
    {
        $customer = $this->model->getListTable('customer', "where reset_token = '$token'");
        if (!empty($customer)) {
            return $this->model->updateData('customer', $updates, "where reset_token = '$token'");
        }

    }

    public function delAccountNoVerify()
    {
        return $this->model->deleteData("customer", "where status = 0  and  token_expiration < NOW()");
    }

    public function convertDayToVietnamese($date) {
        $englishDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $vietnameseDays = ['Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy', 'Chủ Nhật'];
        
        // Lấy ngày của tuần từ $date
        $dayOfWeek = date('l', strtotime($date));

        // Chuyển đổi sang tiếng Việt
        $vietnameseDay = str_replace($englishDays, $vietnameseDays, $dayOfWeek);

        // Trả về ngày tiếng Việt
        return $vietnameseDay . ', ' . date('d/m/Y', strtotime($date));
    }
}
