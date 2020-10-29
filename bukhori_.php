<head>
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0; charset=utf-8;" />
<title>Hadist Apps</title>
<link rel="stylesheet" type="text/css" href="todolist.css">
<link media="only screen and (max-device-width: 480px)" href="smallscreen.css" type="text/css" rel="stylesheet" />
<link media="only screen and (min-device-width: 481px)" href="largescreen.css" type="text/css" rel="stylesheet" />
<style type="text/css">
<!--
.style5 {
	color: #0000FF;
	font-size: 36px;
}
.style7 {font-size: 36px}
-->
</style>
</head>

<body onLoad="window.scrollTo(0, 1);">
<?php

if($_GET[hal]=="1")
{
	$page = 1;
 	$pre = 1;
 	$next= $page+ 1;
}
else
{
 	$page = $_GET[hal];
    $pre = $page - 1;
 	$next= $page+ 1;
}

$con = mysql_connect("localhost","root","nadipw");
mysql_set_charset('utf8',$con);
mysql_select_db("db_arab", $con);
$result = mysql_query("SELECT * FROM db_hadist where number = $page");
$row = mysql_fetch_array($result);

?>
<br>
<a href="./" > <img src="img/button-home.jpg" alt="home" width="85" height="85"></a>
<span class="style7">Home</span>
<table width="100%" border="0">
  <tr>
    <td><a href="./bukhori.php?hal=<? echo $pre; ?>" ><img src="img/previous.png" alt="pre" width="85" height="85"></a></td>
    <td><h1 align="center" class="style3"><span class="style5"><?php echo  $row['hadist'];?></span></h1><span class="bab"><h4 align="center"><?php echo  $row['kitab'];?></h4></span>&nbsp;</td>
    <td><div align="right"><a href="./bukhori.php?hal=<? echo $next; ?>" ><img src="img/Next.png" width="85" height="85"></a></div></td>
  </tr>
</table>
<span class="bab"><h4 align="center"><?php echo  $row['bab'];?></h4></span>
<div dir="rtl" align="right"><strong> <span class="hadist"> <?php echo  $row['content']  ?></span></strong></div> 
<br>
<span class="meaning" >Artinya :</span>
<br> 
<br>

<div align="justify"> <span class="meaning" > <?php echo '"' . $row['meaning'] . '"'  ?> </span></div> 
<?php
mysql_close($con);
?>

</body>
</html>