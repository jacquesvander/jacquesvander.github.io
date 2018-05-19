<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Catering Task</title>
<style type="text/css">
body {
	font-family: "Apple Chancery", Times, serif;
	background-color: #D6D6D6;
}
.center {
	text-align:center;
}
body,td,th {
	color: #06F; 
}
.larger {
	font-size:larger;
	text-align:right;
}
table {
	margin-left:auto;
	margin-right:auto;
}
</style>
</head>
<body>
<h3 class="center">COA123 - Server-Side Programming</h3>
<h2 class="center">Individual Coursework - Wedding Planner</h2>
<h1 class="center">Task 4 - Costs (costs.php)</h1>

<?php
$con=mysqli_connect("","coa123wuser","grt64dkh","coa123wdb") ;
$size=$_GET['partySize'];
$old_date=$_GET['date'];
$myDateTime = DateTime::createFromFormat('d/m/Y', $old_date);
$date = $myDateTime->format('Y-m-d');
function isweekend($dat){
$dat=strtotime($dat);
$dat=date("l", $dat);
$dat=strtolower($dat);

if($dat=="saturday" || $dat=="sunday"){
return true;
}
else return false;
}


$query="SELECT venue.venue_id,venue.name, venue.weekend_price, venue.weekday_price, venue_booking.date_booked
FROM venue 
INNER JOIN venue_booking ON venue.venue_id=venue_booking.venue_id

where venue.venue_id not in (Select venue_id from venue_booking where date_booked='$date')
and capacity >=$size
GROUP BY venue.venue_id";

if($result=mysqli_query($con,$query)){
if(mysqli_num_rows($result)>0){
echo "<table border='1'>";
echo "<tr>";
echo "<th>venue_id</td>";
echo "<th>name</td>";
if(isweekend($date)){
echo "<th>cost per day</th>";
}
else{
echo "<th>cost per day</th>";
}


echo "</tr>";
while($row=mysqli_fetch_array($result)){
echo "<tr>";
echo "<td>".$row['venue_id']."</td>";
echo "<td>".$row['name']."</td>";
if(isweekend($date)){
echo "<td>".$row['weekend_price']."</td>";
}
else{
echo "<td>".$row['weekday_price']."</td>";
}

echo "</tr>";
}
echo "</table>";
mysqli_free_result($result);
}else {
echo "No records matching your query were found. ";
}
}else {
echo "Error: Could not execute $query.".mysqli_error($con);
}
mysqli_close($con);
?>





</body>
</html>