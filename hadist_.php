<?php
header('Content-type: text/html; charset=utf-8');
include 'config/page.inc.php';
include 'config/func_layout.php';


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
		$query="select * from tb_hadist where id= '$_GET[type]' ";
		$restitle=mysql_query($query); 
		$rowt = mysql_fetch_array($restitle); 
		
					if (!empty($_GET[valkey]) and empty($_POST[search]))
					   {
						 $query_param=" and meaning like '%$_GET[valkey]%' ";
					   }
					if (isset($_POST[pencarian]) and !empty($_POST[search]))
						{
						    $query_param=" and meaning like '%$_POST[search]%'";
						}	   
					$query=$query.$query_param." order by number asc  ";
					
					
					$strsql ="select count(*) jml from tb_hadist ".$query_param;					
					$results=mysql_query($strsql); 
					$rowcount = mysql_fetch_array($results);
					$totalData	= $rowcount["jml"];
					
					if (!empty($_POST[search]))
					$paging = pager($totalData,1,"1","./hadist.php?valkey=".$_POST['search']."&type=".$_GET['type'] );
					else
					$paging = pager($totalData,1,$_GET['page'],"./hadist.php?valkey=".$_GET['valkey']."&type=".$_GET['type']);
					
		
		$res = mysql_query("SELECT * FROM tb_ikhtisar ");
		$rw = mysql_fetch_array($res);


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
                    <table  width="100%" border="0">
                  <tr>                    
                    <td><h1 align="center" class="style3"><span class="style5">
					    <?php echo $rowt['hadist'];?></span></h1>
                        <span class="bab">
                        <h4 align="center">
						<?php echo  $rw['bis'];?></h4>
                        </span>&nbsp;                   
                    </td>                    
                  </tr>
                </table>
                <span class="bab"><h4 align="center"><?php echo  $rw['muqodimah'];?></h4></span>
                </hgroup>
            </header>
            
            <section id="articles"> <!-- A new section with the articles -->
				<!-- Article 1 start -->
                <article id="article1"> <!-- The new article tag. The id is supplied so it can be scrolled into view. -->
                    <div class="line"></div>
                    <div class="articleBody clear">
                      <table width="100%" border="0">
                      <tr>
                        <td width="2%"  align="center"><h3 align="center" class="style3"> <span class="style5">No</span></h3></td>
                        <td width="43%" align="center"><h3 align="center" class="style3"> <span class="style5">Arti</span></h3></td>
                        <td></td>
                        <td width="45%" align="center"><h3 align="center" class="style3"> <span class="style5">Hadist</span></h3></td>
                      </tr>
                      
                      <?php			 						
					  			$query= $query.$paging[0];		
								echo $query;	
								$no=$paging[3];
								$result = mysql_query($query);
                                while ($row = mysql_fetch_array($result))
                                {  
                        ?>
                      <tr>  
                        <td align="left" valign="middle"> 
                        <a href="./detail_hadist.php?type=<?php echo $_GET[type]; ?>&hal=<?php echo $row['number'];?>" ><span class="mlist"><?php echo  $row['number'];?>&nbsp;</span></a>
                        </td>
                        
                        <td>
						<div dir="ltr" align="justify">
                            <div align="right"><a href="./detail_hadist.php?type=<?php echo $_GET[type]; ?>&hal=<?php echo $row['number'];?>" >
                            			<span class="mlist">
                                        <?php $kata=strtok($row["meaning"]," ");
                                        for ($i=1;$i<=25;$i++)
                                        {
                                            echo($kata);
                                            echo(" ");
                                            $kata=strtok(" ");
                                        }?>...                                       
                                        </span></a>
                             </div>
                        </div>                     
                        </td>
                        
                        <td>
                        </td>
                        
                        <td>
                        <div dir="rtl" align="justify">
                            <div align="right"><a href="./detail_hadist.php?type=<?php echo $_GET[type]; ?>&hal=<?php echo $row['number'];?>" >
                            			<span class="clist">
                                        <?php $kata=strtok($row["content"]," ");
                                        for ($i=1;$i<=25;$i++)
                                        {
                                            echo($kata);
                                            echo(" ");
                                            $kata=strtok(" ");
                                        }?>...                 
                                        
                                        </span>   
                                        </a>
                              </div>
                        </div>                        
                        </td>
                        </a>
                      </tr>
                      	<?php 
					  		    }
						?> 
                    </table>
                   
                  </div>
                </article>
            </section>
            
           
              <div align="center"><h3 align="center" class="style3"><?php //echo $paging[1]; ?></h3>
                <!-- A new section with the articles -->
              </div>
              <footer> 
                <div align="center">
                  <!-- Marking the footer section -->
                  
                     </div>
                <div class="line"> </div>
            <section id="articles"> 
           <p align="center">Copyright 2011 - Yunus S</p> 
           <div align="center">
             <!-- Change the copyright notice -->
                 </div>
              </footer>
		</section>
 <!-- Closing the #page section -->
        
  </body>
</html>       
<style type="text/css">
<!--
.mlist {color:#ffffff;
	padding:2px 4px;
	display:block;
	font-family: "Scheherazade";
	src: url(ScheherazadeRegOT.ttf);
	font-size: 18px;
	font-style: normal;
	line-height: normal;
	font-weight: normal;
	font-variant: normal;
	text-align:justify;
	white-space: normal;
	width: 100%;	
	line-height:120%;}
.clist {color:#CCCC00;
	padding:2px 4px;
	display:block;
	font-family: "Scheherazade";
	src: url(ScheherazadeRegOT.ttf);
	font-size: 18px;
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