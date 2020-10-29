<?php

function paging($total_rows,$url,$sub,$page)
{

		$PAGE_DEFAULT = 1;
		$PAGESIZE_DEFAULT = 20;
		$PAGESIZE_LOWER_LIMIT = 20;
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
			"<a href='$PHP_SELF?url=$url&sub=$sub&page=$i' class='teks_link'>$i</a>";
		}
		$adjacent_pages_links .= " <b>$page</b>";
		for ($i=$page+1; $i<($page+6); $i++) {
		  if ($i > $last_page) break;
		  $adjacent_pages_links .= " ".
			"<a href=$PHP_SELF?url=$url&sub=$sub&page=$i class='teks_link'>$i</a>";
		}
		$adjacent_pages_links .= ($page+5 < $last_page ? " ..." : "");
					
					
					$i = $offset+1;
					if($total_rows > 0)
					{
			$navigasi = "<table  border=0 wnegarath=100% class=teksisi><tr>" .
		
			 // link ke halaman pertama (jika bukan di halaman pertama)
			"<td>".($page == 1 ? "First" :"<a href=$PHP_SELF?url=$url&sub=$sub&page=1 class='teks_link'>First</a>")."</td>".
		
			// link ke halaman sebelumnya (jika bukan di halaman pertama)
			"<td>".($page == 1 ? "Prev" :"<a href=$PHP_SELF?url=$url&sub=$sub&page=".($page-1)." class='teks_link'>Prev</a>")."</td>".
		
			// link 5 halaman ke belakang dan 5 halaman ke depan
			"<td align=mnegaradle wnegarath=100% >$adjacent_pages_links</td>".
		
			// link ke halaman sebelumnya (jika bukan di halaman terakhir)
			"<td align=right>".($page == $last_page ? "Next" :"<a href=$PHP_SELF?url=$url&sub=$sub&page=".($page+1)." class='teks_link'>Next</a>")."</td>".
		
			// link ke halaman terakhir (jika bukan di halaman terakhir)
			"<td align=right>".($page == $last_page ? "Last" :"<a href=$PHP_SELF?url=$url&sub=$sub&page=$last_page class='teks_link'>Last</a>")."</td>".
		
			"</tr></table>";
			$sqlpro= "LIMIT ".$offset.",".$count."";
			}
	return array($sqlpro,$navigasi);
}

function combo($nama, $alokasi, $data) {
	$html = "<select name='".$nama."' class='kotak'>";
	$html .= "	<option value=''></option>";
	foreach ($data as $value => $label){
		if ($alokasi==$value){
			$html .= "<option value='".$value."' selected>".$label."</option>";
		}
		else{
			$html .= "<option value='".$value."'>".$label."</option>";
		}
	}
	$html .= "</select>";
	return $html;
}

function date_indo_englis($tgl)
{
		$value_tahun = substr($tgl,6);
		$value_bulan = substr($tgl,3,-5);
		$value_tanggal = substr($tgl,0,-8);
		
		$tgl_eng="$value_tahun-$value_bulan-$value_tanggal";
	
		return $tgl_eng;
}

function date_englis_indo($tgli)
{
		$value_tahuni = substr($tgli,0,-6);
		$value_bulani = substr($tgli,5,-3);
		$value_tanggali = substr($tgli,8);
		
		$tgl_indo="$value_tanggali-$value_bulani-$value_tahuni";
	
		return $tgl_indo;
}

function date_to_text($tgli)
{
		$value_tahuni = substr($tgli,0,-6);
		$value_bulani = substr($tgli,5,-3);
		$value_tanggali = substr($tgli,8);
		
		switch($value_bulani){
			case 1 : $bulan = "Januari"; break;
			case 2 : $bulan = "Februari"; break;
			case 3 : $bulan = "Maret"; break;
			case 4 : $bulan = "April"; break;
			case 5 : $bulan = "Mei"; break;
			case 6 : $bulan = "Juni"; break;
			case 7 : $bulan = "Juli"; break;
			case 8 : $bulan = "Agustus"; break;
			case 9 : $bulan = "September"; break;
			case 10 : $bulan = "Oktober"; break;
			case 11 : $bulan = "November"; break;
			case 12 : $bulan = "Desember"; break;
		}

		
		$tgl_text="$value_tanggali $bulan $value_tahuni";
		
		return $tgl_text;
}

function OutputText($nama, $alokasi, $data) 
{
	foreach ($data as $value => $label)
	{
		if ($alokasi==$value)
		{
			$html .= "$label";
		}
	}
	return $html;
}


?>