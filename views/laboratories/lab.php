<?php include($_SERVER['DOCUMENT_ROOT'] . '/controllers/logged_checker.php'); ?>
<!doctype html>
<html lang="en">

<head>
  <title>Schedules</title>
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</head>

<body style="background-color: #EBF4F6">
  <div class="wrapper d-flex align-items-stretch">

    <!-- sidebar / nav diri -->
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/views/includes/nav.php'); ?>
    <!-- sidebar / nav diri -->

    <div id="content" class="p-4 p-md-5 pt-5">
      <?php include '../includes/user-container.php'; ?>
      <div class="row mt-4">
        <div class="col-md-12">
          <p>Currently Viewing</p>
          <h1 class="text-left">Computer Laboratory Schedules</h1>
          <div class="py-3"></div>
          <select id="labSelector" class="form-control mb-3" style="width: auto;">
            <option value="lab1" selected>Laboratory 1</option>
            <option value="lab2">Laboratory 2</option>
            <option value="lab3">Laboratory 3</option>
            <option value="lab4">Laboratory 4</option>
          </select>
          <?php if ($_SESSION['role'] != 'student'): ?>
            <button id="addScheduleBtn" class="btn mb-3" style="background-color: #071952; color: white">Add
              Schedule</button>
            <button id="addReservationBtn" class="btn btn-success mb-3 ml-2">Add Reservation</button>
          <?php endif; ?>
          <?php if ($_SESSION['role'] != 'Instructor' && $_SESSION['role'] != 'student' && $_SESSION['role'] != 'Dean/Principal'): ?>
          <?php endif; ?>
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
      var labSelector = document.getElementById('labSelector');
      var currentLab = 'lab1';

      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'timeGridWeek',
        slotMinTime: '08:00:00',
        slotMaxTime: '21:00:00',
        contentHeight: 'auto',
        aspectRatio: 2,
        dayMaxEvents: true,
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek'
        },
        events: `get_events.php?lab=${currentLab}`,
        eventClick: function (info) {
          if (info.event.extendedProps.type === 'schedule') {
            $.ajax({
              url: 'get_event_details.php',
              type: 'GET',
              data: { id: info.event.id.split('_')[1] },
              dataType: 'json',
              success: function (data) {
                console.log(data);
                let showEditButton = data.current_user === data.personnel_name;

                let swalConfig = {
                  title: 'Schedule Details',
                  html: `
            <div style="text-align: left;">
              <p><i class="fas fa-book" style="width: 20px;"></i> <strong>Subject:</strong> ${data.subject}</p>
              <p><i class="fas fa-user" style="width: 20px;"></i> <strong>Personnel:</strong> ${data.personnel_name}</p>
              <p><i class="fas fa-clock" style="width: 20px;"></i> <strong>Start Time:</strong> ${formatTime(data.start_time)}</p>
              <p><i class="fas fa-hourglass-end" style="width: 20px;"></i> <strong>End Time:</strong> ${formatTime(data.end_time)}</p>
            </div>
          `,
                  icon: 'info',
                  showCloseButton: true,
                };

                if (showEditButton) {
                  swalConfig.showCancelButton = true;
                  swalConfig.cancelButtonText = 'Close';
                  swalConfig.confirmButtonText = 'Edit';
                } else {
                  swalConfig.confirmButtonText = 'Close';
                }

                Swal.fire(swalConfig).then((result) => {
                  if (result.isConfirmed && showEditButton) {
                    editSchedule(data);
                  }
                });
              },
              error: function () {
                Swal.fire('Error', 'Failed to fetch event details', 'error');
              }
            });
          } else if (info.event.extendedProps.type === 'reservation') {
            $.ajax({
              url: 'get_reservation_details.php',
              type: 'GET',
              data: { id: info.event.id.split('_')[1] },
              dataType: 'json',
              success: function (data) {
                console.log(data);

                let showEditDeleteButtons = data.personnel_id == data.current_user;

                let swalConfig = {
                  title: 'Reservation Details',
                  html: `
            <div style="text-align: left;">
              <p><i class="fas fa-bookmark" style="width: 20px;"></i> <strong>Title:</strong> ${data.title}</p>
              <p><i class="fas fa-calendar" style="width: 20px;"></i> <strong>Date:</strong> ${info.event.start.toLocaleDateString()}</p>
              <p><i class="fas fa-clock" style="width: 20px;"></i> <strong>Start Time:</strong> ${formatTime(info.event.start.toTimeString().split(' ')[0])}</p>
              <p><i class="fas fa-hourglass-end" style="width: 20px;"></i> <strong>End Time:</strong> ${formatTime(info.event.end.toTimeString().split(' ')[0])}</p>
            </div>
          `,
                  icon: 'info',
                  showCloseButton: true,
                  showCancelButton: showEditDeleteButtons,
                  cancelButtonText: 'Close',
                };

                if (showEditDeleteButtons) {
                  swalConfig.showDenyButton = true;
                  swalConfig.confirmButtonText = 'Edit';
                  swalConfig.denyButtonText = 'Delete';
                } else {
                  swalConfig.confirmButtonText = 'Close';
                }

                Swal.fire(swalConfig).then((result) => {
                  if (result.isConfirmed && showEditDeleteButtons) {
                    editReservation(info.event.id.split('_')[1]);
                  } else if (result.isDenied && showEditDeleteButtons) {
                    deleteReservation(info.event.id.split('_')[1]);
                  }
                });
              },
              error: function () {
                Swal.fire('Error', 'Failed to fetch reservation details', 'error');
              }
            });
          }
        }
      });

      calendar.render();

      function editReservation(id) {
        $.ajax({
          url: 'get_reservation_details.php',
          type: 'GET',
          data: { id: id },
          dataType: 'json',
          success: function (data) {
            Swal.fire({
              title: 'Edit Reservation',
              html: `
          <input id="edit-title" class="swal2-input" placeholder="Title" value="${data.title}">
          <input id="edit-date" class="swal2-input" type="date" value="${data.start_date}">
          <input id="edit-start-time" class="swal2-input" type="time" value="${data.start_time}">
          <input id="edit-end-time" class="swal2-input" type="time" value="${data.end_time}">
        `,
              focusConfirm: false,
              preConfirm: () => {
                return {
                  title: document.getElementById('edit-title').value,
                  date: document.getElementById('edit-date').value,
                  startTime: document.getElementById('edit-start-time').value,
                  endTime: document.getElementById('edit-end-time').value
                }
              }
            }).then((result) => {
              if (result.isConfirmed) {
                $.ajax({
                  url: 'update_reservation.php',
                  type: 'POST',
                  data: {
                    id: id,
                    title: result.value.title,
                    date: result.value.date,
                    startTime: result.value.startTime,
                    endTime: result.value.endTime
                  },
                  success: function (response) {
                    Swal.fire('Updated!', 'Reservation has been updated.', 'success');
                    calendar.refetchEvents();
                  },
                  error: function () {
                    Swal.fire('Error', 'Failed to update reservation', 'error');
                  }
                });
              }
            });
          },
          error: function () {
            Swal.fire('Error', 'Failed to fetch reservation details', 'error');
          }
        });
      }

      function deleteReservation(id) {
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: 'delete_reservation.php',
              type: 'POST',
              data: { id: id },
              success: function (response) {
                Swal.fire('Deleted!', 'Reservation has been deleted.', 'success');
                calendar.refetchEvents();
              },
              error: function () {
                Swal.fire('Error', 'Failed to delete reservation', 'error');
              }
            });
          }
        });
      }

      labSelector.addEventListener('change', function () {
        currentLab = this.value;
        calendar.removeAllEventSources();
        calendar.addEventSource(`../laboratories/get_events.php?lab=${currentLab}`);
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
        console.log('Add Schedule button clicked');
        Swal.fire({
          title: 'Add Schedule',
          html:
            '<div class="form-group">' +
            '<input type="hidden" id="swal-lab" value="' + currentLab + '">' +
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
            $.ajax({
              url: `check_conflicts.php?lab=${currentLab}`,
              type: 'POST',
              data: scheduleData,
              dataType: 'json',
              success: function (response) {
                if (response.conflict) {
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

      function editSchedule(scheduleData) {
        Swal.fire({
          title: 'Edit Schedule',
          html:
            '<div class="form-group">' +
            '<input type="hidden" id="swal-id" value="' + scheduleData.id + '">' +
            '<input type="hidden" id="swal-lab" value="' + currentLab + '">' +
            '<label for="swal-subject">Subject:</label>' +
            '<input id="swal-subject" class="swal2-input" value="' + scheduleData.subject + '">' +
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
            '<option value="1" ' + (scheduleData.semester == 1 ? 'selected' : '') + '>1st Semester</option>' +
            '<option value="2" ' + (scheduleData.semester == 2 ? 'selected' : '') + '>2nd Semester</option>' +
            '</select>' +
            '</div>' +
            '<div class="form-group">' +
            '<label>Day:</label>' +
            '<div id="day-buttons">' +
            '<button type="button" class="btn btn-outline-primary day-btn ' + (scheduleData.day === 'Monday' ? 'active' : '') + '" data-day="Monday">Monday</button>' +
            '<button type="button" class="btn btn-outline-primary day-btn ' + (scheduleData.day === 'Tuesday' ? 'active' : '') + '" data-day="Tuesday">Tuesday</button>' +
            '<button type="button" class="btn btn-outline-primary day-btn ' + (scheduleData.day === 'Wednesday' ? 'active' : '') + '" data-day="Wednesday">Wednesday</button>' +
            '<button type="button" class="btn btn-outline-primary day-btn ' + (scheduleData.day === 'Thursday' ? 'active' : '') + '" data-day="Thursday">Thursday</button>' +
            '<button type="button" class="btn btn-outline-primary day-btn ' + (scheduleData.day === 'Friday' ? 'active' : '') + '" data-day="Friday">Friday</button>' +
            '</div>' +
            '</div>' +
            '<div class="form-group">' +
            '<label for="swal-start-time">Start Time:</label>' +
            '<input id="swal-start-time" class="swal2-input" type="time" value="' + scheduleData.start_time + '">' +
            '</div>' +
            '<div class="form-group">' +
            '<label for="swal-end-time">End Time:</label>' +
            '<input id="swal-end-time" class="swal2-input" type="time" value="' + scheduleData.end_time + '">' +
            '</div>',
          focusConfirm: false,
          didOpen: () => {
            document.querySelectorAll('.day-btn').forEach(btn => {
              btn.addEventListener('click', function () {
                document.querySelectorAll('.day-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
              });
            });
            populatePersonnelDropdown(scheduleData.personnel_id);
          },
          preConfirm: () => {
            const selectedDay = document.querySelector('.day-btn.active');
            return {
              id: document.getElementById('swal-id').value,
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
            updateSchedule(result.value);
          }
        });
      }

      function updateSchedule(data) {
        $.ajax({
          url: 'update_schedule.php',
          type: 'POST',
          data: data,
          dataType: 'json',
          success: function (response) {
            if (response.status === 'success') {
              Swal.fire('Success', response.message, 'success');
              calendar.refetchEvents();
            } else {
              console.error('Update failed:', response.message);
              Swal.fire('Error', response.message, 'error');
            }
          },
          error: function (jqXHR, textStatus, errorThrown) {
            console.error('AJAX error:', textStatus, errorThrown);
            console.error('Response text:', jqXHR.responseText);
            Swal.fire('Error', 'An error occurred while updating the schedule. Please check the console and error logs for details.', 'error');
          }
        });
      }

      function populatePersonnelDropdown(selectedPersonnelId) {
        $.ajax({
          url: 'get_personnel.php',
          type: 'GET',
          dataType: 'json',
          success: function (data) {
            var select = $('#swal-personnel');
            select.empty();
            select.append('<option value="">Select Personnel</option>');
            $.each(data, function (index, item) {
              select.append('<option value="' + item.id + '" ' + (item.id == selectedPersonnelId ? 'selected' : '') + '>' + item.name + '</option>');
            });
          },
          error: function () {
            console.error('Failed to fetch personnel data');
          }
        });
      }

      function submitSchedule(data) {
        const startTime = data.startTime;
        const endTime = data.endTime;
        const minTime = '08:00';
        const maxTime = '21:00';

        if (startTime < minTime || endTime > maxTime || startTime >= endTime) {
          Swal.fire('Invalid Time', 'Please enter a time between 8:00 AM and 9:00 PM. Start time must be earlier than end time.', 'error');
          return;
        }

        $.ajax({
          url: 'submit_schedule.php',
          type: 'POST',
          data: { ...data, lab: currentLab },
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

      document.getElementById('addReservationBtn').addEventListener('click', function () {
        Swal.fire({
          title: 'Add Reservation',
          html:
            '<div class="form-group">' +
            '<input type="hidden" id="swal-lab" value="' + currentLab + '">' +
            '<label for="swal-event-title">Event Title:</label>' +
            '<input id="swal-event-title" class="swal2-input" placeholder="Enter event title">' +
            '</div>' +
            '<div class="form-group">' +
            '<label for="swal-start-date">Date:</label>' +
            '<input id="swal-start-date" class="swal2-input" type="date">' +
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

      function submitReservation(data, force = false) {
        const startTime = data.start_time;
        const endTime = data.end_time;
        const minTime = '08:00';
        const maxTime = '21:00';

        if (startTime < minTime || endTime > maxTime || startTime >= endTime) {
          Swal.fire('Invalid Time', 'Please enter a time between 8:00 AM and 9:00 PM. Start time must be earlier than end time.', 'error');
          return;
        }

        $.ajax({
          url: 'submit_reservation.php',
          type: 'POST',
          data: { ...data, lab: currentLab, force: force },
          dataType: 'json',
          success: function (response) {
            console.log('Server response:', response);
            if (response.status === 'success') {
              Swal.fire('Success', response.message, 'success');
              calendar.refetchEvents();
            } else if (response.status === 'conflict' && !force) {
              Swal.fire({
                title: 'Reservation Conflict',
                text: "This reservation conflicts with an existing reservation / schedule. Do you want to add it anyway?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, add it!',
                cancelButtonText: 'No, cancel'
              }).then((result) => {
                if (result.isConfirmed) {
                  submitReservation(data, true);
                }
              });
            } else {
              Swal.fire('Error', response.message, 'error');
            }
          },
          error: function (xhr, status, error) {
            console.error('AJAX error:', status, error);
            console.log('Response:', xhr.responseText);
            Swal.fire('Error', 'An error occurred while submitting the reservation', 'error');
          }
        });
      }
    });
  </script>
</body>

</html>