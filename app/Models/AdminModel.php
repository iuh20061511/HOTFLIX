<?php


class AdminModel extends Model
{
    private $model;
    public function __construct()
    {
        $this->model = new Model();
    }

    public function getListStaff()
    {
        return $this->model->getListFromThreeTables('role','staff','cinemas','id_role','id_cinema');
    }

    public function getListMember()
    {
        return $this->model->getListFromThreeTables('role','customer','rank','id_role','id_rank');
    }

    public function infoStaff($id_staff)
    {
        return $this->model->getListFromThreeTables('role','staff','cinemas','id_role','id_cinema',"WHERE staff.id_staff = $id_staff");
    }
}
