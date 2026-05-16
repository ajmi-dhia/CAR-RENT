<?php

function isCarAvailable($conn, $car_id, $start, $end) {

    $sql = "
        SELECT * FROM reservations
        WHERE car_id = $car_id
        
        AND NOT (
            date_fin < '$start'
            OR date_debut > '$end'
        )
    ";

    $result = mysqli_query($conn, $sql);

    return mysqli_num_rows($result) == 0;
}

?>