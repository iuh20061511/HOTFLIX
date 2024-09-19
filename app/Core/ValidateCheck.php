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
        return $this->model->getListTable('customer', "where phone = $phone");

    }

    public function checkEmailExists($email)
    {
        return $this->model->getListTable('customer', "where email = '$email'");

    }


}





?>