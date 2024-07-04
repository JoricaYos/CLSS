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

        <div id="content" class="p-4 p-md-5 pt-5">
            <?php include '../includes/user-container.php'; ?>
            <div class="row mt-4">
                <div class="col-md-12">
                    <p>Currently Viewing</p>
                    <h1 class="text-left">Computer Laboratory 1 Schedules</h1>
                    <br>
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Schedule Details Modal  Ni-->
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
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                height: '800px',
                slotDuration: '00:30:00',
                slotMinTime: '08:00:00',
                slotMaxTime: '21:00:00',
                events: function (fetchInfo, successCallback, failureCallback) {
                    $.ajax({
                        url: '/views/laboratories/get_sched.php',
                        type: 'GET',
                        data: {
                            lab: 'lab1'
                        },
                        success: function (data) {
                            var events = JSON.parse(data);
                            successCallback(events);
                        },
                        error: function (xhr, status, error) {
                            console.error('AJAX error:', status, error);
                            failureCallback([]);
                        }
                    });
                },
                headerToolbar: {
                    left: 'dayGridMonth timeGridWeek list',
                    center: 'title',
                },
                views: {
                    timeGridWeek: {
                        type: 'timeGridWeek',
                        buttonText: 'Weekly'
                    }
                },
                eventDidMount: function (info) {
                    if (info.event.extendedProps.type === 'schedule') {
                        info.el.style.backgroundColor = '#071952';
                    } else if (info.event.extendedProps.type === 'reserve') {
                        info.el.style.backgroundColor = '#136927';
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

            $('#repeatWeekly').change(function () {
                $('#weeklyDays').toggle(this.checked);
            });

            $('#allDay').change(function () {
                $('#timeSection').toggle(!this.checked);
            });

            $('#addScheduleForm').submit(function (event) {
                event.preventDefault();

                var startDate = new Date($('#startDate').val());
                var endDate = new Date($('#endDate').val());
                var allDayChecked = $('#allDay').prop('checked');
                var repeatWeeklyChecked = $('#repeatWeekly').prop('checked');

                var formData = $(this).serialize();

                var type = ($(this).data('type') === 'schedule') ? 'schedule' : 'reserve';
                formData += '&lab=' + encodeURIComponent('lab1') + '&type=' + encodeURIComponent(type);

                if (startDate > endDate) {
                    alert("End date must be equal to or later than start date.");
                    return;
                }

                if (!allDayChecked) {
                    var startTime = $('#startTime').val();
                    var endTime = $('#endTime').val();

                    if (startTime < '08:00' || startTime >= endTime || endTime > '21:00') {
                        alert("Time must start at least 8:00 AM and end no later than 9:00 PM, and end time must be later than start time.");
                        return;
                    }
                }

                $.ajax({
                    url: 'submit_sched.php',
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        var result = JSON.parse(response);
                        if (result.success) {
                            $('#addScheduleModal').modal('hide');
                            $('#successModal').modal('show');
                            calendar.refetchEvents();
                        } else {
                            alert("Error: " + result.error);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX error:', status, error);
                        alert("An error occurred while submitting the schedule.");
                    }
                });
            });
        });
    </script>
</body>

</html>