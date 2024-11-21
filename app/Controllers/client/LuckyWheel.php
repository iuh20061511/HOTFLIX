<?php
    class LuckyWheel extends Controller{
        private $model;
        private $validate;
        private $giveTicket;

        private $data = [];

        public function __construct()
        {
            $this->model = $this->model('AccountModel');
            $this->validate = new Validate();
        }

        public function index()
        {
            // Thiết lập thông tin cơ bản
            $this->data['sub']['title'] = "Vòng quay trúng thưởng";
            $id_account = $_SESSION['is_login']['id_account'];

            // Gọi hàm xử lý phân trang
            $pagination = $this->getPaginatedGifts($id_account, 4); // 4 items per page
            $this->data['sub']['listGiftDetails'] = $pagination['listGiftDetails'];
            $this->data['sub']['pagination'] = $pagination['pagination'];

            // Lấy thông tin người dùng và danh sách quà tặng
            $this->data['sub']['user'] = $this->model->getListTable('customer', "where id_customer = $id_account");
            $this->data['sub']['listGift'] = $this->model->getListTable('gifts');

            // Thiết lập nội dung view
            $this->data['content'] = 'client/luckywheel';
            $this->view("layout/client", $this->data);
        }

        /**
         * Hàm xử lý phân trang quà tặng
         */
        private function getPaginatedGifts($id_account, $itemsPerPage)
        {
            $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $offset = ($currentPage - 1) * $itemsPerPage;

            // Tính tổng số quà và số trang
            $totalGifts = count($this->model->getListFromTwoTables(
                'gift_details',
                'gifts',
                'id_gift',
                "where id_customer = $id_account and status = 0 ORDER BY id_giftDetails DESC"
            ));
            $totalPages = ceil($totalGifts / $itemsPerPage);

            // Lấy danh sách quà tặng theo trang
            $listGiftDetails = $this->model->getListFromTwoTables(
                'gift_details',
                'gifts',
                'id_gift',
                "where id_customer = $id_account and status = 0 ORDER BY id_giftDetails DESC LIMIT $itemsPerPage OFFSET $offset"
            );

            return [
                'listGiftDetails' => $listGiftDetails,
                'pagination' => [
                    'totalPages' => $totalPages,
                    'currentPage' => $currentPage,
                    'itemsPerPage' => $itemsPerPage,
                    'totalGifts' => $totalGifts,
                ],
            ];
        }

        /**
         * Hàm xử lý logic quay vòng trúng thưởng
         */
        // private function processWheelSpin($id_account)
        // {
        //     $id_gift = $_POST['id_gift_wheel'];
        //     $updatePoint = $_POST['updatePoint'];

        //     // Lấy thông tin quà tặng
        //     $gift = $this->model->getListTable('gifts', "where id_gift = $id_gift");
        //     $typeGift = mb_strtolower($gift[0]['type']);
        //     $pointGift = $gift[0]['point'] ?? 0;

        //     // Cập nhật điểm
        //     $data = ['points' => $updatePoint];
        //     if ($typeGift === "điểm") {
        //         $data['points'] += $pointGift;
        //     }

        //     // Nếu là quà hiện vật, thêm vào bảng gift_details
        //     if ($typeGift !== "không trúng" && $typeGift !== "điểm") {
        //         $dataGift = [
        //             'id_customer' => $id_account,
        //             'id_gift' => $id_gift,
        //             'status' => 0,
        //         ];
        //         $this->model->InsertData('gift_details', $dataGift);
        //     }

        //     // Cập nhật điểm cho khách hàng
        //     $result = $this->model->updateData('customer', $data, "where id_customer = $id_account");
        //     if ($result) {
        //         // Reload lại trang sau khi cập nhật
        //         $redirectUrl = "vong-quay-may-man.html";
        //         header("refresh:0; url=$redirectUrl");
        //     }
        // }

        public function spin()
        {
            header('Content-Type: application/json; charset=utf-8');
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $input = json_decode(file_get_contents('php://input'), true);
                $id_gift = $input['id_gift'] ?? null;
                $updatePoint = $input['updatePoint'] ?? null;
                $id_account = $_SESSION['is_login']['id_account'];
                $currentPage = $input['currentPage'];
                $offset = ($currentPage - 1) * 4;

                // Logic xử lý quay thưởng
                $gift = $this->model->getListTable('gifts', "where id_gift = $id_gift");
                $typeGift = mb_strtolower($gift[0]['type']);
                $pointGift = $gift[0]['point'] ?? 0;

                $data = ['points' => $updatePoint];
                if ($typeGift === "điểm") {
                    $data['points'] += $pointGift;
                }

                if ($typeGift !== "không trúng" && $typeGift !== "điểm") {
                    $dataGift = [
                        'id_customer' => $id_account,
                        'id_gift' => $id_gift,
                        'status' => 0,
                    ];
                    $this->model->InsertData('gift_details', $dataGift);
                }

                $this->model->updateData('customer', $data, "where id_customer = $id_account");

                $listGiftDetails = $this->model->getListFromTwoTables(
                    'gift_details',
                    'gifts',
                    'id_gift',
                    "where id_customer = $id_account and status = 0 ORDER BY id_giftDetails DESC LIMIT 4 OFFSET $offset"
                );

                $totalGifts = count($listGiftDetails);
                $totalPages = $totalGifts > 0 ? ceil($totalGifts / 4) : 1;  

                echo json_encode([
                    'status' => 'success',
                    'newPoints' => $data['points'],
                    'totalPages' => $totalPages,
                    'currentPage' => $currentPage,
                    'giftDetails' => $listGiftDetails,
                ]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Yêu cầu không hợp lệ!']);
            }
        }



    }
?>