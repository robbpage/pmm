<div id="mask"></div>
<div id="errorPopCover">
	<div id="secondPop">
        <div id="errorPopShell">
            <div id="errorPopMSG" class="s18 bold"></div>
            <div id="emailPopSend" class="button" style="display:none;">Send</div>
            <div id="errorPopClose" class="button">Close</div>
        </div>
    </div>
</div>
<?PHP
# page title
$title = "Warranty Registration | Premix-Marbletite - Pool Finishes - Stucco - Plaster - Roof Tile Mortars";
# header
include_once('header.php');
# database
include_once('inc/dbc.php');
?>
<div id="contentShell">
<form id="form" name="form" method="post" action="warranty.php">
	<div id="content">
		<div id="warrantyHeader"></div>
		<div id="warrBlurb" class="s18 grayD" style="text-align: left;">Thank you for choosing Premix Marbletite. We hope you’re enjoying your new pool finish. Please make sure to fill out the warranty form below and carefully read our <span class="linkWarranty" onclick="scrollIT('#tNcLINK')">Warranty Terms & Conditions</span> before submitting your registration.  Registering your pool protects your investment. It’s quick and easy and will make any warranty claims much more efficient.</div>
	</div>
	<div id="fullDivide"></div>
	<div id='poolHeaderWhite' class='s18 bold poolExtras'>Step 1: <span class='it blue'>Select your product</span></div>
	<div id="content">
		<div id="warr-bag-ms" class="warrbags">
			<img id="bag-ms" src="img/bag_marquis-series_on.jpg" class="warrbagsPIX" />
			<div id="bag-ms-pop" class="warr-colorPop s12 black">
				<div class="warrRowHead s12 bold it blue">Select your color</div>
			<?PHP
			# get the colors for marquis series
			$prodR = $dbc->query("SELECT p.* FROM products p LEFT JOIN prodcats c ON p.prodID = c.cPROD WHERE prodSTAT = 1 AND c.cCAT = 27");
			while($prodA = $prodR->fetch_array(MYSQLI_ASSOC)){
				$prodID    = $prodA['prodID'];
				$prodNUM   = $prodA['prodNUM'];
				$prodCOLOR = $prodA['prodCOLOR'];
				echo "
				<div id='ms-selected' class='warrRow' name='$prodNUM $prodCOLOR'><span class='s10 gray'>#$prodNUM</span> $prodCOLOR</div>";
			}
			?>
			</div>
		</div>
		<div id="warr-bag-fs" class="warrbags">
			<img id="bag-fs" src="img/bag_freestone-series_on.jpg" class="warrbagsPIX" />
			<div id="bag-fs-pop" class="warr-colorPop s12 black">
				<div class="warrRowHead s12 bold it blue">Select your color</div>
			<?PHP
			# get the colors for freestone series
			$prodR = $dbc->query("SELECT p.* FROM products p LEFT JOIN prodcats c ON p.prodID = c.cPROD WHERE prodSTAT = 1 AND c.cCAT = 28");
			while($prodA = $prodR->fetch_array(MYSQLI_ASSOC)){
				$prodID    = $prodA['prodID'];
				$prodNUM   = $prodA['prodNUM'];
				$prodCOLOR = $prodA['prodCOLOR'];
				echo "
				<div id='fs-selected' class='warrRow' name='$prodNUM $prodCOLOR'><span class='s10 gray'>#$prodNUM</span> $prodCOLOR</div>";
			}
			?>
			</div>
		</div>
		<div id="warr-bag-cs" class="warrbags">
			<img id="bag-cs" src="img/bag_crystal-series_on.jpg" class="warrbagsPIX" />
			<div id="bag-cs-pop" class="warr-colorPop s12 black">
				<div class="warrRowHead s12 bold it blue">Select your color</div>
			<?PHP
			# get the colors for crystal series
			$prodR = $dbc->query("SELECT p.* FROM products p LEFT JOIN prodcats c ON p.prodID = c.cPROD WHERE prodSTAT = 1 AND c.cCAT = 29");
			while($prodA = $prodR->fetch_array(MYSQLI_ASSOC)){
				$prodID    = $prodA['prodID'];
				$prodNUM   = $prodA['prodNUM'];
				$prodCOLOR = $prodA['prodCOLOR'];
				echo "
				<div id='cs-selected' class='warrRow' name='$prodNUM $prodCOLOR'><span class='s10 gray'>#$prodNUM</span> $prodCOLOR</div>";
			}
			?>
			</div>
		</div>
		<div id="warr-bag-mm" class="warrbags">
			<img id="bag-mm" src="img/bag_marquis-magic_on.jpg" class="warrbagsPIX" />
			<div id="bag-mm-pop" class="warr-colorPop s12 black">
				<div class="warrRowHead s12 bold it blue">Select your color</div>
			<?PHP
			# get the colors for marquis magic
			$prodR = $dbc->query("SELECT p.* FROM products p LEFT JOIN prodcats c ON p.prodID = c.cPROD WHERE prodSTAT = 1 AND c.cCAT = 30");
			while($prodA = $prodR->fetch_array(MYSQLI_ASSOC)){
				$prodID    = $prodA['prodID'];
				$prodNUM   = $prodA['prodNUM'];
				$prodCOLOR = $prodA['prodCOLOR'];
				echo "
				<div id='mm-selected' class='warrRow' name='$prodNUM $prodCOLOR'><span class='s10 gray'>#$prodNUM</span> $prodCOLOR</div>";
			}
			?>
			</div>
		</div>
		<div style="clear: both;"></div>
		<div id="warr-bag-ms-selected" class="warrbagSelected"></div>
		<div id="warr-bag-fs-selected" class="warrbagSelected"></div>
		<div id="warr-bag-cs-selected" class="warrbagSelected"></div>
		<div id="warr-bag-mm-selected" class="warrbagSelected"></div>
		<div style="clear: both; margin-bottom: 10px;"><input type="hidden" name="prodSelect" id="prodSelect" value="" /><input type="hidden" name="prodSeries" id="prodSeries" value="" /></div>
	</div>
	<div id='poolHeaderWhite' class='s18 bold poolExtras'>Step 2: <span class='it blue'>Provide the required information</span></div>
	<div id="content" style="height: 480px;">
		<div id="warrHomeOwner" class="warrCol">
			<span class="it bold blue s20">Homeowner Info</span>
			<div id="hoNameH" class="formHead bold black s14">Name</div>
			<div class="formRow"><input type="text" id="hoName" name="hoName" class="formTXT s18 bold txtReq" /></div>
			<div id="hoAddyH" class="formHead bold black s14">Address</div>
			<div class="formRow"><input type="text" id="hoAddy" name="hoAddy" class="formTXT s18 bold txtReq" /></div>
			<div id="hoCityH" class="formHead bold black s14">City</div>
			<div class="formRow"><input type="text" id="hoCity" name="hoCity" class="formTXT s18 bold txtReq" /></div>
			<div class="formFloat">
			<div id="hoStateH" class="formHead bold black s14">State</div>
			<div class="formRow">
			<select name="hoState" id="hoState" class="warrState s18 txtReq" onfocus="" onblur="">
			<option value="" selected="selected">Please select ...</option>
			<option value="AK">Alaska</option>
			<option value="AL">Alabama</option>
			<option value="AR">Arkansas</option>
			<option value="AZ">Arizona</option>
			<option value="CA">California</option>
			<option value="CO">Colorado</option>
			<option value="CT">Connecticut</option>
			<option value="DC">Washington D.C.</option>
			<option value="DE">Delaware</option>
			<option value="FL">Florida</option>
			<option value="GA">Georgia</option>
			<option value="HI">Hawaii</option>
			<option value="IA">Iowa</option>
			<option value="ID">Idaho</option>
			<option value="IL">Illinois</option>
			<option value="IN">Indiana</option>
			<option value="KS">Kansas</option>
			<option value="KY">Kentucky</option>
			<option value="LA">Louisiana</option>
			<option value="MA">Massachusetts</option>
			<option value="MD">Maryland</option>
			<option value="ME">Maine</option>
			<option value="MI">Michigan</option>
			<option value="MN">Minnesota</option>
			<option value="MO">Missouri</option>
			<option value="MS">Mississippi</option>
			<option value="MT">Montana</option>
			<option value="NC">North Carolina</option>
			<option value="ND">North Dakota</option>
			<option value="NE">Nebraska</option>
			<option value="NH">New Hampshire</option>
			<option value="NJ">New Jersey</option>
			<option value="NM">New Mexico</option>
			<option value="NV">Nevada</option>
			<option value="NY">New York</option>
			<option value="OH">Ohio</option>
			<option value="OK">Oklahoma</option>
			<option value="OR">Oregon</option>
			<option value="PA">Pennsylvania</option>
			<option value="PR">Puerto Rico</option>
			<option value="RI">Rhode Island</option>
			<option value="SC">South Carolina</option>
			<option value="SD">South Dakota</option>
			<option value="TN">Tennessee</option>
			<option value="TX">Texas</option>
			<option value="UT">Utah</option>
			<option value="VA">Virginia</option>
			<option value="VT">Vermont</option>
			<option value="WA">Washington</option>
			<option value="WI">Wisconsin</option>
			<option value="WV">West Virginia</option>
			<option value="WY">Wyoming</option>
			</select>
			</div>
			</div>
			<div class="formFloat">
			<div id="hoZipH" class="formHead bold black s14">Zip</div>
			<div class="formRow"><input type="text" id="hoZip" name="hoZip" class="formTXT s18 bold txtReq" style="width: 100px;" /></div>
			</div>
			<div style="clear: both;"></div>
			<div id="hoPhoneH" class="formHead bold black s14">Phone</div>
			<div class="formRow"><input type="text" id="hoPhone" name="hoPhone" class="formTXT s18 bold" /></div>
			<div id="hoEmailH" class="formHead bold black s14">Email</div>
			<div class="formRow"><input type="text" id="hoEmail" name="hoEmail" class="formTXT s18 bold" /></div>
		</div>

		<div id="warrInstaller" class="warrCol">
			<span class="it bold blue s20">Contractor/Applicator Info</span>
            <div class="formFloat">
			<div id="caNameH" class="formHead bold black s14">Name</div>
			<div class="formRow"><input type="text" id="caName" name="caName" class="formTXT s18 bold txtReq" style="width: 150px; margin-right: 20px;" /></div>
			</div>
			<div class="formFloat">
			<div id="caLicenceH" class="formHead bold black s14">Licence #</div>
			<div class="formRow"><input type="text" id="caLicence" name="caLicence" class="formTXT s18 bold txtReq" style="width: 130px;" /></div>
			</div>
            <div style="clear: both;"></div>
			<div id="caAddyH" class="formHead bold black s14">Address</div>
			<div class="formRow"><input type="text" id="caAddy" name="caAddy" class="formTXT s18 bold txtReq" /></div>
			<div id="caCityH" class="formHead bold black s14">City</div>
			<div class="formRow"><input type="text" id="caCity" name="caCity" class="formTXT s18 bold txtReq" /></div>
			<div class="formFloat">
			<div id="caStateH" class="formHead bold black s14">State</div>
			<div class="formRow">
			<select name="caState" id="caState" class="warrState s18 txtReq" onfocus="" onblur="">
			<option value="" selected="selected">Please select ...</option>
			<option value="AK">Alaska</option>
			<option value="AL">Alabama</option>
			<option value="AR">Arkansas</option>
			<option value="AZ">Arizona</option>
			<option value="CA">California</option>
			<option value="CO">Colorado</option>
			<option value="CT">Connecticut</option>
			<option value="DC">Washington D.C.</option>
			<option value="DE">Delaware</option>
			<option value="FL">Florida</option>
			<option value="GA">Georgia</option>
			<option value="HI">Hawaii</option>
			<option value="IA">Iowa</option>
			<option value="ID">Idaho</option>
			<option value="IL">Illinois</option>
			<option value="IN">Indiana</option>
			<option value="KS">Kansas</option>
			<option value="KY">Kentucky</option>
			<option value="LA">Louisiana</option>
			<option value="MA">Massachusetts</option>
			<option value="MD">Maryland</option>
			<option value="ME">Maine</option>
			<option value="MI">Michigan</option>
			<option value="MN">Minnesota</option>
			<option value="MO">Missouri</option>
			<option value="MS">Mississippi</option>
			<option value="MT">Montana</option>
			<option value="NC">North Carolina</option>
			<option value="ND">North Dakota</option>
			<option value="NE">Nebraska</option>
			<option value="NH">New Hampshire</option>
			<option value="NJ">New Jersey</option>
			<option value="NM">New Mexico</option>
			<option value="NV">Nevada</option>
			<option value="NY">New York</option>
			<option value="OH">Ohio</option>
			<option value="OK">Oklahoma</option>
			<option value="OR">Oregon</option>
			<option value="PA">Pennsylvania</option>
			<option value="PR">Puerto Rico</option>
			<option value="RI">Rhode Island</option>
			<option value="SC">South Carolina</option>
			<option value="SD">South Dakota</option>
			<option value="TN">Tennessee</option>
			<option value="TX">Texas</option>
			<option value="UT">Utah</option>
			<option value="VA">Virginia</option>
			<option value="VT">Vermont</option>
			<option value="WA">Washington</option>
			<option value="WI">Wisconsin</option>
			<option value="WV">West Virginia</option>
			<option value="WY">Wyoming</option>
			</select>
			</div>
			</div>
			<div class="formFloat">
			<div id="caZipH" class="formHead bold black s14">Zip</div>
			<div class="formRow"><input type="text" id="caZip" name="caZip" class="formTXT s18 bold txtReq" style="width: 100px;" /></div>
			</div>
			<div style="clear: both;"></div>
			<div id="caPhoneH" class="formHead bold black s14">Phone</div>
			<div class="formRow"><input type="text" id="caPhone" name="caPhone" class="formTXT s18 bold" /></div>
			<div id="caEmailH" class="formHead bold black s14">Email</div>
			<div class="formRow"><input type="text" id="caEmail" name="caEmail" class="formTXT s18 bold" /></div>
		</div>

		<div id="warrAddInfo" class="warrCol">
			<span class="it bold blue s20">Additional Info</span>
			<div class="formHead bold black s14">Installation Date</div>
				<select name="prodmonth" id="prodmonth" class="s18 txtReq" style="width: 120px; height: 34px; margin-right: 20px; border: 1px solid #CCC;" onfocus="" onblur="">
					<option value="" selected="selected">Month ...</option>
					<option value="1">January</option>
					<option value="2">February</option>
					<option value="3">March</option>
					<option value="4">April</option>
					<option value="5">May</option>
					<option value="6">June</option>
					<option value="7">July</option>
					<option value="8">August</option>
					<option value="9">September</option>
					<option value="10">October</option>
					<option value="11">November</option>
					<option value="12">December</option>
				</select>
				<select name="prodday" id="prodday" class="s18 txtReq" style="width: 80px; height: 34px; margin-right: 20px; border: 1px solid #CCC;" onfocus="" onblur="">
					<option value="" selected="selected">Day ...</option>
					<option value="1">01</option>
					<option value="2">02</option>
					<option value="3">03</option>
					<option value="4">04</option>
					<option value="5">05</option>
					<option value="6">06</option>
					<option value="7">07</option>
					<option value="8">08</option>
					<option value="9">09</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
					<option value="23">23</option>
					<option value="24">24</option>
					<option value="25">25</option>
					<option value="26">26</option>
					<option value="27">27</option>
					<option value="28">28</option>
					<option value="29">29</option>
					<option value="30">30</option>
					<option value="31">31</option>
				</select>
				<select name="prodyear" id="prodyear" class="s18" style="width: 80px; height: 34px; border: 1px solid #CCC;" onfocus="" onblur="">
					<?PHP $year = date('Y'); $year2 = (date('Y')-1); $year3 = (date('Y')-2); ?>
					<option value="<?PHP echo $year3; ?>"><?PHP echo $year3; ?></option>
					<option value="<?PHP echo $year2; ?>"><?PHP echo $year2; ?></option>
					<option value="<?PHP echo $year; ?>" selected="selected"><?PHP echo $year; ?></option>
				</select>
			<div class="formFloat">
			<div id="caSizeH" class="formHead bold black s14">Job Size</div>
			<div class="formRow"><input type="text" id="caSize" name="caSize" class="formTXT s18 bold txtReq" style="width: 154px; margin-right: 20px;" /></div>
			</div>
			<div class="formFloat">
			<div id="caBatchH" class="formHead bold black s14">Batch #</div>
			<div class="formRow"><input type="text" id="caBatch" name="caBatch" class="formTXT s18 bold txtReq" style="width: 154px;" /></div>
			</div>
			<div style="clear: both;"><input type="text" id="cfCorpID" name="cfCorpID" value="" /></div>
			<div id="caDealerH" class="formHead bold black s14">Dealer</div>
			<div class="formRow"><input type="text" id="caDealer" name="caDealer" class="formTXT s18 bold txtReq" style="width: 330px;" /></div>
			<div class="formHead bold black s14">Project Type</div>
			<div class="formRow" style="margin-left: -4px;"><label style="cursor: pointer;"><input name="project" type="radio" value="newproject" /> New Project</label> &nbsp; &nbsp; &nbsp;<label style="cursor: pointer;"><input name="project" type="radio" value="reno" /> Resurface/Renovation</label></div>
			<div id="warrDisc" class="s12 grayD">Your information will never be shared with anyone outside of Premix Marbletite or our Customer Support Team.  Please provide either a phone number or email address so that we may contact you in the event of a waranty claim.</div>
		</div>
	</div>
	<div id="content" class="warrTnCagree s18 bold">
		<input type="checkbox" name="tNc" id="tNc" style="margin-right: 10px;" />I have read and agree with the <span class="linkWarranty" onclick="scrollIT('#tNcLINK')">Premix Marbletite Warranty Terms & Conditions</span><br />
		<div id="warrButt" class="button s14">Submit Warranty</div>
	</div>
	<!-- warranty terms & conditions -->
	<div id="tNcLINK"></div>
	<div id="warrantyTnC">
		<div class="tNcHeader s20 bold blue">Premix Marbletite Ten (10) Year Limited Warranty Terms & Conditions</div>
		<span class="s12">Premix-Marbletite Manufacturing Co. (herinafter referred to as Premix), warrants its products - Marquis Series, Freestone Series, Crystal Series and Marquis Magic - against failure on a 10 Year Limited Warranty from the date of installation by a professional licensed pool finish applicator. In the event of failure, Premix shall, upon verification, provide Marquis Series, Freestone Series, Crystal Series or Marquis Magic materials to repair the area of failure only.</span><br /><br />
		<div class="tNcHeader s14 bold" style="margin-bottom: 0px;">LIMITATIONS:</div>
		<span class="s12 bold">NOTE: TO THE EXTENT PERMITTED BY LAW, THERE IS NO OTHER WARRANTY OR REPRESENTATION OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING NO WARRANTY OF MERCHANTABILITY OR OF FITNESS FOR A PARTICULAR PURPOSE. THIS IS A 10 YEAR LIMITED WARRANTY AS SET FORTH HEREIN.</span><br />
		<ol>
			<li>This Warranty excludes damage due to defects in workmanship or physical abuse of the pool.</li>
			<li>Some loss of aggregate is expected, especially in a new installation; this is not to be considered a failure.</li>
			<li>It is understood that stone itself and application techniques will result in variations in tone and appearance. This variation in pool shades is not to be considered a failure; the Marquis Series, Freestone Series, Crystal Series and Marquis Magic are not warranted with regard to color.</li>
			<li>The contractor shall have the right to repair the area of failure only. The Marquis Series, Freestone Series, Crystal Series and Marquis Magic replacement is limited to this repair. It is understood that some cosmetic variation will result.</li>
			<li>Premix warrants the Marquis Series, Freestone Series, Crystal Series and Marquis Magic material only and is not responsible for labor to repair said material.</li>
			<li>Subsequent costs such as water replacement, chemicals, land and loss of use of the pool are not covered.</li>
			<li>This Warranty shall not include pools that have been abused physically or through lack of proper chemical balancing, chlorine applications or other chemical abuses.</li>
			<li>Minor surfacing checking, cracks and minor cracks are not covered by this Warranty.</li>
			<li>This Warranty is non-transferable.</li>
			<li>Pool must be checked monthly by a pool retail outlet having water testing capabilities. Computerized records must be present at time of inspection.</li>
		</ol>
		<span class="s14 bold">The Premix warranty is not valid unless this form is completed in full (batch number required) and submitted within thirty (30) days of installation of Marquis Series, Freestone Series, Crystal Series and Marquis Magic material.</span><br /><br />
		<span class="s14 bold">This warranty gives you specific legal rights and you may also have other rights, which vary from state to state.</span><br /><br /><br />
		<div class="tNcHeader s18 bold blue">POOL WATER CHEMISTRY</div>
		<span class="s14">It is necessary for the longevity of your pool finish and as a condition of this Warranty, that the following chemical guidelines and <strong>Sequestering Agent</strong><sup>&reg;</sup> levels must be followed and maintained: Sanitizer levels must be maintained in accordance with the manufacturer's specifications of the sanitizer you are using. (<strong>Ex:</strong> Free Chlorine = 1 - 3ppm)</span><br /><br />
		<div style="width: 500px; margin: 0 auto; background: #FFF; border: 1px solid #CCC; margin-bottom: 20px;">
			<div style="width: 180px; float: left; text-indent: 10px; border-bottom: 1px dashed #DEDEDE; padding: 4px 0;" class="bold">pH</div><div style="width: 310px; float: left; border-bottom: 1px dashed #DEDEDE; padding: 4px 0 4px 10px;">7.2 - 7.6</div>
			<div style="width: 180px; float: left; text-indent: 10px; border-bottom: 1px dashed #DEDEDE; padding: 4px 0;" class="bold">Total Alkalinity (TA)</div><div style="width: 310px; float: left; border-bottom: 1px dashed #DEDEDE; padding: 4px 0 4px 10px;">80-120 ppm</div>
			<div style="width: 180px; float: left; text-indent: 10px; border-bottom: 1px dashed #DEDEDE; padding: 4px 0;" class="bold">Calcium Hardness (CH)</div><div style="width: 310px; float: left; border-bottom: 1px dashed #DEDEDE; padding: 4px 0 4px 10px;">200-400 ppm</div>
			<div style="width: 180px; float: left; text-indent: 10px; border-bottom: 1px dashed #DEDEDE; padding: 4px 0;" class="bold">Cyanuric Acid</div><div style="width: 310px; float: left; border-bottom: 1px dashed #DEDEDE; padding: 4px 0 4px 10px;">40-60 ppm</div>
			<div style="width: 180px; float: left; text-indent: 10px; border-bottom: 1px dashed #DEDEDE; padding: 4px 0;" class="bold">Sequestering Agent</div><div style="width: 310px; float: left; border-bottom: 1px dashed #DEDEDE; padding: 4px 0 4px 10px;">10-12 ppm (6oz. per 10,000gal of water)</div>
			<div style="width: 180px; float: left; text-indent: 10px; padding: 4px 0;" class="bold">Salt Water pools<br />&nbsp;</div><div style="width: 310px; float: left; padding: 4px 0 4px 10px;">Lower pH to 7.2 weekly (very important)<br />Use Sequestering Agent for salt water pools</div>
			<div style="clear: both;"></div>
		</div>
		<span class="s14">Pool fill water containing high levels of metals may need to be pre-treated and filtered before being added to your pool. <strong>DO NOT</strong> stop water while the pool is filling. If adding additional fill hoses, add to the deep end of the pool only. The initial process, including start up chemicals, should be done by a pool professional. This may take serveral days. Afterwards, balance the pool water to the above noted water parameters. Check the pH serveral times per week for the first few weeks and add pool acid <strong>pre-diluted</strong> to the deep end of the pool to lower the pH to 7.0-7.2 range or lower if needed. <strong><u>NEVER</u></strong> allow the pH to rise above 7.6 during the first 30 days. Brush the pool daily for the first 30 days, then as needed. To help prevent metal stains and scaling of the finish and to up-hold your product warranty, you must add the proper amount of the <strong><u>Sequa-Sol<sup>&reg;</sup> or any leading brand of Sequestering Agent</u></strong> weekly as noted above. After the first 30 days, check the pool water routinely at least once a week or more often and keep the water balanced to the above noted water chemistry parameters. For salt water pools: do not add salt to the pool for the first 30 days. Be sure to add pool acid <strong><u>weekly</u></strong> and lower the pH to 7.2ppm. No pool cleaners without brushes or vacuums with wheels for the first 30 days. Do <strong>not</strong> add Calcium for the first 60 days; then only if it is below 200ppm.</span><br /><br /><br />
		<div class="tNcHeader s18 bold blue">WARRANTY CLAIM PROCEDURES</div>
		<span class="s14">To initiate a warranty claim, notify Premix-Marbletite Manufacturing Co., 1259 NW 21st Street, Pompano Beach, FL 33069. Prior to an inspection, Premix-Marbletite Manufacturing Co. must receive by certified mail a brief note describing the complaint and photocopies (do <strong>NOT</strong> send the originals) of the following:<br />
		<ol>
			<li>Original "return receipt" as completed at time of application</li>
			<li>Historical copies of Pool Water Chemistry test results for 24 recent and successive months</li>
		</ol></span>
		<div id="back2top" class="button s14" onclick="scrollIT('#fullDivide')";>Back to Top</div>
	</div>
</form>
</div>
<?PHP include_once('footer.php'); ?>

<div id="dummy"></div>
