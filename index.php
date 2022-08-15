<?php
session_start();
include "connection.php";
if (isset($_POST['admin_submit'])) {
$happy_email=$_POST['happy_email'];
$happy_password=$_POST['happy_password'];
$sql="SELECT * FROM `admin`";
$result=mysqli_query($con,$sql);
while ($line=mysqli_fetch_assoc($result)) {
if($line['happy_email']==$happy_email && $line['happy_password']==$happy_password)
{
$_SESSION['happy_email_ses']=$happy_email;
?>
<script type="text/javascript">
window.location.assign('show.php');
</script>
<?php
}
else {
?>
<script type="text/javascript">
window.alert('Invalid Inputs. Try again !');
window.history.back();
</script>
<?php
} } } ?>
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
<script>
$(document).ready(function(){
$("#Show-Download-Btn").hide();
$("#Reg-Loading").hide();
$("#Visit-Loading").hide();
$("#Hi-Partner").on("click", function(event) {
Swal.fire({
html: '<h5 class="fw-bold p-1 text-success">Comming Soon...!</h5>',
imageUrl: 'lib/img/HP-1.png',
imageWidth: 400,
imageHeight: 200,
imageAlt: 'Image',
})
});
$("#Reg-Submit").on("click", function(event) {
$("#Reg-Loading").show();
$("#Visit-Loading").hide();
});
$("#Submit-Button").on("click", function(event) {
$("#Reg-Loading").hide();
$("#Visit-Loading").show();
});
$("#Reg-Contact").on("keyup", function(event) {
$(this).val($(this).val().replace(/[a-z]/i, ""));
})
$("#Submit-Button").on("click", function(){
if($("#User-Name").val() == "" || $("#User-Name").val() == "None"){
Swal.fire({
icon: 'error',
title: 'Oops...',
text: 'Please Enter Your Name !',
}).then(function(){
$("#Visit-Loading").hide();
$("#Reg-Loading").hide();
});
} else {
var Name = $("#User-Name").val();
Swal.fire({
html: '<h3 class="fw-bold p-2">Happy Independence Day <br><br><span class="text-danger">'+Name+'</span></h3>'+
'<p class="text-success">Thanks, for hoisting the flag</p>',
imageUrl: 'lib/img/The-Day.gif',
imageWidth: 200,
imageHeight: 200,
imageAlt: 'Image',
showConfirmButton: true,
confirmButtonText: '<a data-bs-toggle="modal" data-bs-target="#RegisterModal" class="text-white"> Register </a>'
}).then(function(){
$("#Visit-Loading").hide();
$("#Reg-Loading").hide();
});
$.ajax
({
type: "POST",
url: "fetch.php",
data: {"Name": Name },
success: function (datapsearch) {
if (datapsearch != "") {
}
}
});
}
});

$("#Reg-Submit").on("click", function(){
if($("#Reg-Name").val() == "" || $("#Reg-Location").val() == "" || $("#Reg-Contact").val() == ""){
Swal.fire({
icon: 'error',
title: 'Oops...',
text: 'Some inputs are empty !',
}).then(function(){
$("#Visit-Loading").hide();
$("#Reg-Loading").hide();
});
} else {
var Reg_Name = $("#Reg-Name").val().replace(/[\s]/g, "");
var Reg_Location = $("#Reg-Location").val();
var Reg_Contact = $("#Reg-Contact").val();
$.ajax
({
type: "POST",
url: "fetch.php",
data: {"Reg_Name": Reg_Name, "Reg_Location": Reg_Location, "Reg_Contact": Reg_Contact},
success: function (data) {
if (data != "") {
Swal.fire({
icon: 'success',
html: '<h3 class="fw-bold" style="color:green">Registration Successful<h3>'+
'<span style="color:blue;padding:1px">'+Reg_Name+'</span>',
imageUrl: 'lib/img/The-Day.gif',
imageWidth: 50,
imageHeight: 50,
imageAlt: 'Image',
showCancelButton: true,
confirmButtonColor: '#138808',
cancelButtonColor: '#ff9933',
confirmButtonText: 'Certificate',
cancelButtonText: '×'
}).then((result) => {
if (result.isConfirmed) {
Swal.fire({
html: '<h5 class="fw-bold p-1">Thank You ! <span class="text-danger">'+Reg_Name+'</span></h5>'+
'<a href='+data+' download="Certificate.png" class="text-white btn btn-success"> Download </a>',
imageUrl: data,
imageWidth: 400,
imageHeight: 200,
imageAlt: 'Image',
showConfirmButton: false
}).then(function(){
$("#Visit-Loading").hide();
$("#Reg-Loading").hide();
});
}
})
$("#Show-Download-Btn").show();
$("#Show-Download-Btn").html('<a href='+data+' download="Certificate.png" class="text-center text-white btn btn-success"> Download Certificate</a>');
}
}
});
}
});
});
var countDownDate = new Date("Aug 15, 2022 23:59:59").getTime();
var x = setInterval(function() {
var now = new Date().getTime();
var distance = countDownDate - now;
var days = Math.floor(distance / (1000 * 60 * 60 * 24));
var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
var seconds = Math.floor((distance % (1000 * 60)) / 1000);
document.getElementById("Offer-Time").innerHTML = hours + "h "
+ minutes + "m " + seconds + "s ";
if (distance < 0) {
clearInterval(x);
document.getElementById("Offer-Time").innerHTML = "EXPIRED";
}
}, 1000);
</script>
<style>
div a img{display: none;}
.disclaimer { display:none;}
.wrapper h3, .wrapper button{
color: #fff;
text-transform: uppercase;
font-weight: bold;
background: linear-gradient(to right, #095fab 10%, #25abe8 33%, #57d75b 66%, #ff123f 90%);
background-size: auto auto;
background-clip: border-box;
background-size: 200% auto;
color: #fff;
background-clip: text;
text-fill-color: transparent;
-webkit-background-clip: text;
-webkit-text-fill-color: transparent;
animation: textclip 1.5s linear infinite;
display: inline-block;
}
@keyframes textclip {
to {
background-position: 200% center;
}
}
</style>
</head>
<body>
<div class="row content">
<div class="col-sm-12 col-md-12 col-md-12 content">
<canvas class="zp-m" id="Gravity"></canvas>
<script src='lib/js/IND-Gravity.min.js'></script>
<br>
<div class="d-flex justify-content-center"><h4 class="text-danger fw-bold">Happy Indian</h4></div>
<div class="d-flex justify-content-center"><img src="lib/img/Emblem.png" data-bs-toggle="modal" data-bs-target="#RegisterModal" alt="" class="zp-or-1" style="max-width: 60px;"></div>
<div class="d-flex justify-content-center wrapper text-center"><h3 class="fw-bold p-1 zp-or-1" data-bs-toggle="modal" data-bs-target="#About">Happy Independence Day</h3></div>
<div class="d-flex justify-content-center"><img src="lib/img/Our-Nation.gif" alt="" class="zp-or" style="max-width: 225px;"></div>
<div class="d-flex justify-content-center text-center"><p class="fw-bold text-success zp-or-1"><a href="" data-bs-toggle="modal" data-bs-target="#About">Let's stand together for the nation by hoisting the flag</a></p></div>
<div class="d-flex justify-content-center">
<div class="input-group mb-3 zp-or-1" style="max-width: 500px;padding:0px 10px">
<input type="text" class="form-control border border-primary border-3" id="User-Name" placeholder="Enter Your Name Here..." aria-label="Enter Your Name Here" aria-describedby="Enter-Name" required>
<button class="btn border border-primary border-3 border-start-0 bg-india text-dark" id="Submit-Button" type="button"><img src="lib/img/Indian-Flag.gif" alt="" class="zp-or-1" style="max-width: 20px;"> Let's Go <img src="lib/img/Loading.gif" id="Visit-Loading" alt="" class="zp-or-1" style="max-width: 20px;"></button>
</div></div><a href="" data-bs-toggle="modal" data-bs-target="#RegisterModal"><div class="d-flex p-3 justify-content-center wrapper"><button class="zp-or-1 btn border border-5 border-primary btn-success">Register for Certificate</button></div></a>
<center><table data-bs-toggle="modal" data-bs-target="#RegisterModal" class="table table-bordered border-primary border border-3 table-responsive table-sm table-hover text-white fw-bold w-25 text-center" style="background:green">
<tr style="background:#000080">
<th>Users</th>
<th>Visitors</th>
</tr>
<tr>
<td><span class="counter" data-count="
<?php 
$query_visitors=mysqli_query($con,"SELECT `id` FROM `visitors`"); 
$visitors = mysqli_num_rows($query_visitors);
$query_registers=mysqli_query($con,"SELECT `id` FROM `certificates`"); 
$registers = mysqli_num_rows($query_registers);
$result=$visitors+$registers; 
echo $result; ?>"></span></td>
<td><span class="counter" data-count="
<?php 
$visit_query1 = mysqli_query($con,"SELECT `visits` FROM `admin`");
$visit_fetch1 = mysqli_fetch_assoc($visit_query1);
$total_visits1 = $visit_fetch1['visits'];
$update_visits1 = $total_visits1 + 1;
mysqli_query($con,"UPDATE `admin` SET `visits`='$update_visits1' WHERE `happy_email` = 'kirankumar.3219.rkk@gmail.com'");
$result1=$total_visits1; 
echo $result1; ?>"></span></td> 
</tr>
</table> </center>
<div class="d-flex p-3 justify-content-center"><span class="zp-or-1 fs-4 f-w"><span href="" data-bs-toggle="modal" data-bs-target="#AdminLogin">Powered by </span><img src="lib/img/HiPartner.png" alt="img" style="width:120px;padding-bottom:7px" id="Hi-Partner"></span></div>
</div>
</div>
<div class="modal fade" id="RegisterModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="RegisterModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg">
<div class="modal-content bg-india">
<div class="modal-header">
<h3 class="modal-title fw-bold" id="RegisterModalLabel">Certification Details</h3>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<div class="input-group mb-3">
<input type="text" class="form-control border border-primary border-2 fw-bold text-success" id="Reg-Name" placeholder="Your Name" required>
</div>
<div class="input-group mb-3">
<input type="text" class="form-control border border-primary border-2 fw-bold text-success" id="Reg-Location" placeholder="Your Location" required>
</div>
<div class="input-group mb-3">
<button disabled class="fw-bold border border-primary border-2 border-end-0 btn-light text-success" class="border border-primary border-2 border-end-0">+91</button>
<input type="text" class="form-control border border-primary border-2 fw-bold border-start-0 text-success" pattern="[6789][0-9]{9}" maxlength="10" id="Reg-Contact" placeholder="Contact Number" required>
<button class="input-group-text fw-bold border border-primary border-2 border-start-0 btn-primary" id="Reg-Submit"><img src="lib/img/Indian-Flag.gif" alt="" class="zp-or-1" style="max-width: 20px;"> Register <img src="lib/img/Loading.gif" id="Reg-Loading" alt="" class="zp-or-1" style="max-width: 20px;"></button>
</div>
<center><span id="Show-Download-Btn"></span></center>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<div class="modal fade" id="About" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="AboutLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content bg-india">
<div class="modal-header">
<h5 class="modal-title" id="AboutLabel">About</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<h2 class="text-center fw-bold text-danger">Offer Closes Soon.....!</h2><br>
<center><span id="Offer-Time" class="text-center fw-bold text-success fs-4"></span></center><hr>
<h3 class="text-center fw-bold">Sponsors From</h3><hr>
<div class="d-flex justify-content-between p-1"><a href="https://dowithus4u.000webhostapp.com/"><span><span>⟶</span>Team doWithUs</span></a><a href="https://dowithus4u.000webhostapp.com/" class="btn btn-success btn-sm">Visit</a></div>
<div class="d-flex justify-content-between p-1"><a href="https://friendsforever2021.000webhostapp.com/MSC-Friends/"><span><span>⟶</span>Dravidian University</span></a><a href="https://friendsforever2021.000webhostapp.com/MSC-Friends/" class="btn btn-success btn-sm">Visit</a></div>
<div class="d-flex justify-content-between p-1"><a href="https://friendsforever2021.000webhostapp.com/"><span><span>⟶</span>Kuppam Degree College</span></a><a href="https://friendsforever2021.000webhostapp.com/" class="btn btn-success btn-sm">Visit</a></div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<div class="modal fade" id="AdminLogin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="AboutLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content bg-india">
<div class="modal-header">
<h5 class="modal-title" id="AdminLoginLabel">Admin</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<h3 class="text-center fw-bold">Credentials</h3><hr>
<form action="" method="post" class="was-validated">
<div class="mb-3">
<label for="Email1" class="form-label">Email address</label>
<input type="email" class="form-control" name="happy_email" required>
</div>
<div class="mb-3">
<label for="Password" class="form-label">Password</label>
<input type="password" class="form-control" name="happy_password" required>
</div>
<div class="mb-3">
<button type="submit" class="btn btn-primary form-control" name="admin_submit">Submit</button>
</div>
</form>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
</body>
</html>


