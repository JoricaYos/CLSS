<?php include ($_SERVER['DOCUMENT_ROOT'] . '/controllers/logged_checker.php'); ?>

<!doctype html>
<html lang="en">

<head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <link rel="icon" href="../../assets/smcc-logo.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- External CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/table.css">

    <!-- barChart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
    #profile-image-container {
        position: relative;
        width: 100%;
        height: auto;
        overflow: hidden;
    }

    #profile-image {
        display: block;
        width: 100%;
        height: auto;
        object-fit: cover;
    }
    </style>
</head>

<body style="background-color: #EBF4F6">
    <div class="wrapper d-flex align-items-stretch">
        <!-- Sidebar inclusion lagee -->
        <?php include ($_SERVER['DOCUMENT_ROOT'] . '/views/includes/nav.php'); ?>
        <!-- Sidebar inclusion lagee -->

        <!-- Main Content -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <?php include '../includes/user-container.php'; ?>
            <div id="profile-section">
                <div class="row mt-4">
                    <div class="col-md-8">
                        <p>Currently Viewing</p>
                        <h1 class="text-left">Your Profile</h1>
                    </div>
                    <div class="col-md-4 text-right">
                        <div id="button-group-edit" style="display: block;">
                            <button id="edit-profile-btn" class="btn btn-primary">Edit</button>
                        </div>
                        <div id="button-group-save-cancel" style="display: none;">
                            <button id="cancel-profile-btn" class="btn btn-secondary mr-2">Cancel</button>
                            <button id="save-profile-btn" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </div>

                <div class="row mt-4 align-items-center justify-content-center">
                    <div class="col-md-4 text-center">
                        <div id="profile-image-container" class="shadow">
                            <img id="profile-image" src="../../assets/smcc-logo.png" alt="Profile Image">
                            <input type="file" id="profile-image-input" accept="image/*" style="display: none;">
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Full Name:</label>
                            <input type="text" class="form-control" id="full-name" disabled>
                        </div>
                        <div class="form-group">
                            <label for="confirm-password">Username:</label>
                            <input type="text" class="form-control" id="username"
                                value="<?php echo $_SESSION['username']; ?>" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" disabled>
                        </div>
                        <div class="form-group">
                            <label for="confirm-password">Confirm Password:</label>
                            <input type="password" class="form-control" id="confirm-password" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>
    </div>

    <!-- CDN JS  HEE HEEE-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="../../js/popper.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/main.js"></script>
    <script src="../../js/table.js"></script>
    <script>
    $(document).ready(function() {
        $('#edit-profile-btn').click(function() {
            $('#full-name').prop('disabled', false);
            $('#password').prop('disabled', false);
            $('#confirm-password').prop('disabled', false);
            $('#profile-image-input').show();

            $('#button-group-edit').hide();
            $('#button-group-save-cancel').show();
        });

        $('#cancel-profile-btn').click(function() {
            $('#full-name').prop('disabled', true);
            $('#password').prop('disabled', true);
            $('#confirm-password').prop('disabled', true);
            $('#profile-image-input').hide();

            $('#button-group-edit').show();
            $('#button-group-save-cancel').hide();
        });

        $('#save-profile-btn').click(function() {
            // Add code to save changes here (e.g., submit form via AJAX)
            // After saving, disable fields and hide buttons
            $('#full-name').prop('disabled', true);
            $('#password').prop('disabled', true);
            $('#confirm-password').prop('disabled', true);
            $('#profile-image-input').hide();

            $('#button-group-edit').show();
            $('#button-group-save-cancel').hide();
        });

        $('#profile-image-input').change(function() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#profile-image').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        });
    });
    </script>

</body>

</html>