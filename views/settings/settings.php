<?php include ($_SERVER['DOCUMENT_ROOT'] . '/controllers/logged_checker.php'); ?>

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
    <?php include ($_SERVER['DOCUMENT_ROOT'] . '/views/includes/nav.php'); ?>
    <div id="content" class="p-4 p-md-5 pt-5">
      <?php include '../includes/user-container.php'; ?>
      <div class="row mt-4">
        <div class="col-md-8">
          <p>Currently Viewing</p>
          <h1 class="text-left">Admin Settings</h1>
        </div>
      </div>
      <button type="button" class="btn btn-primary" id="btn-custom" data-toggle="modal"
        data-target="#addPersonnelModal">
        Add Schedule
      </button>

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
                    <span class="date-value"><?php echo $semester['sem1-start']; ?></span>
                    <input type="date" class="form-control date-input" style="display:none;"
                      value="<?php echo $semester['sem1-start']; ?>">
                  </td>
                  <td>
                    <span class="date-value"><?php echo $semester['sem1-end']; ?></span>
                    <input type="date" class="form-control date-input" style="display:none;"
                      value="<?php echo $semester['sem1-end']; ?>">
                  </td>
                  <td><button class="btn btn-warning btn-set btn-sm btn-full-width">Set</button></td>
                </tr>
                <tr>
                  <td>2nd Semester</td>
                  <td>
                    <span class="date-value"><?php echo $semester['sem2-start']; ?></span>
                    <input type="date" class="form-control date-input" style="display:none;"
                      value="<?php echo $semester['sem2-start']; ?>">
                  </td>
                  <td>
                    <span class="date-value"><?php echo $semester['sem2-end']; ?></span>
                    <input type="date" class="form-control date-input" style="display:none;"
                      value="<?php echo $semester['sem2-end']; ?>">
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
                  success: function(response) {
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
                  error: function() {
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

</body>

</html>