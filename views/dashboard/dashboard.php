<?php include($_SERVER['DOCUMENT_ROOT'] . '/controllers/logged_checker.php'); ?>

<!doctype html>
<html lang="en">

<head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <link rel="icon" href="../../assets/smcc-logo.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/table.css">

    <!-- barChaaart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .card-img-top {
            padding: 10px;
            width: 100px;
            height: 100px;
        }

        .card {
            border-radius: 10px;
        }

        .table-responsive {
            overflow-y: auto;
        }

        .table-responsive thead th {
            position: sticky;
            top: 0;
            background-color: #071952; 
            color: white;
            z-index: 1;
        }

        #reservationsCard {
            height: 100%;
        }

        #reservationsCard .card-body {
            display: flex;
            flex-direction: column;
        }

        #reservationsCard .table-responsive {
            flex-grow: 1;
        }
    </style>
</head>

<body style="background-color: #EBF4F6">

    <div class="wrapper d-flex align-items-stretch">
        <!-- Sidebar diri -->
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/views/includes/nav.php'); ?>
        <!-- Sidebar diri -->

        <!-- Main Content diri -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <?php include '../includes/user-container.php'; ?>
            <div class="row mt-4">
                <div class="col-md-8">
                    <h1 class="text-left">Hello
                        <?php echo htmlspecialchars(current(explode(' ', $_SESSION['name']))); ?>,
                    </h1>
                    <p>This is what we've got for you today.</p>
                </div>
            </div>
            <div class="py-3"></div>

            <div>
                <div class="row mt-4">
                    <div class="col-md-8">
                        <p class="text-left">Your Schedules</p>
                    </div>
                </div>
                <div class="row py-4">
                    <div class="col-md-2">
                        <select id="semesterFilter" class="form-control">
                            <option value="all">Show All</option>
                            <option value="1">1st Semester</option>
                            <option value="2">2nd Semester</option>
                        </select>
                    </div>
                </div>

                <table id="scheduleTable" class="table table-bordered text-center">
                    <thead style="background-color: #071952; color: white">
                        <tr>
                            <th><i class="fas fa-keyboard"></i> Subject</th>
                            <th><i class="fas fa-school"></i> Semester</th>
                            <th><i class="fas fa-map-marker"></i> Laboratory</th>
                            <th><i class="fas fa-calendar-week"></i> Day</th>
                            <th><i class="fas fa-clock"></i> Time</th>
                        </tr>
                    </thead>
                    <tbody style="background-color: white;">
                    </tbody>
                </table>
            </div>

            <div class="row mt-4">
                <div class="col-md-2">
                    <div class="card">
                        <img src="../../assets/schedule.png" class="card-img-top" alt="Image 1">
                        <div class="card-body">
                            <h4 class="card-title" id="scheduleCount">0</h4>
                            <h6 class="card-subtitle mb-2 text-muted">Schedules</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card">
                        <img src="../../assets/reserve.png" class="card-img-top" alt="Image 2">
                        <div class="card-body">
                        <h4 class="card-title" id="reserveCount">0</h4>
                            <h6 class="card-subtitle mb-2 text-muted">Reservations</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card" id="reservationsCard">
                        <div class="card-body">
                        <h6 class="card-subtitle mb-2">Your Reservations</h6>
                            <div class="table-responsive">
                                <table class="table text-center  table-hover">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                        </tr>
                                    </thead>
                                    <tbody id="reservationsList">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="py-4"></div>

            <?php if ($_SESSION['role'] == 'Admin'): ?>
                <div class="row py-4">
                    <div class="col-md-2">
                        <select id="chartSelector" class="form-control">
                            <option value="both">Schedules & Reservations</option>
                            <option value="schedules">Schedules</option>
                            <option value="reservations">Reservations</option>
                        </select>
                    </div>
                </div>
                <div><canvas id="myChart"></canvas></div>
                <div class="py-5"></div>
            <?php endif; ?>
        </div>

    </div>

    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="../../js/popper.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/main.js"></script>
    <script src="../../js/table.js"></script>

    <script>
        $(document).ready(function () {
            var allSchedules = [];

            function fetchSchedules() {
                $.ajax({
                    url: 'get_personnel_sched.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        allSchedules = data;
                        displaySchedules(allSchedules);
                        updateScheduleCount(allSchedules.length);
                        adjustReservationsCardHeight();
                    },
                    error: function () {
                        console.log('Error fetching schedule data');
                    }
                });
            }

            function displaySchedules(schedules) {
                var tableBody = $('#scheduleTable tbody');
                tableBody.empty();
                $.each(schedules, function (i, item) {
                    var row = $('<tr>').append(
                        $('<td>').text(item.subject),
                        $('<td>').text(item.semester),
                        $('<td>').text(item.lab),
                        $('<td>').text(item.day),
                        $('<td>').text(item.time)
                    );
                    tableBody.append(row);
                });
            }

            function updateScheduleCount(count) {
                $('#scheduleCount').text(count);
            }

            $('#semesterFilter').on('change', function () {
                var selectedSemester = $(this).val();
                var filteredSchedules;

                if (selectedSemester === 'all') {
                    filteredSchedules = allSchedules;
                } else {
                    filteredSchedules = allSchedules.filter(function (schedule) {
                        return schedule.semester === (selectedSemester === '1' ? '1st Semester' : '2nd Semester');
                    });
                }

                displaySchedules(filteredSchedules);
                updateScheduleCount(filteredSchedules.length);
            });

            fetchSchedules();

            function fetchRecentReservations() {
                $.ajax({
                    url: 'get_reserve.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        displayRecentReservations(data);
                        updateReserveCount(data.length);
                    },
                    error: function () {
                        console.log('Error fetching recent reservations');
                    }
                });
            }

            function updateReserveCount(count) {
                $('#reserveCount').text(count);
            }


            function adjustReservationsCardHeight() {
                var maxHeight = 0;
                $('.col-md-2 .card').each(function () {
                    var height = $(this).outerHeight();
                    if (height > maxHeight) {
                        maxHeight = height;
                    }
                });

                $('#reservationsCard').height(maxHeight);

                var cardBody = $('#reservationsCard .card-body');
                var tableResponsive = cardBody.find('.table-responsive');
                var availableHeight = cardBody.height() - (tableResponsive.position().top - cardBody.position().top);
                tableResponsive.css('max-height', availableHeight + 'px');
            }

            function displayRecentReservations(reservations) {
                var reservationsList = $('#reservationsList');
                reservationsList.empty();

                if (reservations.length === 0) {
                    reservationsList.append('<tr><td colspan="3">No reservations found.</td></tr>');
                } else {
                    $.each(reservations, function (i, reservation) {
                        var reservationHtml =
                            '<tr>' +
                            '<td>' + reservation.title + '</td>' +
                            '<td>' + reservation.start_date + '</td>' +
                            '<td>' + reservation.start_time + ' - ' + reservation.end_time + '</td>' +
                            '</tr>';
                        reservationsList.append(reservationHtml);
                    });
                }

                adjustReservationsCardHeight();
            }

            $(window).on('load resize', adjustReservationsCardHeight);

            fetchRecentReservations();

            $(window).on('load', function () {
                setTimeout(adjustReservationsCardHeight, 100);
            });
        });

        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart;
        var counts;

        $.ajax({
            url: 'get_counts.php',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                counts = data;
                createChart(true, true);
            },
            error: function () {
                console.log('Error fetching count data');
            }
        });

        function createChart(showSchedules, showReservations) {
            if (myChart) {
                myChart.destroy();
            }

            var datasets = [];
            if (showSchedules) {
                datasets.push({
                    label: 'Schedules',
                    data: [counts.schedules.lab1, counts.schedules.lab2, counts.schedules.lab3, counts.schedules.lab4],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                });
            }
            if (showReservations) {
                datasets.push({
                    label: 'Reservations',
                    data: [counts.reservations.lab1, counts.reservations.lab2, counts.reservations.lab3, counts.reservations.lab4],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                });
            }

            myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Computer lab 1', 'Computer lab 2', 'Computer lab 3', 'Computer lab 4'],
                    datasets: datasets
                },
                options: {
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        document.getElementById('chartSelector').addEventListener('change', function () {
            var selectedValue = this.value;
            switch (selectedValue) {
                case 'both':
                    createChart(true, true);
                    break;
                case 'schedules':
                    createChart(true, false);
                    break;
                case 'reservations':
                    createChart(false, true);
                    break;
            }
        });
    </script>
</body>

</html>