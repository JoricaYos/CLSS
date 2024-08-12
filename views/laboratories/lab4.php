<?php include ($_SERVER['DOCUMENT_ROOT'] . '/controllers/logged_checker.php'); ?>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</head>

<body style="background-color: #EBF4F6">
    <div class="wrapper d-flex align-items-stretch">

        <!-- sidebar / nav diri -->
        <?php include ($_SERVER['DOCUMENT_ROOT'] . '/views/includes/nav.php'); ?>
        <!-- sidebar / nav diri -->

        <div id="content" class="p-4 p-md-5 pt-5">
            <?php include '../includes/user-container.php'; ?>
            <div class="row mt-4">
                <div class="col-md-12">
                    <p>Currently Viewing</p>
                    <h1 class="text-left">Computer Laboratory 4</h1>
                    <br>
                    <button id="addScheduleBtn" class="btn btn-success mb-3">Add Schedule</button>
                    <button id="addReservationBtn" class="btn btn-secondary mb-3 ml-2">Add Reservation</button>
                </div>
            </div>
            <div id="calendar"></div>
        </div>
    </div>

    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="../../js/popper.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/main.js"></script>
    <script src="../../js/table.js"></script>

    <script>
        function formatTime(time24) {
            const [hours, minutes] = time24.split(':');
            let period = 'AM';
            let hours12 = parseInt(hours, 10);

            if (hours12 >= 12) {
                period = 'PM';
                if (hours12 > 12) {
                    hours12 -= 12;
                }
            }
            if (hours12 === 0) {
                hours12 = 12;
            }

            return `${hours12}:${minutes} ${period}`;
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                aspectRatio: 2,
                dayMaxEvents: true,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,list'
                },
                events: 'get_events.php?lab=lab4',
                eventClick: function (info) {
                    if (info.event.extendedProps.type === 'schedule') {
                        $.ajax({
                            url: 'get_event_details.php',
                            type: 'GET',
                            data: { id: info.event.id.split('_')[1] },
                            dataType: 'json',
                            success: function (data) {
                                Swal.fire({
                                    title: 'Schedule Details',
                                    html: `
                <div style="text-align: left;">
                    <p><i class="fas fa-book" style="width: 20px;"></i> <strong>Subject:</strong> ${data.subject}</p>
                    <p><i class="fas fa-user" style="width: 20px;"></i> <strong>Personnel:</strong> ${data.personnel}</p>
                    <p><i class="fas fa-clock" style="width: 20px;"></i> <strong>Start Time:</strong> ${formatTime(data.start_time)}</p>
                    <p><i class="fas fa-hourglass-end" style="width: 20px;"></i> <strong>End Time:</strong> ${formatTime(data.end_time)}</p>
                </div>
            `,
                                    icon: 'info'
                                });
                            },
                            error: function () {
                                Swal.fire('Error', 'Failed to fetch event details', 'error');
                            }
                        });
                    } else if (info.event.extendedProps.type === 'reservation') {
                        Swal.fire({
                            title: 'Reservation Details',
                            html: `
                <div style="text-align: left;">
                    <p><i class="fas fa-bookmark" style="width: 20px;"></i> <strong>Title:</strong> ${info.event.title}</p>
                    <p><i class="fas fa-calendar" style="width: 20px;"></i> <strong>Date:</strong> ${info.event.start.toLocaleDateString()}</p>
                    <p><i class="fas fa-clock" style="width: 20px;"></i> <strong>Start Time:</strong> ${formatTime(info.event.start.toTimeString().split(' ')[0])}</p>
                    <p><i class="fas fa-hourglass-end" style="width: 20px;"></i> <strong>End Time:</strong> ${formatTime(info.event.end.toTimeString().split(' ')[0])}</p>
                </div>
            `,
                            icon: 'info'
                        });
                    }
                }
            });
            calendar.render();
        });

        function populatePersonnelDropdown() {
            $.ajax({
                url: 'get_personnel.php',
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    var select = $('#swal-personnel');
                    select.empty();
                    select.append('<option value="">Select Personnel</option>');
                    $.each(data, function (index, item) {
                        select.append('<option value="' + item.id + '">' + item.name + '</option>');
                    });
                },
                error: function () {
                    console.error('Failed to fetch personnel data');
                }
            });
        }

        document.getElementById('addScheduleBtn').addEventListener('click', function () {
            Swal.fire({
                title: 'Add Schedule',
                html:
                    '<div class="form-group">' +
                    '<input type="hidden" id="swal-lab" value="lab4">' +
                    '<label for="swal-subject">Subject:</label>' +
                    '<input id="swal-subject" class="swal2-input" placeholder="Enter subject">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="swal-personnel">Personnel:</label>' +
                    '<select id="swal-personnel" class="swal2-input">' +
                    '<option value="">Select Personnel</option>' +
                    '</select>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="swal-semester">Semester:</label>' +
                    '<select id="swal-semester" class="swal2-input">' +
                    '<option value="">Select Semester</option>' +
                    '<option value="1">1st Semester</option>' +
                    '<option value="2">2nd Semester</option>' +
                    '</select>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label>Day:</label>' +
                    '<div id="day-buttons">' +
                    '<button type="button" class="btn btn-outline-primary day-btn" data-day="Monday">Monday</button>' +
                    '<button type="button" class="btn btn-outline-primary day-btn" data-day="Tuesday">Tuesday</button>' +
                    '<button type="button" class="btn btn-outline-primary day-btn" data-day="Wednesday">Wednesday</button>' +
                    '<button type="button" class="btn btn-outline-primary day-btn" data-day="Thursday">Thursday</button>' +
                    '<button type="button" class="btn btn-outline-primary day-btn" data-day="Friday">Friday</button>' +
                    '</div>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="swal-start-time">Start Time:</label>' +
                    '<input id="swal-start-time" class="swal2-input" type="time">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="swal-end-time">End Time:</label>' +
                    '<input id="swal-end-time" class="swal2-input" type="time">' +
                    '</div>',
                focusConfirm: false,
                didOpen: () => {
                    document.querySelectorAll('.day-btn').forEach(btn => {
                        btn.addEventListener('click', function () {
                            document.querySelectorAll('.day-btn').forEach(b => b.classList.remove('active'));
                            this.classList.add('active');
                        });
                    });
                    populatePersonnelDropdown();
                },
                preConfirm: () => {
                    const selectedDay = document.querySelector('.day-btn.active');
                    return {
                        subject: document.getElementById('swal-subject').value,
                        personnel: document.getElementById('swal-personnel').value,
                        semester: document.getElementById('swal-semester').value,
                        day: selectedDay ? selectedDay.dataset.day : null,
                        startTime: document.getElementById('swal-start-time').value,
                        endTime: document.getElementById('swal-end-time').value,
                        lab: document.getElementById('swal-lab').value
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const scheduleData = result.value;
                    // Check for conflicts before submitting
                    $.ajax({
                        url: 'check_conflicts.php?lab=lab4',
                        type: 'POST',
                        data: scheduleData,
                        dataType: 'json',
                        success: function (response) {
                            if (response.conflict) {
                                // If there's a conflict, show a confirmation dialog
                                Swal.fire({
                                    title: 'Schedule Conflict',
                                    text: "This schedule conflicts with an existing one. Do you want to add it anyway?",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Yes, add it!'
                                }).then((confirmResult) => {
                                    if (confirmResult.isConfirmed) {
                                        submitSchedule(scheduleData);
                                    }
                                });
                            } else {
                                // If no conflict, submit the schedule directly
                                submitSchedule(scheduleData);
                            }
                        },
                        error: function () {
                            Swal.fire('Error', 'An error occurred while checking for conflicts', 'error');
                        }
                    });
                }
            });
        });

        function submitSchedule(data) {
            $.ajax({
                url: 'submit_schedule.php',
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        Swal.fire('Success', response.message, 'success');
                        calendar.refetchEvents();
                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                },
                error: function () {
                    Swal.fire('Error', 'An error occurred while submitting the schedule', 'error');
                }
            });
        }
    </script>

    <script>
        document.getElementById('addReservationBtn').addEventListener('click', function () {
            Swal.fire({
                title: 'Add Reservation',
                html:
                    '<div class="form-group">' +
                    '<input type="hidden" id="swal-lab" value="lab4">' +
                    '<label for="swal-event-title">Event Title:</label>' +
                    '<input id="swal-event-title" class="swal2-input" placeholder="Enter event title">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="swal-start-date">Start Date:</label>' +
                    '<input id="swal-start-date" class="swal2-input" type="date">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="swal-end-date">End Date:</label>' +
                    '<input id="swal-end-date" class="swal2-input" type="date">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="swal-start-time">Start Time:</label>' +
                    '<input id="swal-start-time" class="swal2-input" type="time">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="swal-end-time">End Time:</label>' +
                    '<input id="swal-end-time" class="swal2-input" type="time">' +
                    '</div>',
                focusConfirm: false,
                preConfirm: () => {
                    return {
                        title: document.getElementById('swal-event-title').value,
                        lab: document.getElementById('swal-lab').value,
                        start_date: document.getElementById('swal-start-date').value,
                        end_date: document.getElementById('swal-end-date').value,
                        start_time: document.getElementById('swal-start-time').value,
                        end_time: document.getElementById('swal-end-time').value
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    submitReservation(result.value);
                }
            });
        });

        function submitReservation(data) {
            $.ajax({
                url: 'submit_reservation.php',
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        Swal.fire('Success', response.message, 'success');
                        calendar.refetchEvents();
                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                },
                error: function () {
                    Swal.fire('Error', 'An error occurred while submitting the reservation', 'error');
                }
            });
        }
    </script>

    <style>
        /* Style for all events */
        .fc-event {
            background-color: #2F48A1 !important;
            border-color: #2F48A1 !important;
        }

        /* Style for reservations */
        .fc-event[data-event-type="reservation"] {
            background-color: #28a745 !important;
            border-color: #28a745 !important;
        }

        .fc-event.reservation-event {
            background-color: #28a745 !important;
            border-color: #28a745 !important;
        }


        /* Style for event text */
        .fc-event-title,
        .fc-event-time {
            color: white !important;
        }

        .swal2-input,
        .swal2-select {
            width: 100% !important;
            margin: 5px auto !important;
        }

        .form-group {
            text-align: left;
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
    </style>
</body>

</html>