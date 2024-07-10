<?php include ($_SERVER['DOCUMENT_ROOT'] . '/controllers/logged_checker.php'); ?>
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
            <div style="text-align: center; margin-bottom: 20px;">
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
                    <img src="../../assets/iso.jpg" alt="Second Image" style="width: 100px; height: 70px;">
                </div>
            </div>
            <br>
            <h4 id="lab-schedule-title" style="text-align: center;">COMPUTER LABORATORY 1 SCHEDULE</h4>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div id="calendar"></div>
                    <br><br><br>
                    <div class="approval-section">
                        <div class="left">
                            <p>Prepared by: <span style="font-weight: bold; text-decoration: underline;">Name
                                    here</span><br><span style="font-weight: bold;">Position 69</span></p>
                        </div>
                        <div class="right">
                            <p>Approved by: <span style="font-weight: bold; text-decoration: underline;">NAME
                                    here</span><br><span style="font-weight: bold;">Position 69</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Schedule Details Modal -->
    <div class="modal fade" id="scheduleDetailsModal" tabindex="-1" role="dialog"
        aria-labelledby="scheduleDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scheduleDetailsModalLabel">Schedule Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Title:</strong> <span id="modalTitle"></span></p>
                    <p><strong>Time:</strong> <span id="modalTime"></span></p>
                    <p><strong>Description:</strong> <span id="modalDescription"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
            var urlParams = new URLSearchParams(window.location.search);
            var lab = urlParams.get('lab') || 'lab1';
            var labScheduleTitle = document.getElementById('lab-schedule-title');
            labScheduleTitle.textContent = 'COMPUTER LABORATORY ' + lab.charAt(lab.length - 1) + ' SCHEDULE';

            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                height: 'auto',
                width: '500px',
                contentHeight: 'auto',
                slotDuration: '00:30:00',
                slotMinTime: '08:00:00',
                slotMaxTime: '21:00:00',
                events: function (fetchInfo, successCallback, failureCallback) {
                    $.ajax({
                        url: '/views/laboratories/get_sched.php',
                        type: 'GET',
                        data: {
                            lab: lab
                        },
                        success: function (data) {
                            var events = JSON.parse(data);
                            // Filter out 'reserve' type events
                            var filteredEvents = events.filter(event => event.type !== 'reserve');
                            successCallback(filteredEvents);
                        },
                        error: function (xhr, status, error) {
                            console.error('AJAX error:', status, error);
                            failureCallback([]);
                        }
                    });
                },
                headerToolbar: {
                    left: '',
                    center: '',
                    right: ''
                },
                views: {
                    timeGridWeek: {
                        type: 'timeGridWeek',
                        buttonText: 'Weekly',
                        dayHeaderFormat: { weekday: 'long' }
                    }
                },
                eventDidMount: function (info) {
                    if (info.event.extendedProps.type === 'schedule') {
                        info.el.style.backgroundColor = '#071952';
                    }
                },
                eventClick: function (info) {
                    var event = info.event;
                    $('#modalTitle').text(event.title);
                    $('#modalDate').text(event.start.toLocaleDateString() + ' - ' + (event.end ? event.end.toLocaleDateString() : ''));
                    $('#modalTime').text(event.allDay ? 'All Day' : event.start.toLocaleTimeString() + ' - ' + (event.end ? event.end.toLocaleTimeString() : ''));
                    $('#modalDescription').text(event.extendedProps.description || 'No description');
                    $('#scheduleDetailsModal').modal('show');
                }
            });

            calendar.render();

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
        });

    </script>
</body>

</html>