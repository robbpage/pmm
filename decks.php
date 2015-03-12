<?PHP
# page title
$title = "Deck Finishes by Premix Marbletite - Pool Finishes - Stucco - Plaster - Roof Tile Mortars";
# header
include_once('header.php');
# database
include_once('inc/dbc.php');
?>

<div id="contentShell">

	<div id="decksHeader"></div>
	<div id="deckSubHeader">
		<div id="deckSubLeft" class="s16">
		<span class="bold it">DECKorative Concrete Finishes</span> not only beautify your outdoor areas, they offer many additional advantages:<br /><br />
		<ul>
			<li>Cooler than plain concrete</li>
			<li>Anti-slip textured surface</li>
			<li>Easy application and mixing</li>
			<li>Fast curing time</li>
			<li>Water cleanup</li>
			<li>Hard, durable finish</li>
			<li>Variety of colors</li>
		</ul>
		</div>
		<div id="deckSubRight" class="s16">These <span class="bold it">DECKorative Concrete Finishing Systems</span> can be used to turn any unsightly or dreary concrete surface into a dazzling design. These durable formulations can be used to <span class="bold it">protect and enhance</span> cementitious patios, swimming pool decks, walkways and driveways.<br /><br />Compliment your outdoor spaces, enhance your landscape designs and turn your living space into a designer’s dream. <span class="bold it">Imagine the possibilities!</span><br /><br />Perhaps the best part of these beautiful finishes is the ease of maintenance. Resistant to staining and mildew, <span class="bold it">a simple garden hose and household cleaner will keep your surfaces looking like new.</span>
		</div>
	</div>

	<div id="deckSubHeader" class="dsh"></div>

      <div id="content">
		<div id="deckProdLEFT">
		<?PHP
		# DECK stuff
		$catR = $dbc->query("SELECT * FROM categories WHERE catPAR = 2 AND catSTAT = 1 AND catNAME != 'DECKote'");
		while($catA = $catR->fetch_array(MYSQLI_ASSOC)){
			$catNAME = $catA['catNAME'];
			$catDESC = $catA['catDESC'];
			$catID  = $catA['catID'];
			echo "
			<div id='decksProdContainer'>
				<span class='bold blue s24 it'>$catNAME</span><br />
				<div id='deckoteBlurb'>$catDESC</div>";
			$prodR = $dbc->query("SELECT p.* FROM products p LEFT JOIN prodcats c ON p.prodID = c.cPROD WHERE prodSTAT = 1 AND c.cCAT = $catID");
			while($prodA = $prodR->fetch_array(MYSQLI_ASSOC)){
				$prodNUM    = $prodA['prodNUM'];
				$prodNAME   = $prodA['prodNAME'];
				$prodDESC   = $prodA['prodDESC'];
				$prodCOLOR  = $prodA['prodCOLOR'];
				$prodWEIGHT = $prodA['prodWEIGHT'];
				$prodPALLET = $prodA['prodPALLET'];
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
				<div class='decksProdIMG'><img src='img/img-$prodNUM.jpg' /></div>
				<div class='decksProdINFO' class='s12 lh12'>
					<span class='s10 bold'>#$prodNUM</span><br />
					<span class='s18 bold it'>$prodNAME</span><br />
					<div class='grayD lh16' style='margin-top: 4px;'>";
				if($prodDESC != ""){ echo "$prodDESC<br />"; }
				echo "$prodCOLOR<br />$prodWEIGHT - $prodPALLET/pallet</div>
				<div>
					$MSDS  $PDS
				</div>
				</div>";
			}
			echo "
				<img src='img/decksDivider.png' class='deckdivideArrow' />
				<div style='clear: both;'></div>
			</div>";
		}
		?>
		</div>
		<div id="deckProdRIGHT">
		<?PHP
		# DECKote Info
		$catR = $dbc->query("SELECT * FROM categories WHERE catID = 14");
		while($catA = $catR->fetch_array(MYSQLI_ASSOC)){
			$catNAME = $catA['catNAME'];
			$catDESC = $catA['catDESC'];
			$catID  = $catA['catID'];
			$link   = str_replace(" ","",$catNAME);
			echo "
			<span class='bold blue s24 it'>$catNAME</span><br />
			<div id='deckoteBlurb'>$catDESC</div>";
		}
		# DECKote Products
		$prodR = $dbc->query("SELECT p.* FROM products p LEFT JOIN prodcats c ON p.prodID = c.cPROD WHERE prodSTAT = 1 AND c.cCAT = 14");
		echo "
			<div id='deckoteProds'>";
		while($prodA = $prodR->fetch_array(MYSQLI_ASSOC)){
			$prodNUM    = $prodA['prodNUM'];
			$prodNAME   = $prodA['prodNAME'];
			$prodWEIGHT = $prodA['prodWEIGHT'];
			$prodPALLET = $prodA['prodPALLET'];
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
				<span class='s10 bold'>#$prodNUM</span><br /><span class='s18 it bold'>$prodNAME</span><br />
				<div>
					$MSDS   $PDS
				</div>
				<div class='clear'></div>";
		}
		echo "<br />
			<span class='s12 grayD'>$prodWEIGHT - $prodPALLET/pallet</span><br /><br />
			</div>
			<img src='img/deckote_colors.jpg' />";
		?>
		</div>
		<div style="clear: both;"></div>
	</div>

</div>

<?PHP include_once('footer.php'); ?>
