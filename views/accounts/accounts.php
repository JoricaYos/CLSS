<?php include($_SERVER['DOCUMENT_ROOT'] . '/controllers/logged_checker.php'); ?>

<!doctype html>
<html lang="en">
<head>
    <title>Accounts</title>
    <meta charset="utf-8">
    <link rel="icon" href="../../assets/smcc-logo.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/table.css">
</head>
<body style="background-color: #EBF4F6">
    <div class="wrapper d-flex align-items-stretch">
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/views/includes/nav.php'); ?>
        <div id="content" class="p-4 p-md-5 pt-5">
            <?php include '../includes/user-container.php'; ?>
            <div class="row mt-4">
                <div class="col-md-8">
                    <p>Currently Viewing</p>
                    <h1 class="text-left">User Accounts</h1>
                </div>
            </div>
            <button type="button" class="btn btn-primary" id="btn-custom" data-toggle="modal" data-target="#addPersonnelModal">
                Add Personnel
            </button>

            <div class="row mt-4">
                <div class="col-md-12">
                    <table id="researchersTable" class="display">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><i class="fas fa-user"></i> NAME</th>
                                <th><i class="fas fa-user-tag"></i> ROLE</th>
                                <th><i class="fas fa-user-circle"></i> USERNAME</th>
                                <th><i class="fas fa-calendar-alt"></i> RESERVATIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addPersonnelModal" tabindex="-1" role="dialog" aria-labelledby="addPersonnelModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPersonnelModalLabel">Add Personnel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addPersonnelForm" method="post" action="add_personnel.php">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" required style="border: 1px solid #ced4da;">
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" id="username" required style="border: 1px solid #ced4da;">
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select class="form-control form-control-with-border" name="role" id="role">
                                    <option value="view1">View 1</option>
                                    <option value="view2">View 2</option>
                                    <option value="view3">View 3</option>
                                    <option value="view4">View 4</option>
                                    <option value="personnel">Personnel</option>
                                </select>
                            </div>
                            <input type="hidden" id="password" name="password">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Modal -->
        <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
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
                "ajax": "get_personnel.php",
                "columns": [
                    { "data": "#" },
                    { "data": "name" },
                    { "data": "role" },
                    { "data": "username" },
                    {
                        "data": "reservations",
                        "render": function (data) {
                            return data ? data : '0';
                        }
                    }
                ]
            });

            // Show the success modal if a success message exists
            <?php if (isset($_SESSION['success_message'])): ?>
                $('#successModal').modal('show');
            <?php endif; ?>
        });
    </script>
</body>
</html>
