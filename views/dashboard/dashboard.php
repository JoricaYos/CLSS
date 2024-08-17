<?php include ($_SERVER['DOCUMENT_ROOT'] . '/controllers/logged_checker.php'); ?>

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
</head>

<body style="background-color: #EBF4F6">

    <div class="wrapper d-flex align-items-stretch">
        <!-- Sidebar diri -->
        <?php include ($_SERVER['DOCUMENT_ROOT'] . '/views/includes/nav.php'); ?>
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
                <div class="py-5"></div>
            </div>

            <?php if ($_SESSION['role'] == 'Admin'): ?>
                <div class="row">
                    <div class="col-md-2">
                        <select id="chartSelector" class="form-control">
                            <option value="both">Schedules & Reservations</option>
                            <option value="schedules">Schedules</option>
                            <option value="reservations">Reservations</option>
                        </select>
                    </div>
                </div>
                <div class="py-2"></div>
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
            $.ajax({
                url: 'get_personnel_sched.php',
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    var tableBody = $('#scheduleTable tbody');
                    $.each(data, function (i, item) {
                        var row = $('<tr>').append(
                            $('<td>').text(item.subject),
                            $('<td>').text(item.semester),
                            $('<td>').text(item.lab),
                            $('<td>').text(item.day),
                            $('<td>').text(item.time)
                        );
                        tableBody.append(row);
                    });
                },
                error: function () {
                    console.log('Error fetching schedule data');
                }
            });
        });

        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart;
        var counts;

        $.ajax({
            url: 'get_counts.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                counts = data;
                createChart(true, true);
            },
            error: function() {
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