<?php
header('Content-type: text/html; charset=utf-8');

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
		
		$con = mysql_connect("localhost","root","");
		mysql_set_charset('utf8',$con);
		mysql_select_db("db_arab", $con);
		$result = mysql_query("SELECT * FROM tb_hadist where number = $page and id = $_GET[type]");
		$row = mysql_fetch_array($result);


?>
<html>
	<head>
    
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0; charset=utf-8;" />      
        <title>Hadist App</title>        
        <link rel="stylesheet" type="text/css" href="styles.css" />
        <link rel="stylesheet" type="text/css" href="todolist.css">       
        
    </head>
 <body onLoad="window.scrollTo(0, 1);">
		 <section id="page"> <!-- Defining the #page section with the section tag -->
    
            <header> <!-- Defining the header section of the page with the appropriate tag -->
            
                <hgroup>
                <a href="./" > <img src="img/home.png" alt="home" width="75" height="75"></a>
                <a href="./hadist.php?type=<?php echo $_GET[type]; ?>"> <img src="img/back.png" alt="home" width="75" height="75"></a>
                    <table  width="100%" border="0">
                  <tr>
                    <td><a href="./detail_hadist.php?type=<?php echo $_GET[type]; ?>&hal=<? echo $pre; ?>" ><img src="img/previous.png" alt="pre" width="50" height="50"></a></td>
                    <td><h1 align="center" class="style3"><span class="style5"><?php echo  $row['hadist'];?></span></h1><span class="bab"><h4 align="center"><?php echo  $row['kitab'];?></h4></span>&nbsp;</td>
                    <td><div align="right"><a href="./detail_hadist.php?type=<?php echo $_GET[type]; ?>&hal=<? echo $next; ?>" ><img src="img/Next.png" width="50" height="50"></a></div></td>
                  </tr>
                </table>
                <span class="bab"><h4 align="center"><?php echo  $row['bab'];?></h4></span>
                </hgroup>
            </header>
              
                    <div class="line"></div>
                    <div class="articleBody clear">
                      <div dir="rtl" align="justify">
                        <div align="right"><strong> <span class="style1"><?php echo  $row['content']  ?></span></strong></div>
                      </div> 
                      <br>
                      <div class="line"></div> 
                      <span class="meaning" >Artinya :</span>
					  <div align="justify"> <span class="meaning" > <?php echo '"' . $row['meaning'] . '"'  ?> </span></div>                   
                    </div>

     <footer> <!-- Marking the footer section -->

           <div class="line"></div>
           
          
         <!-- Change the copyright notice -->
     </footer>
		</section> <!-- Closing the #page section -->
        
  </body>
</html>       
<style type="text/css">
<!--
.style1 {color:#CCCC00;
	padding:2px 4px;
	display:block;
	font-family: "Scheherazade";
	src: url(ScheherazadeRegOT.ttf);
	font-size: 45px;
	font-style: normal;
	line-height: normal;
	font-weight: normal;
	font-variant: normal;
	text-align:justify;
	white-space: normal;
	width: 100%;	
	line-height:120%;}
-->
</style>
<?php
mysql_close($con);
?>