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
        return $this->model->getListFromThreeTables('role', 'staff', 'cinemas', 'id_role', 'id_cinema');
    }

    public function getListMember()
    {
        return $this->model->getListFromThreeTables('role', 'customer', 'rank', 'id_role', 'id_rank');
    }

    public function infoStaff($id_staff)
    {
        return $this->model->getListFromThreeTables('role', 'staff', 'cinemas', 'id_role', 'id_cinema', "WHERE staff.id_staff = $id_staff");
    }

    public function getListRoom()
    {
        return $this->model->getListFromTwoTables('room', 'room_type', 'id_roomType');
    }

    public function splitAddress($address)
    {
        // Tách chuỗi thành mảng dựa trên dấu phẩy
        $parts = array_map('trim', explode(',', $address));

        // Lấy các phần tử ngược lại và gán cho biến
        $district = $parts[count($parts) - 2];
        $ward = $parts[count($parts) - 3];
        $street = $parts[count($parts) - 4];
        $number = $parts[count($parts) - 5];


        // Loại bỏ các chữ không mong muốn
        $number = str_replace("Số ", "", $number);
        $street = str_replace("Đường ", "", $street);
        $ward = str_replace("P.", "", $ward);

        // Trả về dưới dạng mảng hoặc có thể xuất ra tùy ý
        return [
            'number_address' => $number,
            'street_address' => $street,
            'ward_address' => $ward,
            'district_address' => $district,
        ];
    }

    public function upload($name, $tmp_name, $fd)
    {
        if ($name != '') {
            $des = $fd . "/" . $name;
            if (move_uploaded_file($tmp_name, $des)) {
                return 1;
            } else {
                return 0;
            }
        }
    }


}
