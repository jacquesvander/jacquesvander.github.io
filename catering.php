<!DOCTYPE html >
<html xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

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
<title>Task 1</title>
</head>

<body>
<h3 class="center">COA123 - Server-Side Programming</h3>
<h2 class="center">Individual Coursework - Wedding Planner</h2>
<h1 class="center">Task 1 - Catering (catering.php)</h1>

<br/>

<table border="1">

<?php 
if(isset($_GET['submit'])) {
	$min=$_GET['min'];
	$max=$_GET['max'];
	$c1=$_GET['c1'];
	$c2=$_GET['c2'];
	$c3=$_GET['c3'];
	$c4=$_GET['c4'];
	$c5=$_GET['c5'];




if(is_numeric($max) && is_numeric($max) && is_numeric($c1) && is_numeric($c2) && is_numeric($c3) && is_numeric($c4) && is_numeric($c5)){


$cs=array($c1,$c2,$c3,$c4,$c5);
$array=[];

for($n=0;$min<=$max;$n++){
$array[$n]=$min;
$min=$min+5;
}

$rows=sizeof($array);
$cols=sizeof($cs);

echo '<th style="width: 100px">→ Cost per Person →<br />↓ Party size ↓</th>';

for($d=0;$d<$cols;$d++){
echo "<td class='cell1' >".$cs[$d]."</td>";
}

for($o=0;$o<$rows;$o++){

for($j=0;$j<=$cols;$j++){
if($j==0){
echo '<tr>';
echo '<td class="cell1">'.$array[$o].'</td>';

}
else{
echo '<td class="cell2">'.$array[$o]*$cs[$j-1].'</td>';
}
		
		
	}
	
	
	
	
}

}else echo "Sorry, one of your values is not valid. Please ensure they are all numbers.";

}
?>
</table>

<br />

