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
                    <h1 class="text-left">Hello <?php echo htmlspecialchars(current(explode(' ', $_SESSION['name']))); ?>,</h1>
                    <p>This is what we've got for you today.</p>
                </div>
            </div>
            <br>
            <br>
            <br>
            <b>Schedules</b>
            <div><canvas id="myChart" width="400" height="200"></canvas></div>
            <br><br>
            <b>
                Reservations
            </b>
            <div><canvas id="mySecondChart" width="400" height="200"></canvas></div>

        </div>

    </div>

    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="../../js/popper.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/main.js"></script>
    <script src="../../js/table.js"></script>

    <!-- PHP to be transfered pa -->
    <?php
    include ($_SERVER['DOCUMENT_ROOT'] . '/models/database.php');

    function getSchedulesCount($lab)
    {
        global $conn;
        $sql = "SELECT COUNT(*) AS count FROM schedules WHERE lab = '$lab' AND type = 'schedule'";
        $result = $conn->query($sql);
        if (!$result) {
            echo "Error: " . $conn->error;
            return 0;
        }
        $row = $result->fetch_assoc();
        return $row['count'];
    }

    function getReservationsCount($lab)
    {
        global $conn;
        $sql = "SELECT COUNT(*) AS count FROM schedules WHERE lab = '$lab' AND type = 'reserve'";
        $result = $conn->query($sql);
        if (!$result) {
            echo "Error: " . $conn->error;
            return 0; 
        }
        $row = $result->fetch_assoc();
        return $row['count'];
    }
    $count_lab1_schedule = getSchedulesCount('lab1');
    $count_lab2_schedule = getSchedulesCount('lab2');
    $count_lab3_schedule = getSchedulesCount('lab3');
    $count_lab4_schedule = getSchedulesCount('lab4');

    $count_lab1_reservation = getReservationsCount('lab1');
    $count_lab2_reservation = getReservationsCount('lab2');
    $count_lab3_reservation = getReservationsCount('lab3');
    $count_lab4_reservation = getReservationsCount('lab4');
    ?>


    <!-- barchart jabaskrep -->
    <script>
        var ctx1 = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: ['Computer lab 1', 'Computer lab 2', 'Computer lab 3', 'Computer lab 4'],
                datasets: [{
                    label: 'Schedules',
                    data: [<?php echo $count_lab1_schedule; ?>, <?php echo $count_lab2_schedule; ?>, <?php echo $count_lab3_schedule; ?>, <?php echo $count_lab4_schedule; ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctx2 = document.getElementById('mySecondChart').getContext('2d');
        var mySecondChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Computer lab 1', 'Computer lab 2', 'Computer lab 3', 'Computer lab 4'],
                datasets: [{
                    label: 'Reservations',
                    data: [<?php echo $count_lab1_reservation; ?>, <?php echo $count_lab2_reservation; ?>, <?php echo $count_lab3_reservation; ?>, <?php echo $count_lab4_reservation; ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>