<?php
// echo(rand(1000,9999));
include("connect.php");
session_start();
if($_SESSION==null)
{
	header('location:login.php');
	exit(1);
}
$email = $_SESSION['email'];
$r=$conn->query("SELECT * FROM user WHERE email='$email'");
$row = $r->fetch_array();
// echo"<pre>";print_r($row);
// echo "<pre>";print_r($row["verified"]); 
// if($row["verified"] == 0)
// {
//     header('location:verify.php');
// 	exit(1);
// }
// die;


// if($r->num_rows>0)
if(isset($_POST['submit1']))
{        
$conn->query("UPDATE user SET wrongcount='0' WHERE email='$email'");
echo " CHARGING  UNBLOCKED.";
}
if(isset($_POST['submit']))
{        
$conn->query("UPDATE user SET chargeverified='0' WHERE email='$email'");
echo " CHARGING  STOPPED.";
}
?>
<!DOCTYPE html>
<html>
    <style>
    .button {
  display: inline-block;
  border-radius: 4px;
  background-color: #f4511e;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 15px;
  padding: 20px;
  width: auto;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}

.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button:hover span {
  padding-right: 25px;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
  background-color: #4CAF50;
  color: white;
}
</style>
<head>
    <style>
body, input {font-size:14pt}
input, label {vertical-align:middle}
.qrcode-text {padding-right:1.7em; margin-right:0}
.qrcode-text-btn {display:inline-block; background:url(//dab1nmslvvntp.cloudfront.net/wp-content/uploads/2017/07/1499401426qr_icon.svg) 50% 50% no-repeat; height:1em; width:1.7em; margin-left:-1.7em; cursor:pointer}
.qrcode-text-btn > input[type=file] {position:absolute; overflow:hidden; width:1px; height:1px; opacity:0}</style>
	<title></title>
</head>
<body>
<h1>Hi, <?php echo $email; ?></h1>
<!--<h2>Your API: http://divineocean.in/website/iot/device.php?email=<?php echo $email; ?></h2>-->
<?php 
if($row["chargeverified"] == 0)
{
?> 
<h2>TO CHARGE YOUR EV. ENTER CODE OR SCAN QR OF CHARGING PORT </h2>
<div>
<form action="chargecodesend.php" method="POST">
<input id = alert type=text size=16 placeholder="ENTER STATION CODE" name = "portid" class=qrcode-text><label class=qrcode-text-btn><input type=file accept="image/*" capture=environment onclick="return showQRIntro();" onchange="openQRCamera(this);" tabindex=-1></label> 
<input type=submit value="Go">
</form>
</div>
<?php }
else
{
?>
<p>YOUR EV IS CONNECTED TO PORT.CHARGING USAGE ARE DISPLAYED BELOW .PLEASE REFRESH THE PAGE TO GET UPDATED USAGE </p>
<?php } ?>
<div>
	<form action="pay.php" method="POST">
	<table border="1px solid blue;">
		<tr>
			<th>USED ENERGY</th>
			<th>TOTAL PAYMENT DUE</th>
		</tr>
		<tr>
			<td id = "energy">Nan</td>
			<td  id = "payment">Nan</td>
			
		</tr>
	</table>
	
	<button class="button"><span>PAY</span></button>
	</form>
	<form action="" method="POST">
	    <button class="button"  type = "submit1" name="submit1"><span> UNBLOCK </span></button>
	    
	</form>
	<form action="" method="POST">
	    <button class="button"  type = "submit" name="submit"><span> STOP CHARGING </span></button>
	    
	</form>
	 <span><h1>IF EV IS CONNECTED.THEN LOGOUT WILL STOP CHARGING ASWELL.</h1></span>
	 <button class="button" onclick="window.location.href = 'http://www.divineocean.in/iot/logout.php';"><span>LOGOUT </span></button>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/qr_packed.js">
</script>
<script type="text/javascript">
function openQRCamera(node) {
  var reader = new FileReader();
  reader.onload = function() {
    node.value = "";
    qrcode.callback = function(res) {
      if(res instanceof Error) {
        alert("No QR code found. Please make sure the QR code is within the camera's frame and try again.");
      } else {
        node.parentNode.previousElementSibling.value = res;
      }
    };
    qrcode.decode(reader.result);
  };
  reader.readAsDataURL(node.files[0]);
}

function showQRIntro() {
  return confirm("Use your camera to take a picture of a QR code.");
}
function alert()
{
    alert()
}
$(document).ready(function() {

  
        
        var ajax_call = function() {
         var formData = {
            'name'              : 'SHIVAM',
        };

        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'process.php', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
        })
            // using the done promise callback
            .done(function(data) {

                // log data to the console so we can see
                console.log(data); 
                $("#energy").text(data['energy']+"Watthr");
                $("#payment").text("Rs."+data['paymentdue']);
                // here we will handle errors and validation messages
            });
};

var interval = 1000  * 1; // where X is your every X minutes

setInterval(ajax_call, interval);

        // get the form data
        // there are many ways to get this data using jQuery (you can use the class or id also)
        

        // stop the form from submitting the normal way and refreshing the page

});
</script>
</body>
</html>