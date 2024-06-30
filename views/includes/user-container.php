<?php
session_start();

if (isset($_SESSION['username'])) {
    $name = $_SESSION['name'];
    $firstLetter = strtoupper(substr($name, 0, 1));
    $restOfName = substr($name, 1);
?>
<div class="full-width-container d-flex justify-content-end">
    <div class="dropdown">
        <div class="user-container d-flex align-items-center position-relative dropdown-toggle-custom" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="circle-container d-flex justify-content-center align-items-center">
                <span class="letter"><?php echo $firstLetter; ?></span>
            </div>
            <span class="user-name"><?php echo $restOfName; ?></span>
        </div>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a href="../../controllers/logout.php" class="dropdown-item">Logout</a>
        </div>
    </div>
</div>
<?php } ?>
