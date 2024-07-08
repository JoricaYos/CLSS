<?php
if (isset($_SESSION['username'])) {
    $name = $_SESSION['name'];
    $profileImage = !empty($_SESSION['img']) ? '/' . $_SESSION['img'] : '../../assets/smcc-logo.png';
?>
<div class="full-width-container d-flex justify-content-end">
    <div class="dropdown">
        <div class="user-container d-flex align-items-center position-relative dropdown-toggle-custom" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="circle-container" style="width: 40px; height: 40px; overflow: hidden; border-radius: 50%; position: relative;">
                <img src="<?php echo $profileImage; ?>" alt="Profile Image" style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); border-radius: 50%;">
            </div>
            <span class="user-name"><?php echo $name; ?></span>
        </div>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a href="../../controllers/logout.php" class="dropdown-item">Logout</a>
        </div>
    </div>
</div>
<?php } ?>
