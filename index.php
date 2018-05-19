<!DOCTYPE html>
<html>
<head>
<style>
.img{ height:400px;
width:100%;
}
.table{ position:center;
width:100%;
height:200px;
font-size:20pt;
background-color:#40E0D0;
overflow:auto;


}
body{ background-color:#FFE4E1;}
.form{
text-align:center;
width:100%;
float:center;
height:200px;

}
.input{
width:200px;
height:60px;
font-size:20pt;
}
h1{
text-align:center;
font-size:20pt;
}
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #F0FFFF;
   }

li {
    float: left;
}

li a {
    display: block;
    color: black;
    text-align: center;
    padding: 25px 30px;
    text-decoration: none;
    font-size:20pt;
    
}

li a:hover {
    background-color: #1E90FF;
}


</style>



 
 

</head>


<body>
<div id="page-wrap">
<nav>
<ul>
  <li><a class="active" href="wedding.php">Home</a></li>
  <li><a href="venues.php">Venues</a></li>
  <li><a href="cateringCosts.php">Catering</a></li>
  <li><a href="contact.html">Contact</a></li>
</ul>
</nav>
<section id="main-content">
<div id="guts">
<script src="jquery.js" type="text/javascript"></script>
<div class="flower">
<img class="img" src="flowers.jpg">
</div>
<table border='1' style="background-color:white;width:100%;height:100px">
<th>
<h1>Book your dream wedding venue</h1>
</th>
</table>
<div id="ma">
<table id="main">
<form method="get" class="form" id="form" name="form" id="main">

<th>
<label style="font-size:20pt"> Wedding Date:</label>
<input type="date" placeholder="Date" id="date" name="date" class="input" >
</th>

<th>
<input type="number" placeholder=" Party Size" name="partySize" id="partySize" class="input" >
</th>

<th>
<label style="font-size:20pt"> Catering grade:</label>
<select name="cateringGrade" id="cateringGrade" class="input">
<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
<option>5</option>
</select>
</th>
<th>
<button type="submit" name="submit" id="submit" class="input"  >Search</button>
</th>
</form>
</table>
</div>


<?php 
$con=mysqli_connect("","coa123wuser","grt64dkh","coa123wdb") ;

if(isset($_GET['submit'])) {

	$partySize=$_GET["partySize"];
	$catering=$_GET["cateringGrade"];
	$old_date=$_GET["date"];
	$date = date("Y-m-d",strtotime($old_date));
	function isweekend($dat){
		$dat=strtotime($dat);
		$dat=date("l", $dat);
		$dat=strtolower($dat);

		if($dat=="saturday" || $dat=="sunday"){
			return true;
		}
	else return false;
}
function totalcost($price,$cost,$size){
$x= $price+$cost*$size;
return "£".$x;
}
	
$query="SELECT venue.venue_id,venue.name, venue.weekend_price, venue.weekday_price, venue_booking.date_booked, catering.grade, catering.cost
FROM venue 
INNER JOIN venue_booking ON venue.venue_id=venue_booking.venue_id 
INNER JOIN catering ON venue.venue_id=catering.venue_id
where venue.venue_id not in (Select venue_id from venue_booking where date_booked='$date')
and capacity >=$partySize and venue.venue_id in(select venue_id from catering where grade='$catering')
GROUP BY venue.venue_id";

if($result=mysqli_query($con,$query)){
if(mysqli_num_rows($result)>0){
echo "<table border='1' class='table' align='center'>";
echo "<tr>";

echo "<th>NAME</td>";

echo "<th>COST PER DAY</th>";


echo "<th>CATERING COST</td>";
echo "<th>TOTAL COST</td>";

echo "</tr>";
while($row=mysqli_fetch_array($result)){
echo "<tr>";

echo "<td>".$row['name']."</td>";
if(isweekend($date)){
echo "<td>".$row['weekend_price']."</td>";
}
else{
echo "<td>".$row['weekday_price']."</td>";
}
echo "<td>".$row['cost']."</td>";
if(isweekend($date)){
echo "<td>".totalcost($row['weekend_price'],$row['cost'],$partySize)."</td>";
}
else{
echo "<td>".totalcost($row['weekday_price'],$row['cost'],$partySize)."</td>";

}


echo "</tr>";
}
}
echo "</table>";
mysqli_free_result($result);
}else {
echo "No records matching your query were found. ";
}
}


mysqli_close($con);
?>
</div>
</section>
</div>


</body>
</html>


