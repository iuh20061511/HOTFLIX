<?php
class Movies extends Controller
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
        $this->data['sub']['title'] = "Trang quản lý phim";

        // Khởi tạo biến điều kiện
        $getConditions = [];
        $conditions = "";

        // Xử lý tìm kiếm
        if (isset($_GET['search_nameMovie']) && !empty($_GET['search_nameMovie'])) {
            $search_nameMovie = $_GET['search_nameMovie'];
            $getConditions[] = "movie_name LIKE '%$search_nameMovie%'";
        }

        // Xử lý sắp xếp
        if (isset($_GET['movie_sort'])) {
            $status_sort = $_GET['movie_sort'];
            switch ($status_sort) {
                case 0:
                case 1:
                case 2:
                    $getConditions[] = "status = '$status_sort'";
                    break;
                case 3: // Tất cả
                    $redirectUrl ="quan-ly-phim.html";
                    header("refresh:0.5; url=$redirectUrl");
                    break;
                default:
                    break;
            }
        }
        // Tạo điều kiện cho câu truy vấn
        if (!empty($getConditions)) {
            $conditions = " WHERE " . implode(" AND ", $getConditions);
        }

        $this->data['sub']['listMovie'] = $this->model->getListTable('movie', $conditions . " ORDER BY id_movie");
        $this->data['content'] = 'admin/movies/listMovie';
        $this->view("layout/admin", $this->data);
    }


    public function addNewMovie()
    {
        $this->data['sub']['title'] = "Thêm bộ phim mới";

        $this->data['sub']['listGenre'] = $this->model->getListTable('genre');

        if (isset($_POST['addMovie'])) {
            if(!empty($_POST['movie_name']) && strlen($_POST['movie_name'])>2){
                $this->data['sub']['error']['movie_name'] = $this->model->checkMovieExist($_POST['movie_name']);
            }else{
                $this->data['sub']['error']['movie_name'] = $this->validate->checkFullName($_POST['movie_name']);
            }
            $this->data['sub']['error']['genre'] = $this->validate->checkSelect($_POST['genre']);
            $this->data['sub']['error']['description'] = $this->validate->checkStringEmpty($_POST['description']);
            $this->data['sub']['error']['actor'] = $this->validate->checkStringEmpty($_POST['actor']);
            $this->data['sub']['error']['director'] = $this->validate->checkStringEmpty($_POST['director']);
            $this->data['sub']['error']['trailer'] = $this->validate->checkStringEmpty($_POST['trailer']);
            $this->data['sub']['error']['duration'] = $this->validate->checkEmptyNumber($_POST['duration'], 70);
            $this->data['sub']['error']['release_date'] = $this->validate->checkReleaseDate($_POST['release_date']);
            $this->data['sub']['error']['nation'] = $this->validate->checkSelect($_POST['nation']);

            if (empty($_FILES['poster']) || $_FILES['poster']['error'] !== UPLOAD_ERR_OK) {
                $this->data['sub']['error']['poster'] = "Vui lòng chọn poster cho phim!";
            } else {
                $name = time()."_".$_FILES['poster']['name'];
                $tmp_name = $_FILES['poster']['tmp_name'];
            }

            if (array_filter($this->data['sub']['error']) == []) {
                $des_upload = "app/public/admin/img/movies";
                if($this->model->upload($name,$tmp_name,$des_upload)!=1)
					{
						echo "<script>alert('Lưu poster phim thất bại!');</script>";
					}else{
						$genre_string = implode(',', $_POST['genre']);
                        $data = [
                            'movie_name' => $_POST['movie_name'],
                            'genre' => $genre_string,
                            'description' => $_POST['description'],
                            'actor' => $_POST['actor'],
                            'director' => $_POST['director'],
                            'trailer' => $_POST['trailer'],
                            'duration' => $_POST['duration'],
                            'release_date' => $_POST['release_date'],
                            'nation' => $_POST['nation'],
                            'poster' => $name,
                            'status' => "Sắp chiếu"
                        ];
                        $result = $this->model->InsertData('movie', $data);
                        if ($result) {
                            echo "<script>alert('Thêm phim mới thành công')</script>";
                            $redirectUrl ="quan-ly-phim.html";
                            header("refresh:0.5; url=$redirectUrl");
                        }
					}
            }
        }

        $this->data['content'] = 'admin/movies/addMovie';

        $this->view("layout/admin", $this->data);

    }

    public function updateMovie($id_movie)
    {
        $this->data['sub']['title'] = "Cập nhật phim";
        $this->data['sub']['movieUpdate'] = $this->model->getListTable('movie',"where id_movie=$id_movie");

        if (isset($_POST['updateMovie'])) {
            if(!empty($_POST['movie_name']) && strlen($_POST['movie_name'])>=3){
                if($this->validate->checkNameMovieExistsEdit($_POST['movie_name'], $id_movie)){
                    $this->data['sub']['error']['movie_name'] = "Tên bộ phim này đã được sử dụng!";
                }
            }else{
                $this->data['sub']['error']['movie_name'] = $this->validate->checkFullName($_POST['movie_name']);
            }
            $this->data['sub']['error']['genre'] = $this->validate->checkSelect($_POST['genre']);
            $this->data['sub']['error']['description'] = $this->validate->checkStringEmpty($_POST['description']);
            $this->data['sub']['error']['actor'] = $this->validate->checkStringEmpty($_POST['actor']);
            $this->data['sub']['error']['director'] = $this->validate->checkStringEmpty($_POST['director']);
            $this->data['sub']['error']['trailer'] = $this->validate->checkStringEmpty($_POST['trailer']);
            $this->data['sub']['error']['duration'] = $this->validate->checkEmptyNumber($_POST['duration'], 70);
            $this->data['sub']['error']['release_date'] = $this->validate->checkReleaseDate($_POST['release_date']);
            $this->data['sub']['error']['nation'] = $this->validate->checkSelect($_POST['nation']);

            if (array_filter($this->data['sub']['error']) == []) {
                $movie = $this->model->getListTable('movie', "where id_movie=$id_movie");
                $poster_old = $movie[0]['poster'];

                if (!empty($_FILES['poster']['name'])) {
                    $name = time()."_".$_FILES['poster']['name'];
                    $tmp_name = $_FILES['poster']['tmp_name'];
                    $des_upload = "app/public/admin/img/movies";
                    $des_unload = "app/public/admin/img/movies/$poster_old";

                    // Kiểm tra và xóa poster cũ nếu tồn tại
                    if (file_exists($des_unload)) {
                        unlink($des_unload);
                    }

                    // Upload poster mới
                    if ($this->model->upload($name, $tmp_name, $des_upload) != 1) {
                        echo "<script>alert('Lưu poster phim thất bại!');</script>";
                        return; // Ngừng quá trình nếu upload thất bại
                    }
                } else {
                    $name = $poster_old; // Không có file mới, giữ nguyên poster cũ
                }
                $genre_string = implode(',', $_POST['genre']);
                $data = [
                    'movie_name' => $_POST['movie_name'],
                    'genre' => $genre_string,
                    'description' => $_POST['description'],
                    'actor' => $_POST['actor'],
                    'director' => $_POST['director'],
                    'trailer' => $_POST['trailer'],
                    'duration' => $_POST['duration'],
                    'release_date' => $_POST['release_date'],
                    'nation' => $_POST['nation'],
                    'poster' => $name
                ];
                $result = $this->model->updateData('movie', $data, "where id_movie = $id_movie");
                if ($result) {
                    echo "<script>alert('Cập nhật phim thành công')</script>";
                    $redirectUrl = "quan-ly-phim.html";
                    header("refresh:0.5; url=$redirectUrl");
                }
            }
        }

        $this->data['content'] = 'admin/movies/updateMovie';

        $this->view("layout/admin", $this->data);
    }

    public function deleteMovie()
    {
        $this->data['sub']['title'] = "Xóa bộ phim";
        if(isset($_POST['deleteMovie'])){
            $id_movie = $_POST['id_movie'];
            $movie = $this->model->getListTable('movie', "where id_movie=$id_movie");
            $poster_old = $movie[0]['poster'];
            $des_unload = "app/public/admin/img/movies/$poster_old";

            // Kiểm tra và xóa poster cũ nếu tồn tại
            if (file_exists($des_unload)) {
                unlink($des_unload);
            }
            $result = $this->model->deleteData('movie', "where id_movie = $id_movie");
                    if ($result) {
                        echo "<script>alert('Xóa bộ phim thành công')</script>";
                        $redirectUrl ="quan-ly-phim.html";
                        header("refresh:0.5; url=$redirectUrl");
                    }
        }

        $this->view("layout/admin", $this->data);
    }

}