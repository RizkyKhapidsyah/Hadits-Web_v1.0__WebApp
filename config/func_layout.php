<?php

function pager($total_rows,$totpage,$page,$url)
{      
		
        if (empty($totpage))
		    $totpage=10;
		if (empty($url))
		   $url = "./?url=$_GET[url]";
		      
		$PAGE_DEFAULT = 1;
		$PAGESIZE_DEFAULT = $totpage;
		$PAGESIZE_LOWER_LIMIT = 5;
		$PAGESIZE_UPPER_LIMIT = 100;
		
		 
		if (!isset($page)) $page = $PAGE_DEFAULT;
		if ($page < 1 && $page != -1) $page = 1;
		if (!isset($pagesize)) $pagesize = $PAGESIZE_DEFAULT;
		
		if ($pagesize < $PAGESIZE_LOWER_LIMIT)
			 $pagesize = $PAGESIZE_LOWER_LIMIT;
		if ($pagesize > $PAGESIZE_UPPER_LIMIT)
			  $pagesize = $PAGESIZE_UPPER_LIMIT;
		 
		if ($page == -1) 
		{
		  $count = $pagesize;
		  $offset = $total_rows - $pagesize;
		} else {
		  $count = $pagesize;
		  $offset = ($page-1) * $pagesize;
		  //echo $offset;
		}
		
		// buat bar navigasi prev, next, first, last, pages...
		$last_page      = ceil($total_rows/$pagesize);  // hlm terakhir = jml hlm
		
		$adjacent_pages_links = ($page > 6 ? "..." : "");
		for ($i=$page-5; $i<$page; $i++) {
		  if ($i < 1) continue;
		  $adjacent_pages_links .= " ".
			"<a href='$url&page=$i' class='teks_link'>$i</a>";
		}
		$adjacent_pages_links .= " <b>$page</b>";
		for ($i=$page+1; $i<($page+6); $i++) {
		  if ($i > $last_page) break;
		  $adjacent_pages_links .= " ".
			"<a href=$url&page=$i class='teks_link'>$i</a>";
		}
		$adjacent_pages_links .= ($page+5 < $last_page ? " ..." : "");
					
					
					$i = $offset+1;
					if($total_rows > 0)
					{
			$navigasi = "<table  border=0 wnegarath=100% class=teksisi><tr>" .
			"<td>&nbsp;</td>".
			 // link ke halaman pertama (jika bukan di halaman pertama)
			"<td>".($page == 1 ? "First" :"<a href=$url&page=1 class='teks_link'>First</a>")."</td>".
		
			// link ke halaman sebelumnya (jika bukan di halaman pertama)
			"<td>".($page == 1 ? "Prev" :"<a href=$url&page=".($page-1)." class='teks_link'>Prev</a>")."</td>".
		
			// link 5 halaman ke belakang dan 5 halaman ke depan
			"<td align=mnegaradle wnegarath=100% >$adjacent_pages_links</td>".
		
			// link ke halaman sebelumnya (jika bukan di halaman terakhir)
			"<td align=right>".($page == $last_page ? "Next" :"<a href=$url&page=".($page+1)." class='teks_link'>Next</a>")."</td>".
		
			// link ke halaman terakhir (jika bukan di halaman terakhir)
			"<td align=right>".($page == $last_page ? "Last" :"<a href=$url&page=$last_page class='teks_link'>Last</a>")."</td>".
		
			"</tr></table>";
			$sqlpro= "LIMIT ".$count." OFFSET ".$offset."";
			//echo $sqlpro;
			}
	return array($sqlpro,$navigasi,$last_page,$offset);
}
function paging($total_rows,$page,$modul)
{

		$PAGE_DEFAULT = 1;
		$PAGESIZE_DEFAULT = 10;
		$PAGESIZE_LOWER_LIMIT = 10;
		$PAGESIZE_UPPER_LIMIT = 100;
		 
		if (!isset($page)) $page = $PAGE_DEFAULT;
		if ($page < 1 && $page != -1) $page = 1;
		if (!isset($pagesize)) $pagesize = $PAGESIZE_DEFAULT;
		
		if ($pagesize < $PAGESIZE_LOWER_LIMIT)
			 $pagesize = $PAGESIZE_LOWER_LIMIT;
		if ($pagesize > $PAGESIZE_UPPER_LIMIT)
			  $pagesize = $PAGESIZE_UPPER_LIMIT;
		 
		if ($page == -1) 
		{
		  $count = $pagesize;
		  $offset = $total_rows - $pagesize;
		} else {
		  $count = $pagesize;
		  $offset = ($page-1) * $pagesize;
		}
		
		// buat bar navigasi prev, next, first, last, pages...
		$last_page      = ceil($total_rows/$pagesize);  // hlm terakhir = jml hlm
		
		$adjacent_pages_links = ($page > 6 ? "..." : "");
		for ($i=$page-5; $i<$page; $i++) {
		  if ($i < 1) continue;
		  $adjacent_pages_links .= " ".
			"<a href='$modul&modul=$_GET[modul]&namekey=$_GET[namekey]&valkey=$_GET[valkey]&page=$i' class='teks_link'>$i</a>";
		}
		$adjacent_pages_links .= " <b>$page</b>";
		for ($i=$page+1; $i<($page+6); $i++) {
		  if ($i > $last_page) break;
		  $adjacent_pages_links .= " ".
			"<a href=$modul&modul=$_GET[modul]&namekey=$_GET[namekey]&valkey=$_GET[valkey]&page=$i class='teks_link'>$i</a>";
		}
		$adjacent_pages_links .= ($page+5 < $last_page ? " ..." : "");
					
					
					$i = $offset+1;
					if($total_rows > 0)
					{
			$navigasi = "<table  border=0 wnegarath=100% class=teksisi><tr>" .
		    "<td> Jumlah data : $total_rows </td>".
			"<td>&nbsp;</td>".
			 // link ke halaman pertama (jika bukan di halaman pertama)
			"<td>".($page == 1 ? "First" :"<a href=$modul&modul=$_GET[modul]&namekey=$_GET[namekey]&valkey=$_GET[valkey]&page=1 class='teks_link'>First</a>")."</td>".
		
			// link ke halaman sebelumnya (jika bukan di halaman pertama)
			"<td>".($page == 1 ? "Prev" :"<a href=$modul&modul=$_GET[modul]&namekey=$_GET[namekey]&valkey=$_GET[valkey]&page=".($page-1)." class='teks_link'>Prev</a>")."</td>".
		
			// link 5 halaman ke belakang dan 5 halaman ke depan
			"<td align=mnegaradle wnegarath=100% >$adjacent_pages_links</td>".
		
			// link ke halaman sebelumnya (jika bukan di halaman terakhir)
			"<td align=right>".($page == $last_page ? "Next" :"<a href=$modul&modul=$_GET[modul]&namekey=$_GET[namekey]&valkey=$_GET[valkey]&page=".($page+1)." class='teks_link'>Next</a>")."</td>".
		
			// link ke halaman terakhir (jika bukan di halaman terakhir)
			"<td align=right>".($page == $last_page ? "Last" :"<a href=$modul&modul=$_GET[modul]&namekey=$_GET[namekey]&valkey=$_GET[valkey]&page=$last_page class='teks_link'>Last</a>")."</td>".
		
			"</tr></table>";
			$sqlpro= "LIMIT ".$offset.",".$count."";
			}
	return array($sqlpro,$navigasi,$last_page );
}




?>

