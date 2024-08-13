<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/controllers/logged_checker.php');
?>

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

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            border-radius: 50%;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:checked+.slider:before {
            transform: translateX(26px);
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
                    <h1 class="text-left">User Accounts</h1>
                </div>
            </div>
            <button type="button" class="btn btn-primary" id="btn-custom">
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
                                <th><i class="fas fa-cog"></i> ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="../../js/popper.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/main.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                        "data": "status",
                        "render": function (data, type, row) {
                            const isChecked = data === 'active' ? 'checked' : '';
                            return `
                        <label class="switch">
                            <input type="checkbox" class="status-switch" data-id="${row.id}" ${isChecked}>
                            <span class="slider round"></span>
                        </label>
                    `;
                        }
                    }
                ]
            });

            $('#researchersTable').on('change', '.status-switch', function () {
                const id = $(this).data('id');
                const status = $(this).is(':checked') ? 'active' : 'inactive';

                fetch('update_status.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id, status })
                }).then(response => response.json())
                    .then(result => {
                        if (!result.success) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: result.message,
                                confirmButtonColor: '#3085d6'
                            }).then(() => {
                                $(this).prop('checked', !$(this).is(':checked'));
                            });
                        }
                    }).catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred while updating the status.',
                            confirmButtonColor: '#3085d6'
                        }).then(() => {
                            $(this).prop('checked', !$(this).is(':checked'));
                        });
                    });
            });

            $('#btn-custom').on('click', function () {
                Swal.fire({
                    title: 'Add Personnel',
                    html: `
            <form id="addPersonnelForm" method="post">
                <div class="form-group" style="text-align: left;">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" required style="border: 1px solid #ced4da;">
                </div>
                <div class="form-group" style="text-align: left;">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username" required style="border: 1px solid #ced4da;">
                </div>
                <div class="form-group" style="text-align: left;">
                    <label for="role">Role</label>
                    <select class="form-control" name="role" id="role" required style="border: 1px solid #ced4da;">
                        <option value="Instructor">Instructor</option>
                        <option value="Library Custodian">Custodian</option>
                        <option value="Dean/Principal">Dean/Principal</option>
                    </select>
                </div>
            </form>
        `,
                    showCancelButton: true,
                    confirmButtonText: 'Submit',
                    cancelButtonText: 'Cancel',
                    preConfirm: () => {
                        const form = document.getElementById('addPersonnelForm');
                        const formData = new FormData(form);

                        return fetch('add_personnel.php', {
                            method: 'POST',
                            body: formData
                        }).then(response => response.json())
                            .then(result => {
                                if (!result.success) {
                                    Swal.showValidationMessage(
                                        `Request failed: ${result.message}`
                                    );
                                }
                                return result;
                            });
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: result.value.message,
                            confirmButtonColor: '#3085d6'
                        }).then(() => {
                            $('#researchersTable').DataTable().ajax.reload();
                        });
                    }
                }).catch((error) => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while adding personnel.',
                        confirmButtonColor: '#3085d6'
                    });
                });
            });

            <?php
            if (isset($_SESSION['success_message'])) {
                echo "Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '" . addslashes($_SESSION['success_message']) . "',
        confirmButtonColor: '#3085d6'
    });";
                unset($_SESSION['success_message']);
            } elseif (isset($_SESSION['error_message'])) {
                echo "Swal.fire({
        icon: 'error',
        title: 'Error',
        text: '" . addslashes($_SESSION['error_message']) . "',
        confirmButtonColor: '#3085d6'
    });";
                unset($_SESSION['error_message']);
            }
            ?>
        });
    </script>
</body>

</html>