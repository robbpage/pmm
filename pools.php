<div id="popCover">
	<div id="popSwatch">
		<div id="popProd" class="bold white s24"></div>
		<div id="popClose" class="bold white s10">close</div>
	</div>
</div>
<?PHP
# page title
$title = "Pool Finishes by Premix Marbletite - Deck Finishes - Stucco - Plaster - Roof Tile Mortars";
# header
include_once('header.php');
# database
include_once('inc/dbc.php');
?>

<div id="contentShell">

<?PHP
if(isset($_GET['series'])){
	# get the series name from the url
	$catID = $_GET['id'];
	$catNAME = $_GET['series'];
	$catMSDS = "MSDS_$catNAME.pdf";
	$catPDS  = "PDS_$catNAME.pdf";
	$catHEAD = "img/header_$catNAME.jpg";
	$MSDS = "";
	$PDS = "";
	//$MSDS_File = find_file("MSDS","",$catNAME,"");
	//$PDS_File  = find_file("PDS","",$catNAME,"");
	$MSDS_File = find_file("MSDS","",$catNAME);
	$PDS_File  = find_file("PDS","",$catNAME);
	if ($MSDS_File != "0") {
		$MSDS = "<div class='button poolButton go button$catID' data-link='$MSDS_File'>MSDS</div>";
	}
	if ($PDS_File != "0") {
		$PDS = "<div class='button poolButton go button$catID' data-link='$PDS_File'>Product Sheet</div>";
	}
	
	echo "
	<div id='content'>
		<div id='seriesHeader' style='background-image: url(img/$catNAME-blank.jpg);'>
			<div id='poolButtonsSeries'>
				$PDS
				$MSDS
			</div>
		</div>
		<div id='poolHeaderWhite' class='s18 bold blue'>These finishes come in 80lb. bags and there are 42 bags on each pallet</div>";
	# get the products for the selected series
	$count = 1;
	$prodR = $dbc->query("SELECT p.* FROM products p LEFT JOIN prodcats c ON p.prodID = c.cPROD WHERE prodSTAT = 1 AND c.cCAT = $catID");
	while($prodA = $prodR->fetch_array(MYSQLI_ASSOC)){
		$prodID    = $prodA['prodID'];
		$prodNUM   = $prodA['prodNUM'];
		$prodCOLOR = $prodA['prodCOLOR'];
		# product images
		if(is_file("img/sm/$prodNUM.jpg")){
			$prodIMGsm = "img/sm/$prodNUM.jpg";
			$swatchIT  = $prodNUM;
		} else {
			$prodIMGsm = "img/sm/no-image.jpg";
			$swatchIT  = "";
		}
		// row count & reset
		if($count == 4){
			$margin = "margin-right: 0;";
			$count = 1;
		} else {
			$margin = "";
			$count++;
		}
		echo "
		<div class='swatchBOX' style='$margin' data-num='$prodNUM' data-col='$prodCOLOR'>
			<div id='swatchIMG' class='$prodNUM'><img src='$prodIMGsm' /></div>
			<div id='swatchTXT' class='bold s20'><span class='s12 gray'>#$prodNUM</span><br />$prodCOLOR</div>
		</div>";
	}
	echo "
		<div style='clear: both;'></div>
	</div>";
} else {
?>

	<div id="poolsHeader"></div>
	<?PHP # get the pool main categories
	$count = 1;
    $catR = $dbc->query("SELECT * FROM categories WHERE catPAR = 1 AND catSTAT = 1 ORDER BY catSORT ASC");
    while($catA = $catR->fetch_array(MYSQLI_ASSOC)){
        $catNAME = $catA['catNAME'];
        $catDESC = $catA['catDESC'];
        $catID  = $catA['catID'];
		$link   = str_replace(" ","",$catNAME);
		if($count != 1){
			echo "
		<div id='divider'></div>";
		}
        echo "
		<div class='poolMains s16 grayD' data-link='$link' style='margin-top: -20px;'><span class='s24 blue it bold'>$catNAME</span><br />$catDESC</div>";
		#                 #
		#  pool finishes  #
		#                 #
		if($catID == 8){
			echo "
			<div id='$link' class='poolSubs'>";
			# get the pool sub categories
			$subR = $dbc->query("SELECT * FROM categories WHERE catPAR = $catID AND catSTAT = 1 ORDER BY catSORT ASC");
			while($subA = $subR->fetch_array(MYSQLI_ASSOC)){
				$subID   = $subA['catID'];
				$subNAME = $subA['catNAME'];
				$subDESC = $subA['catDESC'];
				$subPAR  = $subA['catPAR'];
				$subLINK = strtolower(str_replace(" ","-",$subNAME));
				$MSDS = "";
				$PDS = "";
				//$MSDS_File = find_file("MSDS","",$catNAME,"");
				//$PDS_File  = find_file("PDS","",$catNAME,"");
				$MSDS_File = find_file("MSDS","",$subLINK);
				$PDS_File  = find_file("PDS","",$subLINK);
				if ($MSDS_File != "0") {
					$MSDS = "<div class='button poolButton go button$subID' data-link='$MSDS_File'>MSDS</div>";
				}
				if ($PDS_File != "0") {
					$PDS = "<div class='button poolButton go button$subID' data-link='$PDS_File'>Product Sheet</div>";
				}
				echo "
				<div id='$subLINK' class='poolSeries' style='background-image: url(img/$subLINK.jpg);'>
					<div id='poolButtons'>
						<div class='button poolButton go button$subID' data-link='pools.php?id=$subID&series=$subLINK'>Color Options</div>
						$PDS
						$MSDS
					</div>
				</div>";
			}
			echo"
			</div>";
			$count++;
		}
		#                      #
		#  base mix solutions  #
		#                      #
		if($catID == 9){
			echo "
			<div id='$link' class='poolSubs'>
				<div id='poolHeaderWhite' class='s18 bold poolExtras'>Step 1: <span class='it blue'>Choose a Base Mix</span></div>";
			# get the base mixes
			$subR = $dbc->query("SELECT p.* FROM products p LEFT JOIN prodcats c ON p.prodID = c.cPROD WHERE prodSTAT = 1 AND c.cCAT = 32");
			while($subA = $subR->fetch_array(MYSQLI_ASSOC)){
				$prodNUM    = $subA['prodNUM'];
				$prodNAME   = $subA['prodNAME'];
				$prodDESC   = $subA['prodDESC'];
				$prodCOLOR  = $subA['prodCOLOR'];
				$prodWEIGHT = $subA['prodWEIGHT'];
				$prodPALLET = $subA['prodPALLET'];
				$divID      = strtolower(str_replace(" ","",$prodNAME));
				$MSDS = "";
				$PDS = "";
				$MSDS_File = find_file("MSDS", $prodNUM,$prodNAME);
				$PDS_File  = find_file("PDS", $prodNUM,$prodNAME);
				
				
				if ($MSDS_File != "0") {
					$MSDS = "<div id=\"fileList\" class=\"blue clear\" onclick=\"location.href='$MSDS_File'\">
								&bull; MSDS
							</div>";
				}
				if ($PDS_File != "0") {
					$PDS = "<div id=\"fileList\" class=\"blue\" onclick=\"location.href='$PDS_File'\">
								&bull; Product Sheet
							</div>";
				}
				
				echo "
				<div id='$divID' class='baseMixBags'>
					<div id='baseBAG'><img src='img/img-$prodNUM.jpg' /></div>
					<div id='baseINFO' class='s12'>
						<span class='s10 bold'>#$prodNUM</span><br />
						<span class='s18 bold it'>$prodNAME</span><br />
						<span class='grayD'>$prodDESC<br />$prodCOLOR<br />$prodWEIGHT - $prodPALLET/pallet</span>
						<div>
						$MSDS $PDS
						</div>
					</div>
				</div>";
			}
			echo "
				<div style='clear: both; margin-bottom: 40px;'></div>
				<div id='poolHeaderWhite' class='s18 bold poolExtras'>Step 2: <span class='it blue'>Choose a Color and/or Quartz Accent</span></div>";
			# get the color powder bags
			echo "
				<div id='powderbagShell'>
					<div id='powderHead'></div>";
			$subR = $dbc->query("SELECT p.* FROM products p LEFT JOIN prodcats c ON p.prodID = c.cPROD WHERE prodSTAT = 1 AND c.cCAT = 34");
			while($subA = $subR->fetch_array(MYSQLI_ASSOC)){
				$prodNUM    = $subA['prodNUM'];
				$prodHEX   = $subA['prodDESC'];
				$prodCOLOR  = $subA['prodCOLOR'];
				$divID      = strtolower(str_replace(" ","",$prodNAME));
				echo "
					<div id='powderColors' style='background: #$prodHEX' class='white bold'><span class='s10'>#$prodNUM</span> $prodCOLOR</div>";
			}
			// color disclaimer for powders
			echo "
					<div id='powderColorsDisc' class='bold s10'>Actual color may vary.<br />See your dealer before ordering.</div>
				</div>";
			# get the quartz/pebbles
			echo "
				<div id='quartzShell'>
					<div id='quartzHead'></div>";
			//                                   |                                                                                          |
			//                                   |  this isn't perfect but it works for now.  get products based on predetermined colors    |
			//                                   |  if they ever add new quartz/pebbles to this list this will need to be manually updated  |
			//                                   |                                                                                          |
			// black quartz
			echo "
				<div id='quartzBOX' class='quartzBlack'>
					<div id='quartzINFO' class='bold'>";
			$subR = $dbc->query("SELECT p.* FROM products p LEFT JOIN prodcats c ON p.prodID = c.cPROD WHERE prodSTAT = 1 AND c.cCAT = 33 AND prodCOLOR = 'Black'");
			while($subA = $subR->fetch_array(MYSQLI_ASSOC)){
				$prodNUM  = $subA['prodNUM'];
				$prodNAME = $subA['prodNAME'];
				echo "
					<span class='s10' style='padding-top: 20px'>#$prodNUM</span> $prodNAME<br />";
			}
			echo "
					</div>
				</div>";
			// blue quartz
			echo "
				<div id='quartzBOX' class='quartzBlue'>
					<div id='quartzINFO' class='bold'>";
			$subR = $dbc->query("SELECT p.* FROM products p LEFT JOIN prodcats c ON p.prodID = c.cPROD WHERE prodSTAT = 1 AND c.cCAT = 33 AND prodCOLOR = 'Blue'");
			while($subA = $subR->fetch_array(MYSQLI_ASSOC)){
				$prodNUM  = $subA['prodNUM'];
				$prodNAME = $subA['prodNAME'];
				echo "
					<span class='s10' style='padding-top: 20px'>#$prodNUM</span> $prodNAME<br />";
			}
			echo "
					</div>
				</div>";
			// teal quartz
			echo "
				<div id='quartzBOX' class='quartzTeal'>
					<div id='quartzINFO' class='bold'>";
			$subR = $dbc->query("SELECT p.* FROM products p LEFT JOIN prodcats c ON p.prodID = c.cPROD WHERE prodSTAT = 1 AND c.cCAT = 33 AND prodCOLOR = 'Teal'");
			while($subA = $subR->fetch_array(MYSQLI_ASSOC)){
				$prodNUM  = $subA['prodNUM'];
				$prodNAME = $subA['prodNAME'];
				echo "
					<span class='s10' style='padding-top: 20px'>#$prodNUM</span> $prodNAME<br />";
			}
			echo "
					</div>
				</div>";
			// gold pebbles
			echo "
				<div id='quartzBOX' class='pebbleGold'>
					<div id='quartzINFO' class='bold'>";
			$subR = $dbc->query("SELECT p.* FROM products p LEFT JOIN prodcats c ON p.prodID = c.cPROD WHERE prodSTAT = 1 AND c.cCAT = 33 AND prodCOLOR = 'Gold'");
			while($subA = $subR->fetch_array(MYSQLI_ASSOC)){
				$prodNUM  = $subA['prodNUM'];
				$prodNAME = $subA['prodNAME'];
				echo "
					<span class='s10' style='padding-top: 20px'>#$prodNUM</span> $prodNAME<br />";
			}
			echo "
					</div>
				</div>";
				
				
			echo "
				</div>
				<div style='clear: both;'></div>
			</div>";
		}
		#                  #
		#  bonding agents  #
		#                  #
		if($catID == 10){
			echo "
			<div id='$link' class='poolSubs'>
				<div id='bondingAgentsHeader'>
					<div id='bondtiteShell'>";
			// get the bond tite info
			$subR = $dbc->query("SELECT p.* FROM products p LEFT JOIN prodcats c ON p.prodID = c.cPROD WHERE prodSTAT = 1 AND c.cCAT = 26");
			while($subA = $subR->fetch_array(MYSQLI_ASSOC)){
				$prodNUM    = $subA['prodNUM'];
				$prodNAME   = $subA['prodNAME'];
				$prodCOLOR  = $subA['prodCOLOR'];
				$prodWEIGHT = $subA['prodWEIGHT'];
				$prodPALLET = $subA['prodPALLET'];
				$MSDS = "";
				$PDS = "";
				$MSDS_File = find_file("MSDS", $prodNUM,$prodNAME);
				$PDS_File  = find_file("PDS", $prodNUM,$prodNAME);
				
				if ($MSDS_File != "0") {
					$MSDS = "<div id=\"fileList\" class=\"blue\" onclick=\"location.href='$MSDS_File'\">
								&bull; MSDS
							</div>";
				}
				if ($PDS_File != "0") {
					$PDS = "<div id=\"fileList\" class=\"blue\" onclick=\"location.href='$PDS_File'\">
								&bull; Product Sheet
							</div>";
				}
				
				echo "
						<div id='btIMG'><img src='img/img-$prodNUM.jpg' /></div>
						<div id='btINFO' class='s12'>
							<span class='s10 bold'>#$prodNUM</span><br />
							<span class='s18 bold it'>$prodNAME</span><br />
							<span class='grayD'>$prodCOLOR<br />$prodWEIGHT - $prodPALLET/pallet</span><br />
								$MSDS
								$PDS
						</div>";
			
			
			
			}
			echo "
					</div>
				</div>
			</div>";
		}
    }
}
?>

</div>

<?PHP include_once('footer.php'); ?>

<div id="dummy"></div>
