<?php include($_SERVER['DOCUMENT_ROOT'] . '/controllers/logged_checker.php'); ?>

<?php
$title = isset($_GET['title']) ? htmlspecialchars($_GET['title']) : 'Laboratory Schedule';
$lab = isset($_GET['lab']) ? htmlspecialchars($_GET['lab']) : 'lab1';
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
            @page {
                size: landscape;
            }

            body * {
                visibility: hidden;
            }

            #content,
            #content * {
                visibility: visible;
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

<body style="background-color: #EBF4F6">
    <div class="pl-5">
        <button id="printButton" class="btn btn-primary mt-3 px-4 py-2">Print Calendar</button>
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
            <br>
            <h4 id="lab-schedule-title" style="text-align: center;"><?php echo $title; ?></h4>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div id="calendar"></div>
                    <br><br><br>
                    <div class="approval-section">
                        <div class="left">
                            <p>Prepared by: <span style="font-weight: bold; text-decoration: underline;">Mr. Joshua
                                    Keith Pasco</span><br><span style="font-weight: bold;">Laboratory-Incharge</span>
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
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                dayMaxEvents: true,
                height: 'auto',
                width: '500px',
                contentHeight: 'auto',
                slotDuration: '00:30:00',
                slotMinTime: '08:00:00',
                slotMaxTime: '21:00:00',
                events: 'get_sched.php?lab=<?php echo $lab; ?>',
                headerToolbar: {
                    left: '',
                    center: '',
                    right: ''
                },
            });
            calendar.render();
        });

    </script>

    <script>
        $('#printButton').click(function () {
            html2canvas(document.querySelector('#content')).then(canvas => {
                const { jsPDF } = window.jspdf;
                var imgData = canvas.toDataURL('image/png');
                var doc = new jsPDF('landscape');
                var imgWidth = doc.internal.pageSize.getWidth();
                var imgHeight = canvas.height * imgWidth / canvas.width;
                doc.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);
                doc.save('calendar.pdf');
            });
        });

        window.onbeforeprint = function () {
            document.getElementById('printButton').style.display = 'none';
        };

        window.onafterprint = function () {
            document.getElementById('printButton').style.display = 'block';
        };
    </script>
</body>

</html>