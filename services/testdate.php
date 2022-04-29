<?php 


date_default_timezone_set('Asia/Kolkata');

require "config.php";
$date = date('Y-m-d');


function dateDifference($start_date, $end_date){
    // calulating the difference in timestamps 
    $diff = strtotime($start_date) - strtotime($end_date);
     
    // 1 day = 24 hours 
    // 24 * 60 * 60 = 86400 seconds
    return ceil(abs($diff / 86400));
}

$row = $db->query("SELECT *  FROM bills where status = 'Pending' and date_add(date,interval 2 day) < '$date' and guid = '1' ")->fetch();

$dateDiff = dateDifference($row['duedate'], $date);

echo $dateDiff;exit;

