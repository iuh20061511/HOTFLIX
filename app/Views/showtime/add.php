<!-- main content -->
<main class="main">
    <div class="container-fluid">
        <div class="row">
            <!-- main title -->
            <div class="col-12">
                <div class="main__title">
                    <h2>Thêm suất chiếu</h2>

                </div>
            </div>
            <div class="col-12">
                <form action="" class="sign__form sign__form--add" method="POST">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12" style="margin-top: 15px">
                                    <div class="sign__group">
                                        <select name="movie" id="movieSelect" class="sign__input">
                                            <option value="#">Chọn bộ phim....</option>
                                            <?php
                                            $selectedMovie = isset($_POST['movie']) ? $_POST['movie'] : '';
                                            foreach ($listMovie as $movie) {
                                                $isSelected = ($selectedMovie === ($movie['id_movie'] . ',' . $movie['duration'])) ? 'selected' : '';
                                                ?>
                                                <option value='<?php echo $movie['id_movie'] . ',' . $movie['duration']; ?>'
                                                    <?php echo $isSelected; ?>>
                                                    <?php echo $movie['movie_name']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>

                                        <input type="submit" value="select_movie" name="sub_movie"
                                            style="display: none;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-xl-6" style="margin-top: 15px">
                                        <div class="sign__group" style="display: flex; align-items: center;">
                                            <label for="number_address" style="margin-right: 5px;color: #fff">Ngày bắt
                                                đầu:
                                            </label>
                                            <input type="date" class="sign__input" name="start_date" id="startDate"
                                                value="<?php
                                                if (isset($_POST['start_date']))
                                                    echo $_POST['start_date']
                                                        ?>">
                                            </div>
                                        </div>

                                        <div class="col-12 col-xl-6" style="margin-top: 15px">
                                            <div class="sign__group" style="display: flex; align-items: center;">
                                                <label for="number_address" style="margin-right: 5px;color: #fff">Ngày kết
                                                    thúc:
                                                </label>
                                                <input type="date" class="sign__input" name="finish_date" id="finishDate"
                                                    value="<?php
                                                if (isset($_POST['finish_date']))
                                                    echo $_POST['finish_date']
                                                        ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12" style="margin-top: 15px">
                                        <div class="sign__group d-flex align-items-center mb-3">
                                            <!-- Sử dụng d-flex để sắp xếp ngang -->
                                            <label for="number_address" style="margin-right: 5px; color: #fff">Chọn
                                                phòng:</label>
                                        <?php foreach ($listRoom as $rom) { ?>
                                            <div class="form-check me-3"> <!-- Thêm khoảng cách giữa các checkbox -->
                                                <input type="radio" class="form-check-input" name="room"
                                                    id="room-<?php echo $rom['id_room']; ?>"
                                                    value="<?php echo $rom['room_name']; ?>" onchange="toggleCheckboxes()">
                                                <label class="form-check-label text-light"
                                                    for="room-<?php echo $rom['id_room']; ?>">
                                                    <?php echo $rom['room_name']; ?>
                                                </label>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="row" id="timeSlots" style="display: none;">
                                        <div class="d-flex">
                                            <div class="col-2 m-1">
                                                <div class="border rounded p-2 text-center">
                                                    <input type="checkbox" class="form-check-input" />
                                                    <label class="form-check-label text-light">10-12h</label>
                                                </div>
                                            </div>
                                            <div class="col-2 m-1">
                                                <div class="border rounded p-2 text-center">
                                                    <input type="checkbox" class="form-check-input" />
                                                    <label class="form-check-label text-light">12-14h</label>
                                                </div>
                                            </div>
                                            <div class="col-2 m-1">
                                                <div class="border rounded p-2 text-center">
                                                    <input type="checkbox" class="form-check-input" />
                                                    <label class="form-check-label text-light">14-16h</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>

                            <div class="col-12 mt-5">
                                <input type="submit" value="Thêm rạp phim" class="sign__btn sign__btn--small"
                                    name="addCinema">
                            </div>
                        </div>
                </form>
            </div>

        </div>
    </div>
</main>
<script>
    const movieSelect = document.getElementById('movieSelect');
    const startDateInput = document.getElementById('startDate');
    const finishDateInput = document.getElementById('finishDate');
    const submitButton = document.querySelector('input[name="sub_movie"]');

    function checkAndSubmit() {
        if (movieSelect.value !== '#' && startDateInput.value && finishDateInput.value) {
            submitButton.click();  // Tự động ấn nút submit
        }
    }

    // Thêm sự kiện 'change' cho select movie
    movieSelect.addEventListener('change', checkAndSubmit);

    // Thêm sự kiện 'change' cho input date
    startDateInput.addEventListener('change', checkAndSubmit);
    finishDateInput.addEventListener('change', checkAndSubmit);
</script>

<script>
    function toggleCheckboxes() {
        // Lấy div chứa checkbox
        var timeSlotsDiv = document.getElementById('timeSlots');

        // Hiển thị hoặc ẩn checkbox dựa trên trạng thái radio
        if (document.querySelector('input[name="room"]:checked')) {
            timeSlotsDiv.style.display = 'block'; // Hiện
        } else {
            timeSlotsDiv.style.display = 'none'; // Ẩn
        }
    }
</script>