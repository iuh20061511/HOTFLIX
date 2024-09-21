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

        if($customerResult){
            $customer = $customerResult[0];
            if(password_verify($password, $customer['password'])){
                $name_role= $this->model->getListTable('role', "where id_role =" .$customer['id_role']);
                $customer['name_role'] = $name_role[0]['ten_role'];
                return $customer;
            }
        }
        if($staffResult){
            $staff = $staffResult[0];
            if(password_verify($password, $staff['password'])){
                $name_role= $this->model->getListTable('role', "where id_role =" .$staff['id_role']);
                $staff['name_role'] = $name_role[0]['ten_role'];
                return $staff;
            }
        }

        return false;

    }


}
