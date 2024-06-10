<html>
<head>
	 <meta charset="utf-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1">

  		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  		<script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  		 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/style1.css">
  <style type="text/css">
  
.navbar {
  background: black;
}
 .navbar-nav .nav-link {
    font-size: 20px;
    font-weight: 600; 
    padding: 15px; 
  }

.nav-link {
  color: black; 
  padding: 10px;
  text-align: center; 
}

.nav-link:hover {
  transform: scale(1.1);
  color: #56f57b;

}

.nav-item
    {
      width: 120px;
      padding: 0 10px;
      margin-bottom: 5px;
    }
.nav-link.active {
    color: red !important; 
 
}
label{
  font-size: 18pt;
}
  #logo{
    width: 70px;
    height: auto;
    margin-left: 200%;
  }
  @media (max-width: 770px){
    #logo{
      margin-left: 100%;
      width: 55px;
      height: auto;
    }
  }

  </style>
</head>
<body>

<nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top" style="height: 100px;">
  <a class="navbar-brand" href="#">
    <img src="images/horse.png" alt="Logo" id="logo">
  </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar" 
    style="background-color: black; border-radius:8px;">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="collapsibleNavbar">
      <ul class="navbar-nav">
         <!--<li class="nav-item">
          <a class="nav-link" id="login" style="background-color:#f7f6eb; border-radius:20px;" href="login.php">Log In</a>
        </li>-->
        <?php
        session_start();
        if (isset($_SESSION["login"]) && $_SESSION["login"] == 1000) {
          // User is logged in, display "Log Out" link
          echo '
          <li class="nav-item">
            <a class="nav-link" id="logout" style="background-color:#f7f6eb; border-radius:20px;" href="logout.php">Log Out</a>
          </li>';
        } else {
          // User is not logged in, display "Log In" link
          echo '
          <li class="nav-item">
            <a class="nav-link" id="login" style="background-color:#f7f6eb; border-radius:20px;" href="login.php">Log In</a>
          </li>';
        }
        ?>
        <li class="nav-item">
          <a class="nav-link" id="entry" style="background-color:#f7f6eb; border-radius:20px;" href="entry.php">Entry</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="letter" style="background-color:#f7f6eb; border-radius:20px;" href="letter.php">Letter</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="display" style="background-color:#f7f6eb; border-radius:20px;" href="display.php">List</a>
        </li> 
      </ul>
    </div>
  </nav>
<script type="text/javascript">
    $(document).ready(function(){
      
      var loc=$(location).attr('pathname').match(/[^\/]+$/);
      //alert("loc=" + loc[0]);
         if(!loc) { loc="index.php"; } else { loc=loc[0]; }
         var cid=loc.replace('.php', '');
         //alert("cid=" + cid);
         $("#"+ cid ).css("background-color","#60aef7");;
    });
</script>

</body>
