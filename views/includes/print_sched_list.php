<?php
include($_SERVER['DOCUMENT_ROOT'] . '/controllers/logged_checker.php');
include($_SERVER['DOCUMENT_ROOT'] . '/models/database.php');

$semester = isset($_GET['semester']) ? $_GET['semester'] : 'all';
$personnel_id = $_SESSION['id'];

$query = "SELECT subject, semester, lab, day, start_time, end_time FROM sched WHERE personnel_id = ?";
if ($semester !== 'all') {
    $query .= " AND semester = ?";
}
$query .= " ORDER BY semester, CASE day
    WHEN 'Monday' THEN 1
    WHEN 'Tuesday' THEN 2
    WHEN 'Wednesday' THEN 3
    WHEN 'Thursday' THEN 4
    WHEN 'Friday' THEN 5
    WHEN 'Saturday' THEN 6
    WHEN 'Sunday' THEN 7
    END, start_time";

$stmt = $conn->prepare($query);
if ($semester !== 'all') {
    $stmt->bind_param("is", $personnel_id, $semester);
} else {
    $stmt->bind_param("i", $personnel_id);
}
$stmt->execute();
$result = $stmt->get_result();

$schedules = array();
while ($row = $result->fetch_assoc()) {
    $start = date("g:i A", strtotime($row['start_time']));
    $end = date("g:i A", strtotime($row['end_time']));
    $row['time'] = $start . ' - ' . $end;
    $row['semester'] = $row['semester'] == '1' ? '1st Semester' : '2nd Semester';
    $schedules[] = $row;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="icon" href="../../assets/smcc-logo.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/table.css">
    <link rel="stylesheet" href="../../css/calendar.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.0/jspdf.umd.min.js"></script>

    <style>
        @media print {

            body * {
                visibility: hidden;
            }

            #content,
            #content * {
                visibility: visible;
            }

            @page {
                size: landscape;
                margin: 0mm;
            }

            body {

                margin: 1cm;
            }


            #content {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
            }

            #printButton {
                display: none !important;
            }
        }

        .approval-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .approval-section .left,
        .approval-section .right {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="pl-5">
        <button id="printButton" class="btn btn-primary mt-3 px-4 py-2">Print Schedule</button>
    </div>

    <div class="wrapper d-flex align-items-stretch justify-content-center">
        <div id="content" class="p-4 p-md-5 pt-5">
            <div style="text-align: center; margin-bottom: 20px; margin-left: 50px">
                <div style="display: inline-block; text-align: center;">
                    <img src="../../assets/smcc-logo.png" alt="SMCC Logo" style="width: 70px; height: 70px;">
                </div>
                <div style="display: inline-block; vertical-align: top; margin-left: 20px; text-align: left;">
                    <h2 style="margin-top: 0;">Saint Michael College of Caraga</h2>
                    <h6 class="text-center">Brgy. 4, Nasipit, Agusan del Norte</h6>
                    <h6 class="text-center">www.smccnasipit.edu.ph</h6>
                    <h6 class="text-center">+63 085 343-3251 / +63 085 283-3113</h6>
                </div>
                <div style="display: inline-block; vertical-align: top; margin-left: 20px;">
                    <img src="../../assets/iso.jpg" alt="Second Image" style="width: 110px; height: 70px;">
                </div>
            </div>

            <h2 class="mb-4 text-center">Class Schedules</h2>
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>SUBJECT</th>
                        <?php if ($semester === 'all'): ?>
                            <th>SEMESTER</th>
                        <?php endif; ?>
                        <th>LABORATORY</th>
                        <th>DAY</th>
                        <th>TIME</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($schedules as $schedule): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($schedule['subject']); ?></td>
                            <?php if ($semester === 'all'): ?>
                                <td><?php echo htmlspecialchars($schedule['semester']); ?></td>
                            <?php endif; ?>
                            <td><?php echo htmlspecialchars($schedule['lab']); ?></td>
                            <td><?php echo htmlspecialchars($schedule['day']); ?></td>
                            <td><?php echo htmlspecialchars($schedule['time']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="row">
                <div class="col-md-12">
                    <div id="calendar"></div>
                    <br><br><br>
                    <div class="approval-section">
                        <div class="left">
                            <p>Prepared by: <span
                                    style="font-weight: bold; text-decoration: underline;"><?php echo htmlspecialchars($_SESSION['name']); ?></span><br><span
                                    style="font-weight: bold;"><?php echo htmlspecialchars($_SESSION['role']); ?></span>
                            </p>
                        </div>
                        <div class="right">
                            <p>Approved by: <span style="font-weight: bold; text-decoration: underline;">Mrs. Daisa O.
                                    Gupit, MIT</span><br><span style="font-weight: bold;">CCIS Dean</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="../../js/popper.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/main.js"></script>
    <script src="../../js/table.js"></script>

    <script>
        document.getElementById('printButton').addEventListener('click', function () {
            window.print();
        });
    </script>
</body>

</html>