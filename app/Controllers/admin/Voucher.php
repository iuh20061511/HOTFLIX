<?php
class Voucher extends Controller
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

        // Thiết lập phân trang
        $itemsPerPage = 5; // Số khuyến mãi trên mỗi trang
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Trang hiện tại, mặc định là 1

        // Tổng số khuyến mãi và tính tổng số trang
        $totalPromotions = count($this->model->getListTable('promotion')); // Đếm tổng số khuyến mãi
        $totalPages = ceil($totalPromotions / $itemsPerPage);

        // Lấy danh sách khuyến mãi theo trang hiện tại
        $offset = ($currentPage - 1) * $itemsPerPage;
        $this->data['sub']['listPromotion'] = $this->model->getListTable('promotion', " ORDER BY id_promotion ASC LIMIT $itemsPerPage OFFSET $offset");

        // Thêm thông tin phân trang vào $this->data để sử dụng trong view
        $this->data['sub']['pagination'] = [
            'totalPages' => $totalPages,
            'currentPage' => $currentPage,
            'itemsPerPage' => $itemsPerPage,
            'totalPromotions' => $totalPromotions,
        ];

        $this->data['content'] = 'admin/voucher/listVoucher';
        $this->view("layout/admin", $this->data);
    }


    public function addNewVoucher()
    {
        $this->data['sub']['title'] = "Trang thêm voucher";
        if (isset($_POST['addPromotion'])) {
            if(!empty($_POST['promotion_name']) && strlen($_POST['promotion_name'])>3){
                $this->data['sub']['error']['promotion_name'] = $this->validate->checkPromotionExist($_POST['promotion_name']);
            }else{
                $this->data['sub']['error']['promotion_name'] = $this->validate->checkFullName($_POST['promotion_name']);
            }
            $this->data['sub']['error']['description'] = $this->validate->checkStringEmpty($_POST['description']);
            $this->data['sub']['error']['promotion_code'] = $this->validate->checkStringEmpty($_POST['promotion_code']);
            $this->data['sub']['error']['discount_value'] = $this->validate->checkEmptyNumber($_POST['discount_value'], 8);
            $this->data['sub']['error']['date_start'] = $this->validate->checkReleaseDate($_POST['date_start']);
            $this->data['sub']['error']['date_end'] = $this->validate->checkEndDate($_POST['date_end'],$_POST['date_start']);

            if (empty($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
                $this->data['sub']['error']['image'] = "Vui lòng chọn poster cho chương trình khuyến mãi!";
            } else {
                $name = time()."_".$_FILES['image']['name'];
                $tmp_name = $_FILES['image']['tmp_name'];
            }

            if (array_filter($this->data['sub']['error']) == []) {
                $des_upload = "app/public/admin/img/promotion";
                if($this->model->upload($name,$tmp_name,$des_upload)!=1)
                    {
                        echo "<script>alert('Lưu poster chương trình khuyến mãi thất bại!');</script>";
                    }else{
                        $data = [
                            'promotion_name' => $_POST['promotion_name'],
                            'promotion_code' => strtoupper($_POST['promotion_code']),
                            'description' => $_POST['description'],
                            'discount_value' => $_POST['discount_value'],
                            'date_start' => $_POST['date_start'],
                            'date_end' => $_POST['date_end'],
                            'discount_type'=>$_POST['discount_type'],
                            'image' => $name
                        ];
                        $result = $this->model->InsertData('promotion', $data);
                        if ($result) {
                            echo "<script>alert('Thêm chương trình khuyến mãi mới thành công')</script>";
                            $redirectUrl ="them-voucher.html";
                            header("refresh:0.5; url=$redirectUrl");
                        }
                    }
            }

        }
        $this->data['content'] = 'admin/voucher/addVoucher';

        $this->view("layout/admin", $this->data);
    }

    public function deleteVoucher()
    {
        $this->data['sub']['title'] = "Xóa mặt hàng";

        if(isset($_POST['deleteVoucher'])){
            $id_promotion = $_POST['id_promotion'];
            $promotion = $this->model->getListTable('promotion', "where id_promotion=$id_promotion");
            $img_old = $promotion[0]['image'];
            $des_unload = "app/public/admin/img/promotion/$img_old";

            if (file_exists($des_unload)) {
                unlink($des_unload);
            }
            $result = $this->model->deleteData('promotion', "where id_promotion = $id_promotion");
                    if ($result) {
                        echo "<script>alert('Xóa voucher thành công')</script>";
                        $redirectUrl ="quan-ly-voucher.html";
                        header("refresh:0; url=$redirectUrl");
                    }
        }
    }

    function updateVoucher($id_promotion){
        $this->data['sub']['title'] = "Xóa mặt hàng";
        $this->data['sub']['promotion'] = $this->model->getListTable('promotion', "where id_promotion=$id_promotion");
        if (isset($_POST['updatePromotion'])) {
            if(!empty($_POST['promotion_name']) && strlen($_POST['promotion_name'])>=3){
                if($this->validate->checkPromotionExistsEdit($_POST['promotion_name'], $id_promotion)){
                    $this->data['sub']['error']['promotion_name'] = "Tên voucher đã được sử dụng!";
                }
            }else{
                $this->data['sub']['error']['promotion_name'] = $this->validate->checkFullName($_POST['promotion_name']);
            }
            $this->data['sub']['error']['description'] = $this->validate->checkStringEmpty($_POST['description']);
            $this->data['sub']['error']['promotion_code'] = $this->validate->checkStringEmpty($_POST['promotion_code']);
            $this->data['sub']['error']['discount_value'] = $this->validate->checkEmptyNumber($_POST['discount_value'], 8);
            $this->data['sub']['error']['date_start'] = $this->validate->checkReleaseDate($_POST['date_start']);
            $this->data['sub']['error']['date_end'] = $this->validate->checkEndDate($_POST['date_end'],$_POST['date_start']);
            if (array_filter($this->data['sub']['error']) == []) {
                $promotion = $this->data['sub']['promotion'][0];
                $img_old = $promotion['image'];

                if (!empty($_FILES['image']['name'])) {
                    $name = time()."_".$_FILES['image']['name'];
                    $tmp_name = $_FILES['image']['tmp_name'];
                    $des_upload = "app/public/admin/img/promotion";
                    $des_unload = "app/public/admin/img/promotion/$img_old";

                    // Kiểm tra và xóa poster cũ nếu tồn tại
                    if (file_exists($des_unload)) {
                        unlink($des_unload);
                    }

                    // Upload poster mới
                    if ($this->model->upload($name, $tmp_name, $des_upload) != 1) {
                        echo "<script>alert('Lưu poster mới cho thất bại!');</script>";
                        return; // Ngừng quá trình nếu upload thất bại
                    }
                } else {
                    $name = $img_old; // Không có file mới, giữ nguyên poster cũ
                }
                $data = [
                    'promotion_name' => $_POST['promotion_name'],
                    'promotion_code' => strtoupper($_POST['promotion_code']),
                    'description' => $_POST['description'],
                    'discount_value' => $_POST['discount_value'],
                    'date_start' => $_POST['date_start'],
                    'date_end' => $_POST['date_end'],
                    'discount_type'=>$_POST['discount_type'],
                    'image' => $name
                ];
                $result = $this->model->updateData('promotion', $data, "where id_promotion = $id_promotion");
                if ($result) {
                    echo "<script>alert('Cập nhật chương trình khuyến mãi thành công')</script>";
                    $redirectUrl = "quan-ly-voucher.html";
                    header("refresh:0.5; url=$redirectUrl");
                }
            }
        }

        $this->data['content'] = 'admin/voucher/updateVoucher';
        $this->view("layout/admin", $this->data);
    }

    public function listGift(){
        $this->data['sub']['title'] = "Danh sách quà tặng";
        $this->data['sub']['listGift'] = $this->model->getListTable('gifts');

        $this->data['content'] = 'admin/voucher/listGift';
        $this->view("layout/admin", $this->data);
    }

    public function addNewGift(){
        $this->data['sub']['title'] = "Danh sách quà tặng";
        if (isset($_POST['addGift'])) {
            if(!empty($_POST['gift_name']) && strlen($_POST['gift_name'])>3){
                $this->data['sub']['error']['gift_name'] = $this->validate->checkGiftExist($_POST['gift_name']);
            }else{
                $this->data['sub']['error']['gift_name'] = $this->validate->checkFullName($_POST['gift_name']);
            }
            $this->data['sub']['error']['point'] = $this->validate->checkEmptyNumber($_POST['point'], 2000);

            if (empty($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
                $this->data['sub']['error']['image'] = "Vui lòng chọn hình ảnh cho quà tặng!";
            } else {
                $name = time()."_".$_FILES['image']['name'];
                $tmp_name = $_FILES['image']['tmp_name'];
            }

            if (array_filter($this->data['sub']['error']) == []) {
                $des_upload = "app/public/admin/img/gift";
                if($this->model->upload($name,$tmp_name,$des_upload)!=1)
                    {
                        echo "<script>alert('Lưu hình ảnh quà tặng thất bại!');</script>";
                    }else{
                        $data = [
                            'gift_name' => $_POST['gift_name'],
                            'point' => $_POST['point'],
                            'image' => $name
                        ];
                        $result = $this->model->InsertData('gifts', $data);
                        if ($result) {
                            echo "<script>alert('Thêm quà tặng mới thành công')</script>";
                            $redirectUrl ="quan-ly-qua-tang.html";
                            header("refresh:0; url=$redirectUrl");
                        }
                    }
            }
        }

        $this->data['content'] = 'admin/voucher/addGift';
        $this->view("layout/admin", $this->data);
    }

    public function deleteGift()
    {
        $this->data['sub']['title'] = "Xóa quà tặng";

        if(isset($_POST['deleteGift'])){
            $id_gift = $_POST['id_gift'];
            $gift = $this->model->getListTable('gifts', "where id_gift=$id_gift");
            $img_old = $gift[0]['image'];
            $des_unload = "app/public/admin/img/gift/$img_old";

            if (file_exists($des_unload)) {
                unlink($des_unload);
            }
            $result = $this->model->deleteData('gifts', "where id_gift = $id_gift");
                    if ($result) {
                        echo "<script>alert('Xóa quà tặng thành công')</script>";
                        $redirectUrl ="quan-ly-qua-tang.html";
                        header("refresh:0; url=$redirectUrl");
                    }
        }
    }



}