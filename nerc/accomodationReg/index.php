<?php
    /* at the top of 'check.php' */
    if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
        /* 
           Up to you which header to send, some prefer 404 even if 
           the files does exist for security
        */
        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );

        /* choose the appropriate page to redirect users */
        die( header( 'location: ../accommodation.html' ) );

        error_reporting(E_ALL);
		ini_set("display_errors", 1);

    }
?>


<!DOCTYPE html>
<html>
	<head>


		<style type="text/css">
			*{
				box-sizing: border-box;
				padding: 0;
				margin: 0;
				font-family: 'Jost',sans-serif;
				font-size: 1.1rem;
				color: #333;
				
			}
			body{
				width: 100vw;
				height: 100vh;
				position: absolute;
				overflow-x: hidden;
				background: url("../images/research conclave_back.jpg") no-repeat fixed center;
				background-blend-mode: inherit;
				/*background-size: 182vh;*/
				background-size: cover;
			}
			body > div{
				

			}

			.header{
				/*background: url("../images/header.JPG") no-repeat fixed center;*/
				background-blend-mode: inherit;
				/*background-size: 182vh;*/
				background-size: cover;
			}
			.header > h1{
				padding: 20px 0;
				margin-left: 50%;
				transform: translateX(-50%);
			}

			.header img{
			  position: relative;
			  width: 100vw;
			  height: 197px;
			}

			.footer{
				position: relative;
				top:auto;
				width: 100vw;
				bottom: 0;
				background: #fff;
				padding-top: 50px;
			}

			.footer img{
				margin-left: 75%;
				transform: translateX(-58%);
			}

			h2{
				margin-bottom: 40px;
			}

			h3{
				margin-bottom: 40px;
				text-decoration: underline;
			}

			.page{
				display: none;
				margin-top: 20vh;
				margin-left: 50%;
				transform: translateX(-50%);
				width: 55vw;
				height: calc(100% - 50px);
				height: fit-content;
				padding: 4%;
				border: 1px solid black;
				margin-bottom: 20vh;
			}
			.page .formGrp{
				
			    display: flex;
			    width: 100%;
			    margin: 30px 0;
			    flex-direction: row;
			    flex-wrap: nowrap;
			    align-content: space-around;
			    justify-content: space-between;
			    align-items: stretch;

			}
			.page .formGrpOther{
				width: 100%;
				margin-top: 10px;
				margin-bottom: 30px;
			}
			/*#page_1{
				display: block;
			}*/
			#page_2{
				display: block;
			}

			.btnGrp {
				display: flex;
				flex-direction: row;
				justify-content: flex-start;
				align-items: baseline;
				margin-top: 20px;
			}
			.btnGrp button{
				padding: 5px;
				border: none;
				color: #ccc;
				background-color: #4e4565;
			}
			.btnGrp button:nth-of-type(2){
				margin-left: 40px;
				background-color: #4e4510;
			}

			.subFormDiv{
				display: none;
				/*border: 1px solid #ccc;
    			padding: 70px;*/
    			margin-bottom: 68px;
			}

			select{
				width: 33%;
				/*width: auto;*/
    			max-width: 50%;
    			position: absolute;
    			left: 50%;
			}

			#otherTitle{
				display: none;
			}
			#otherParticipationType{
				display: none;
			}
			#submitBtn{
				background-color: green;
			}

			.formGrp input[type="text"], .formGrp input[type="password"], .formGrp input[type="file"]{
				position: absolute;
    			left: 50%;
			}

			.formGrp input[type="radio"] {
			  margin: 0 16px;
			}

			.formGrp textarea{
			  /*margin-left: 50%;*/
			  position: relative;
			  /*transform: translateY(-100%);*/
			  width: 50%;
			  resize: none;
			}

			.formGrp.yesNo {
			  margin-left: 50%;
			  position: relative;
			  top: -50px;
			  display: block;
			}

			.formGrp label, p{
				width: 40%;
			    display: inline-block;
			    word-break: break-word;
			    text-align: left;
			    font-size: 1rem;
			}

			.radioQues{
				width: 40%;
			    display: inline-block;
			    word-break: break-word;
			    text-align: left;
			}

			.subFormDiv table{
				margin:  50px 0;
			}

			.subFormDiv table td input{
				/*width: 125px;*/
				width: 100%;
			}

			#mopPanelDiv .formGrp{
				margin-left: unset;
				display: flex;
			    align-content: center;
			    align-items: baseline;
			    justify-content: space-around;
			}

			#mopPanelDiv .radioQues{
				margin-bottom: 37px;
				width: 100%;
				text-decoration: underline;
			}

			#mopPanelDiv .formGrp label{
				width: 90%;
			}

			.annxLink {
			  margin: 30px 0;
			  display: inline-block;
			  font-weight: bold;
			  color: #693fff;
			}

			.note{
				width: 100%;
				text-align: justify-all;
				font-size: 0.9rem;
			}
			.note strong{
				font-size: 0.9rem;
			}

		</style>
		
	</head>
	<body>
		<div class='header'>
			<img src="../images/header.JPG">
		</div>
		<form id="visitorForm" class="visitorForm" action="saveVisitorDetails.php" method="post" enctype="multipart/form-data">
		<!------------------ACTUAL VARIABLES TO POST TO PHP SCRIPT-------------------------------->
		<input type="hidden" name="post_participationType" id="post_participationType" value=""/>
		<input type="hidden" name="post_email" id="post_email" value=""/>
		<input type="hidden" name="post_contactName" id="post_contactName" value=""/>
		<input type="hidden" name="post_contactPhone" id="post_contactPhone" value=""/>
		<input type="hidden" name="post_instituteName" id="post_instituteName" value=""/>
		<input type="hidden" name="post_hotelAddress" id="post_hotelAddress" value=""/>
		<input type="hidden" name="post_flightTrainNo" id="post_flightTrainNo" value=""/>
		<input type="hidden" name="post_arrivalDate" id="post_arrivalDate" value=""/>
		<input type="hidden" name="post_pickupLocation" id="post_pickupLocation" value=""/>
		<input type="hidden" name="post_departureDate" id="post_departureDate" value=""/>
		<input type="hidden" name="post_dropLocation" id="post_dropLocation" value=""/>
		<input type="hidden" name="post_hotelToVenue" id="post_hotelToVenue" value=""/>




		<!------------------FIRST PAGE-------------------------------->
		<div class='page' id='page_2'>
			<h3>Accommodation and Transportation Portal</h3>
			<p class="note">
				<strong>Note 1:</strong> Participating students will be given accommodation inside IITG hostels on first cumfirst serve basis, as we have only limited number of hostel rooms. Visiting students will not be provided with any accommodation inside the IITG campus.<br/><br/>
				<strong>Note 2:</strong> Delegates and invitees staying at Guwahati hotels, may avail transport arrangement from their hotels to the venue (IITG). Bus or cab shuttles might be provided on a fixed schedule based on their requirement. <br/><br/>
				<strong>Note 3:</strong> Kindly provide your travel itinerary to avail Airport / Railway station pick up and drop service. Bus/cab shuttles might be arranged at regular intervals from the railway station/ airportbased on availability and requirement.Timing for the shuttle bus services will be updated in NERC accommodation website.<br/><br/>

			</p>

			<div class='formGrp'>
				<label for='participationType'>Select Registration Type:</label>
				<select name='participationType' id='participationType' onchange='checkSelectOther(this)'>
					<option value="" selected disabled >Select Type</option>
					<option value='Student Participant'>Student Participant</option>
					<option value='Delegates/ Invitees'>Delegates/ Invitees</option>
					<option value='Others'>Others</option>
				</select>
			</div>
			<div class='formGrpOther'><input type="text" name="otherParticipationType" id="otherParticipationType" placeholder="Enter Other Type" maxlength="50"></div>


			<div class='formGrp'><label for='contactName'>Enter Name:</label><input type="text" name='contactName' id='contactName' maxlength="150" /></div>
			<div class='formGrp'><label for='instituteName'>Enter Institute Name:</label><input type="text" name='instituteName' id='instituteName' maxlength="140" /></div>
			<div class='formGrp'><label for='contactPhone'>Enter Contact Number:</label><input type="text" name='contactPhone' id='contactPhone' maxlength="15"/></div>

			<div class='formGrp'><label for='email'>Enter Email</label><input type='text' name='email' id='email' maxlength='100' pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"></div>
			<div class='formGrp'><label for='emailRpt'>Confirm Email Address</label><input type='text' id='emailRpt'></div>

			<div class='formGrp'><label for='hotelAddress'>Booked Hotel (Name and Address):</label><input type="text" name='hotelAddress' id='hotelAddress' maxlength="200" /></div>
			<div class='formGrp'><label for='arrivalDate'>Arrival date and Time:</label><input type="text" name='arrivalDate' id='arrivalDate' maxlength="40" /></div>
			<div class='formGrp'><label for='flightTrainNo'>Arrival Flight/Train No.:</label><input type="text" name='flightTrainNo' id='flightTrainNo' maxlength="40" /></div>

			<p class='radioQues'>Pickup Location :</p>
					<div class='formGrp yesNo'><input type='radio' name='pickupLocation[]' value='Airport' id='pickup1'/>	<label for='pickup1'>Airport</label></div>
					<div class='formGrp yesNo'><input type='radio' name='pickupLocation[]' value='Railway Station' id='pickup2'/>	<label for='pickup2'>Railway Station</label></div>

			<div class='formGrp'><label for='arrivalDate'>Departure date and Time:</label><input type="text" name='departureDate' id='departureDate' maxlength="40" /></div>

			<p class='radioQues'>Drop-Off Location :</p>
					<div class='formGrp yesNo'><input type='radio' name='dropLocation[]' value='Airport' id='drop1'/>	<label for='drop1'>Airport</label></div>
					<div class='formGrp yesNo'><input type='radio' name='dropLocation[]' value='Railway Station' id='drop2'/>	<label for='drop2'>Railway Station</label></div>

			<p class='radioQues'>Transportation from Hotels to Venue (IITG campus):</p>
					<div class='formGrp yesNo'><input type='radio' name='hotelToVenue[]' value='Required' id='drop1'/>	<label for='drop1'>Required</label></div>
					<div class='formGrp yesNo'><input type='radio' name='hotelToVenue[]' value='Not Required' id='drop2'/>	<label for='drop2'>Not Required</label></div>

			<p class="note">In case of any queries regarding Accommodation contact: Dr Sharmila (9967380897);Dr Parijat (9432188546)<br/><br/>

				In case of any queries regarding Transportation contact: Dr Ashwini Sawant (9337995167). <br/><br/>

				You can also reach us at <strong>nerc_accommodation@iitg.ac.in</strong>.
			</p>


			<div class='btnGrp'>
				<button type='button' onclick='goBack(this);'>Back</button>
				<button type='button' id='submitBtn' onclick='proceed(this);'>Submit</button>
			</div>

		</div>


		

	</form>
	
	<div class='footer'>
			<img src="../images/footer.JPG">
		</div>

	<script>
		//Prevent form submission on window refresh
		if ( window.history.replaceState ) {
    	    window.history.replaceState( null, null, window.location.href );
	    }

	    

		function checkSelectOther(thisElem){
			var id = thisElem.id;
			var val = thisElem.value;
			if(id==='participationType' && val==='Others'){
				document.getElementById('otherParticipationType').style.display = 'block';			}
			else if(id==='participationType' && val!=='Others'){
				document.getElementById('otherParticipationType').style.display = 'none';
				document.getElementById('post_participationType').value = val;

			}
		}
		

		function goBack(btn){
			
			window.location.href = '../accomodation.html';
			
		}

		function proceed(btn){			

				var post_pickupLocation = "";
				var post_dropLocation = "";
				var post_hotelToVenue = "";

			//----------VALIDATION-------------------//

				
				var participationType = document.getElementById('participationType');
				var otherParticipationType = document.getElementById('otherParticipationType');
				
				var contactName = document.getElementById('contactName');
				var instituteName = document.getElementById('instituteName');
				var contactPhone = document.getElementById('contactPhone');

				var hotelAddress = document.getElementById('hotelAddress');
				var arrivalDate = document.getElementById('arrivalDate');
				var flightTrainNo = document.getElementById('flightTrainNo');

				var pickupLocation = document.getElementsByName('pickupLocation[]');
				var departureDate = document.getElementById('departureDate');
				var dropLocation = document.getElementsByName('dropLocation[]');
				var hotelToVenue = document.getElementsByName('hotelToVenue[]');

				
				
				var email = document.getElementById('email').value;
				var emailRpt = document.getElementById('emailRpt').value;
				var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
				
				 	
				 	
				 	if(participationType.value==="" || participationType.value==="Others"){
				 		if(participationType.value===""){
					 		alert("Enter Participation Type");
							participationType.focus();
							return;
				 		}
				 		else if(participationType.value==="Others" && otherParticipationType.value===''){
				 			alert("Enter Other Participation Type");
							otherParticipationType.focus();
							return;
				 		}
				 	}

				 	if(contactName.value===""){
				 		alert("Enter Name.");
						contactName.focus();
						return;	
				 	}
				 	if(contactPhone.value===""){
				 		alert("Enter Mobile.");
						contactPhone.focus();
						return;	
				 	}
				 	if(instituteName.value===""){
				 		alert("Enter Institute Name");
						instituteName.focus();
						return;
				 	}

				 	if(hotelAddress.value===""){
				 		alert("Enter Hotel Name and Address");
						hotelAddress.focus();
						return;
				 	}
				 	if(arrivalDate.value===""){
				 		alert("Enter Arrival Date and Time");
						arrivalDate.focus();
						return;
				 	}
				 	if(flightTrainNo.value===""){
				 		alert("Enter Flight/Train No.");
						flightTrainNo.focus();
						return;
				 	}
				 	
				 	if(departureDate.value===""){
				 		alert("Enter Departure Date and Time.");
						departureDate.focus();
						return;	
				 	}

				var flag1 = 0;
				for (var i = 0; i < pickupLocation.length; i++) {
					if(pickupLocation[i].checked){
						++flag1;
						post_pickupLocation = pickupLocation[i].value;
					}
				}
				if(flag1===0){
					alert('Please select Pickup Location');
					pickupLocation[0].focus();
					return;
				}

				var flag2 = 0;
				for (var i = 0; i < dropLocation.length; i++) {
					if(dropLocation[i].checked){
						++flag2;
						post_dropLocation = dropLocation[i].value;
					}
				}
				if(flag2===0){
					alert('Please select Drop Location');
					dropLocation[0].focus();
					return;
				}

				var flag3 = 0;
				for (var i = 0; i < hotelToVenue.length; i++) {
					if(hotelToVenue[i].checked){
						++flag3;
						post_hotelToVenue = hotelToVenue[i].value;
					}
				}
				if(flag3===0){
					alert('Please select whether Transportation from Hotel to Venue (IITG) is required.');
					hotelToVenue[0].focus();
					return;
				}


				

				if(!email.match(mailformat)){
					alert("Please enter valid email");
					return;
				}
				if(email==="" || emailRpt===""){
					alert("Please enter both emails");
					return;
				}
				if(email!==emailRpt){
					alert('Emails entered do not match');
					return;
				}

				
				
				
				/*if(!participationType.value==="Others"){
					document.getElementById('post_participationType').value = participationType.value;
				}else{
					document.getElementById('post_participationType').value = otherParticipationType.value;
				}*/
				if(participationType.value==="Others"){
					document.getElementById('post_participationType').value = otherParticipationType.value;
				}
				
				
				document.getElementById('post_contactName').value = contactName.value;
				document.getElementById('post_instituteName').value = instituteName.value;
				document.getElementById('post_contactPhone').value = contactPhone.value;

				document.getElementById('post_hotelAddress').value = hotelAddress.value;
				document.getElementById('post_arrivalDate').value = arrivalDate.value;
				document.getElementById('post_flightTrainNo').value = flightTrainNo.value;

				document.getElementById('post_departureDate').value = departureDate.value;

				document.getElementById('post_pickupLocation').value = post_pickupLocation;
				document.getElementById('post_dropLocation').value = post_dropLocation;
				document.getElementById('post_hotelToVenue').value = post_hotelToVenue;

				document.getElementById('post_email').value = email;

				
				
				//-----------POPULATE MAIN POST FIELDS END--------------//

				if (confirm("Are you sure?") == true) {
					submitForm();
				}else{
					return;
				}
		}


		//FUNCTION TO SUBMIT THE FORM
		function submitForm(){
			document.getElementById('submitBtn').disabled = true;
			document.getElementById('visitorForm').submit();
		}





	</script>

	</body>
</html>