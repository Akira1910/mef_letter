<?php
include("inc/nav.php");
include("inc/dbsetting.php");

$userid = 0;
$row = null;

if (isset($_GET["userid"])) {
    $userid = $_GET["userid"];
    $sql1 = "SELECT * FROM user_table WHERE user_id=" . $userid;
    $result4 = $dbconn->query($sql1);

    if ($result4 && $result4->num_rows > 0) {
        $row = $result4->fetch_assoc();
    } else {
        echo "No user found with ID: " . $userid;
        exit();
    }
} else {
    echo "Invalid User ID";
    exit();
}
?>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style type="text/css">
        body {
            background-image: url('images/uedit.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .formbox {
            box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
            margin-top: 10%;
            border-radius: 30px;
            padding: 20px;
            width: 50%;
            min-width: 350px;
            justify-content: center;
            background: linear-gradient(224deg, #fc766d, #fac6be);
        }
        .inbox {
            min-width: 250px;
            max-width: 700px;
        }
        #mycontent {
            padding-left: 20px;
        }
        label {
            font-size: 18pt;
        }
        @media (max-width: 720px) {
            .formbox { 
                padding: 10px;
                margin-top: 45%;
            }
            label {
                font-size: 16pt;
            }
            h2 {
                font-size: 20pt;
            }
            #levelbtn {
                margin-top: 5%;
            }
            #clear {
                margin-top: 5%;
            }
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body id="ueditbd">
<div class="container-sm formbox">
    <form action="usersubmit.php" method="POST" class="was-validated">
        <h2 style="margin-top: 8px;"><center>User Account Form</center></h2><br><br>
        <div id="mycontent">
            <label for="memname">Full Name:</label><br>
            <input type="text" class="form-control inbox" id="memname" name="memname" value="<?php echo $row["fullname"]; ?>" autofocus required><br>
            <label for="usrname">User Name:</label>
            <span id="msg"></span><br>
            <input type="text" class="form-control inbox" id="usrname" name="usrname" value="<?php echo $row["username"]; ?>" autocomplete="off" required><br>
            <button id="btncheck" style="width: auto; height: 38px; border-radius: 10px;" type="button" class="btn btn-dark" name="cbtn">Check Username</button><br><br>
            <label for="levelsel">Update User Level:</label><br>
            <select name="levelsel" id="levelsel" style="width: 200px; height: 35px; border-radius: 15px;" class="inbox">
                <option value=''>Select Level</option>
                <?php
                $sql = "SELECT level_id, description FROM level_table ORDER BY lvl_id";
                $result = $dbconn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row1 = $result->fetch_assoc()) {
                        echo "<option value='" . $row1['level_id'] . "'>" . $row1['description'] . "</option>";
                    }
                }
                  $level_id = trim($row["level_id"]);
                    $arr = explode(" ", $level_id);
                    $descriptions = [];

                    for ($i = 0; $i < count($arr); $i++) {
                        $level = trim($arr[$i]);
                        if (!empty($level)) {
                            $sql3 = "SELECT description FROM level_table WHERE level_id ='" . $level . "'";
                            $result3 = $dbconn->query($sql3);
                            if ($result3 && $result3->num_rows > 0) {
                                $row3 = $result3->fetch_assoc();
                                $descriptions[] = $row3["description"];
                            }
                        }
                    }
                ?>
            </select>

            <button type="button" name="levelbtn" id="levelbtn" style="border-radius: 10px;" class="btn btn-dark">Add Level</button><br><br>
            <input type="text" name="levelinput" id="levelinput" value="<?php echo implode(", ", $descriptions) ?>" style="border-radius:  10px;" class="form-control" readonly>&nbsp;
            <button type="button" style="border-radius: 15px; margin-top: 10px;" name="clear" id="clear" class="btn btn-danger">Clear</button><br><br>
            <input type="hidden" name="lvlhidden" id="lvlhidden">
            <label for="department">Department:</label><br>
            <input type="text" class="form-control inbox" id="department" name="department" value="<?php echo $row["dep"]; ?>" required><br><br>
            <button type="submit" style="border-radius: 10px;" id="usubmit" name="usubmit" class="btn btn-dark">Update User</button>
            <button type="reset" style="margin-left: 30px; border-radius: 10px;" class="btn btn-dark">Reset All</button>
            <input type="hidden" name="userid" value="<?php echo $userid; ?>">
        </div>
    </form>
</div><br><br><br><br><br>

<script type="text/javascript">
    var mval = "";
    var myvalue = "";
    $(document).ready(function() {
        $("#btncheck").click(function() {
            var getname = $("#usrname").val();
            $.ajax({
                type: "POST",
                url: "checkuname.php",
                data: "usrname=" + getname,
                success: function(data) {
                    if (data == 1) {
                        $("#msg").html("<font color='red'>Username Already Exist!</font>");
                    } else {
                        $("#msg").html("<font color='green'>Username Available.</font>");
                    }
                }
            });
        });

        $("#levelbtn").click(function(){
            var addlevel = $("#levelsel option:selected").text();
            var value = $("#levelsel").val();
            if (value == '') return;
            mval += $("#levelinput").val().length > 0 ? ", " + addlevel : addlevel;
            $("#levelinput").val(mval);
            myvalue += myvalue.length > 0 ? " " + value : value;
            $("#lvlhidden").val(myvalue);
        });

        $("#clear").click(function(){
            $("#levelinput").val("");
            mval = "";
            myvalue = "";
            $("#lvlhidden").val("");
        });
    });
</script>
</body>
</html>
