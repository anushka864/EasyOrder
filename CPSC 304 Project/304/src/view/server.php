<?php
$errors = array();
$messages = array();

function info($errors, $messages) {
	foreach ($errors as $error) {
		echo '<div class="alert alert-warning">
						<a href="#" class="close" data-dismiss="alert">&times;</a>' . $error . 
				'</div>';
	}
	foreach ($messages as $message) {
		echo '<div class="alert alert-success">
						<a href="#" class="close" data-dismiss="alert">&times;</a>' . $message . 
				'</div>';
	}
}
if(isset($_POST['delete'])) {
    getDelete();
} else if (isset($_POST['insert'])) {
    getInsert();
} else if(isset($_POST['sdelete'])) {
    deleteStaff();
} else if (isset($_POST['update'])) {
    updatePrice();
}

// add some fodd into processOrder table:
function getInsert() {
    $ifname = $iordernub = $inofood = $ibid = "";
    $fname = $_POST["ifname"];
    $iordernub = $_POST["iordernub"];
    $inofood = $_POST["inofood"];
    $ibid = $_POST["ibid"];
    require_once("config/db.php");
    require_once("controller/DB.php");
    error_reporting(-1);
ini_set('display_errors',1);
    $sql = "INSERT INTO processorder VALUES ('$fname', $iordernub, $inofood, $ibid)";
//	$sql = "insert into fooditem values('$fname', 2.0)";
echo $sql;
   $dbConn = oci_connect(DB_USER, DB_PASS, DB_NAME);
    $result = oci_parse($dbConn, $sql);
    if($result!=false){
        oci_execute($result);
    } else { 
        $e = oci_error($result);
        echo $e['Insert fail: please make sure your values are appropriate. Hehe']; 
    }
oci_free_statement($result);
oci_close($dbConn);
} 

// delete w/e in the delete area:
function getDelete() {
    $dfname = "";
	$dsucc = "";
    $dfname = $_POST["dfname"];
    require_once("config/db.php");
    require_once("controller/DB.php");
    error_reporting(-1);
ini_set('display_errors',1);
    $sql = "delete from fooditem where fname = '$dfname'";
    $dbConn = oci_connect(DB_USER, DB_PASS, DB_NAME);
    $result = oci_parse($dbConn, $sql);
    if($result!=false){
        oci_execute($result);
				global $errors; 
				global $messages;
				$messages[] = "Food item " . $dfname . " deleted.";
				info($errors, $messages);
    } else { 
        $e = oci_error($result);
        echo $e['delete fail: please make sure your values are appropriate. Hehe']; 
    }
oci_free_statement($result);
oci_close($dbConn);
}

function deleteStaff() {
    $sname = "";
    $sname = $_POST["sname"];
    require_once("config/db.php");
    require_once("controller/DB.php");
    error_reporting(-1);
ini_set('display_errors',1);
    $sql = "delete from staff where staffname = '$sname'";
    $dbConn = oci_connect(DB_USER, DB_PASS, DB_NAME);
    $result = oci_parse($dbConn, $sql);
    if($result!=false){
        oci_execute($result);
    $dsucc = "Yay";
    } else { 
        $e = oci_error($result);
        echo $e['delete fail: please make sure your values are appropriate. Hehe']; 
    }
oci_free_statement($result);
oci_close($dbConn);
}

// Update them price of a fooditem:
function updatePrice(){
    $ufname = $uprice = "";
    $ufname = $_POST['ufname'];
    $uprice = $_POST['uprice'];
    require_once("config/db.php");
    //require_once("controller/DB.php");
    $sql = "update fooditem set price = $uprice where fname='$ufname'";
   $dbConn = oci_connect(DB_USER, DB_PASS, DB_NAME);
    $result = oci_parse($dbConn, $sql);
		global $errors; 
		global $messages;
    if($result!=false){
        if($foo = @oci_execute($result)) {
		$messages[] = "we made it bois";
		info($errors, $messages);
} else { 
	$errors[] = "Invalid input please check and try again";
	info($errors, $messages); 
         }
				}
oci_free_statement($result);
oci_close($dbConn);
}

?>


<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
		<script type="text/javascript">
		function hey(msg) {
			document.getElementsByClassName('alert')[0].innerHTML=msg;
		}
		</script>
</head>

<body style="padding-top:50px; background-color:#CCCCCC;">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <p class="navbar-text" style="color:#fff;">Welcome! </p>
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse navbar-right">
            <!-- maybe we want to search something -->
            <ul class="nav navbar-nav">
                <li class="dropdown" role="presentation">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> View Table <b class="caret"></b></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a class="ajax-link" href="search_server_fooditem.php"> FoodItem </a></li>
                        <li><a class="ajax-link" href="search_server_process.php"> ProcessOrder</a></li>
                        <li><a class="ajax-link" href="search_server_staff.php"> Staff</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav><!-- End of Navbar -->
    <div id="TakingOrder" class="container"  "style=min-height:500px;">
    <div class="row">
        <div class="col-md-6">
        <form style="padding-top: 5px;" method="post" name="orderForm">
            <h3> FoodItem DELETION </h3>
            <label > FoodName : </label>
            <input type="text" name="dfname">
            <input id="submitbutton" type="submit" value="press delete" name="delete"><hr>           
 <h3> FoodItem Insertion </h3>
            <p><label > FoodName : </label>
            <input type="text" name="ifname"></p>
            <p><label > OrderNumb : </label>
            <input type="number" name="iordernub"></p>
            <p><label > #Food : </label>
            <input type="number" name="inofood"></p>
            <p><label > BID : </label>
            <input type="number" name="ibid"></p>
            <input id="submitbutton" type="submit" value="press insert" name="insert"><hr>
            <h3> Staff Deletion </h3>
            <label> StaffName to be FIRED </label>
            <input type="text" name="sname">
            <input id="submitbutton" type="submit" value="press delete" name="sdelete"><hr>
            <h3> Update Price of Fooditem </h3>
            <p><label > FoodItem's Name : </label>
            <input type="text" name="ufname"></p>
            <p><label > New Price : </label>
            <input type="number" name="uprice"></p>
            <input id="submitbutton" type="submit" value="press update" name="update">
            </form>
        </div><!-- End of Left Coln -->

        <div class="col-md-6 tab-content">
        </div><!-- End of Right Coln -->
    </div>
    </div><!-- end of section -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- Responding to the external php here -->
    <script type="text/javascript">
      $(document).ready(function(){ 
        $(".ajax-link").on("click", function(e) {
          e.preventDefault();
          $(".tab-content").load(this.href);
        });
      });
    </script>
</body>
</html>
