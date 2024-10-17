<?php
class Menu_Items extends Controller
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
        $this->data['sub']['title'] = "Trang quản lý bắp nước-combo";
        $this->data['sub']['quantityItem'] = count($this->model->getListTable('menu_items'));
        // Khởi tạo biến điều kiện
        $getConditions = [];
        $conditions = "";

        // Xử lý tìm kiếm
        if (isset($_GET['search_nameItem']) && !empty($_GET['search_nameItem'])) {
            $search_nameItem = $_GET['search_nameItem'];
            $getConditions[] = "item_name LIKE '%$search_nameItem%' OR description LIKE '%$search_nameItem%'";
        }

        // Tạo điều kiện cho câu truy vấn
        if (!empty($getConditions)) {
            $conditions = " WHERE " . implode(" AND ", $getConditions);
        }

        $this->data['sub']['listMenuItem'] = $this->model->getListTable('menu_items', $conditions . " ORDER BY id_item");
        $this->data['content'] = 'admin/menu_items/listMenuItem';

        $this->view("layout/admin", $this->data);
    }

    public function addNewItem()
    {
        $this->data['sub']['title'] = "Trang Thêm bắp nước";

        if (isset($_POST['addItem'])) {
            if(!empty($_POST['item_name']) && strlen($_POST['item_name'])>2){
                $this->data['sub']['error']['item_name'] = $this->validate->checkItemExist($_POST['item_name']);
            }else{
                $this->data['sub']['error']['item_name'] = $this->validate->checkFullName($_POST['item_name']);
            }
            $this->data['sub']['error']['description'] = $this->validate->checkStringEmpty($_POST['description']);
            $this->data['sub']['error']['price'] = $this->validate->checkEmptyNumber($_POST['price'], 20000);

            if (empty($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
                $this->data['sub']['error']['image'] = "Vui lòng chọn poster mặt hàng!";
            } else {
                $name = time()."_".$_FILES['image']['name'];
                $tmp_name = $_FILES['image']['tmp_name'];
            }

            if (array_filter($this->data['sub']['error']) == []) {
                $des_upload = "app/public/admin/img/menu_items";
                if($this->model->upload($name,$tmp_name,$des_upload)!=1)
                    {
                        echo "<script>alert('Lưu poster bắp nước thất bại!');</script>";
                    }else{
                        $data = [
                            'item_name' => $_POST['item_name'],
                            'description' => $_POST['description'],
                            'price' => $_POST['price'],
                            'image' => $name
                        ];
                        $result = $this->model->InsertData('menu_items', $data);
                        if ($result) {
                            echo "<script>alert('Thêm mặt hàng mới thành công')</script>";
                            $redirectUrl ="quan-ly-bap-nuoc.html";
                            header("refresh:0.5; url=$redirectUrl");
                        }
                    }
            }
        }

        $this->data['content'] = 'admin/menu_items/addItem';

        $this->view("layout/admin", $this->data);
    }

    public function updateItem($id_item)
    {
        $this->data['sub']['title'] = "Trang Cập nhật bắp nước-combo";

        $this->data['sub']['itemUpdate'] = $this->model->getListTable('menu_items',"where id_item=$id_item");

        if (isset($_POST['updateItem'])) {
            if(!empty($_POST['item_name']) && strlen($_POST['item_name'])>=3){
                if($this->validate->checkNameItemExistsEdit($_POST['item_name'], $id_item)){
                    $this->data['sub']['error']['item_name'] = "Tên mặt hàng đã được sử dụng!";
                }
            }else{
                $this->data['sub']['error']['item_name'] = $this->validate->checkFullName($_POST['item_name']);
            }
            $this->data['sub']['error']['description'] = $this->validate->checkStringEmpty($_POST['description']);
            $this->data['sub']['error']['price'] = $this->validate->checkEmptyNumber($_POST['price'], 20000);

            if (array_filter($this->data['sub']['error']) == []) {
                $item = $this->model->getListTable('menu_items', "where id_item=$id_item");
                $img_old = $item[0]['image'];

                if (!empty($_FILES['image']['name'])) {
                    $name = time()."_".$_FILES['image']['name'];
                    $tmp_name = $_FILES['image']['tmp_name'];
                    $des_upload = "app/public/admin/img/menu_items";
                    $des_unload = "app/public/admin/img/menu_items/$img_old";

                    // Kiểm tra và xóa poster cũ nếu tồn tại
                    if (file_exists($des_unload)) {
                        unlink($des_unload);
                    }

                    // Upload poster mới
                    if ($this->model->upload($name, $tmp_name, $des_upload) != 1) {
                        echo "<script>alert('Lưu poster mới cho mặt hàng thất bại!');</script>";
                        return; // Ngừng quá trình nếu upload thất bại
                    }
                } else {
                    $name = $img_old; // Không có file mới, giữ nguyên poster cũ
                }
                $data = [
                    'item_name' => $_POST['item_name'],
                    'description' => $_POST['description'],
                    'price' => $_POST['price'],
                    'image' => $name
                ];
                $result = $this->model->updateData('menu_items', $data, "where id_item = $id_item");
                if ($result) {
                    echo "<script>alert('Cập nhật mặt hàng thành công')</script>";
                    $redirectUrl = "quan-ly-bap-nuoc.html";
                    header("refresh:0.5; url=$redirectUrl");
                }
            }
        }

        $this->data['content'] = 'admin/menu_items/updateItem';

        $this->view("layout/admin", $this->data);

    }

    public function deleteItem()
    {
        $this->data['sub']['title'] = "Xóa voucher";

        if(isset($_POST['deleteItem'])){
            $id_item = $_POST['id_movie'];
            $item = $this->model->getListTable('menu_items', "where id_item=$id_item");
            $img_old = $item[0]['image'];
            $des_unload = "app/public/admin/img/menu_items/$img_old";

            if (file_exists($des_unload)) {
                unlink($des_unload);
            }
            $result = $this->model->deleteData('menu_items', "where id_item = $id_item");
                    if ($result) {
                        echo "<script>alert('Xóa mặt hàng thành công')</script>";
                        $redirectUrl ="quan-ly-bap-nuoc.html";
                        header("refresh:0.5; url=$redirectUrl");
                    }
        }
        $this->view("layout/admin", $this->data);
    }


}