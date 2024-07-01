<!doctype html>
<html lang="en">

<head>
    <title>Computer lab 1</title>
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
</head>

<body style="background-color: #EBF4F6">
    <div class="wrapper d-flex align-items-stretch">

        <!-- Sidebar -->
        <?php include ($_SERVER['DOCUMENT_ROOT'] . '/views/includes/nav.php'); ?>
        <!-- Sidebar -->

        <!-- Main Content -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <?php include '../includes/user-container.php'; ?>
            <div class="row mt-4">
                <div class="col-md-12">
                    <p>Currently Viewing</p>
                    <h1 class="text-left">Computer Laboratory 1</h1>
                    <br>
                    <div id="calendar"></div>

                </div>
            </div>
        </div>
        <!-- Main Content -->

    </div>

    <!-- Add Schedule Modal -->
    <div class="modal fade" id="addScheduleModal" tabindex="-1" role="dialog" aria-labelledby="addScheduleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addScheduleModalLabel">Add Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addScheduleForm" method="POST" action="submit_sched.php">
                        <div class="form-group">
                            <label for="scheduleTitle">Schedule Title</label>
                            <input type="text" class="form-control" id="scheduleTitle" name="scheduleTitle" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="repeatWeekly" name="repeatWeekly">
                            <label class="form-check-label" for="repeatWeekly">Repeat Weekly?</label>
                        </div>
                        <div id="weeklyDays" style="display: none;">
                            <div class="form-group">
                                <label>Repeat on:</label><br>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-secondary active">
                                        <input type="checkbox" name="days[]" value="Sun" autocomplete="off"> S
                                    </label>
                                    <label class="btn btn-secondary active">
                                        <input type="checkbox" name="days[]" value="Mon" autocomplete="off"> M
                                    </label>
                                    <label class="btn btn-secondary active">
                                        <input type="checkbox" name="days[]" value="Tue" autocomplete="off"> T
                                    </label>
                                    <label class="btn btn-secondary active">
                                        <input type="checkbox" name="days[]" value="Wd" autocomplete="off"> W
                                    </label>
                                    <label class="btn btn-secondary active">
                                        <input type="checkbox" name="days[]" value="Thur" autocomplete="off"> T
                                    </label>
                                    <label class="btn btn-secondary active">
                                        <input type="checkbox" name="days[]" value="Fri" autocomplete="off"> F
                                    </label>
                                    <label class="btn btn-secondary active">
                                        <input type="checkbox" name="days[]" value="Sat" autocomplete="off"> S
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="startDate">Start Date</label>
                            <input type="date" class="form-control" id="startDate" name="startDate" required>
                        </div>
                        <div class="form-group">
                            <label for="endDate">End Date</label>
                            <input type="date" class="form-control" id="endDate" name="endDate" required>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="allDay" name="allDay" checked>
                                <label class="form-check-label" for="allDay">
                                    All Day
                                </label>
                            </div>
                        </div>
                        <div id="timeSection" style="display: none;">
                            <div class="form-group">
                                <label for="startTime">Start Time</label>
                                <input type="time" class="form-control" id="startTime" name="startTime">
                            </div>
                            <div class="form-group">
                                <label for="endTime">End Time</label>
                                <input type="time" class="form-control" id="endTime" name="endTime">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Schedule</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>New schedule added successfully.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="../../js/popper.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/main.js"></script>
    <script src="../../js/table.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: '650px',
                events: function (fetchInfo, successCallback, failureCallback) {
                    $.ajax({
                        url: '/views/laboratories/get_sched.php',
                        type: 'GET',
                        success: function (data) {
                            console.log('Fetched data:', data);
                            var events = JSON.parse(data);
                            console.log('Parsed events:', events);
                            successCallback(events);
                        },
                        error: function (xhr, status, error) {
                            console.error('AJAX error:', status, error);
                            failureCallback([]);
                        }
                    });
                },
                headerToolbar: {
                    left: 'prev,next today dayGridMonth timeGridWeek',
                    center: 'title',
                    right: 'addScheduleButton addReservationButton'
                },
                views: {
                    timeGridWeek: {
                        type: 'timeGridWeek',
                        buttonText: 'Weekly'
                    }
                },
                customButtons: {
                    addScheduleButton: {
                        text: 'Add Schedule',
                        click: function () {
                            $('#addScheduleModal').modal('show');
                        }
                    },
                    addReservationButton: {
                        text: 'Add Reservation',
                        click: function () {
                            $('#addScheduleModal').modal('show');
                        }
                    }
                }
            });

            calendar.render();

            $('#repeatWeekly').change(function () {
                if (this.checked) {
                    $('#weeklyDays').show();
                } else {
                    $('#weeklyDays').hide();
                }
            });

            $('#allDay').change(function () {
                if (this.checked) {
                    $('#timeSection').hide();
                } else {
                    $('#timeSection').show();
                }
            });

            $('#addScheduleForm').submit(function (event) {
                var allDayChecked = $('#allDay').prop('checked');
                if (!allDayChecked) {
                    var startTime = $('#startTime').val();
                    var endTime = $('#endTime').val();
                    if (startTime >= endTime) {
                        alert("Start time must be earlier than end time.");
                        event.preventDefault();
                    }
                }
            });
        });
    </script>
</body>

</html>
