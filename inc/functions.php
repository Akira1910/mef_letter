<?php
function convert_date($letterdate) {
    $arrayd = explode("-", $letterdate);
    $formattedDate = $arrayd[2] . "-" . $arrayd[1] . "-" . $arrayd[0];
    return $formattedDate;
}

?>
