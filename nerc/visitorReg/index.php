<?php
    /* at the top of 'check.php' */
    if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
        /* 
           Up to you which header to send, some prefer 404 even if 
           the files does exist for security
        */
        //header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );

        /* choose the appropriate page to redirect users */
        //die( header( 'location: ../registration.html' ) );

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
			#otherInstituteType{
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

		</style>
		
	</head>
	<body>
		<div class='header'>
			<img src="../images/header.JPG">
		</div>
		<form id="visitorForm" class="visitorForm" action="saveVisitorDetails.php" method="post" enctype="multipart/form-data">
		<!------------------ACTUAL VARIABLES TO POST TO PHP SCRIPT-------------------------------->
		<input type="hidden" name="post_instituteName" id="post_instituteName" value=""/>
		<input type="hidden" name="post_instituteType" id="post_instituteType" value=""/>
		<input type="hidden" name="post_state" id="post_state" value=""/>
		<input type="hidden" name="post_city" id="post_city" value=""/>
		<input type="hidden" name="post_address" id="post_address" value=""/>
		<input type="hidden" name="post_contactName" id="post_contactName" value=""/>
		<input type="hidden" name="post_contactPhone" id="post_contactPhone" value=""/>
		<input type="hidden" name="post_contactDesig" id="post_contactDesig" value=""/>
		<input type="hidden" name="post_standard" id="post_standard" value=""/>
		<input type="hidden" name="post_email" id="post_email" value=""/>
		<input type="hidden" name="post_atl" id="post_atl" value=""/>

		



		<!------------------FIRST PAGE-------------------------------->
		<!-- <div class='page' id='page_1'>

			<h2>Select Registration Mode</h2>
			<div class='formGrp'><input type='radio' name='regFor[]' value='self' id='self' onclick='populatePage3("self")'><label for='self' style="display:inline; width: 100%">I am registering for myself</label></div>
			<div class='formGrp'><input type='radio' name='regFor[]' value='institute' id='institute' onclick='populatePage3("institute")'><label for='institute' style="display:inline; width: 100%">I am registering on behalf of Institute/University/Central Organizations</label></div>

			<div class='btnGrp'>
				<button type='button' onclick='goBack(this);'>Back</button>
				<button type='button' onclick='proceed(this);'>Proceed</button>
			</div>

		</div> -->

		<!------------------SECOND PAGE-------------------------------->
		<div class='page' id='page_2'>

			<h2>Visiting Registration for Schools / Colleges</h2>


			<div class='formGrp'><label for='instituteName'>Enter Institute Name:</label><input type="text" name='instituteName' id='instituteName' maxlength="140" /></div>
			<div class='formGrp'>
				<label for='email'>Select Institute Type:</label>
				<select name='instituteType' id='instituteType' onchange='checkSelectOther(this)'>
					<option value="" selected disabled >Select Type</option>
					<option value='School'>School</option>
					<option value='Junior College'>Junior College</option>
					<option value='Degree College'>Degree College</option>
					<option value='Others'>Others</option>
				</select>
			</div>
			<div class='formGrpOther'><input type="text" name="otherInstituteType" id="otherInstituteType" placeholder="Enter Other Type" maxlength="50"></div>
			<p class='radioQues' style="font-weight: bold;text-decoration: underline;">Enter Location:</p>
			<div class='formGrp'><label for='state'>Enter State:</label><input type="text" name='state' id='state' maxlength="100" /></div>
			<div class='formGrp'><label for='city'>Enter Town/City:</label><input type="text" name='city' id='city' maxlength="100" /></div>
			<div class='formGrp'><label for='address'>Enter Address:</label><input type="text" name='address' id='address' maxlength="200" /></div>
			
			

			<div class='formGrp'><label for='contactName'>Enter Contact Person Name:</label><input type="text" name='contactName' id='contactName' maxlength="50" /></div>
			<div class='formGrp'><label for='contactPhone'>Enter Contact Person Mobile No.:</label><input type="text" name='contactPhone' id='contactPhone' maxlength="15"/></div>
			<div class='formGrp'><label for='contactDesig'>Enter Contact Person Designation:</label><input type="text" name='contactDesig' id='contactDesig' maxlength="50"/></div>
			
			<p class='radioQues'>Standards (select one or more) :</p>
					<div class='formGrp yesNo'><input type='checkbox' name='standard[]' value='8th' id='standard1'/>	<label for='standard1'>8th</label></div>
					<div class='formGrp yesNo'><input type='checkbox' name='standard[]' value='9th' id='standard2'/>	<label for='standard2'>9th</label></div>
					<div class='formGrp yesNo'><input type='checkbox' name='standard[]' value='10th' id='standard3'/>	<label for='standard3'>10th</label></div>
					<div class='formGrp yesNo'><input type='checkbox' name='standard[]' value='11th' id='standard4'/>	<label for='standard4'>11th</label></div>
					<div class='formGrp yesNo'><input type='checkbox' name='standard[]' value='12th' id='standard5'/>	<label for='standard5'>12th</label></div>
					<div class='formGrp yesNo'><input type='checkbox' name='standard[]' value='Pursuing' id='standard6'/>	<label for='standard6'>College Student</label></div>

			<p class='radioQues'>Is your Institution a part of "Atal Tinkering Lab" :</p>
					<div class='formGrp yesNo'><input type='radio' name='atalTinkeringLab[]' value='Yes' id='atalTinkeringLabY'/>	<label for='atalTinkeringLabY'>Yes</label></div>
					<div class='formGrp yesNo'><input type='radio' name='atalTinkeringLab[]' value='No' id='atalTinkeringLabN'/>	<label for='atalTinkeringLabN'>No</label></div>

			<div class='formGrp'><label for='email'>Enter Email</label><input type='text' name='email' id='email' maxlength='100' pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"></div>
			<div class='formGrp'><label for='emailRpt'>Confirm Email Address</label><input type='text' id='emailRpt'></div>
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
			
			if(id==='instituteType' && val==='Others'){
				document.getElementById('otherInstituteType').style.display = 'block';
			}
			else if(id==='instituteType' && val!=='Others'){
				document.getElementById('otherInstituteType').style.display = 'none';
			}
		}
		

		function goBack(btn){
			
			window.location.href = '../registration.html';
			
		}

		function proceed(btn){			

				var post_standard = "";
				var post_atl = "";
			//----------VALIDATION-------------------//

				var instituteName = document.getElementById('instituteName');
				var instituteType = document.getElementById('instituteType');
				var otherInstituteType = document.getElementById('otherInstituteType');
				var state = document.getElementById('state');
				var city = document.getElementById('city');
				var address = document.getElementById('address');

				var contactName = document.getElementById('contactName');
				var contactPhone = document.getElementById('contactPhone');
				var contactDesig = document.getElementById('contactDesig');

				var standardArr = document.getElementsByName('standard[]');
				var atalTinkeringLabArr = document.getElementsByName('atalTinkeringLab[]');
				
				var email = document.getElementById('email').value;
				var emailRpt = document.getElementById('emailRpt').value;
				var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
				
				 	
				 	if(instituteName.value===""){
				 		alert("Enter Institute Name");
						instituteName.focus();
						return;
				 	}
				 	if(instituteType.value==="" || instituteType.value==="Others"){
				 		if(instituteType.value===""){
					 		alert("Enter Institute Type");
							instituteType.focus();
							return;
				 		}
				 		else if(instituteType.value==="Others" && otherInstituteType.value===''){
				 			alert("Enter Other Institute Type");
							otherInstituteType.focus();
							return;
				 		}
				 	}



				 	if(state.value===""){
				 		alert("Enter state");
						state.focus();
						return;
				 	}
				 	if(city.value===""){
				 		alert("Enter city");
						city.focus();
						return;
				 	}
				 	if(address.value===""){
				 		alert("Enter address");
						address.focus();
						return;
				 	}
				 	if(contactName.value===""){
				 		alert("Enter Contact Person Name.");
						contactName.focus();
						return;	
				 	}
				 	if(contactPhone.value===""){
				 		alert("Enter Contact Person Mobile.");
						contactPhone.focus();
						return;	
				 	}
				 	if(contactDesig.value===""){
				 		alert("Enter Contact Person Designation.");
						contactDesig.focus();
						return;	
				 	}

				var flag1 = 0;
				for (var i = 0; i < standardArr.length; i++) {
					if(standardArr[i].checked){
						++flag1;
						post_standard = (post_standard==="")? standardArr[i].value : post_standard+";"+standardArr[i].value;
					}
				}
				if(flag1===0){
					alert('Please select atleast one standard');
					standardArr[0].focus();
					return;
				}

				var flag2 = 0;
				for (var i = 0; i < atalTinkeringLabArr.length; i++) {
					if(atalTinkeringLabArr[i].checked){
						++flag2;
						post_atl = atalTinkeringLabArr[i].value;
					}
				}
				if(flag2===0){
					alert('Please select whether involved with Atal Tinkering Lab');
					atalTinkeringLabArr[0].focus();
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

				
				
				document.getElementById('post_instituteName').value = instituteName.value;

				if(!instituteType.value==="Others"){
					document.getElementById('post_instituteType').value = instituteType.value;
				}else{
					document.getElementById('post_instituteType').value = otherInstituteType.value;
				}
				
				document.getElementById('post_state').value = state.value;
				document.getElementById('post_city').value = city.value;
				document.getElementById('post_address').value = address.value;
				document.getElementById('post_contactName').value = contactName.value;
				document.getElementById('post_contactPhone').value = contactPhone.value;
				document.getElementById('post_contactDesig').value = contactDesig.value;
				document.getElementById('post_standard').value = post_standard;
				document.getElementById('post_atl').value = post_atl;
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