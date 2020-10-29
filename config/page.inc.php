<?php
		class loadPage {
					var $namepage;
					var $titlepage;
					var $typeLogin;
					var $AmbilTabel;
					var $keyword;							
					var $judul;
				function __construct() {
						$this->judul="dada";
					
				}	
				function LoadingPage($namaHalaman) {
							if(empty($namaHalaman)) 
								return include_once 'index.html';						 
							else
								return include $namaHalaman;							
					}									
				function LoadTitle($namaTitle) {
							 $this->titlepage=$namaTitle;
					}
					
				function pageDinamis($Page,$alamatLink) {
							echo $alamatLink ."".$Page."</a>";	
					}
				function AlamatLink($url,$cls) {
						echo "<a href=$url class=$cls>";
					}	
				function BuatTabel($lebar,$Tinggi,$border,$warna,$tebalY,$TebalX,$judul,$style)	 {
						 echo "<table border=".$border." width=".$lebar." height=".$Tinggi." bgcolor=".$warna." class=".$style.">";				
					}
				 function TutupTabel() {
						print "</table>";
					}	
				 function RubahJadiHurupBesar($kalimat) {
						echo strtoupper($kalimat);
					}
				 function RubahHuJadiHurupKecil($kalimat) {
						echo strtolower($kalimat);
					}
				 function HilangkanSless($kalimat) {
							$kwd=htmlspecialchars($kalimat);    
							return stripslashes($kwd);
					}
				 function UpFrist($kalimat)	{
							echo ucfirst($kalimat); 
					}
					
			     function cekAngka($angka) {
						if (is_numeric ($angka)) 
							return true;
							else
							return false; 
					}	
								
		}

		
	

?>