<?php
include '../../models/database.php';

function checkReservationConflicts($lab, $start_date, $start_time, $end_time) {
    global $conn;
    
    $lab = mysqli_real_escape_string($conn, $lab);
    $start_date = mysqli_real_escape_string($conn, $start_date);
    $start_time = mysqli_real_escape_string($conn, $start_time);
    $end_time = mysqli_real_escape_string($conn, $end_time);

    
    $sql_reserve = "SELECT * FROM reserve 
            WHERE lab = '$lab' 
            AND start_date = '$start_date' 
            AND (
                (start_time <= '$start_time' AND end_time > '$start_time')
                OR (start_time < '$end_time' AND end_time >= '$end_time')
                OR (start_time >= '$start_time' AND end_time <= '$end_time')
            )";

    $result_reserve = mysqli_query($conn, $sql_reserve);

    if (mysqli_num_rows($result_reserve) > 0) {
        
    }

    $day_of_week = date('l', strtotime($start_date)); 

    $sql_sched = "SELECT * FROM sched 
            WHERE lab = '$lab' 
            AND day = '$day_of_week'
            AND semester_start <= '$start_date' 
            AND semester_end >= '$start_date'
            AND (
                (start_time <= '$start_time' AND end_time > '$start_time')
                OR (start_time < '$end_time' AND end_time >= '$end_time')
                OR (start_time >= '$start_time' AND end_time <= '$end_time')
            )";

    $result_sched = mysqli_query($conn, $sql_sched);

    if (mysqli_num_rows($result_sched) > 0) {
        return true;
    }

    return false; 
}