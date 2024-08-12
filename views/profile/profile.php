<?php include ($_SERVER['DOCUMENT_ROOT'] . '/controllers/logged_checker.php'); ?>

<!doctype html>
<html lang="en">

<head>
    <title>Profile</title>
    <meta charset="utf-8">
    <link rel="icon" href="../../assets/smcc-logo.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/table.css">
    <style>
        #profile-image-container {
            width: 200px;
            height: auto;
            overflow: hidden;
            margin: 0 auto;
        }

        #profile-image {
            display: block;
            width: 200px;
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>

<body style="background-color: #EBF4F6">
    <div class="wrapper d-flex align-items-stretch">
        <?php include ($_SERVER['DOCUMENT_ROOT'] . '/views/includes/nav.php'); ?>

        <div id="content" class="p-4 p-md-5 pt-5">
            <?php include '../includes/user-container.php'; ?>
            <div id="profile-section">
                <form id="profile-form" enctype="multipart/form-data">
                    <div class="row mt-4">
                        <div class="col-md-8">
                            <p>Currently Viewing</p>
                            <h1 class="text-left">Your Profile</h1>
                            <div class="py-5"></div>
                        </div>
                        <div class="col-md-4 text-right">
                            <div id="button-group-edit" style="display: block;">
                                <button type="button" id="edit-profile-btn" class="btn btn-primary">Edit</button>
                            </div>
                            <div id="button-group-save-cancel" style="display: none;">
                                <button type="button" id="cancel-profile-btn"
                                    class="btn btn-secondary mr-2">Cancel</button>
                                <button type="submit" id="save-profile-btn" class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4 justify-content-center">
                        <div class="col-md-4 text-center">
                            <div id="profile-image-container" class="shadow">
                                <?php
                                $profileImage = !empty($_SESSION['img']) ? '/' . $_SESSION['img'] : '../../assets/smcc-logo.png';
                                ?>
                                <img id="profile-image" src="<?php echo $profileImage; ?>" alt="Profile Image">
                                <input type="file" id="profile-image-input" name="profile_image" accept="image/*"
                                    style="display: none;">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="full-name">Full Name:</label>
                                <input type="text" class="form-control" id="full-name" name="name"
                                    value="<?php echo $_SESSION['name']; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    value="<?php echo $_SESSION['username']; ?>" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    value="<?php echo $_SESSION['username']; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="confirm-password">Confirm Password:</label>
                                <input type="password" class="form-control" id="confirm-password"
                                    name="confirm_password" value="<?php echo $_SESSION['username']; ?>" disabled>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <br>
        </div>
    </div>

    <!-- Modal for displaying response messages -->
    <div class="modal fade" id="responseModal" tabindex="-1" role="dialog" aria-labelledby="responseModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="responseModalLabel">Response Message Heee Hee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="responseMessage"></p>
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
    <script>
        $(document).ready(function () {
            $('#edit-profile-btn').click(function () {
                $('#full-name').prop('disabled', false);
                $('#username').prop('disabled', false);
                $('#password').prop('disabled', false);
                $('#confirm-password').prop('disabled', false);
                $('#profile-image-input').show();

                $('#button-group-edit').hide();
                $('#button-group-save-cancel').show();
            });

            $('#cancel-profile-btn').click(function () {
                $('#full-name').prop('disabled', true);
                $('#username').prop('disabled', true);
                $('#password').prop('disabled', true);
                $('#confirm-password').prop('disabled', true);
                $('#profile-image-input').hide();

                $('#button-group-edit').show();
                $('#button-group-save-cancel').hide();
            });

            $('#profile-form').submit(function (e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: 'edit_profile.php',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        try {
                            var res = JSON.parse(response);
                            if (res.status === 'success') {
                                $('#responseMessage').text(res.message);
                                $('#responseModal').modal('show');
                                location.reload();
                            } else {
                                $('#responseMessage').text(res.message);
                                $('#responseModal').modal('show');
                            }
                        } catch (e) {
                            console.error('Parsing error:', e);
                            console.error('Server response:', response);
                            $('#responseMessage').text('An error occurred. Please try again.');
                            $('#responseModal').modal('show');
                        }
                    },
                    error: function () {
                        $('#responseMessage').text('An error occurred. Please try again.');
                        $('#responseModal').modal('show');
                    }
                });
            });

            $('#profile-image-input').change(function () {
                var input = this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#profile-image').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
    </script>

</body>

</html>