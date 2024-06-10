<?php
include("inc/dbsetting.php");
include("inc/functions.php");
$target_dir = "uploadedfiles/";

	if (isset($_POST["lettersub"])) {

    $letter_date = $_POST["letterdate"];
    $formattedDate = convert_date($letter_date);
    $letter_number = $_POST["letternum"];
    $letter_title = $_POST["lettertitle"];
    $letter_type = $_POST["seltype"];
    $letter_id = intval($letter_type);

    $dep_person = $_POST["letterdep"];
    $file_type = $_POST["filesel"];
    $check = $_FILES["upfile"]["tmp_name"];
    if ($check !== false) {

        //$filename = basename($_FILES["upfile"]["name"]);
        $filename = rand(0,100000);
        $filename .= '-' . rand(0,100000);
        $filename .= '-' . rand(0,100000);
        move_uploaded_file($_FILES["upfile"]["tmp_name"], $target_dir . $filename);

        $sql1 = "INSERT INTO letter_table 
            (letter_date, letter_number, letter_title, type_id, dep_person, file_type, filename) VALUES ('$formattedDate', '$letter_number', '$letter_title', $letter_id, '$dep_person', $file_type, '$filename');";
            //echo $sql1;

        $result1 = $dbconn->query($sql1);
        if ($result1) {
            header("location:display.php");
            exit();
        }
    }
}

?>