<?php
session_start();
if(!isset($_SESSION['usr_name'])) {
header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="https://overpass-30e2.kxcdn.com/overpass.css"/>
<link rel="stylesheet" href="css/jquery-ui.css">
<link rel="stylesheet" href="css/jquery.qtip.css" />
<link rel="stylesheet" href="css/bootstrap-slider.css" type="text/css" />
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
<link href="css/bootstrap-toggle.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/datatables.min.css"/>

<script src="js/jquery-1.12.4.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/jquery.dataTables.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>  

</head>
<body>

<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php"><img src="images/innovate.png">  Ready to Innovate?</a>
			<div class="smallVersion">v2.0</div>
		</div>
		<div class="collapse navbar-collapse" id="navbar1">
			<ul class="nav navbar-nav navbar-right">
				<?php if (isset($_SESSION['usr_id'])) { ?>
				<li><a href="myrti.php">My RTI</a></li>
				<li><a href="assess.php">Run Assessment</a></li>
				<li><a href="#">Signed in as <?php echo $_SESSION['usr_name']; ?></a></li>
				<li><a href="logout.php">Log Out</a></li>
				<?php } else { ?>
				<li><a href="register.php">Register</a></li>
				<li><a href="login.php">Login</a></li>
				<?php } ?>

			</ul>
		</div>
	</div>
</nav>
    <div class="container">
 
<?php
if(isset($_SESSION['usr_id'])) {
include 'dbconnect.php';
$userId = $_SESSION['usr_id'];
$userName = $_SESSION['usr_name'];

?>
    <div class="container">
<h3>Completed Assessments for <?php print $userName; ?> </h3>
<table  class="bordered" id="assessmentTable">
    <thead>
    <tr>
        <th>Client Name</th>        
        <th>Country</th>
        <th>Line of Business</th>
        <th>Timestamp</th>
        <th>Customer Data</th>
        <th>Link to Output</th>
    </tr>
    </thead>
    <tbody>
<?php
connectDB();
$qq = "SELECT * FROM data WHERE user='".$userName."'";
$res = mysqli_query($db, $qq);
while ($row = $res->fetch_assoc()) {
	if ($row['demo'] == "on") {
	$demoData = "<img src=images/cross.png>";
	} else {
	$demoData = "<img src=images/tick.png>";
	}
	
print "<tr><td>" . $row['client'] . "</td><td>" . $row['country'] . "</td><td>" . $row['lob'] . "</td><td>" . $row['date'] . "</td><td>" . $demoData . "</td><td><a target=_ href=results.php?hash=" . $row['hash'] . ">Link</a></td></tr>";
}

?>
<tbody>
</table>

      </div>


    </div> <!-- /container -->
<?php    }
####  End of Logged on bit ######
?>

<script>
$(document).ready( function () {
    $('#assessmentTable').DataTable();
} );
</script> 
</body>
</html>
