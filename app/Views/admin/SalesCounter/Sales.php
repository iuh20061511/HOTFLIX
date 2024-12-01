<main class="main m-3">
    <div class="container-fluid">
        <div class="row">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 mb-3 p-3 bg-light">
                        <div class="btn-group " role="group" id="dateSelector">

                        </div>
                    </div>


                    <div class="row">

                        <div class="col-3 bg-light p-3">
                            <h4>Danh Sách Phim</h4>
                            <div id="movieList" class="list-group">


                            </div>
                        </div>


                        <div class="col-9">
                            <div id="showtimeDetails">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {

                    const showTimesByCinema = <?php echo json_encode($showTimesByCinema); ?>;
                    const uniqueMovies = [...new Set(showTimesByCinema.map(item => item.movie_name))];

                    let selectedMovie = null;
                    let selectedDate = null;

                    function generateDateButtons() {
                        const dateSelector = document.getElementById('dateSelector');
                        const today = new Date();

                        for (let i = 0; i < 7; i++) {
                            const date = new Date(today);
                            date.setDate(today.getDate() + i);

                            const formattedDate = date.toISOString().split('T')[0];
                            const displayDate = date.toLocaleDateString('vi-VN', {
                                weekday: 'short',
                                month: 'numeric',
                                day: 'numeric',
                                year: 'numeric'
                            });

                            const button = document.createElement('button');
                            button.type = 'button';
                            button.classList.add('btn', 'btn-outline-primary', 'mx-1', 'p-2');
                            button.dataset.date = formattedDate;
                            button.textContent = displayDate;

                            if (i === 0) {
                                button.classList.add('active');
                                selectedDate = formattedDate;
                            }

                            button.addEventListener('click', function() {

                                document.querySelectorAll('#dateSelector .btn').forEach(btn =>
                                    btn.classList.remove('active')
                                );
                                this.classList.add('active');
                                selectedDate = this.dataset.date;
                                filterShowtimes();
                            });

                            dateSelector.appendChild(button);
                        }
                    }


                    function populateMovieList() {
                        const movieList = document.getElementById('movieList');

                        uniqueMovies.forEach(movie => {
                            const movieItem = document.createElement('a');
                            movieItem.href = '#';
                            movieItem.classList.add('list-group-item', 'list-group-item-action');
                            movieItem.textContent = movie;
                            movieItem.dataset.movie = movie;

                            movieItem.addEventListener('click', function(e) {
                                e.preventDefault();

                                document.querySelectorAll('#movieList .list-group-item').forEach(item =>
                                    item.classList.remove('active')
                                );
                                this.classList.add('active');

                                selectedMovie = this.dataset.movie === 'all' ? null : this.dataset.movie;

                                filterShowtimes();
                            });

                            movieList.appendChild(movieItem);
                        });
                    }

                    function filterShowtimes() {
                        const showtimeDetails = document.getElementById('showtimeDetails');
                        showtimeDetails.innerHTML = '';

                        const filteredShowtimes = showTimesByCinema.filter(show =>
                            show.show_date === selectedDate &&
                            (selectedMovie === null || show.movie_name === selectedMovie)
                        );

                        if (filteredShowtimes.length === 0) {
                            showtimeDetails.innerHTML = `
                    <div class="alert alert-info">
                        Không có suất chiếu phù hợp.
                    </div>
                `;
                            return;
                        }


                        const groupedShowtimes = {};
                        filteredShowtimes.forEach(show => {
                            if (!groupedShowtimes[show.movie_name]) {
                                groupedShowtimes[show.movie_name] = [];
                            }
                            groupedShowtimes[show.movie_name].push(show);
                        });

                        Object.entries(groupedShowtimes).forEach(([movieName, showtimes]) => {
                            const movieCard = document.createElement('div');
                            movieCard.classList.add('card', 'mb-3');

                            const movieInfo = showtimes[0];

                            movieCard.innerHTML = `
                    <div class="card-header">
                        <h5 class="card-title">${movieName}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <img src="<?php echo _WEB_ROOT ?>/public/admin/img/movies/${movieInfo.poster}" 
                                    class="img-fluid rounded movie-poster" 
                                    alt="${movieName} Poster">
                            </div>
                            <div class="col-5">
                                <p><strong>Đạo diễn:</strong> ${movieInfo.director}</p>
                                <p><strong>Diễn viên:</strong> ${movieInfo.actor}</p>
                                <p><strong>Thể loại:</strong> ${movieInfo.genre}</p>
                                <p><strong>Quốc gia:</strong> ${movieInfo.nation}</p>
                                <p><strong>Thời lượng:</strong> ${movieInfo.duration} phút</p>
                            </div>
                            <div class="col-4"> <!-- Sửa col-2 thành col-4 để đúng tỷ lệ -->
                                <h6>Các suất chiếu:</h6>
                                <div class="btn-group" role="group">
                                    ${showtimes.map(show => {
                                        const startTime = show.start_time.slice(0, 5);
                                        const [hours, minutes] = startTime.split(':').map(num => parseInt(num)); 
                                        const date = new Date();
                                        date.setHours(hours, minutes + 30); 
                                        const newTime = date.toTimeString().slice(0, 5); 
                                        return `<a href='chon-ghe-${show.id_showTime}.html' type="button" class="btn btn-outline-primary m-1">
                                                    ${newTime}
                                                </a>`;
                                    }).join('')}
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                            showtimeDetails.appendChild(movieCard);
                        });
                    }

                    generateDateButtons();
                    populateMovieList();
                    filterShowtimes();
                });
            </script>


        </div>
    </div>
</main>