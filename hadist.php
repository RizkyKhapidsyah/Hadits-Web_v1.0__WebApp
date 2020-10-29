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
		
		$tableName="tb_hadist";		
		$targetpage = "hadist.php?type=".$_GET[type] ; 	
		$limit = 5;
		
		
		
		$stages = 3;
		
		$page = mysql_escape_string($_GET['page']);
		if($page){
			$start = ($page - 1) * $limit; 
		}else{
			$start = 0;	
		}
	
		$query = "SELECT * FROM tb_hadist where id= '$_GET[type]'  ";
		$query1 = "SELECT * FROM tb_hadist where id= '$_GET[type]'  ";
		$querys = "SELECT COUNT(*) as num FROM tb_hadist where id= '$_GET[type]' ";
			
		if (isset($_POST[Cari]) and $_POST[no_hadist] != "")
		{
			$query_param = " and $_POST[berdasarkan] like '%$_POST[no_hadist]%' ";
			$start = 0;	
		}
		$query  = $query.$query_param;
		$query1 = $query1.$query_param." order by number asc LIMIT $start, $limit";
		$querys = $querys.$query_param;
		
	
		
		$total_pages = mysql_fetch_array(mysql_query($querys));
		$total_pages = $total_pages[num];	
		//echo $query;
		//echo $query1;
		
		$restitle=mysql_query($query); 
		$rowt = mysql_fetch_array($restitle); 
		
					   
						
		$query=$query.$query_param." order by number asc  " . " LIMIT $start, $limit ";
					
		
					
		//$result = mysql_query($query);
		
		$res = mysql_query("SELECT * FROM tb_ikhtisar ");
		$rw = mysql_fetch_array($res);
		
	
		
	
    // Get page data
	
	$result = mysql_query($query1);
	
	//
	
	
	// Initial page num setup
	if ($page == 0){$page = 1;}
	$prev = $page - 1;	
	$next = $page + 1;							
	$lastpage = ceil($total_pages/$limit);		
	$LastPagem1 = $lastpage - 1;					
	
	
	$paginate = '';
	if($lastpage > 1)
	{	
	

	
	
		$paginate .= "<div class='paginate'>";
		// Previous
		if ($page > 1){
			$paginate.= "<a href='$targetpage&page=$prev'>Previous</a>";
		}else{
			$paginate.= "<span class='disabled'>Previous</span>";	}
			

		
		// Pages	
		if ($lastpage < 7 + ($stages * 2))	// Not enough pages to breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page){
					$paginate.= "<span class='current'>$counter</span>";
				}else{
					$paginate.= "<a href='$targetpage&page=$counter'>$counter</a>";}					
			}
		}
		elseif($lastpage > 5 + ($stages * 2))	// Enough pages to hide a few?
		{
			// Beginning only hide later pages
			if($page < 1 + ($stages * 2))		
			{
				for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)
				{
					if ($counter == $page){
						$paginate.= "<span class='current'>$counter</span>";
					}else{
						$paginate.= "<a href='$targetpage&page=$counter'>$counter</a>";}					
				}
				$paginate.= "...";
				$paginate.= "<a href='$targetpage&page=$LastPagem1'>$LastPagem1</a>";
				$paginate.= "<a href='$targetpage&page=$lastpage'>$lastpage</a>";		
			}
			// Middle hide some front and some back
			elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))
			{
				$paginate.= "<a href='$targetpage&page=1'>1</a>";
				$paginate.= "<a href='$targetpage&page=2'>2</a>";
				$paginate.= "...";
				for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)
				{
					if ($counter == $page){
						$paginate.= "<span class='current'>$counter</span>";
					}else{
						$paginate.= "<a href='$targetpage&page=$counter'>$counter</a>";}					
				}
				$paginate.= "...";
				$paginate.= "<a href='$targetpage&page=$LastPagem1'>$LastPagem1</a>";
				$paginate.= "<a href='$targetpage&page=$lastpage'>$lastpage</a>";		
			}
			// End only hide early pages
			else
			{
				$paginate.= "<a href='$targetpage&page=1'>1</a>";
				$paginate.= "<a href='$targetpage&page=2'>2</a>";
				$paginate.= "...";
				for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page){
						$paginate.= "<span class='current'>$counter</span>";
					}else{
						$paginate.= "<a href='$targetpage&page=$counter'>$counter</a>";}					
				}
			}
		}
					
				// Next
		if ($page < $counter - 1){ 
			$paginate.= "<a href='$targetpage&page=$next'>Next</a>";
		}else{
			$paginate.= "<span class='disabled'>Next</span>";
			}
			
		$paginate.= "</div>";		
	
	
}	

?>
<html>
	<head>    
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0; charset=utf-8;" />      
        <title>Hadist App</title>        
        <link rel="stylesheet" type="text/css" href="styles.css" />
        <link rel="stylesheet" type="text/css" href="todolist.css">
    </head>
 <body onLoad="window.scrollTo(0, 1);">
		  <section id="page">
            <header>
                <hgroup>
                             
                <form id="taskentry"  name="form1" action="<?=$PHP_SELF?>" method="post">                
                    <table width="100%" border="0">
                      <tr>
                        <td width="12%"><ul><select name="berdasarkan" class="search">
                        <option value="">.:Pilih:.</option>
                            <option value="number">No. Hadist</option>
                            <option value="meaning">Arti</option>        
                         </select>
                        </ul>
                        </td>
                        <td width="88%"><input name="no_hadist" type="text" class="search" id="no_hadist" placeholder="No Hadist"/>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2"><input type="submit" name="Cari" value="Cari" class="search"/></td>
                      </tr>
                    </table>
               
                </form>              
                                 
                <table  width="100%" border="0">
                  <tr>                    
                    <td width="1%">
                        <a href="./" > <img src="img/home.png" alt="home" width="75" height="75"></a>                   
                    </td> 
                  <td>
                  <h2 align="center" class="style3"><span class="style5">
					    <?php echo $rowt['hadist'];?></span></h2>
                        <span class="bab">
                        <h4 align="center">
						<?php echo  $rw['bis'];?></h4>
                        </span>
                  </td>
                  </tr>
                </table>
                
                <span class="bab"><h4 align="center"><?php echo  $rw['muqodimah'];?></h4></span>
                </hgroup>
            </header>
            
          
				<!-- Article 1 start -->
                <div id="hadisdiv"> <!-- The new article tag. The id is supplied so it can be scrolled into view. -->
                  
                    
                      <table width="100%" border="0">
                      <tr>
                        <td width="2%"  align="center"><h3 align="center" class="style3"> <span class="style5">No</span></h3></td>
                        <td width="43%" align="center"><h3 align="center" class="style3"> <span class="style5">Arti</span></h3></td>
                        <td></td>
                        <td width="45%" align="center"><h3 align="center" class="style3"> <span class="style5">Hadist</span></h3></td>
                      </tr>                      
                      <?php		
								
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
                        <tr>
                        <td colspan="4" align="center"><?php  echo $total_pages.' Results'; echo $paginate; ?>&nbsp;</td>
                       </tr> 
                    </table>
                   
                  </div>
                </article>
            </section>            
           
            
              <footer> 
               	
              </footer>
		
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
	font-size: 23px;
	font-style: normal;
	line-height: normal;
	font-weight: normal;
	font-variant: normal;
	text-align:justify;
	white-space: normal;
	width: 100%;	
	line-height:120%;}	
-->
.paginate {
font-family:Arial, Helvetica, sans-serif;
	padding: 3px;
	margin: 3px;
}

.paginate a {
	padding:2px 5px 2px 5px;
	margin:2px;
	border:1px solid #999;
	text-decoration:none;
	color: #666;
}
.paginate a:hover, .paginate a:active {
	border: 1px solid #999;
	color: #000;
}
.paginate span.current {
    margin: 2px;
	padding: 2px 5px 2px 5px;
		border: 1px solid #999;
		
		font-weight: bold;
		background-color: #999;
		color: #FFF;
	}
	.paginate span.disabled {
		padding:2px 5px 2px 5px;
		margin:2px;
		border:1px solid #eee;
		color:#DDD;
	}
	
	li{
		padding:4px;
		margin-bottom:3px;
		background-color:#FCC;
		list-style:none;}
		
	ul{margin:6px;
	padding:0px;}
</style>
<?php
mysql_close($con);
?>