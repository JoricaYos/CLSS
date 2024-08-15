<?php include($_SERVER['DOCUMENT_ROOT'] . '/controllers/logged_checker.php'); ?>

<?php
include '../../models/database.php';

$sql = "SELECT * FROM semester LIMIT 1";
$result = $conn->query($sql);

$semester = array();
if ($result->num_rows > 0) {
  $semester = $result->fetch_assoc();
}
?>

<!doctype html>
<html lang="en">

<head>
  <title>Settings</title>
  <meta charset="utf-8">
  <link rel="icon" href="../../assets/smcc-logo.png" type="image/png">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css">
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <link rel="stylesheet" href="../../css/style.css">
  <link rel="stylesheet" href="../../css/table.css">
  <style>
    .btn-full-width {
      width: 100%;
      display: block;
    }
  </style>
</head>

<body style="background-color: #EBF4F6">
  <div class="wrapper d-flex align-items-stretch">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/views/includes/nav.php'); ?>
    <div id="content" class="p-4 p-md-5 pt-5">
      <?php include '../includes/user-container.php'; ?>
      <div class="row mt-4">
        <div class="col-md-8">
          <p>Currently Viewing</p>
          <h1 class="text-left">Admin Settings</h1>
        </div>
      </div>
      <div class="py-5"></div>
      <p>Semester</p>

      <div class="row mt-4">
        <div class="col-md-12">
          <table id="researchersTable" class="display">
            <thead>
              <tr>
                <th><i class="fas fa-school"></i> SEMESTER</th>
                <th><i class="fas fa-calendar-plus"></i> START DATE</th>
                <th><i class="fas fa-calendar-times"></i> END DATE</th>
                <th><i class="fas fa-wrench"></i> ACTIONS</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($semester)): ?>
                <tr>
                  <td>1st Semester</td>
                  <td>
                    <span class="date-value"><?php echo $semester['sem1_start']; ?></span>
                    <input type="date" class="form-control date-input" style="display:none;"
                      value="<?php echo $semester['sem1_start']; ?>">
                  </td>
                  <td>
                    <span class="date-value"><?php echo $semester['sem1_end']; ?></span>
                    <input type="date" class="form-control date-input" style="display:none;"
                      value="<?php echo $semester['sem1_end']; ?>">
                  </td>
                  <td><button class="btn btn-warning btn-set btn-sm btn-full-width">Set</button></td>
                </tr>
                <tr>
                  <td>2nd Semester</td>
                  <td>
                    <span class="date-value"><?php echo $semester['sem2_start']; ?></span>
                    <input type="date" class="form-control date-input" style="display:none;"
                      value="<?php echo $semester['sem2_start']; ?>">
                  </td>
                  <td>
                    <span class="date-value"><?php echo $semester['sem2_end']; ?></span>
                    <input type="date" class="form-control date-input" style="display:none;"
                      value="<?php echo $semester['sem2_end']; ?>">
                  </td>
                  <td><button class="btn btn-warning btn-set btn-sm btn-full-width">Set</button></td>
                </tr>
              <?php else: ?>
                <tr>
                  <td colspan="4">No semester data available.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
          <div class="py-5"></div>
          <div class="row mt-4">
            <div class="col-md-12">
              <p>Laboratories</p>
              <select id="labSelector" class="form-control mb-3" style="width: auto;">
                <option value="lab1" selected>Laboratory 1</option>
                <option value="lab2">Laboratory 2</option>
                <option value="lab3">Laboratory 3</option>
                <option value="lab4">Laboratory 4</option>
              </select>
              <button id="addScheduleBtn" class="btn mb-3" style="background-color: #0B206A; color: white">Add
                Schedule</button>
              <button id="addReservationBtn" class="btn mb-3 ml-2" style="background-color: #106825; color: white;">Add
                Reservation</button>
              <button id="printScheduleBtn" class="btn btn-primary mb-3 ml-2">Print Schedule</button>
            </div>
          </div>
          <div id="calendar"></div>
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
            <?php
            if (isset($_SESSION['success_message'])) {
              echo $_SESSION['success_message'];
              unset($_SESSION['success_message']);
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="../../js/popper.js"></script>
  <script src="../../js/bootstrap.min.js"></script>
  <script src="../../js/main.js"></script>
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
    $(document).ready(function () {
      $('#researchersTable').DataTable({
        searching: false,
        paging: false,
        info: false
      });

      $('.btn-set').click(function () {
        var $row = $(this).closest('tr');
        var $button = $(this);

        if ($button.text() === 'Set') {
          $row.find('.date-value').hide();
          $row.find('.date-input').show();
          $button.text('Save');
        } else {
          var semesterIndex = $row.index() + 1;
          var startDate = $row.find('.date-input:eq(0)').val();
          var endDate = $row.find('.date-input:eq(1)').val();

          $.ajax({
            url: 'update_semester.php',
            method: 'POST',
            data: {
              semester: semesterIndex,
              start_date: startDate,
              end_date: endDate
            },
            success: function (response) {
              if (response === 'success') {
                $row.find('.date-value:eq(0)').text(startDate).show();
                $row.find('.date-value:eq(1)').text(endDate).show();
                $row.find('.date-input').hide();
                $button.text('Set');

                // swalalala (sweet alert pag sucessful ang pag update)
                Swal.fire({
                  icon: 'success',
                  title: 'Updated Successfully!',
                  text: 'The semester dates have been updated.',
                  confirmButtonText: 'OK'
                });
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Update Failed',
                  text: 'Failed to update. Please try again.',
                  confirmButtonText: 'OK'
                });
              }
            },
            error: function () {
              Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred. Please try again.',
                confirmButtonText: 'OK'
              });
            }
          });
        }
      });
    });
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
        events: `../laboratories/get_events.php?lab=${currentLab}`,
        eventClick: function (info) {
          if (info.event.extendedProps.type === 'schedule') {
            $.ajax({
              url: 'get_admin_event_details.php',
              type: 'GET',
              data: { id: info.event.id.split('_')[1] },
              dataType: 'json',
              success: function (data) {
                console.log(data);
                Swal.fire({
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
                  showCancelButton: true,
                  showDenyButton: true,
                  cancelButtonText: 'Close',
                  confirmButtonText: 'Edit',
                  denyButtonText: 'Delete',
                  showCloseButton: true,
                }).then((result) => {
                  if (result.isConfirmed) {
                    editSchedule(data);
                  } else if (result.isDenied) {
                    deleteSchedule(data.id);
                  }
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

      labSelector.addEventListener('change', function () {
        currentLab = this.value;
        calendar.removeAllEventSources();
        calendar.addEventSource(`../laboratories/get_events.php?lab=${currentLab}`);
      });

      function deleteSchedule(scheduleId) {
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
              url: 'delete_schedule.php',
              type: 'POST',
              data: { id: scheduleId },
              dataType: 'json',
              success: function (response) {
                if (response.status === 'success') {
                  Swal.fire('Deleted!', response.message, 'success');
                  calendar.refetchEvents();
                } else {
                  Swal.fire('Error', response.message, 'error');
                }
              },
              error: function () {
                Swal.fire('Error', 'An error occurred while deleting the schedule', 'error');
              }
            });
          }
        });
      }

      function populatePersonnelDropdown() {
        $.ajax({
          url: '../laboratories/get_personnel.php',
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
              url: `../laboratories/check_conflicts.php?lab=${currentLab}`,
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
          url: '../laboratories/update_schedule.php',
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
          url: '../laboratories/get_personnel.php',
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
          url: '../laboratories/submit_schedule.php',
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

      function submitReservation(data) {
        const startTime = data.start_time;
        const endTime = data.end_time;
        const minTime = '08:00';
        const maxTime = '21:00';

        if (startTime < minTime || endTime > maxTime || startTime >= endTime) {
          Swal.fire('Invalid Time', 'Please enter a time between 8:00 AM and 9:00 PM. Start time must be earlier than end time.', 'error');
          return;
        }

        $.ajax({
          url: '../laboratories/submit_reservation.php',
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
            Swal.fire('Error', 'An error occurred while submitting the reservation', 'error');
          }
        });
      }

      document.getElementById('printScheduleBtn').addEventListener('click', function () {
        const title = encodeURIComponent(`Computer ${currentLab.charAt(3)} Laboratory Schedule`);
        const lab = currentLab;
        window.location.href = `../includes/print-sched.php?title=${title}&lab=${lab}`;
      });
    });
  </script>

  <style>
    .fc-event {
      background-color: #0B206A !important;
      border-color: #0B206A !important;
    }

    .fc-event.reservation-event {
      background-color: #106825 !important;
      border-color: #106825 !important;
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

    #calendar .fc-event-title,
    #calendar .fc-event-time {
      font-size: 12px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
  </style>

</body>

</html>