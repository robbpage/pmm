//                                            //
//    N a v i g a t i o n  E l e m e n t s    //
//                                            //

/* drop down menus */
$(function(){
	$('.drop').on('mouseover',function(){
		var theDiv = $(this).attr('id');
		$('#'+theDiv+'Drop').css('display','block');
	}).on('mouseout',function(){
		var theDiv = $(this).attr('id');
		$('#'+theDiv+'Drop').css('display','none');
	})
	// detecting clicks and routing accordingly
	$('.go').on('click',function(){
		var theLINK = $(this).data('link');
		document.location.href=theLINK;
	})
	// detecting click on headerLogo
	$('#headerLogo').on('click',function(){
		document.location.href='index.php';
	})
})
/* keep menu options on screen while scrolling */
$(window).bind('scroll', function() {
	if ($(window).scrollTop() > 104) {
		$('#headerShell').css({'position':'fixed','top':-104});
		$('#contentShell').css({'padding-top':180});
	} else {
		$('#headerShell').css({'position':'relative','top':0});
		$('#contentShell').css({'padding-top':40});
	}
});

//                                               //
//    S e a r c h  B o x  C l e a r / F i l l    //
//                                               //
$(function(){
	$('#st').focus(function(){
		if($(this).val() == "Search ..."){
			$(this).val('');
			$(this).removeClass('it').addClass('');
		}
	}).blur(function(){
		if($(this).val() == ""){
			$(this).removeClass('').addClass('it');
			$(this).val('Search ...');
		}
	}).keyup(function(event){
		if(event.which == 13){
			if(this.value != ""){
				$('#searchMag').trigger('click');
			}
		}
	})
	$('#searchMag').click(function(){
		var st = $('#st').val();
		if(st != "Search ..."){
			//alert(st);
			//document.location.href='search.php?st='+st;
			$.post( "search.php?check=1", { SearchTerm: st })
			  .done(function( data ) {
				var stCheck = data;
				if(stCheck != 0){;
					document.location.href='search.php?st='+st;
				} else {
					alert("No Results");
				}
			});
		}
	})
})


//                     //
//    C o n t a c t    //
//                     //
$(function(){
	// this is for the Help Type Check Boxes
	$('.checky').on('click',function(){
		var clicked = $(this).attr('id');
		// turn both off
		$('#checkProdICON').attr('src','img/icon_checkboxOFF.jpg');
		$('#checkServICON').attr('src','img/icon_checkboxOFF.jpg');
		// turn on the one they clicked
		$('#'+clicked+'ICON').attr('src','img/icon_checkboxON.jpg');
		// set the hidden field to reflect their selection
		$('#contactType').attr('value',clicked);
	})
	// this is for changing the label font color when they enter txt into the text field
	$('.txtbox, .txtarea, .formTXT, .warrState').on('focus',function(){
		var headerTXT = $(this).attr('id');
		$('#'+headerTXT+'H').addClass('blue');
	}).on('blur',function(){
		var headerTXT = $(this).attr('id');
		$('#'+headerTXT+'H').removeClass('blue');
	})
	// form submission shit
	$('#formSubmit').on('click',function(){
		if($('#corpID').val() != ""){
			// do nothing
		} else {
			var name = $('#name').val();
			var email = $('#email').val();
			var county = $('#county').val();
			if(name != "" && email != "" && county != ""){
				// everything filled out, check email for proper format
				var valid = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				if(!valid.test(email)){
					// invalid email error message
					errorPopper("Please enter a valid email address");
				} else {
					// everything passes, process the form
					$(function(){
						$.post("inc/func.php?contact", $('#form').serialize(), function(data){
							if(data == 1){
								// message sent
								errorPopper("Your message has been sent. Thank you.");
								gotoLink = "index.php";
							} else {
								// message failed
								errorPopper("Something went wrong, please try again.");
							}
						});
					});
				}
			} else {
				// missing fields error message
				errorPopper("Please fill out all fields marked with a *");
			}
		}
	})
})

//                 //
//    P o o l s    //
//                 //
$(function(){
	$(".poolMains").on("click", function () {
		var theSub = '#'+$(this).data('link');
		$(theSub).animate({
			height: "toggle"
		}, 300, "swing");
	});
})

//                                         //
//    S w a t c h  P o p U p  I m a g e    //
//                                         //
$(function(){
	$('.swatchBOX').on('click',function(){
		var prodNUM = $(this).data('num');
		var prodCOL = $(this).data('col');
		var prodIMG = 'url(img/lg/'+prodNUM+'.jpg)';
		var height = $('#dummy').height();
		var width  = $('#dummy').width();
		var offset = (height/2)-300;
		$('#popProd').html("<span class='s14'>#"+prodNUM+"</span> "+prodCOL);
		$('#popCover').css({'width':width,'height':height,'opacity':1});
		$('#popSwatch').css({'display':'block','margin-top':offset,'background-image':prodIMG});
	})
	$('#popCover').on('click',function(){
		$(this).css({'opacity':0});
		setTimeout(function(){
			$('#popCover').css({'width':0,'height':0});
			$('#popSwatch').css('display','none');
		}, 300);
		
	})
})

<!--                          -->
<!--  CLEAR or FILL ELEMENTS  -->
<!--                          -->
function clearIT(id) {
	var itemID   = document.getElementById(id);
	var itemVAL  = itemID.value;
	var curCLASS = itemID.className;
	if(itemVAL == "Address or Zip/Postal Code" || itemVAL == "Search ..." || itemVAL == "enter code"){ itemID.value=''; itemID.className = curCLASS.replace('grey', 'black').replace('italic', ''); }
	if(itemVAL != "" || itemVAL != "Address or Zip/Postal Code" || itemVAL != "Search ..." || itemVAL != "enter code"){ itemID.className.replace('grey', 'black').replace('italic', '')}}
function fillIT(id, value) {
	var itemID  = document.getElementById(id);
	var itemVAL = value;
	var curCLASS = itemID.className;
	if(itemID.value == ""){ itemID.value = itemVAL; itemID.className = curCLASS.replace('black', 'grey italic'); }}

<!--                              -->
<!--  WTB.PHP GEO CODER FUNCTION  -->
<!--                              -->
var geocoder;
function codeAddress() {
	var address = document.getElementById("address").value;
	geocoder = new google.maps.Geocoder();
	if (geocoder) {
		geocoder.geocode({'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var LatLon = results[0].geometry.location;
				var checkMe = AddressCheck(LatLon);
					//document.addzip.submit();
			} else {
		 		msgCloser(2);
			}
	  	});
	}
}

function AddressCheck(latlon){
	var getBack;
	var radius = document.getElementById("radius").value;
	$.post( "inc/func.php?wtb=check&latlon="+latlon+"&radius="+radius, function( data ) {
		 var getBack = makeMap(data,latlon);
	});
}
function makeMap(data,latlon){
  if(data == 0 || data == 2){
	  $('#mask').css({'width':'100%','height':'100%'});
	 if(data == 0){
		 errorPopper("Unfortunately we don't have any locations in your area. Try increasing your search radius.");
	 } else {
		 errorPopper("Unfortunately we don't have any locations in your area.")
	 }
  } else {
	 document.addzip.subby.value=latlon;
	 document.addzip.submit();
  }
}


<!--                                    -->
<!--  W H E R E  T O  B U Y  S T U F F  -->
<!--                                    -->
$(function(){
	$('#wtb-radiusArrowShell').mouseover(function(){
		$('#wtb-radiusFly').css({'display':'inline'});
	}).mouseout(function(){
		$('#wtb-radiusFly').css({'display':'none'});
	})
})
function radIT(therad){
	$('#radius').val(therad+' miles');
	$('#wtb-radiusFly').css({'display':'none'});
}



<!--                                  -->
<!--    W A R R A N T Y  S T U F F    -->
<!--                                  -->

//----------------------------------------------------------------------------------------
//                                                                            BAGS SECTION
//----------------------------------------------------------------------------------------
$(function(){
	$('.warrbagsPIX').mouseover(function(){
		$(this).css({'opacity':1});
	}).mouseout(function(){
		$(this).css({'opacity':0});
	}).on('click',function(){
		var thisOne = $(this).attr('id');
		var thatOne = $(this).attr('src');
		var thePop  = thisOne+'-pop';
		$('#warr-bag-ms').css({'background-image':'url(img/bag_marquis-series_off.jpg)'});
		$('.warr-colorPop').css({'opacity':0,'top':'-250px'});
		$('.warrbagSelected').html('');
		$('#warr-bag-fs').css({'background-image':'url(img/bag_freestone-series_off.jpg)'});
		$('#warr-bag-cs').css({'background-image':'url(img/bag_crystal-series_off.jpg)'});
		$('#warr-bag-mm').css({'background-image':'url(img/bag_marquis-magic_off.jpg)'});
		$('#warr-'+thisOne).css({'background-image':'url('+thatOne+')'});
		$('#prodSelect').val('');
		colorPOP(thePop);
	})
	$('.warrRow').on('click',function(){
		$('#warr-bag-'+$(this).attr('id')).html(this.innerHTML);
		$('.warr-colorPop').css({'opacity':0,'top':'-250px'});
		$('#prodSelect').val($(this).attr("name"));
		$('#prodSeries').val($(this).attr("id").replace("-selected",""));
	})
})
// color options pop-up menu
function colorPOP(thediv) {
	$('#'+thediv).css({'opacity':1,'top':'25px'});
}
//----------------------------------------------------------------------------------------
//                                                                       SUBMIT FORM STUFF
//----------------------------------------------------------------------------------------
$(document).ready(function(){
	$(document).on('click','#warrButt',function(){
		warrButt()
	})
})
// they clicked the submit button, check for required info
function warrButt(){
	// scrollME errors
	scrollME = "";
	// email validation regEx
	var valid = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	// terms & conditions not agreed
	if($("#tNc").prop('checked') == false){
		scrollME = "#caEmail";
		errorPopper("You must read and agree with our Warranty Terms & Conditions before submitting your warranty form.");
		return false; }
	// no product selected
	if($('#prodSelect').val() == ""){
		scrollME = "#fullDivide";
		errorPopper("You must select the product you for which<br />you are filling out our Warranty Form.");
		return false; }
	// check for one (or both) Homeowner Email or Phone
	if($("#hoEmail").val() == ""){
		if($('#hoPhone').val() == ""){
			scrollME = "#warr-bag-ms-selected";
			errorPopper("You must enter either a Homeowner<br />Phone Number or Email Address.");
			return false; }
	} else {
		// homeowner email address has been entered, make sure it's properly formatted
		if(!valid.test($('#hoEmail').val())){
			// invalid email error message
			scrollME = "#warr-bag-ms-selected";
			errorPopper("Please make sure the Homeowner Email Address<br />you provided is properly formatted.");
			return false; }
	}
	// check for one (or both) Contractor/Applicator Email or Phone
	if($("#caEmail").val() == ""){
		if($('#caPhone').val() == ""){
			scrollME = "#warr-bag-ms-selected";
			errorPopper("You must enter either a Contractor/Applicator<br />Phone Number or Email Address.");
			return false; }
	} else {
		// contractor/applicator email address has been entered, make sure it's properly formatted
		if(!valid.test($('#caEmail').val())){
			// invalid email error message
			scrollME = "#warr-bag-ms-selected";
			errorPopper("Please make sure the Contractor/Applicator<br />Email Address you provided is properly formatted.");
			return false; }
	}
	// project type not entered
	if(!$("input:radio[name='project']").is(":checked")){
		scrollME = "#warr-bag-ms-selected";
		errorPopper("Please make sure to indicate the Project Type.");
		return false; }
	// check for empty fields
	$('#form .txtReq').each(function(){
		if($(this).val() == ''){
			scrollME = "#warr-bag-ms-selected";
			errorPopper("Please make sure to fill out the entire form.");
			return false; }
	})
	// if there are no errors, fire off the form processor function
	if(scrollME == ""){
		processForm(); }
}

// no errors, process the form
function processForm(){
	$(function(){
		$.post("inc/func.php?warranty", $('#form').serialize(), function(data){
			if(data != "0"){
				gotoLink = "index.php";
				errorPopper("Thank you, your warranty has been submitted.<br /><br />Your confirmation number is <span class='blue s20'>PMM"+data+"</span><br /><br/><span class='gray s10'>You will need your confirmation number in the event of a waranty claim.</span><div class=\"Echeck\"><div style=\"padding:0px 5px 0 0; float:left;\"><input type=\"checkbox\" id=\"emailSend\" onchange=\"processFormEmailSend("+data+")\" /></div><span class='Email black s12'>Email me a copy of my Warranty Registration and Confirmation Number</span></div><div class=\"clear\"></div>");
			} else {
				errorPopper("Something went wrong. Please try again.<br /><br />If you are continuing to get this message please<br />contact our customer support team for assistance.<br /><br /><span class='blue'>We apologize for the inconvenience.</span>");
			}
		})
	})
}

// Email Selection
function processFormEmailSend(conNum){
	$( "#errorPopShell" ).fadeOut("fast");
			var ischeck = document.getElementById("emailSend").checked;
			var ContractorEmail = document.getElementById("caEmail").value;
			var homeEmail = document.getElementById("hoEmail").value;
			var msg = "";
			var Emails = "";
			var colspan ="";
			var skip = 0;
			
			if(ContractorEmail != "" && homeEmail == ""){
				$.post("inc/func.php?warrantyEmail", {ContractorEmail: ContractorEmail, conNum: conNum}, function(data){
					if(data == "1"){
						document.location.href = "index.php";
					} else {
						errorPopper("Something went wrong. <br /><br />Please contact our customer support team for assistance.<br /><br /><span class='blue'>We apologize for the inconvenience.</span>");
					}
				})	
				skip = 1;
			} else if (ContractorEmail == "" && homeEmail != ""){
				$.post("inc/func.php?warrantyEmail", {homeEmail: homeEmail, conNum: conNum}, function(data){
					if(data == "1"){
						document.location.href = "index.php";
					} else {
						errorPopper("Something went wrong. <br /><br />Please contact our customer support team for assistance.<br /><br /><span class='blue'>We apologize for the inconvenience.</span>");
					}
				})
				skip = 1;	
			}
			
			if(ischeck == true && skip == 0){

				$('#errorPopClose').css({'display':'none'});
				$('#emailPopSend').css({'display':'block'});
				Emails += "<tr>";	
				if(ContractorEmail != ""){
					Emails += "<td><div class=\"EmailList\"><div style=\"padding:1px 5px 0 0; float:left;\"><input type=\"checkbox\" id=\"cEmail\" name=\"cEmail\" checked/></div><span class='Email black s12'>"+ContractorEmail+"</span>";
					Emails += "<input id=\"ContractorEmail\" name=\"ContractorEmail\" type=\"hidden\" value=\""+ContractorEmail+"\"/></div></td>";
				}
				if(homeEmail != ""){
					Emails += "<td><div class=\"EmailList\"><div style=\"padding:1px 5px 0 0; float:left;\"><input type=\"checkbox\" id=\"hEmail\" name=\"hEmail\" checked/></div><span class='Email black s12'>"+homeEmail+"</span>";
					Emails += "<input id=\"homeEmail\" name=\"homeEmail\" type=\"hidden\" value=\""+homeEmail+"\"/></div></td>";
				}
				Emails += "</tr>";
				
				if(ContractorEmail != "" && homeEmail != ""){
					var msg = "<span>Which Email Addresses would you like to use?</span>";
					Emails += "<input id=\"onlyOne\" name=\"onlyOne\" type=\"hidden\" value=\"0\"/>"
					Emails += "<tr><td colspan=\"2\" align=\"center\"><div style=\"width:225px; height:30px\"><div id=\"otherCheck\" class='red s10' style=\"float:right; height:12px\"></div><div style=\"clear:both\"></div><div><span class='grayD s12'>Other Email: </span><input onblur=\"Efill()\" type=\"text\" id=\"otherEmail\" name=\"otherEmail\"></div></div></td></tr>";
				} else if(ContractorEmail == "" && homeEmail == "") {
					var msg = "<span>Which Email Address would you like to use?</span>";
					Emails += "<input id=\"onlyOne\" name=\"onlyOne\" type=\"hidden\" value=\"1\"/>"
					Emails += "<tr><td align=\"center\"><div style=\"width:225px; height:30px\"><div id=\"otherCheck\" class='red s10' style=\"float:right; height:12px\"></div><div style=\"clear:both\"></div><div><input onblur=\"Efill()\" type=\"text\" id=\"otherEmail\" name=\"otherEmail\"></div></div></td></tr>";
				}
				Emails += "<input id=\"conNum\" name=\"conNum\" type=\"hidden\" value=\""+conNum+"\"/>";
				setTimeout(function(){
					errorPopper(msg+"<div id=\"emailPopDiv\"><table border=\"0\" align=\"center\">"+Emails+"</table></div>");
					//var newWidth = document.getElementById("emailPopDiv").offsetWidth	
				},1000);
				//alert(newWidth);
				$( "#errorPopShell" ).fadeIn("slow");
					
			}
}
// check other email, email the warranty form
function Efill(){
	var otherEmailCheck = document.getElementById("otherEmail").value;
	var otherVal =  validateEmailForm(otherEmailCheck);	
	if(otherVal == false && otherEmailCheck != ""){
		document.getElementById("otherCheck").innerHTML  = "Invalid Email Address";
	} else {
		document.getElementById("otherCheck").innerHTML  = "";
	}
}
// scrollTo function
function scrollIT(location){
	$('html,body').animate({ scrollTop: $(location).offset().top }, 'fast');
}

// there are errors, open the error pop-up msg window
function errorPopper(errorMSG){
	// get the dimensions of the browser window for the error msg pop-up window
	height = $('#dummy').height();
	width  = $('#dummy').width();
	// put the error msg in the pop-up window
	$('#errorPopMSG').html(errorMSG);
	$('#errorPopCover').css({'width':width,'height':height,'opacity':1});
	// get the height of the msg window and position it properly
	var popHeight = $('#errorPopShell').height();
	var popOffset = (height/2)-(popHeight/2);
	$('#errorPopShell').css({'display':'block','margin-top':popOffset});
}
// close the error pop-up msg window
/*$(function(){
	$('#errorPopClose').on('click', function(){
		$('#errorPopCover').css({'opacity':0});
		$('#errorPopShell').css({'margin-top':0});
		setTimeout(function(){
			$('#errorPopCover').css({'width':0,'height':0});
			$('#errorPopShell').css({'display':'none'});
			if(typeof gotoLink != 'undefined'){
				document.location.href = gotoLink; }
			else if(typeof scrollME != 'undefined'){
				$('html,body').animate({ scrollTop: $(scrollME).offset().top }, 'fast'); }
		}, 300);
		
	})
})*/
$("#errorPopClose").click(errorPopClose);
function errorPopClose(){
	$('#errorPopCover').css({'opacity':0});
			$('#errorPopShell').css({'margin-top':0});
			setTimeout(function(){
				$('#errorPopCover').css({'width':0,'height':0});
				$('#errorPopShell').css({'display':'none'});
				if(typeof gotoLink != 'undefined'){
					document.location.href = gotoLink; }
				else if(typeof scrollME != 'undefined'){
					$('html,body').animate({ scrollTop: $(scrollME).offset().top }, 'fast'); }
			}, 300);	
}

$("#emailPopSend").click(emailPopSend);
function emailPopSend (){
		var otherEmail = document.getElementById("otherEmail").value;
		var onlyOne = document.getElementById("onlyOne").value;
		var vali = validateEmailForm(otherEmail)
		var whatToSend = '';
		if(onlyOne == 1){
			 if(otherEmail == "" || vali == false){
			 	$( "#secondPop" ).effect( "shake", {times:4,direction: "left"}, 300);	 
			 } else {
				 SendEmail(1);
			 }
		} else {
			var homeIsCheck = document.getElementById("hEmail").checked;
			var contIsCheck = document.getElementById("cEmail").checked;
				if(homeIsCheck == true || contIsCheck == true || otherEmail != ""){
					 if(otherEmail != "" && vali == false){
						$( "#secondPop" ).effect( "shake", {times:4,direction: "left"}, 300);
					 } else {
						SendEmail(2);	 
					 }
				} else {
					$( "#secondPop" ).effect( "shake", {times:4,direction: "left"}, 300);
				}
		}
}

function SendEmail(stepToTake){
	$('#mask').css({'width':'100%','height':'100%'});
	var conNum = document.getElementById("conNum").value;
	if(stepToTake == 1){
		var otherEmail = document.getElementById("otherEmail").value;		
		
		$.post("inc/func.php?warrantyEmail", {otherEmail: otherEmail, conNum: conNum}, function(data){
			if(data == "1"){
			errorPopper("Email was successfully sent");
				$('#errorPopClose').css({'display':'block'});
				$('#emailPopSend').css({'display':'none'});
				$('#mask').css({'width':0,'height':0});
			} else {
			errorPopper("Something went wrong. <br /><br />Please contact our customer support team for assistance.<br /><br /><span class='blue'>We apologize for the inconvenience.</span>");
				$('#errorPopClose').css({'display':'block'});
				$('#emailPopSend').css({'display':'none'});
				$('#mask').css({'width':0,'height':0});
			}
		})
	} else {;
		var ContractorEmail = document.getElementById("ContractorEmail").value;
		var homeEmail = document.getElementById("homeEmail").value;
		var otherEmail = document.getElementById("otherEmail").value;
		
		$.post("inc/func.php?warrantyEmail", {ContractorEmail: ContractorEmail, homeEmail: homeEmail, otherEmail: otherEmail, conNum: conNum}, function(data){
			
			if(data == "1"){
			errorPopper("Email was successfully sent");
				$('#errorPopClose').css({'display':'block'});
				$('#emailPopSend').css({'display':'none'});
				$('#mask').css({'width':0,'height':0});
			} else {
			errorPopper("Something went wrong. <br /><br />Please contact our customer support team for assistance.<br /><br /><span class='blue'>We apologize for the inconvenience.</span>");
				$('#errorPopClose').css({'display':'block'});
				$('#emailPopSend').css({'display':'none'});
				$('#mask').css({'width':0,'height':0});
			}
		})
	}
}

// email validation check
function validateEmailForm(emailVali){
var atpos=emailVali.indexOf("@");
var dotpos=emailVali.lastIndexOf(".");
	if (atpos<1 || dotpos<atpos+2 || dotpos+2>=emailVali.length){
	  return false;
	} else {
		return true;	
	}
}
