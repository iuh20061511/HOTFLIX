<?php

class AccountModel extends Model
{
    private $model;
    public function __construct()
    {
        $this->model = new Model();
    }

    public function checkPhoneExists($phone)
    {
        return $this->model->getListTable('customer', "where phone = $phone");

    }

    public function checkLogin($email, $password)
    {
        $customerResult = $this->model->getListTable('customer', "where email = '$email'");
        $staffResult = $this->model->getListTable('staff', "where email = '$email'");

        if ($customerResult) {
            $customer = $customerResult[0];
            if (password_verify($password, $customer['password'])) {
                $name_role = $this->model->getListTable('role', "where id_role =" . $customer['id_role']);
                $customer['name_role'] = $name_role[0]['ten_role'];
                return $customer;
            }
        }
        if ($staffResult) {
            $staff = $staffResult[0];
            if (password_verify($password, $staff['password'])) {
                $name_role = $this->model->getListTable('role', "where id_role =" . $staff['id_role']);
                $staff['name_role'] = $name_role[0]['ten_role'];
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
}
