
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
<h1 class="center">Task 2 - Details (details.php)</h1>
<?php
$con=mysqli_connect("","coa123wuser","grt64dkh","coa123wdb") ;
$venueId=$_GET['venueId'];
$query="SELECT * FROM venue where venue_id = $venueId";

if($result=mysqli_query($con,$query)){
if(mysqli_num_rows($result)>0){
echo "<table border='1'>";
echo "<tr>";
echo "<th>venue_id</th>";
echo "<th>name</td>";
echo "<th>capacity</th>";
echo "<th>weekend_price</th>";
echo "<th>weekday_price</th>";
echo "<th>licensed</th>";
echo "</tr>";
while($row=mysqli_fetch_array($result)){
echo "<tr>";
echo "<td>".$row[0]."</td>";
echo "<td>".$row[1]."</td>";
echo "<td>".$row[2]."</td>";
echo "<td>".$row['weekend_price']."</td>";
echo "<td>".$row['weekday_price']."</td>";
echo "<td>".$row['licensed']."</td>";
echo "</tr>";
}
echo "</table>";
mysqli_free_result($result);
}else {
echo "No records matching your query were found. ";
}
}else {
echo "Error: Could not execute $sql.".mysqli_error($con);
}
mysqli_close($con);
?>





</body>
</html>