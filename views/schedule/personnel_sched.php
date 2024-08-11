<?php include ($_SERVER['DOCUMENT_ROOT'] . '/controllers/logged_checker.php'); ?>

<!doctype html>
<html lang="en">

<head>
  <title>Your Schedules</title>
  <meta charset="utf-8">
  <link rel="icon" href="../../assets/smcc-logo.png" type="image/png">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="../../css/style.css">
  <link rel="stylesheet" href="../../css/table.css">
  <style>
    .table-responsive {
      overflow-x: auto;
    }
  </style>
</head>

<body style="background-color: #EBF4F6">
  <div class="wrapper d-flex align-items-stretch">
    <?php include ($_SERVER['DOCUMENT_ROOT'] . '/views/includes/nav.php'); ?>

    <div id="content" class="p-4 p-md-5 pt-5">
      <?php include '../includes/user-container.php'; ?>
      <div id="profile-section">
        <div class="row mt-4">
          <div class="col-md-8">
            <p>Currently Viewing</p>
            <h1 class="text-left">Your Schedules</h1>
          </div>

        </div>

        <div class="py-5"></div>


        <table id="scheduleTable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Subject</th>
              <th>Semester</th>
              <th>Lab</th>
              <th>Day</th>
              <th>Time</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
      <br>
    </div>
  </div>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="../../js/popper.js"></script>
  <script src="../../js/bootstrap.min.js"></script>
  <script src="../../js/main.js"></script>
  
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
  </script>
</body>

</html>