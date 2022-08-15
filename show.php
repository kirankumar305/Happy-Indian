<?php 
include "connection.php";
if (isset($_POST['admin_submit'])) {
$happy_email=$_POST['happy_email'];
$happy_password=$_POST['happy_password'];
$sql="SELECT * FROM `admin`";
$result=mysqli_query($con,$sql);
$line=mysqli_fetch_assoc($result);
if($line['happy_email']==$happy_email && $line['happy_password']==$happy_password)
{
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>I'm INDIAN</title>
<link rel="icon" href="lib/img/Icon.png" type="image/x-icon">
<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Rubik:wght@400;500;600;700&display=swap">
<link type="text/css" rel="stylesheet" href="lib/css/IND-bootstrap.min.css">
<link type="text/css" rel="stylesheet" href="lib/css/IND-sweetalert.css">
<link type="text/css" rel="stylesheet" href="lib/css/IND-dataTable.css">
<script type="text/javascript" src="lib/js/IND-jquery.js"></script>
<script type="text/javascript" src="lib/js/IND-bootstrap.js"></script>
<script type="text/javascript" src="lib/js/IND-sweetalert.js"></script>
<script type="text/javascript" src="lib/js/IND-dataTables.js"></script>
<script type="text/javascript" src="lib/js/IND-dataTableExtra.js"></script>
<script>
    $(document).ready(function(){
$('#visitors-data-table').DataTable();
$('#pictures-data-table').DataTable();
});
</script>
<style>
div a img{display: none;}
.disclaimer { display:none;}
</style>
</head>
<body>
<div class="container-fluid text-center p-3">
<div class="container-fluid text-center">
<div class="row">
<div class="col-sm-4 col-md-4 col-xl-4 bg-success p-2">
<a href="logout.php"><h4 class="text-white">WELCOME</h4></a>
<div class="animated zoomInUp">
<img data-toggle="modal" data-target="#changeprofileshared" src="lib/img/Admin.png" style="max-width:250px;height:auto;position:relative;background-position: center;border-radius:50%;border:3px solid #fff;border-style:dotted">
</div>
<a href="logout.php"><h4 class="text-primary">You looks glorious</h4></a>
<a href="logout.php"><h4><span style="color:blue">Mr.<span style="color:#00714F"> R Kiran Kumar</span></h4></a>
</div>
<div class="col-sm-8 col-md-8 col-xl-8 p-4 bg-info">
<h4 class="mb-3">Visitors</h4>
<table class="table table-bordered table-responsive table-sm table-hover bg-white" id="visitors-data-table">
<thead class="table-primary">
<tr>
<th>ID</th>
<th>Visitor Name</th>
<th>Visitor's IP</th>
<th>Visited On</th>
</tr>
</thead>
 <tbody>
<?php $visitors_table_qry = mysqli_query($con,"SELECT * FROM `visitors` ORDER BY `id` DESC");
while ($visitors_table_data = mysqli_fetch_assoc($visitors_table_qry)) {
echo "<tr><td>".$visitors_table_data['id']."</td>
 <td>".$visitors_table_data['name']."</td>
 <td>".$visitors_table_data['ip']."</td>
 <td>".$visitors_table_data['time']."</td></tr>";
}
?>
</tbody>
</table>
</div>
</div>
</div>
<div class="container-fluid text-center">
<div class="row">
<div class="col-sm-12 col-md-12 col-xl-12 bg-success p-4">
<h4 class="mb-3">Certificates</h4>
<table class="table table-bordered table-responsive table-sm table-hover bg-white" id="pictures-data-table">
<thead class="table-primary">
<tr>
<th>ID</th>
<th>Name</th>
<th>Contact</th>
<th>Location</th>
<th>IP</th>
<th>Picture</th>
<th>Time</th>
</tr>
</thead>
 <tbody>
<?php $cert_table_qry = mysqli_query($con,"SELECT * FROM `certificates` ORDER BY `id` DESC");
while ($cert_table_data = mysqli_fetch_assoc($cert_table_qry)) {
echo "<tr><td>".$cert_table_data['id']."</td>
 <td>".$cert_table_data['c_name']."</td>
 <td>".$cert_table_data['c_contact']."</td>
 <td>".$cert_table_data['c_location']."</td>
 <td>".$cert_table_data['c_ip']."</td>"; ?>
<td><img style="width:200px" src="<?php if(empty($cert_table_data['c_file'])){echo "lib/img/Admin.png";}else{echo $cert_table_data['c_file']; } ?>"></td>
<td><?php echo $cert_table_data['c_time']; ?></td></tr> <?php } ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</body>
</html>
<?php
}
else {
?>
<script type="text/javascript">
alert("Invalid Credentials");
window.location.assign('index.php');
</script>
<?php
} } else { ?>
<script type="text/javascript">
window.location.assign("index.php");
</script> <?php
} ?>