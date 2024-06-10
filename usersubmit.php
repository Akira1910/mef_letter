<?php
include("inc/dbsetting.php");

if (isset($_POST["usubmit"])) {
    $userid = $_POST['userid'];
    $fullname = $_POST['memname'];
    $username = $_POST['usrname'];
    $level_id  = $_POST["lvlhidden"];
    $department = $_POST['department'];

    $sql2 = "UPDATE user_table SET 
            fullname = '" . $fullname . "', 
            username = '" . $username . "', 
            dep = '" . $department . "',
            level_id='" . $level_id . "'"; 

    $sql2 .= " WHERE user_id=" . $userid;
    
    echo $sql2;

    $result2 = $dbconn->query($sql2);

    if ($result2) {
        header("location:userlist.php");
        exit();
    } else {
        echo "Error updating user: " . $dbconn->error;
    }
}
?>
