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
<?php
$con=mysqli_connect("","coa123wuser","grt64dkh","coa123wdb") ;
$minCapacity=$_GET['minCapacity'];
$maxCapacity=$_GET['maxCapacity'];
$query="SELECT name, weekend_price,weekday_price FROM venue where licensed = 1 and capacity >= $minCapacity and capacity <= $maxCapacity";

if($result=mysqli_query($con,$query)){
if(mysqli_num_rows($result)>0){
echo "<table border='1'>";
echo "<tr>";

echo "<th>name</td>";
echo "<th>weekend_price</th>";
echo "<th>weekday_price</th>";

echo "</tr>";
while($row=mysqli_fetch_array($result)){
echo "<tr>";

echo "<td>".$row['name']."</td>";
echo "<td>".$row['weekend_price']."</td>";
echo "<td>".$row['weekday_price']."</td>";
;
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