<?php 
include("inc/nav.php");
include("inc/dbsetting.php");

if ($_SESSION["login"] != 1000) {
    header("location:index.php");
    exit;
}

$usrlevel = $_SESSION["usrlevel"];
$sql1 = "";
if (isset($_POST["searchbtn"])) {
    $field = $_POST["field"];
    $sword = $_POST["sword"];            
    $str = "";

    if ($field === "general" && strlen($sword) > 0) {
        $str = " (fullname LIKE '%" . $sword . "%' OR username LIKE '%" . $sword . "%' OR dep LIKE '%" . $sword . "%')";
    } else if ($field === "fullname") {
        $str = " fullname LIKE '%" . $sword . "%'";
    } else if ($field === "username") {
        $str = " username LIKE '%" . $sword . "%'";
    } else if ($field === "dep") {
        $str = " dep LIKE '%" . $sword . "%'";
    }
    
    $where = strlen($str) > 0 ? " WHERE " : " ";
    $sql1 = "SELECT * FROM user_table" . $where . $str . " ORDER BY user_id;";
    $result1 = $dbconn->query($sql1);
} else {
    $sql1 = "SELECT * FROM user_table ORDER BY user_id;";
    //$sql1 = "SELECT user_table.*, level_table.description FROM user_table 
             //INNER JOIN level_table ON level_table.description = user_table.level_id 
             //ORDER BY rec_id;";
    $result1 = $dbconn->query($sql1);
}
?>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style type="text/css">
        body {
            background-image: url('images/entry.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        table {
            border-spacing: 0;
            border: 2px solid;
            box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
            border-radius: 6px;
        }
        .displaytable {
            width: 100%;
            border: solid 2px;
            background: linear-gradient(300deg, #f7b69e, #f7f69e);
        }
        th {
            text-align: center;
            border: 2px solid;
            height: 40px;
            padding: 10px;
            font-size: 18pt;
        }
        td {
            border: 2px solid;
            padding: 5px;
            font-size: 14pt;
            vertical-align: text-top;
            text-align: justify;
        }
        tr {
            width: 10%;
            border: 2px solid;
        }
        #searchform {
            margin-top: 13%;
            margin-left: 5%;
        }
        .sel {
            border-radius: 15px;
        }
        #createbtn{
         float: right;
         border-radius: 10px;
         font-weight: bold;
         text-shadow: 2px 2px #ff0000;
         width: 12%;
         height: 6%;
         box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
         color: white;
         background: linear-gradient(265deg, #fcaf49, #fc4a3a);
        }
        #actiontd{
         width: 10%;
         text-align: center;
        }
        .edbtn{
         width: 70px;
         margin-bottom: 8%;
        }
        h5{
         margin-left: 12%;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="searchform" class="was-validated">
            <div class="row">
                <div class="col-lg-5 srbox">
                    <select class="form-control sel" name="field">
                        <option value="general">General</option>
                        <option value="fullname">Fullname</option>
                        <option value="username">User Name</option>
                        <option value="dep">Department</option>
                    </select>                    
                </div>
                <div class="col-lg-4 srbox">
                    <input type="text" class="form-control" placeholder="Search" id="sarea" name="sword" autofocus>
                </div>
                <div class="col-lg-3">
                    <button type="submit" class="btn btn-dark btnd" name="searchbtn">Search</button>&nbsp;
                    <button type="reset" class="btn btn-dark btnd" onclick="location.href='userlist.php';">Cancel</button>
                </div>
            </div>
        </form>
        <div id="usertable">
         
            <center>
                <h1>User List</h1>
                <button id="createbtn"  onclick="location.href='entry.php';">Create Account</button>
                <?php
                if ($result1->num_rows > 0) {
                    echo "<h5>(" . $result1->num_rows . " users are found)</h5><br>";
                    echo "<table class='table-bordered displaytable'><tr>";
                    echo "<th>No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Department</th>
                          <th>User Level</th>
                          <th id='actth' >Action</th>";
                    echo "</tr>";
                    $number = 1;

                    while ($row = $result1->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td width=3% style='padding:6px;'>" . $number . "</td>";
                        echo "<td width=18%>" . $row["fullname"] . "</td>";
                        echo "<td width=12%>" . $row["username"] . "</td>";
                        echo "<td width=12%>" . $row["dep"] . "</td>";
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

                    // Display user levels with descriptions
                    echo '<td width=30%>' . implode("/ ", $descriptions) . '</td>';
                        echo "<td id='actiontd'>";
                        if (strpos($usrlevel, "|20") > -1) {
                            echo "<button style='border_radius:10px;' data-id='" . $row["user_id"] . "' class='btn btn-dark edbtn'>Edit</button><br>";
                        }
                        if (strpos($usrlevel, "|10") > -1) {
                            echo "<button style='border_radius:10px;' del-id='" . $row["user_id"] . "' class='btn btn-danger delbtn'>Delete</button>";
                        }
                        echo "</td>";
                        echo "</tr>";
                        $number++;
                    }
                    echo "</table>";                    
                } else if (isset($_POST["searchbtn"])) {
                    echo "<h5 style='text-align: center; padding: 10px; color: red; margin-top: 5%;'>List not Found!</h5>";
                }
                ?>
            </center>
        </div>
    </div><br><br><br>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".edbtn").click(function(){
                var userid = $(this).attr("data-id");
                location.href = "useredit.php?userid=" + userid;
            });
            $(".delbtn").click(function(){
                if (!confirm("Are you sure?")) return;
                var udelid = $(this).attr("del-id");
                location.href = "userdelete.php?userid=" + udelid;
            });
            $(".createbtn").click(function(){
               //location.href = "entry.php";
               header("location:entry.php");
            });
        });
    </script>
</body>
