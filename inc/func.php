<?PHP
// contact form submission
if(isset($_GET['contact'])){
	// define the submitted variables
	$name   = $_POST['name'];
	$email  = $_POST['email'];
	$county = $_POST['county'];
	$phone  = $_POST['phone'];
	$type   = $_POST['contactType'];
	if($type = "checkProd"){ $type = "Product Inquiry"; }
	if($type = "checkServ"){ $type = "Service Inquiry"; }
	$hcwh   = $_POST['helphow'];
	// prepare the email
	$body  = "$name - $email";
	if($phone != ""){ $body .= " - $phone"; };
	$body .= "\n\n$county\n\n$type";
	if($hcwh != ""){ $body .= "\n\n$hcwh"; };
	$from   = "From: $name <$email>";
	$sendto = "lcurry@pmmproducts.com"; #laquita.curry@premixmarbletite.com
	// send the email
	if(mail($sendto, 'PMM Website Contact Form', $body, $from, '-f $sendto')){
		echo "1";
	} else {
		echo "2";
	}
}

// process the warranty form information
if(isset($_GET['warranty'])){
	include_once('dbc.php');
	// define the warranty variables
	$hoName    = addslashes($_POST['hoName']);
	$hoAddy    = addslashes($_POST['hoAddy']);
	$hoCity    = addslashes($_POST['hoCity']);
	$hoState   = $_POST['hoState'];
	$hoZip     = addslashes($_POST['hoZip']);
	$hoPhone   = addslashes(str_replace(array('(', ')', '-', ' '), "", $_POST['hoPhone']));
	$hoEmail   = $_POST['hoEmail'];
	$caName    = addslashes($_POST['caName']);
	$caLicence = addslashes($_POST['caLicence']);
	$caAddy    = addslashes($_POST['caAddy']);
	$caCity    = addslashes($_POST['caCity']);
	$caState   = $_POST['caState'];
	$caZip     = addslashes($_POST['caZip']);
	$caPhone   = addslashes(str_replace(array('(', ')', '-', ' '), "", $_POST['caPhone']));
	$caEmail   = $_POST['caEmail'];
	$addInst   = mktime(0,0,0,$_POST['prodmonth'],$_POST['prodday'],$_POST['prodyear']);
	$addSize   = addslashes($_POST['caSize']);
	$addBatch  = addslashes($_POST['caBatch']);
	$addDealer = addslashes($_POST['caDealer']);
	$addType   = $_POST['project'];
	$prodColor = $_POST['prodSelect'];
	// product series
	switch($_POST['prodSeries']){
		case ms: $prodSeries = "Marquis"; break;
		case fs: $prodSeries = "Freestone"; break;
		case cs: $prodSeries = "Crystal"; break;
		case mm: $prodSeries = "Magic"; break;
	}
	// date of submission
	$today     = time();
	// check spambot filter
	if($_POST['cfCorpID'] != ""){
		// spambot detected
		$dbc->query("INSERT INTO spamcount (date) VALUES ('$today')");
		echo "0";
	} else {
		// insert the data into the database
		$ins_str   = "'$hoName', '$hoAddy', '$hoCity', '$hoState', '$hoZip', '$hoPhone', '$hoEmail', '$caName', '$caLicence', '$caAddy', '$caCity', '$caState', '$caZip', '$caPhone', '$caEmail', $addInst, '$addSize', '$addBatch', '$addDealer', '$addType', '$prodSeries', '$prodColor', $today, '10 Year'";
		if($dbc->query("INSERT INTO warranty (ho_name, ho_addy, ho_city, ho_state, ho_zip, ho_phone, ho_email, ca_name, ca_licence, ca_addy, ca_city, ca_state, ca_zip, ca_phone, ca_email, add_installdate, add_jobsize, add_batchnum, add_dealer, add_type, prod_series, prod_color, date_sub, warr_time) VALUES ($ins_str)")){
			$pkID = $dbc->insert_id;
			echo "$pkID";
		} else {
			echo "0";
		}
	}
}
if(isset($_GET['warrantyEmail'])){
	include_once('dbc.php');
	$to = '';
	
	$ContractorEmail = $_POST['ContractorEmail'];
	$homeEmail = $_POST['homeEmail'];
	$otherEmail = $_POST['otherEmail'];
	
	$conNum = $_POST['conNum'];
	
	$query ="SELECT * FROM warranty WHERE pkid = $conNum";
	$eSelect = $dbc->query($query);
	$eArray = $eSelect->fetch_array(MYSQLI_ASSOC);
	// HOME INFO
	$hname = $eArray['ho_name'];
	$haddy = $eArray['ho_addy'];
	$hcity = $eArray['ho_city'];
	$hstate = $eArray['ho_state'];
	$hzip = $eArray['ho_zip'];
	$hphone = $eArray['ho_phone'];
	// CONTRACTOR INFO
	$cname = $eArray['ca_name'];
	$caddy = $eArray['ca_addy'];
	$ccity = $eArray['ca_city'];
	$cstate = $eArray['ca_state'];
	$czip = $eArray['ca_zip'];
	$cphone = $eArray['ca_phone'];
	// INSTALL INFO
	$installDate = $eArray['add_installdate'];
	$jobsize = $eArray['add_jobsize'];
	$batchnum = $eArray['add_batchnum'];
	$dealer = $eArray['add_dealer'];
	// PRODUCT INFO
	$series = $eArray['prod_series'];
	$color = $eArray['prod_color'];
	$warTime = $eArray['warr_time'];
	
	$subject = 'Premix Marbeltite Warranty';
	$message = "
	YOUR CONFIRMATION NUMBER: $conNum 
	Warranty submission date ".date('F d, Y')."
	Product: $series $color $warTime Limited Warranty 
	
	Installation Information--
	Job Size: $jobsize
	Batch #: $batchnum
	Date: ".date('F d, Y', $installDate)."
	Home Information--
	Name: $hname
	Address: $haddy $hcity, $hstate $hzip
	Phone: $hphone
	Email: $hEmail
	
	Contractor / Applicator Information--
	Name: $cname
	Address: $caddy $ccity, $cstate $czip
	Phone: $cphone
	Email: $cEmail
	
	To review our Limited Warranty Terms & Conditions, please visit http://www.pmmproducts.com/warranty.php?terms
	Please do not reply to this message. Replies to this message are routed to an unmonitored mailbox.
	If you have questions please go to http://www.pmmproducts.com/contact.php.
	";
	$headers = 'From: warranty@pmmproducts.com';
	
	if($ContractorEmail != ""){
		$to .= $ContractorEmail . ', ';
	}
	if($homeEmail != ""){
		$to .= $homeEmail . ', ';
	}
	if($otherEmail != ""){
		$to .= $otherEmail . ', ';		
	}
	$to = rtrim($to, ', ');

	if (mail($to, $subject, $message, $headers)) {
		echo 1;
	} else {
		echo 0;
	}
}
// get the support files for products
function find_file($type, $prodNum, $catName){
	$type = strtolower($type);
	$fu = $type.'_'.$prodNum.'_';
	$filenameCat = "files/".$type."_".$catName.".pdf";
	$filenameCat = strtolower ($filenameCat);
	foreach (glob("files/$fu?*") as $filename) {}
	$tempfileName = strtolower ($filename);
	$tempType = strtolower ($type);
	if(file_exists($filenameCat)){
		return $filenameCat;
	} else if (strpos($tempfileName,$tempType) != false) {
		if(file_exists($filename)){
			return $filename;
		} else {
			return 0;
		}
	} else {
		return 0;
	}
}

#                          #
#  WTB GEO CODER FUNCTION  #
#                          #
if(isset($_GET['wtb']) && $_GET['wtb'] == 'check'){
	include "dbc.php";
	$temp = $_GET['latlon'];
	$temp = str_replace("(", "", $temp);
	$temp = str_replace(")", "", $temp);
	$temp = explode(", ", $temp, 2);
	$latty = $temp[0];
	$longy = $temp[1];
	$rad = str_replace(" miles", "", $_GET['radius']);
	$query = "SELECT dist.cust_name, dist.addy,	dist.city, dist.state, dist.zip, dist.phone, dist.lat, dist.lon, dist.website, dist.rank,
				( 3959 * acos( cos( radians( $latty ) ) * cos( radians( lat ) ) * cos( radians( lon ) - radians( $longy ) ) + sin( radians( $latty ) ) * sin( radians( lat ) ) ) ) AS distance
			FROM dist
			INNER JOIN dist_cross ON dist.pkID = dist_cross.distID
			WHERE dist_cross.siteID = 5
			HAVING distance <= $rad
			ORDER BY distance ASC
				";
	$result = $db_reg->query($query);
	$total = $db_reg->affected_rows;
	if($total == 0 || $total == -1 ){
		if($_GET['radius'] == 200){
			echo 2;	
		} else {
			echo 0;		
		}
	} else {
		echo 1;
	}
}
?>
