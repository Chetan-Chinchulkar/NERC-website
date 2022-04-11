<?php
    /* at the top of 'check.php' */
    if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
        /* 
           Up to you which header to send, some prefer 404 even if 
           the files does exist for security
        */
        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );

        /* choose the appropriate page to redirect users */
        die( header( 'location: ../registration.html' ) );

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
				transition: all 0.5s ease-in;
			}
			body{
				width: 100vw;
				height: 100vh;
				position: absolute;
				overflow-x: hidden;
				background: url("../images/research conclave_back.jpg") no-repeat fixed center;
				background-blend-mode: inherit;
				background-size: 182vh;
			}
			body > div{
				

			}

			.header{
				/*background: url("../images/header.JPG") no-repeat fixed center;*/
				background-blend-mode: inherit;
				background-size: 182vh;
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
				display: block;
				width: 100%;
				margin: 30px 0;
			}
			.page .formGrpOther{
				width: 100%;
				margin-top: 10px;
				margin-bottom: 30px;
			}
			#page_1{
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
				border: 1px solid #ccc;
    			padding: 70px;
    			margin-bottom: 68px;
			}

			select{
				width: 20%;;
    			max-width: 50%;
    			position: absolute;
    			left: 50%;
			}

			#otherTitle{
				display: none;
			}
			#otherDesig{
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
			  margin-left: 50%;
			  position: relative;
			  /*transform: translateY(-100%);*/
			  width: 50%;
			  resize: none;
			}

			.formGrp.yesNo {
			  margin-left: 50%;
			  position: relative;
			  top: -50px;
			}

			.formGrp label{
				width: 40%;
			    display: inline-block;
			    word-break: break-word;
			    text-align: left;
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
				width: 125px;
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
		<form id="regForm" class="regForm" action="saveRegDetails.php" method="post" enctype="multipart/form-data">
		<!------------------ACTUAL VARIABLES TO POST TO PHP SCRIPT-------------------------------->
		<input type="hidden" name="post_regMode" id="post_regMode" value=""/>
		<input type="hidden" name="post_email" id="post_email" value=""/>
		<input type="hidden" name="post_pwdInput" id="post_pwdInput" value=""/>
		<input type="hidden" name="post_title" id="post_title" value=""/>
		<input type="hidden" name="post_firstName" id="post_firstName" value=""/>
		<input type="hidden" name="post_surName" id="post_surName" value=""/>
		<input type="hidden" name="post_desig" id="post_desig" value=""/>
		<input type="hidden" name="post_dept" id="post_dept" value=""/>
		<input type="hidden" name="post_affiliation" id="post_affiliation" value=""/>
		<input type="hidden" name="post_sector" id="post_sector" value=""/>
		<input type="hidden" name="post_nationality" id="post_nationality" value=""/>
		<input type="hidden" name="post_phone" id="post_phone" value=""/>
		<input type="hidden" name="post_accomodationReqd" id="post_accomodationReqd" value=""/>
		<input type="hidden" name="post_transportationReqd" id="post_transportationReqd" value=""/>
		<input type="hidden" name="post_otherRequirement" id="post_otherRequirement" value=""/>
		<input type="hidden" name="post_modeOfParticipation" id="post_modeOfParticipation" value=""/>
		<input type="hidden" name="post_participationRole" id="post_participationRole" value=""/>
		<input type="hidden" name="post_sessionType" id="post_sessionType" value=""/>
		<input type="hidden" name="post_techSessOrTheme" id="post_techSessOrTheme" value=""/>
		<input type="hidden" name="post_lectureTitle" id="post_lectureTitle" value=""/>
		<input type="hidden" name="post_lectureDescOrAbstract" id="post_lectureDescOrAbstract" value=""/>
		<input type="hidden" name="post_slotsReqd" id="post_slotsReqd" value=""/>
		<input type="hidden" name="post_abstractFilePath" id="post_abstractFilePath" value=""/>

		<input type="hidden" name="post_powerRqmt" id="post_powerRqmt" value=""/>
		<input type="hidden" name="post_OtherRqmt" id="post_OtherRqmt" value=""/>
		<input type="hidden" name="post_schoolAddress" id="post_schoolAddress" value=""/>
		<input type="hidden" name="post_letterFile" id="post_letterFile" value=""/>
		<input type="hidden" name="post_productName" id="post_productName" value=""/>
		<input type="hidden" name="post_grants" id="post_grants" value=""/>
		<input type="hidden" name="post_pptType" id="post_pptType" value=""/>
		<input type="hidden" name="post_incubator" id="post_incubator" value=""/>
		<input type="hidden" name="post_qualification" id="post_qualification" value=""/>
		<input type="hidden" name="post_expYears" id="post_expYears" value=""/>
		<input type="hidden" name="post_cvFile" id="post_cvFile" value=""/>
		<input type="hidden" name="post_stmtPupose" id="post_stmtPupose" value=""/>
		<input type="hidden" name="post_dateOfVisit" id="post_dateOfVisit" value=""/>

		



		<!------------------FIRST PAGE-------------------------------->
		<div class='page' id='page_1'>

			<h2>Select Registration Mode</h2>
			<div class='formGrp'><input type='radio' name='regFor[]' value='self' id='self' onclick='populatePage3("self")'><label for='self' style="display:inline; width: 100%">I am registering for myself</label></div>
			<div class='formGrp'><input type='radio' name='regFor[]' value='institute' id='institute' onclick='populatePage3("institute")'><label for='institute' style="display:inline; width: 100%">I am registering on behalf of Institute/University/Central Organizations</label></div>
			<!-- <input type='radio' name='regFor[]' value='others' id='others' onclick='populatePage3("others")'><label for='others'>I am registering for myself and others</label> -->

			<div class='btnGrp'>
				<button type='button' onclick='goBack(this);'>Back</button>
				<button type='button' onclick='proceed(this);'>Proceed</button>
			</div>

		</div>

		<!------------------SECOND PAGE-------------------------------->
		<div class='page' id='page_2'>

			<h2>Registration</h2>
			<div class='formGrp'><label for='email'>Enter Email</label><input type='text' name='email' id='email' pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"></div>
			<div class='formGrp'><label for='emailRpt'>Confirm Email Address</label><input type='text' id='emailRpt'></div>

			<div class='formGrp'><label for='pwdInput'>Choose a Password</label><input type='password' name='pwdInput' id='pwdInput'></div>
			<div class='formGrp'><label for='pwdInputRpt'>Confirm Password</label><input type='password' id='pwdInputRpt'></div>
			<div class='btnGrp'>
				<button type='button' onclick='goBack(this);'>Back</button>
				<button type='button' onclick='proceed(this);'>Proceed</button>
			</div>

		</div>


		<!------------------THIRD PAGE-------------------------------->
		<div class='page' id='page_3'>

			<h2>Participant/Delegate Details</h2>
			
			<div class='formGrp'>
				<label for='title'>Enter Title:</label>
				<select name='title' id='title' onchange='checkSelectOther(this)'>
					<option value="" selected disabled>Select a title</option>
					<option value='Prof.'>Prof.</option>
					<option value='Dr.'>Dr.</option>
					<option value='Mr.'>Mr.</option>
					<option value='Mrs.'>Mrs.</option>
					<option value='Other'>Other</option>
				</select>
			</div>
			<div class='formGrpOther'><input type="text" name="otherTitle" id="otherTitle" placeholder="Enter Other Title"></div>
			<div class='formGrp'><label for='email'>Enter First Name</label><input type="text" name='firstName' id='firstName'/></div>
			<div class='formGrp'><label for='email'>Enter Sur Name</label><input type="text" name='surName' id='surName'/></div>
			<div class='formGrp'>
				<label for='email'>Select Appropriate Designation:</label>
				<select name='desig' id='desig' onchange='checkSelectOther(this)'>
					<option value="" selected disabled >Select a designation</option>
					<option value='Director'>Director</option>
					<option value='Managing Director'>Managing Director</option>
					<option value='Vice Chancelor'>Vice Chancelor</option>
					<option value='HOD'>HOD</option>
					<option value='HOC'>HOC</option>
					<option value='Professor'>Professor</option>
					<option value='Scientist'>Scientist</option>
					<option value='Student'>Student</option>
					<option value='Assoc. Professor'>Assoc. Professor</option>
					<option value='Asst. professor'>Asst. professor</option>
					<option value='CEO'>CEO</option>
					<option value='Executive'>Executive</option>
					<option value='Manager'>Manager</option>
					<option value='Founder'>Founder</option>
					<option value='Research Scholar'>Research Scholar</option>
					<option value='School Administration'>School Administration</option>
					<option value='Student'>Student</option>
					<option value='Others'>Others</option>
				</select>
			</div>
			<div class='formGrpOther'><input type="text" name="otherDesig" id="otherDesig" placeholder="Enter Other Designation" maxlength="35"></div>
			<div class='formGrp'><label for='dept'>Enter Department/Center Name</label><input type="text" name='dept' id='dept'/></div>

			
			
			<!-------If Checkbox SELF is selected in page 1----------->
			<div id="page3_self">
			<div class='formGrp'><label for='affiliation_self'>Enter Affiliation</label><input type="text" name='affiliation_self' id='affiliation_self'/></div>
			<div class="formGrp">
					<label for='sector'>Sector:</label>
					<select name='sector' id='sector1'>
						<option value="" selected disabled >Select Sector</option>
						<option value='Private'>Private</option>
						<option value='Government'>Government</option>
						<option value='Academic'>Academic</option>
						<option value='Research Institute'>Research Institute</option>
						<option value='NGO'>NGO</option>
						<option value='Individual'>Individual</option>
					</select>
				</div>
			</div>
			<!-------If Checkbox INSTITUTE is selected in page 2----------->
			<div id="page3_institute">
				<div class='formGrp'><label for='affiliation_institute'>Enter Affiliation</label><input type="text" name='affiliation_institute' id='affiliation_institute'/></div>
				<div class="formGrp">
					<label for='sector'>Sector:</label>
					<select name='sector' id='sector'>
						<option value="" selected disabled >Select Sector</option>
						<option value='Private'>Private</option>
						<option value='Government'>Government</option>
						<option value='Academic'>Academic</option>
						<option value='Research Institute'>Research Institute</option>
						<option value='NGO'>NGO</option>
						<option value='Individual'>Individual</option>
					</select>
				</div>
			</div>
			<!-------If Checkbox OTHERS is selected in page 3----------->
			<div id="page3_others">
				
			</div>

			

			<div class='formGrp'><label for='nationality'>Enter Nationality</label><input type="text" name='nationality' id='nationality'/></div>
			<div class='formGrp'><label for='phone'>Enter Mobile No.</label><input type="text" name='phone' id='phone'/></div>
			
			<p class='radioQues'>Accommodation Required</p>
				<div class='formGrp yesNo'><input type='radio' name='accomodationReqd[]' value='yes' id='accYes'/>	<label for='accYes'>Yes</label></div>
				<div class='formGrp yesNo'><input type='radio' name='accomodationReqd[]' value='no' id='accNo'/>	<label for='accNo'>No</label></div>
			<p class='radioQues'>Local Transportation Required</p>
				<div class='formGrp yesNo'><input type='radio' name='transportationReqd[]' value='yes' id='accYes'/>	<label for='accYes'>Yes</label></div>
				<div class='formGrp yesNo'><input type='radio' name='transportationReqd[]' value='no' id='accNo'/>	<label for='accNo'>No</label></div>
			
				<div class='formGrp'><label for='otherReq'>Any Other Requirement</label><input type="text" name='otherReq' id='otherReq'/></div>

			<div class='btnGrp'>
				<button type='button' onclick='goBack(this);'>Back</button>
				<button type='button' onclick='proceed(this);'>Proceed</button>
			</div>

		</div>

		<!------------------FOURTH PAGE-------------------------------->
		<div class='page' id='page_4'>

			<h2>Mode of Participation</h2>
			<!--Patron(s)/Head/Vice Chancellors Meeting-->
			<div class='formGrp'><input type='radio' name='modeOfParticipation[]' value='Patron(s)/Head/Vice Chancellors Meeting' id='mopPatron' onclick='showMopDiv(this)'/><label id='mopPatronLbl' for='mopPatron' style="width: 80%;">Patron(s)/Head/Vice Chancellors Meeting</label></div>
			<!--Plenary & Motivational R&D Talks-->
			<div class='formGrp'><input type='radio' name='modeOfParticipation[]' value='Plenary & Motivational R&D Talks' id='mopPlenary' onclick='showMopDiv(this)'/><label for='mopPlenary' style="width: 80%;">Plenary & Motivational R&D Talks</label></div>

			<div class='subFormDiv' id='mopPlenaryDiv'>
				<p class='radioQues'>Please Select:</p>
					<div class='formGrp yesNo'><input type='radio' name='mopPlenaryRole[]' value='Scientist/Academician' id='mopPlenaryRoleScientist' onclick='showLectureTitle(this)' onclick='hideLectureTitle(this)' onclick='hideLectureTitle(this)'/>	<label for='mopPlenaryRoleScientist'>Scientist/Academician</label></div>
					<div class='formGrp yesNo'><input type='radio' name='mopPlenaryRole[]' value='Industrialists' id='mopPlenaryRoleIndustrialists' onclick='showLectureTitle(this)' onclick='hideLectureTitle(this)'/>	<label for='mopPlenaryRoleIndustrialists'>Industrialists </label></div>
					<div class='formGrp yesNo'><input type='radio' name='mopPlenaryRole[]' value='Policy Makers' id='mopPlenaryRolePolicy' onclick='showLectureTitle(this)'/>	<label for='mopPlenaryRolePolicy'>Policy Makers</label></div>
					<div class='formGrp yesNo'><input type='radio' name='mopPlenaryRole[]' value='Delegate/Participant' id='mopPlenaryRoleDelegate' onclick='hideLectureTitle(this)'/>	<label for='mopPlenaryRoleDelegate'>Delegate/Participant</label></div>

				<div class='formGrp'><label for='lectureTitle'>Title of the Lecture (max 20 words):</label><input type="text" name='lectureTitle' id='lectureTitle' maxlength="300"/></div>
				<div class='formGrp'><label for='lectureDesc'>About the Lecture (max 200 words):</label><textarea id="lectureDesc" name="lectureDesc" rows="4" cols="50" maxlength="2000"></textarea></div>

			</div>
			<!--Parallel Technical Sessions-->
			<div class='formGrp'><input type='radio' name='modeOfParticipation[]' value='Parallel Technical Sessions' id='mopTech' onclick='showMopDiv(this)'/><label for='mopTech' style="width: 80%;">Parallel Technical Sessions</label></div>

			<div class='subFormDiv' id='mopTechDiv'>
				<p class='radioQues'>I wish to present:</p>
					<div class='formGrp yesNo'><input type='radio' name='mopTechType[]' value='Oral Presentation' id='mopTechTypeOral' onclick='showLectureTitle(this)'/>	<label for='mopTechTypeOral'>Oral Presentation</label></div>
					<div class='formGrp yesNo'><input type='radio' name='mopTechType[]' value='Poster Presentation' id='mopTechTypePoster' onclick='showLectureTitle(this)'/>	<label for='mopTechTypePoster'>Poster Presentation</label></div>
					<div class='formGrp yesNo'><input type='radio' name='mopTechType[]' value='Attendees ' id='mopTechTypeAttendees' onclick='hideLectureTitle(this)'/>	<label for='mopTechTypeAttendees'>Attendees</label></div>
				<p class='radioQues'>Please Select Role:</p>
					<div class='formGrp yesNo'><input type='radio' name='mopTechRole[]' value='Research Scholars' id='mopTechRoleScholar' onclick='showLectureTitle(this)'/>	<label for='mopTechRoleScholar'>Research Scholars</label></div>
					<div class='formGrp yesNo'><input type='radio' name='mopTechRole[]' value='Faculty Member' id='mopTechRoleFaculty' onclick='showLectureTitle(this)'/>	<label for='mopTechRoleFaculty'>Faculty Member</label></div>
					<div class='formGrp yesNo'><input type='radio' name='mopTechRole[]' value='Company Executive ' id='mopTechRoleExec' onclick='showLectureTitle(this)'/>	<label for='mopTechRoleExec'>Company Executive</label></div>
					<div class='formGrp yesNo'><input type='radio' name='mopTechRole[]' value='Delegate/Participant' id='mopTechRoleDelegate'  onclick='hideLectureTitle(this)'/>	<label for='mopTechRoleDelegate'>Delegate/Participant</label></div>

				<div class='formGrp'>
				<label for='techSess'>Select Technical Session Area:</label>
				<select name='techSess' id='techSess'>
					<option value=''>Select a technical session</option>
					<option value='Advanced Functional Materials'>Advanced Functional Materials</option>
					<option value='Advanced Semiconductors and Quantum Materials'>Advanced Semiconductors and Quantum Materials</option>
					<option value='Agro & Food Processing Technologies'>Agro & Food Processing Technologies</option>
					<option value='Artificial Intelligence, Data Science based R&D Interventions'>Artificial Intelligence, Data Science based R&D Interventions</option>
					<option value='Conservation of Biodiversity of North Eastern States'>Conservation of Biodiversity of North Eastern States</option>
					<option value='Disaster Management'>Disaster Management</option>
					<option value='Healthcare Research & Related Technologies'>Healthcare Research & Related Technologies</option>
					<option value='Innovative Design for Societal Needs'>Innovative Design for Societal Needs</option>
					<option value='Low Cost Manufacturing Technologies'>Low Cost Manufacturing Technologies</option>
					<option value='Policies for Research & Innovations'>Policies for Research & Innovations</option>
					<option value='Research and Innovation for Sustainable Development Goals'>Research and Innovation for Sustainable Development Goals</option>
					<option value='Sustainable Environment'>Sustainable Environment</option>
					<option value='Sustainable Energy Generation and Storage'>Sustainable Energy Generation and Storage</option>
					<option value='Sustainable Transportations and Urban Development'>Sustainable Transportations and Urban Development</option>
					<option value='Teaching Learning Technologies'>Teaching Learning Technologies</option>
					<option value='Technologies for Rural Development'>Technologies for Rural Development</option>
				</select>
				</div>

				<div class='formGrp'><label for='lectureTitle1'>Title of the Lecture (max 20 words):</label><input type="text" name='lectureTitle' id='lectureTitle1' maxlength="400"/></div>
				<div class='formGrp'><label for='lectureDesc1'>About the Lecture (max 200 words):</label><textarea id="lectureDesc1" name="lectureDesc" rows="4" cols="50" maxlength="2000"></textarea></div>
				<div class='formGrp'><label for='abstractFile'>Upload Abstract (pdf)</label><input type="file" name='abstractFile' id='abstractFile' accept='application/pdf'/></div>
				<!-- <p>Registration fees will be intimated shortly</p> -->

			</div>

			<!--Brain Storming Sessions & Panel Discussion-->
			<div class='formGrp'><input type='radio' name='modeOfParticipation[]' value='Brain Storming Sessions & Panel Discussion' id='mopBrain' onclick='showMopDiv(this)'/><label for='mopBrain' style="width: 80%;">Brain Storming Sessions & Panel Discussion</label></div>

			<div class='subFormDiv' id='mopBrainDiv'>
				<p class='radioQues'>Please Select Current Role:</p>
					<div class='formGrp yesNo'><input type='radio' name='mopBrainRole[]' value='Director' id='mopBrainRoleDirector' onclick='showLectureTitle(this)'/>	<label for='mopBrainRoleDirector'>Director</label></div>
					<div class='formGrp yesNo'><input type='radio' name='mopBrainRole[]' value='Vice Chancellor' id='mopBrainRoleVice' onclick='showLectureTitle(this)'/>	<label for='mopBrainRoleVice'>Vice Chancellor</label></div>
					<div class='formGrp yesNo'><input type='radio' name='mopBrainRole[]' value='Government Official' id='mopBrainRoleGovt' onclick='showLectureTitle(this)'/>	<label for='mopBrainRoleGovt'>Government Official</label></div>
					<div class='formGrp yesNo'><input type='radio' name='mopBrainRole[]' value='Official from Funding Agency' id='mopBrainRoleFunding' onclick='showLectureTitle(this)'/>	<label for='mopBrainRoleFunding'>Official from Funding Agency</label></div>
					<div class='formGrp yesNo'><input type='radio' name='mopBrainRole[]' value='Delegate/Participant' id='mopBrainRoleDelegate' onclick='hideLectureTitle(this)'/>	<label for='mopBrainRoleDelegate'>Delegate/Participant</label></div>
				<div class='formGrp'>
					<label for='themes'>Select Theme:</label>
					<select name='themes' id='themes'>
						<option value='' selected disabled>Select Theme</option>
						<option value='Theme 1'>Theme 1: Handholding Mechanism for Sustained Research & Innovations Among North-East Institutions</option>
						<option value='Theme 2'>Theme 2: Harnessing Traditional Knowledge of North Eastern States</option>
						<option value='Theme 3'>Theme 3: Conservation of Biodiversity through R&D Interventions</option>
						<option value='Theme 4'>Theme 4: North East Disaster Management & R&D Interventions</option>
						<option value='Theme 5'>Theme 5: Government R&D Policies for North Eastern States</option>
						<option value='Theme 6'>Theme 6: A Road Map for Standardisation of Grass root Innovations through R&D practices</option>
					</select>
				</div>
			</div>


			<!--Research & Innovation Exhibition-->
			<div class='formGrp'><input type='radio' name='modeOfParticipation[]' value='Research & Innovation Exhibition' id='mopResearch' onclick='showMopDiv(this)'/><label for='mopResearch' style="width: 80%;">Research & Innovation Exhibition</label></div>

			<div class='subFormDiv' id='mopResearchDiv'>
				<p class='radioQues'>Please Select Current Role:</p>
					<div class='formGrp yesNo'><input type='radio' name='mopResearchRole[]' value='Research Scholars' id='mopResearchRoleScholar' onclick='showLectureTitle(this)'/>	<label for='mopResearchRoleScholar'>Research Scholars</label></div>
					<div class='formGrp yesNo'><input type='radio' name='mopResearchRole[]' value='Company Executive ' id='mopResearchRoleExec' onclick='showLectureTitle(this)'/>	<label for='mopResearchRoleExec'>Company Executive</label></div>
					<div class='formGrp yesNo'><input type='radio' name='mopResearchRole[]' value='Faculty Member' id='mopResearchRoleStartup' onclick='showLectureTitle(this)'/>	<label for='mopResearchRoleStartup'>Start-Up</label></div>
					<div class='formGrp yesNo'><input type='radio' name='mopResearchRole[]' value='Delegate/Participant' id='mopResearchRoleDelegate'  onclick='hideLectureTitle(this)'/>	<label for='mopResearchRoleDelegate'>Delegate/Participant</label></div>

				<p class='radioQues'>Please Select:</p>
					<div class='formGrp yesNo'><input type='radio' name='mopResearchType[]' value='Model Demonstration' id='mopResearchTypeDemo'/>	<label for='mopResearchTypeDemo'>Model Demonstration</label></div>
					<div class='formGrp yesNo'><input type='radio' name='mopResearchType[]' value='Model Display' id='mopResearchTypeModel'/>	<label for='mopResearchTypeModel'>Model Display</label></div>
					<div class='formGrp yesNo'><input type='radio' name='mopResearchType[]' value='Stall ' id='mopResearchTypeStall '/>	<label for='mopResearchTypeStall'>Stall</label></div>

				<div class='formGrp'><label for='lectureTitle2'>Title of the Exhibition (max 20 words):</label><input type="text" name='lectureTitle' id='lectureTitle2' maxlength="400"/></div>
				<div class='formGrp'><label for='lectureDesc2'>About the Exhibition (max 200 words):</label><textarea id="lectureDesc2" name="lectureDesc" rows="4" cols="50" maxlength="2000"></textarea></div>
				<div class='formGrp'><label for='numberOfSlot'>No. of Slot Required for set-up(Per slot 3m x 3m space: charge for the slot will be intimated later):</label><input type="text" name='numberOfSlot' id='numberOfSlot'/></div>
			</div>


			<!--Guwahati Biotech Park Starts here-->


			<!--Expo-->
			<div class='formGrp'><input type='radio' name='modeOfParticipation[]' value='Expo' id='mopExpo' onclick='showMopDiv(this)'/><label for='mopExpo' style="width: 80%;">Expo</label></div>
			<div class='subFormDiv' id='mopExpoDiv'>
				<table id = "expoTable">
					<thead>
						<tr>
							<th>Name</th>
							<th>Designation</th>
							<th>Email</th>
							<th>Phone Number</th>
							<th>Website</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><input type="text" name='partName_1' id='partName_1' maxlength="100"/></td>
							<td><input type="text" name='partDesig_1' id='partDesig_1' maxlength="100"/></td>
							<td><input type="text" name='partEmail_1' id='partEmail_1' maxlength="100"/></td>
							<td><input type="text" name='partPhone_1' id='partPhone_1' maxlength="100"/></td>
							<td><input type="text" name='partWebsite_1' id='partWebsite_1' maxlength="100"/></td>
							<td><input type="button" id="delPOIbutton" value="-" onclick="deleteRowExpo(this)" hidden="true"/></td>
                			<td><input type="button" id="addmorePOIbutton" value="+" onclick="insRowExpo()"/></td>
						</tr>
						<input type="hidden" id="partRows" name="partRows" value="1"/>
					</tbody>
				</table>

				<p class='radioQues'>Type of display:</p>
					<div class='formGrp yesNo'><input type='checkbox' name='mopExpoType[]' value='Working Model' id='mopExpoTypeWork'/>	<label for='mopExpoTypeWork'>Product: Working Model</label></div>
					<div class='formGrp yesNo'><input type='checkbox' name='mopExpoType[]' value='Fixed Model' id='mopExpoTypeFixed'/>	<label for='mopExpoTypeFixed'>Product: Fixed Model</label></div>
					<div class='formGrp yesNo'><input type='checkbox' name='mopExpoType[]' value='Software App' id='mopExpoTypeSw'/>	<label for='mopExpoTypeSw'>Software App solution in a laptop</label></div>

				<div class='formGrp'><label for='lectureDesc3'>About the Product (max 100 words):</label><textarea id="lectureDesc3" name="lectureDesc" rows="4" cols="50" maxlength="2000"></textarea></div>

				<p class='radioQues'>Power requirement for display/working model:</p>
					<div class='formGrp yesNo'><input type='radio' name='mopExpoPower[]' value='Y' id='mopExpoPowerYes'/>	<label for='mopExpoPowerYes'>Yes</label></div>
					<div class='formGrp yesNo'><input type='radio' name='mopExpoPower[]' value='N' id='mopExpoPowerNo'/>	<label for='mopExpoPowerNo'>No</label></div>

				<div class='formGrp'><label for='numberOfSlot2'>No. of Slot Required for set-up(Per slot 2m x 2m space):</label><input type="text" name='numberOfSlot2' id='numberOfSlot2'/></div>

				<div class='formGrp'><label for='otherReqExpo'>Any Other Requirement</label><input type="text" name='otherReqExpo' id='otherReqExpo'/></div>

			</div>


			<!--Young Minds Challenge-->
			<div class='formGrp'><input type='radio' name='modeOfParticipation[]' value='Young Minds Challenge' id='mopYmc' onclick='showMopDiv(this)'/><label for='mopYmc' style="width: 80%;">Young Minds Challenge</label></div>
			<div class='subFormDiv' id='mopYmcDiv'>
				<div class='formGrp'><label for='addressYmc'>Address of School</label><input type="text" name='addressYmc' id='addressYmc' maxlength="200" /></div>
				<table id='ymcTable'>
					<thead>
						<tr>
							<th>Name</th>
							<th>Standard</th>
							<th>Address</th>
							<th>Phone Number</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><input type="text" name='grpName_1' id='grpName_1' maxlength="100"/></td>
							<td><input type="text" name='grpDesig_1' id='grpDesig_1' maxlength="100"/></td>
							<td><input type="text" name='grpEmail_1' id='grpEmail_1' maxlength="100"/></td>
							<td><input type="text" name='grpPhone_1' id='grpPhone_1' maxlength="100"/></td>
							<td><input type="button" id="delPOIbutton" value="-" onclick="deleteRow(this)" hidden="true"/></td>
                			<td><input type="button" id="addmorePOIbutton" value="+" onclick="insRow()"/></td>
						</tr>
						<input type="hidden" id="grpRows" name="grpRows" value="1"/>
					</tbody>
				</table>

				<div class='formGrp'><label for='nameAcpYmc'>Name of Accompanying Person:</label><input type="text" name='nameAcpYmc' id='nameAcpYmc'/></div>
				<div class='formGrp'><label for='desigAcpYmc'>Designation of Accompanying Person:</label><input type="text" name='desigAcpYmc' id='desigAcpYmc'/></div>
				<div class='formGrp'><label for='phoneAcpYmc'>Phone No. of Accompanying Person:</label><input type="text" name='phoneAcpYmc' id='phoneAcpYmc'/></div>

				<div class='formGrp'>
					<label for='themesYmc'>Select Theme:</label>
					<select name='themesYmc' id='themesYmc'>
						<option value='' selected disabled>Select Theme</option>
						<option value='Theme 8'>Intervention of AI in MedTech</option>
						<option value='Theme 9'>Eco Conservation through Biotech</option>
						<option value='Theme 10'>Bio Solution of Solid Waste Management</option>
						<option value='Theme 11'>Digital Agriculture and New age farms</option>
						<option value='Theme 12'>Bioenergy- Opportunities and Challenges</option>
					</select>
				</div>

				<a class='annxLink' target='_blank' href='../assets/ymcAnnexure1.docx'>Click on this Link to download Letter of Support Template</a>

				<div class='formGrp'><label for='letterFile'>Letter of support from School Principal/headmaster as edited from above template (pdf)</label><input type="file" name='letterFile' id='letterFile' accept='application/pdf'/></div>

				<div class='formGrp'><label for='conceptFile'>Concept note (please submit within 1000 words in PDF format) containing a. Title,<br> b. Problems statement, origin, cause and background,<br> c. Solution offered,<br> d. Implementation and feasibility,<br> e. Ways to make the solution business ready,<br> f. Marketing and advertisement strategy to be adopted.  (pdf)</label><input type="file" name='conceptFile' id='conceptFile' accept='application/pdf'/></div>
				
				<p class='radioQues'>Preferred mode of submission if selected:</p>
					<div class='formGrp yesNo'><input type='radio' name='mopYmcType[]' value='Short Video' id='mopYmcTypeVideo'/>	<label for='mopYmcTypeVideo'>Short Videos (5 min max)</label></div>
					<div class='formGrp yesNo'><input type='radio' name='mopYmcType[]' value='Presentation' id='mopYmcTypePpt'/>	<label for='mopYmcTypePpt'>Presentation (Powerpoint, PDF, etc)</label></div>
					<div class='formGrp yesNo'><input type='radio' name='mopYmcType[]' value='Working Model' id='mopYmcTypeWM'/>	<label for='mopYmcTypeWM'>Working Models</label></div>
					<div class='formGrp yesNo'><input type='radio' name='mopYmcType[]' value='Posters' id='mopYmcTypePosters'/>	<label for='mopYmcTypePosters'>Posters wall hanging (length-4ft, breadth-3ft)</label></div>
					<div class='formGrp yesNo'><input type='radio' name='mopYmcType[]' value='Combined' id='mopYmcTypeComb'/>	<label for='mopYmcTypeComb'>Any Combination of above</label></div>

				<a class='annxLink' target='_blank' href='../assets/ymcAnnexure2.pdf'>Click on this Link to check Guidelines for participating in Young Mind's Challenge</a>
			</div>


			<!--Investor Pitch-->
			<div class='formGrp'><input type='radio' name='modeOfParticipation[]' value='Investor Pitch' id='mopIp' onclick='showMopDiv(this)'/><label for='mopIp' style="width: 80%;">Investor Pitch</label></div>
			<div class='subFormDiv' id='mopIpDiv'>
				<a class='annxLink' target='_blank' href='../assets/ipAnnexure2.pdf'>Click on this Link to check Guidelines for participating in Investor's Pitch</a>
				<a class='annxLink' target='_blank' href='../assets/ipAnnexure1.pptx'>Annexure 1</a>
				<div class='formGrp'><label for='productName'>Name of the product/ technology:</label><input type="text" name='productName' id='productName'/></div>
				<table id="prodTable">
					<thead>
						<tr>
							<th>Name</th>
							<th>Designation</th>
							<th>Email</th>
							<th>Phone Number</th>
							<th>Website</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><input type="text" name='prodPartName_1' id='prodPartName_1' maxlength="100"/></td>
							<td><input type="text" name='prodPartDesig_1' id='prodPartDesig_1' maxlength="100"/></td>
							<td><input type="text" name='prodPartEmail_1' id='prodPartEmail_1' maxlength="100"/></td>
							<td><input type="text" name='prodPartPhone_1' id='prodPartPhone_1' maxlength="100"/></td>
							<td><input type="text" name='prodPartWebsite_1' id='prodPartWebsite_1' maxlength="100"/></td>
							<td><input type="button" id="delPOIbutton" value="-" onclick="deleteRowProd(this)" hidden="true"/></td>
                			<td><input type="button" id="addmorePOIbutton" value="+" onclick="insRowProd()"/></td>
						</tr>
						<input type="hidden" id="prodPartRows" name="prodPartRows" value="1"/>
					</tbody>
				</table>
				<p class='radioQues'>Mode of pitch:</p>
					<div class='formGrp yesNo'><input type='radio' name='mopPitchType[]' value='Virtual' id='mopPitchTypeVirtual'/>	<label for='mopPitchTypeVirtual'>Virtual</label></div>
					<div class='formGrp yesNo'><input type='radio' name='mopPitchType[]' value='Physical' id='mopPitchTypePhysical'/>	<label for='mopPitchTypePhysical'>Physical</label></div>

				<div class='formGrp'><label for='grants'>Grants availed Recognition/awards/patents (please mention if any):</label><input type="text" name='grants' id='grants'/></div>
				<div class='formGrp'><label for='otherReqIp'>Any other requirements:</label><input type="text" name='otherReqIp' id='otherReqIp'/></div>

				<div class='formGrp'><label for='productFile'>Details of the product/ technology (please submit within 1000 words in PDF format) containing a. Which Sector does the product/technology cater to?<br> b. Current Market assessment for product/technology<br> c. Fund sources tapped<br> d. Investment strategies adopted<br> e. Future market Potential and Growth plan<br> f. About the team  (pdf)</label><input type="file" name='productFile' id='productFile' accept='application/pdf'/></div>

				<p class='radioQues'>Type of Presentation:</p>
					<div class='formGrp yesNo'><input type='radio' name='mopPptType[]' value='Physical Demo' id='mopPptTypeDemo'/>	<label for='mopPptTypeDemo'>Physical Demo of product/model</label></div>
					<div class='formGrp yesNo'><input type='radio' name='mopPptType[]' value='Prototype Display' id='mopPptTypeProto'/>	<label for='mopPptTypeProto'>Prototype Display</label></div>
					<div class='formGrp yesNo'><input type='radio' name='mopPptType[]' value='Descriptive Video' id='mopPptTypeVid'/>	<label for='mopPptTypeVid'>Descriptive video</label></div>

			</div>


			<!--Young Innovative Entrepreneur Award-->
			<div class='formGrp'><input type='radio' name='modeOfParticipation[]' value='Young Innovative Entrepreneur Award' id='mopYiea' onclick='showMopDiv(this)'/><label for='mopYiea' style="width: 80%;">Young Innovative Entrepreneur Award</label></div>
			<div class='subFormDiv' id='mopYieaDiv'>
				
				<table id="yieaTable">
					<thead>
						<tr>
							<th>Name</th>
							<th>Designation</th>
							<th>Email</th>
							<th>Phone Number</th>
							<th>Years of Experience</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><input type="text" name='yieaPartName_1' id='yieaPartName_1' maxlength="100"/></td>
							<td><input type="text" name='yieaPartDesig_1' id='yieaPartDesig_1' maxlength="100"/></td>
							<td><input type="text" name='yieaPartEmail_1' id='yieaPartEmail_1' maxlength="100"/></td>
							<td><input type="text" name='yieaPartPhone_1' id='yieaPartPhone_1' maxlength="100"/></td>
							<td><input type="text" name='yieaExp_1' id='yieaExp_1' maxlength="100"/></td>
							<td><input type="button" id="delPOIbutton" value="-" onclick="deleteRowYiea(this)" hidden="true"/></td>
                			<td><input type="button" id="addmorePOIbutton" value="+" onclick="insRowYiea()"/></td>
						</tr>
						<input type="hidden" id="yieaPartRows" name="yieaPartRows" value="1"/>
					</tbody>
				</table>

				<div class='formGrp'><label for='grants'>Name of the product/technology already commercialized</label><input type="text" name='productName' id='productNameYiea'/></div>
				<div class='formGrp'><label for='incubator'>Incubator/ Institute associated with:</label><input type="text" name='incubator' id='incubator'/></div>
				<div class='formGrp'><label for='grants'>Already availed grant/fund/recognition/awards/patents (please mention if any):</label><input type="text" name='grantsYiea' id='grantsYiea'/></div>
				<div class='formGrp'><label for='otherReqYiea'>Any other requirements:</label><input type="text" name='otherReqYiea' id='otherReqYiea'/></div>

				<div class='formGrp'><label for='yieaConceptFile'>Concept note (please submit within 1000 words in PDF format) to be uploaded containing a. Technical Feasibility and innovative aspects of the idea solution, uniqueness
				of the solution<br> b. Commercial Viability and Future Plan of Commercialization<br> c. Target population and Market Potential of the product or service to be developed<br> d. Competitive advantage<br> e. Social implications</label><input type="file" name='yieaConceptFile' id='yieaConceptFile' accept='application/pdf'/></div>


			</div>


			<!--Assam Bio-innovation Fellowship-->
			<div class='formGrp'><input type='radio' name='modeOfParticipation[]' value='Assam Bio-innovation Fellowship' id='mopAbf' onclick='showMopDiv(this)'/><label for='mopYiea' style="width: 80%;">Assam Bio-innovation Fellowship</label></div>
			<div class='subFormDiv' id='mopAbfDiv'>

				<a class='annxLink' target='_blank' href='../assets/ASSAM BIOINNOVATION FELLOWSHIP GUIDELINES.pdf'>Click on this Link to check Guidelines for participating in Assam Bio-Innovation Fellowship</a>
				<div class='formGrp'><label for='qualification'>Educational Qualification:</label><input type="text" name='qualification' id='qualification'/></div>
				<div class='formGrp'><label for='mopAbfExp'>Years of experience in the field:</label><input type="text" name='mopAbfExp' id='mopAbfExp'/></div>
				<div class='formGrp'><label for='mopAbfCVFile'>Academic and Research achievements (Please attach 1-page CV listing patents/technology transferred/ publication
					/book chapters/ articles and awards in PDF format)</label><input type="file" name='mopAbfCVFile' id='mopAbfCVFile' accept='application/pdf'/></div>
				<div class='formGrp'><label for='stmtPurpose'>Statement of Purpose (Please state how this fellowship will help further your research on the relevant topic- Max 500 words):</label><textarea id="stmtPurpose" name="stmtPurpose" rows="4" cols="50" maxlength="6000"></textarea></div>
				<div class='formGrp'><label for='mopAbfRecFile'>Forwarding Letter from head of Institute</label><input type="file" name='mopAbfRecFile' id='mopAbfRecFile' accept='application/pdf'/></div>

				<div class='formGrp'><label for='mopAbfProposalFile'>Detailed proposal on the innovative idea/research with time line and milestones (Max-2000words) (Please refer point no. E of Assam Bio-innovation Fellowship Guidelines) <br>a. Problem statement<br> b. Origin/background of the concept<br> c. Solution offered<br> d. Technical details of research proposal<br> e. Budget requirements<br> f. Societal impact<br> g. Commercial Viability<br> h. Proposed timelines with Milestones</label><input type="file" name='mopAbfProposalFile' id='mopAbfProposalFile' accept='application/pdf'/></div>

				<div class='formGrp'><label for='otherReqAbf'>Any other information:</label><input type="text" name='otherReqAbf' id='otherReqAbf'/></div>

				

			</div>


			<!--Site Visit -->
			<div class='formGrp'><input type='radio' name='modeOfParticipation[]' value='Site Visit to IITG BioNEST and GBP' id='mopSite' onclick='showMopDiv(this)'/><label for='mopSite' style="width: 80%;">Site Visit to IITG BioNEST and GBP</label></div>
			<div class='subFormDiv' id='mopSiteDiv'>

				<p class='radioQues'>Date of Visit:</p>
					<div class='formGrp yesNo'><input type='checkbox' name='mopSiteDate[]' value='21st May 2022' id='mopSiteDate1'/>	<label for='mopSiteDate1'>21st May 2022</label></div>
					<div class='formGrp yesNo'><input type='checkbox' name='mopSiteDate[]' value='22nd May 2022' id='mopSiteDate2'/>	<label for='mopSiteDate2'>22nd May 2022</label></div>				
				

			</div>

			<div class='btnGrp'>
				<button type='button' onclick='goBack(this);'>Back</button>
				<button type='button' onclick='proceed(this);' id='submitBtn' name='submitBtn'>Submit</button>
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

	    function hideLectureTitle(thisElem){
	    	var id = thisElem.id;

	    	if(id==="mopPlenaryRoleDelegate"){

	    		document.getElementById("lectureTitle").parentElement.style.display="none";
	    		document.getElementById("lectureTitle").style.display="none";

	    		document.getElementById("lectureDesc").parentElement.style.display="none";

	    	}else if(id==="mopTechRoleDelegate" || id==="mopTechTypeAttendees"){

	    		document.getElementById("lectureTitle1").parentElement.style.display="none";
	    		document.getElementById("lectureTitle1").style.display="none";
	    		
	    		document.getElementById("lectureDesc1").parentElement.style.display="none";

	    		document.getElementById("techSess").parentElement.style.display="none";

	    		document.getElementById("abstractFile").parentElement.style.display="none";

	    	}else if(id==="mopBrainRoleDelegate"){

	    		
	    	}else if(id==="mopResearchRoleDelegate"){

	    		document.getElementById("lectureTitle2").parentElement.style.display="none";
	    		document.getElementById("lectureTitle2").style.display="none";
	    		
	    		document.getElementById("lectureDesc2").parentElement.style.display="none";

	    		document.getElementById("numberOfSlot").parentElement.style.display="none";
	    	}

	    }

	    function showLectureTitle(thisElem){
	    	var id = thisElem.id;

	    	if(document.getElementById('mopPlenaryDiv').style.display==='block' && id!=="mopPlenaryRoleDelegate"){

	    		document.getElementById("lectureTitle").parentElement.style.display="block";
	    		document.getElementById("lectureTitle").style.display="block";

	    		document.getElementById("lectureDesc").parentElement.style.display="block";

	    	}else if(document.getElementById('mopTechDiv').style.display==='block' && id!=="mopTechRoleDelegate"){
	    		if(!document.getElementById("mopTechTypeAttendees").checked){

	    			document.getElementById("lectureTitle1").parentElement.style.display="block";
		    		document.getElementById("lectureTitle1").style.display="block";
		    		
		    		document.getElementById("lectureDesc1").parentElement.style.display="block";

		    		document.getElementById("techSess").parentElement.style.display="block";

		    		document.getElementById("abstractFile").parentElement.style.display="block";
	    		}
	    		

	    	}else if(document.getElementById('mopBrainDiv').style.display==='block' && id!=="mopBrainRoleDelegate"){

	    		
	    	}else if(document.getElementById('mopResearchDiv').style.display==='block' && id!=="mopResearchRoleDelegate"){

	    		document.getElementById("lectureTitle2").parentElement.style.display="block";
	    		document.getElementById("lectureTitle2").style.display="block";
	    		
	    		document.getElementById("lectureDesc2").parentElement.style.display="block";

	    		document.getElementById("numberOfSlot").parentElement.style.display="block";
	    	}

	    }

		function checkSelectOther(thisElem){
			var id = thisElem.id;
			var val = thisElem.value;
			if(id==='title' && val==='Other'){
				document.getElementById('otherTitle').style.display = 'block';
			}
			else if(id==='title' && val!=='Other'){
				document.getElementById('otherTitle').style.display = 'none';
			}
			if(id==='desig' && val==='Others'){
				document.getElementById('otherDesig').style.display = 'block';
			}
			else if(id==='desig' && val!=='Others'){
				document.getElementById('otherDesig').style.display = 'none';
			}
		}
		function showMopDiv(elem){
			var id = elem.id+"Div";
			var subFormDivArr = document.getElementsByClassName('subFormDiv');
			for (var i = subFormDivArr.length - 1; i >= 0; i--) {
				subFormDivArr[i].style.display='none';
			}
			document.getElementById(id).style.display='block';
		}
		function populatePage3(arg){
			if(arg==='self'){
				document.getElementById('page3_self').style.display = 'block';
				document.getElementById('page3_institute').style.display = 'none';
				document.getElementById('mopPatron').style.display = 'none';
				document.getElementById('mopPatronLbl').style.display = 'none';
			}else if(arg==='institute'){
				document.getElementById('page3_self').style.display = 'none';
				document.getElementById('page3_institute').style.display = 'block';
				document.getElementById('mopPatron').style.display = '';
				document.getElementById('mopPatronLbl').style.display = '';
			}
		}

		function goBack(btn){
			var divBtnGrp = btn.parentElement;
			var divPage = divBtnGrp.parentElement;
			var divPageId = divPage.id;

			var currPageCount = divPageId.split("_")[1];
			var currPrevPageCount = +currPageCount - 1;
			divPage.style.display='none';
			if(currPrevPageCount!==0)
				document.getElementById("page_"+currPrevPageCount).style.display='block';
			else{
				window.location.href = '../registration.html';
			}
		}

		function proceed(btn){			
			var divBtnGrp = btn.parentElement; //the button element
			var divPage = divBtnGrp.parentElement; //the div containing button
			var divPageId = divPage.id; // id of the page whose button is pressed
			var currPageCount = divPageId.split("_")[1];

			//----------VALIDATION-------------------//

			if(currPageCount==="1"){
				var regForArr = document.getElementsByName('regFor[]');
				var flag = 0;
				var post_regMode = "";
				for (var i = 0; i < regForArr.length; i++) {
					if(regForArr[i].checked){
						++flag;
						post_regMode = regForArr[i].value;
					}
				}
				if(flag===0){
					alert('Please select Registration Mode');
					return;
				}

				//-----------POPULATE MAIN POST FIELDS--------------//
				document.getElementById('post_regMode').value = post_regMode;
			}

			if(currPageCount==="2"){
				var email = document.getElementById('email').value;
				var emailRpt = document.getElementById('emailRpt').value;
				var pwdInput = document.getElementById('pwdInput').value;
				var pwdInputRpt = document.getElementById('pwdInputRpt').value;
				var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

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

				if(pwdInput==="" || pwdInputRpt===""){
					alert("Please enter both passwords");
					return;
				}
				if(pwdInput!==pwdInputRpt){
					alert('Passwords entered do not match');
					return;
				}

				//-----------POPULATE MAIN POST FIELDS--------------//
				document.getElementById('post_email').value = email;
				document.getElementById('post_pwdInput').value = pwdInput;
			}

			if(currPageCount==="3"){
				var title = document.getElementById('title');
				var otherTitle = document.getElementById('otherTitle');
				var firstName = document.getElementById('firstName');
				var surName = document.getElementById('surName');
				var desig = document.getElementById('desig');
				var otherDesig = document.getElementById('otherDesig');
				var dept = document.getElementById('dept');
				var nationality = document.getElementById('nationality');
				var phone = document.getElementById('phone');
				var accomodationReqdArr = document.getElementsByName('accomodationReqd[]');
				var transportationReqdArr = document.getElementsByName('transportationReqd[]');
				
				 	if(title.value==="" || title.value==="Other" ){
				 		if(title.value===""){
					 		alert("Enter title");
							title.focus();
							return;
				 		}
				 		else if(title.value==="Other" && otherTitle.value===''){
				 			alert("Enter other title");
							otherTitle.focus();
							return;
				 		}
				 	}
				 	if(firstName.value===""){
				 		alert("Enter First Name");
						firstName.focus();
						return;
				 	}
				 	if(surName.value===""){
				 		alert("Enter Sur Name");
						surName.focus();
						return;
				 	}
				 	if(desig.value==="" || desig.value==="Others"){
				 		if(desig.value===""){
					 		alert("Enter Designation");
							desig.focus();
							return;
				 		}
				 		else if(desig.value==="Other" && otherDesig.value===''){
				 			alert("Enter Other Designation");
							otherDesig.focus();
							return;
				 		}
				 	}
				 	if(dept.value===""){
				 		alert("Enter Department");
						dept.focus();
						return;
				 	}
				 	if(nationality.value===""){
				 		alert("Enter Nationality");
						nationality.focus();
						return;
				 	}
				 	if(phone.value===""){
				 		alert("Enter Phone No.");
						phone.focus();
						return;	
				 	}
				//Validation for affiliation and sector depending on selection on first page
				if(document.getElementById('page3_self').style.display==='none'){
					if(document.getElementById('affiliation_institute').value===''){
						alert('Please enter affiliation of the institute');
						document.getElementById('affiliation_institute').focus();
						return;
					}
					if(document.getElementById('sector').value===''){
						alert('Please enter sector of the institute');
						document.getElementById('sector').focus();
						return;
					}
				}else if(document.getElementById('page3_institute').style.display==='none'){
					if(document.getElementById('affiliation_self').value===''){
						alert('Please enter affiliation');
						document.getElementById('affiliation_self').focus();
						return;
					}
					if(document.getElementById('sector1').value===''){
						alert('Please enter sector of the institute');
						document.getElementById('sector1').focus();
						return;
					}
				}

				//Validation for accomodation and transportation
				var flag1 = 0;
				var flag2 = 0;
				var post_accomodationReqd = '';
				var post_transportationReqd = '';
				for (var i = 0; i < accomodationReqdArr.length; i++) {
					if(accomodationReqdArr[i].checked){
						++flag1;
						post_accomodationReqd = accomodationReqdArr[i].value;
					}
				}
				if(flag1===0){
					alert('Please select if accomodation is required');
					accomodationReqdArr[0].focus();
					return;
				}

				for (var i = 0; i < transportationReqdArr.length; i++) {
					if(transportationReqdArr[i].checked){
						++flag2;
						post_transportationReqd = transportationReqdArr[i].value;
					}
				}
				if(flag2===0){
					alert('Please select if transportation is required');
					transportationReqdArr[0].focus();
					return;
				}

				//-----------POPULATE MAIN POST FIELDS--------------//
				if(title.value==='Other'){
					document.getElementById('post_title').value = otherTitle.value;
				}else{
					document.getElementById('post_title').value = title.value;
				}
				document.getElementById('post_firstName').value = firstName.value;
				document.getElementById('post_surName').value = surName.value;
				if(desig.value==='Others'){
					document.getElementById('post_desig').value = otherDesig.value;
				}else{
					document.getElementById('post_desig').value = desig.value;
				}
				document.getElementById('post_dept').value = dept.value;
				document.getElementById('post_affiliation').value = title.value;
				if(document.getElementById('page3_self').style.display==='none'){
					document.getElementById('post_affiliation').value = document.getElementById('affiliation_institute').value;
					document.getElementById('post_sector').value = document.getElementById('sector').value;
					
				}else if(document.getElementById('page3_institute').style.display==='none'){
					document.getElementById('post_affiliation').value = document.getElementById('affiliation_self').value;
					document.getElementById('post_sector').value = document.getElementById('sector1').value;;
				}
				document.getElementById('post_nationality').value = nationality.value;
				document.getElementById('post_phone').value = phone.value;
				document.getElementById('post_accomodationReqd').value = post_accomodationReqd;
				document.getElementById('post_transportationReqd').value = post_transportationReqd;
				document.getElementById('post_otherRequirement').value = document.getElementById('otherReq').value;

			}

			if(currPageCount==="4"){
				//Main Radio button validation
				var modeOfParticipationArr = document.getElementsByName('modeOfParticipation[]');
				var flag0 = 0;
				var post_modeOfParticipation = '';

				//------------DECLARE ALL POST VARIABLES------------//
				
				var post_participationRole='';
				var post_lectureTitle = '';
				var post_lectureDescOrAbstract = '';
				var post_sessionType = '';
				var post_techSessOrTheme = '';
				var post_abstractFilePath = '';
				var post_slotsReqd = '';
				var post_powerRqmt = '';
				var post_OtherRqmt = '';
				var post_schoolAddress = '';
				var post_letterFile = '';
				var post_productName = '';
					
				var post_grants = '';
				var post_pptType = '';
				var post_incubator = '';
				var post_qualification = '';
				var post_expYears = '';
				var post_cvFile = '';
				var post_stmtPupose = '';
				var post_dateOfVisit = '';

				//--------------------------------------------------//

				for (var i = 0; i < modeOfParticipationArr.length; i++) {
					if(modeOfParticipationArr[i].checked){
						++flag0;
						post_modeOfParticipation = modeOfParticipationArr[i].value;
					}
				}
				if(flag0===0){
					alert('Please select a mode of participation');
					return;
				}

				//Individual subsection validation
				if(document.getElementById('mopPlenaryDiv').style.display==='block'){
					
					var mopPlenaryRoleArr = document.getElementsByName('mopPlenaryRole[]');
					var flag1 = 0;
					
					for (var i = 0; i < mopPlenaryRoleArr.length; i++) {
						if(mopPlenaryRoleArr[i].checked){
							++flag1;
							post_participationRole = mopPlenaryRoleArr[i].value;
						}
					}
					if(flag1===0){
						alert('Please select role');
						mopPlenaryRoleArr[0].focus();
						return;
					}

					if(document.getElementById('lectureTitle').style.display=="block"){

						if(document.getElementById('lectureTitle').value===''){
							alert('Please enter Title of Lecture');
							document.getElementById('lectureTitle').focus();
							return;
						}else if([...document.getElementById('lectureTitle').value].length > 200){
							alert('Title should be within 200 charachters');
							document.getElementById('lectureTitle').focus();
							return;
						}
						else{
							post_lectureTitle = document.getElementById('lectureTitle').value;
						}
						if(document.getElementById('lectureDesc').value===''){
							alert('Please enter Description of Lecture');
							document.getElementById('lectureDesc').focus();
							return;
						}else if([...document.getElementById('lectureDesc').value].length > 2000){
							alert('About/ Description should be within 2000 charachters');
							document.getElementById('lectureDesc').focus();
							return;
						}else{
							post_lectureDescOrAbstract = document.getElementById('lectureDesc').value;
						}

					}

					
				}

				else if(document.getElementById('mopTechDiv').style.display==='block'){
					var mopTechTypeArr = document.getElementsByName('mopTechType[]');
					var flag1 = 0;
					
					for (var i = 0; i < mopTechTypeArr.length; i++) {
						if(mopTechTypeArr[i].checked){
							++flag1;
							post_sessionType = mopTechTypeArr[i].value;
						}
					}
					if(flag1===0){
						alert('Please select type of session');
						mopTechTypeArr[0].focus();
						return;
					}

					var mopTechRoleArr = document.getElementsByName('mopTechRole[]');
					var flag2 = 0;
					
					for (var i = 0; i < mopTechRoleArr.length; i++) {
						if(mopTechRoleArr[i].checked){
							++flag2;
							post_participationRole = mopTechRoleArr[i].value;
						}
					}
					if(flag2===0){
						alert('Please select current role');
						mopTechRoleArr[0].focus();
						return;
					}

					if(!post_participationRole==="Delegate/Participant" && !post_sessionType==="Attendees" && document.getElementById('techSess').value===''){
						alert('Please select a technical session area');
						document.getElementById('techSess').focus();
						return;
					}else{
						post_techSessOrTheme = document.getElementById('techSess').value;
					}

					if(document.getElementById('lectureTitle1').style.display=="block"){
						if(document.getElementById('lectureTitle1').value===''){
							alert('Please enter Title of Lecture');
							document.getElementById('lectureTitle1').focus();
							return;
						}else if([...document.getElementById('lectureTitle1').value].length > 200){
							alert('Title should be within 200 charachters');
							document.getElementById('lectureTitle1').focus();
							return;
						}else{
							post_lectureTitle = document.getElementById('lectureTitle1').value;
						}
						if(document.getElementById('lectureDesc1').value===''){
							alert('Please enter Description of Lecture');
							document.getElementById('lectureDesc1').focus();
							return;
						}else if([...document.getElementById('lectureDesc1').value].length > 2000){
							alert('Title should be within 2000 charachters');
							document.getElementById('lectureDesc1').focus();
							return;
						}else{
							post_lectureDescOrAbstract = document.getElementById('lectureDesc1').value;
						}

						if(document.getElementById('abstractFile').value===''){
							alert('Please upload a 2-page abstract file');
							document.getElementById('abstractFile').focus();
							return;
						}else{
							post_abstractFilePath = document.getElementById('abstractFile').value;
						}
					}

					
				}

				else if(document.getElementById('mopBrainDiv').style.display==='block'){
					var mopBrainRoleArr = document.getElementsByName('mopBrainRole[]');
					var flag1 = 0;
					
					for (var i = 0; i < mopBrainRoleArr.length; i++) {
						if(mopBrainRoleArr[i].checked){
							++flag1;
							post_participationRole = mopBrainRoleArr[i].value;
						}
					}
					if(flag1===0){
						alert('Please select current role');
						mopBrainRoleArr[0].focus();
						return;
					}

					if(document.getElementById('themes').value===''){
						alert('Please choose a theme');
						document.getElementById('themes').focus();
						return;
					}else{
						post_techSessOrTheme = document.getElementById('themes').value;
					}
				}

				else if(document.getElementById('mopResearchDiv').style.display==='block'){
					var mopResearchRoleArr = document.getElementsByName('mopResearchRole[]');
					var flag1 = 0;
					
					for (var i = 0; i < mopResearchRoleArr.length; i++) {
						if(mopResearchRoleArr[i].checked){
							++flag1;
							post_participationRole = mopResearchRoleArr[i].value;
						}
					}
					if(flag1===0){
						alert('Please select current role');
						mopResearchRoleArr[0].focus();
						return;
					}

					if(document.getElementById('lectureTitle2').style.display=="block"){
						var mopResearchTypeArr = document.getElementsByName('mopResearchType[]');
						var flag2 = 0;
						
						for (var i = 0; i < mopResearchTypeArr.length; i++) {
							if(mopResearchTypeArr[i].checked){
								++flag2;
								post_sessionType = mopResearchTypeArr[i].value;
							}
						}
						if(flag2===0){
							alert('Please select exhibition type');
							mopResearchTypeArr[0].focus();
							return;
						}

						if(document.getElementById('numberOfSlot').value===''){
							alert('Please select no. of slots required');
							document.getElementById('numberOfSlot').focus();
							return;
						}else{
							post_slotsReqd = document.getElementById('numberOfSlot').value;
						}

						if(document.getElementById('lectureTitle2').value===''){
							alert('Please enter Title of Lecture');
							document.getElementById('lectureTitle2').focus();
							return;
						}else if([...document.getElementById('lectureTitle2').value].length > 200){
							alert('Title should be within 2000 charachters');
							document.getElementById('lectureTitle2').focus();
							return;
						}else{
							post_lectureTitle = document.getElementById('lectureTitle2').value;
						}
						if(document.getElementById('lectureDesc2').value===''){
							alert('Please enter Description of Lecture');
							document.getElementById('lectureDesc2').focus();
							return;
						}else if([...document.getElementById('lectureDesc2').value].length > 2000){
							alert('About/Description should be within 2000 charachters');
							document.getElementById('lectureDesc2').focus();
							return;
						}else{
							post_lectureDescOrAbstract = document.getElementById('lectureDesc2').value;
						}
					}

					
				}

				//----------GUWAHATI BIOTECH PARK STARTS HERE------------------------------------------//
				//----------EXPO DIV-----------//
				else if(document.getElementById('mopExpoDiv').style.display==='block'){

					

					var partName1 = document.getElementById("partName_1").value;
					var partDesig1 = document.getElementById("partDesig_1").value;
					var partEmail1 = document.getElementById("partEmail_1").value;
					var partPhone1 = document.getElementById("partPhone_1").value;
					var partWebsite1 = document.getElementById("partWebsite_1").value;
					if(partName1==="" || partDesig1 ==="" || partEmail1 ==="" || partPhone1 ==="" || partWebsite1 ===""){
						alert("Please enter atleast one participant");
						document.getElementById("partName_1").focus();
						return;
					}

					var mopExpoTypeArr = document.getElementsByName('mopExpoType[]');
					var flagb1 = 0;
					for (var i = 0; i < mopExpoTypeArr.length; i++) {
						if(mopExpoTypeArr[i].checked){
							++flagb1;
							post_sessionType = (post_sessionType==="") ? mopExpoTypeArr[i].value : post_sessionType + ";" + mopExpoTypeArr[i].value;
						}
					}
					if(flagb1===0){
						alert('Please select type of display');
						mopExpoTypeArr[0].focus();
						return;
					}

					if(document.getElementById("lectureDesc3").value===""){
						alert("Please enter product description.");
						document.getElementById("lectureDesc3").focus();
						return;
					}else{

						post_lectureDescOrAbstract = document.getElementById("lectureDesc3").value;
					
					}

					var mopExpoPowerArr = document.getElementsByName('mopExpoPower[]');
					var flagb2 = 0;
					for (var i = 0; i < mopExpoPowerArr.length; i++) {
						if(mopExpoPowerArr[i].checked){
							++flagb2;
							post_powerRqmt = mopExpoPowerArr[i].value;
						}
					}
					if(flagb2===0){
						alert('Please select power requirement');
						mopExpoPowerArr[0].focus();
						return;
					}

					if(document.getElementById("numberOfSlot2").value===""){
						alert("Please enter no. of slots.");
						document.getElementById("numberOfSlot2").focus();
						return;
					}else{
						post_slotsReqd = document.getElementById("numberOfSlot2").value;
					}

					if(document.getElementById("otherReqExpo").value !== ""){
						post_OtherRqmt = document.getElementById("otherReqExpo").value;
					}					

				}

				//---------------Young Minds Challenge-----------------//
				else if(document.getElementById('mopYmcDiv').style.display==='block'){

					

					if(document.getElementById("addressYmc").value===""){
						alert("Please enter school address");
						document.getElementById("addressYmc").focus();
						return;
					}else{

						post_schoolAddress = document.getElementById("addressYmc").value;

					}

					var grpName_1 = document.getElementById("grpName_1").value;
					var grpDesig_1 = document.getElementById("grpDesig_1").value;
					var grpEmail_1 = document.getElementById("grpEmail_1").value;
					var grpPhone_1 = document.getElementById("grpPhone_1").value;
					if(grpName_1==="" || grpDesig_1 ==="" || grpEmail_1 ==="" || grpPhone_1 ===""){
						alert("Please enter atleast one participant");
						document.getElementById("grpName_1").focus();
						return;
					}

					if(document.getElementById("nameAcpYmc").value===""){
						alert("Please enter accompanying person name");
						document.getElementById("nameAcpYmc").focus();
						return;
					}

					if(document.getElementById("desigAcpYmc").value===""){
						alert("Please enter accompanying person designation");
						document.getElementById("desigAcpYmc").focus();
						return;
					}

					if(document.getElementById("phoneAcpYmc").value===""){
						alert("Please enter accompanying person phone");
						document.getElementById("phoneAcpYmc").focus();
						return;
					}

					if(document.getElementById("themesYmc").value===""){
						alert("Please select theme");
						document.getElementById("themesYmc").focus();
						return;
					}else{
						post_techSessOrTheme = document.getElementById("themesYmc").value;
					}

					if(document.getElementById("letterFile").value===""){
						alert("Please upload Letter of Support");
						document.getElementById("letterFile").focus();
						return;
					}else{
						post_letterFile = document.getElementById("letterFile").value;
					}

					if(document.getElementById("conceptFile").value===""){
						alert("Please upload Concept File");
						document.getElementById("conceptFile").focus();
						return;
					}else{
						post_abstractFilePath = document.getElementById("conceptFile").value;
					}

					var mopYmcTypeArr = document.getElementsByName('mopYmcType[]');
					var flagb3 = 0;
					for (var i = 0; i < mopYmcTypeArr.length; i++) {
						if(mopYmcTypeArr[i].checked){
							++flagb3;
							post_sessionType = mopYmcTypeArr[i].value;
						}
					}
					if(flagb3===0){
						alert('Please select mode of submission');
						mopYmcTypeArr[0].focus();
						return;
					}

				}

				//--------------Investor's Pitch--------------//
				else if(document.getElementById('mopIpDiv').style.display==='block'){

					

					if(document.getElementById("productName").value===""){
						alert("Please mention Product/Technology Name");
						document.getElementById("productName").focus();
						return;
					}else{
						post_productName = document.getElementById("productName").value;
					}

					var prodPartName_1 = document.getElementById("prodPartName_1").value;
					var prodPartDesig_1 = document.getElementById("prodPartDesig_1").value;
					var prodPartEmail_1 = document.getElementById("prodPartEmail_1").value;
					var prodPartPhone_1 = document.getElementById("prodPartPhone_1").value;
					var prodPartWebsite_1 = document.getElementById("prodPartWebsite_1").value;
					if(prodPartName_1==="" || prodPartDesig_1 ==="" || prodPartEmail_1 ==="" || prodPartPhone_1 ==="" || prodPartWebsite_1 ===""){
						alert("Please enter atleast one participant");
						document.getElementById("prodPartName_1").focus();
						return;
					}

					var mopPitchTypeArr = document.getElementsByName('mopPitchType[]');
					var flagb4 = 0;
					for (var i = 0; i < mopPitchTypeArr.length; i++) {
						if(mopPitchTypeArr[i].checked){
							++flagb4;
							post_sessionType = mopPitchTypeArr[i].value;
						}
					}
					if(flagb4===0){
						alert('Please select mode of pitch');
						mopPitchTypeArr[0].focus();
						return;
					}

					if(document.getElementById("grants").value !== ""){
						post_grants = document.getElementById("grants").value;
					}

					if(document.getElementById("otherReqIp").value !== ""){
						post_OtherRqmt = document.getElementById("otherReqIp").value;
					}

					if(document.getElementById("productFile").value===""){
						alert("Please upload details of the Product/ Technology");
						document.getElementById("productFile").focus();
						return;
					}else{
						post_abstractFilePath = document.getElementById("productFile").value;
					}

					var mopPptTypeArr = document.getElementsByName('mopPptType[]');
					var flagb5 = 0;
					for (var i = 0; i < mopPptTypeArr.length; i++) {
						if(mopPptTypeArr[i].checked){
							++flagb5;
							post_pptType = mopPptTypeArr[i].value;
						}
					}
					if(flagb5===0){
						alert('Please select type of presentation');
						mopPptTypeArr[0].focus();
						return;
					}

				}

				//---------Young Innovative Entrepreneur Award--------------//
				else if(document.getElementById('mopYieaDiv').style.display==='block'){



					var yieaPartName_1 = document.getElementById("yieaPartName_1").value;
					var yieaPartDesig_1 = document.getElementById("yieaPartDesig_1").value;
					var yieaPartEmail_1 = document.getElementById("yieaPartEmail_1").value;
					var yieaPartPhone_1 = document.getElementById("yieaPartPhone_1").value;
					var yieaExp_1 = document.getElementById("yieaExp_1").value;
					if(yieaPartName_1==="" || yieaPartDesig_1 ==="" || yieaPartEmail_1 ==="" || yieaPartPhone_1 ==="" || yieaExp_1 ===""){
						alert("Please enter atleast one participant");
						document.getElementById("yieaPartName_1").focus();
						return;
					}


					if(document.getElementById("productNameYiea").value===""){
						alert("Please mention Product/Technology Name");
						document.getElementById("productNameYiea").focus();
						return;
					}else{
						post_productName = document.getElementById("productNameYiea").value;
					}


					if(document.getElementById("incubator").value===""){
						alert("Please enter Incubator/ Institute associated with");
						document.getElementById("incubator").focus();
						return;
					}else{
						post_incubator = document.getElementById("incubator").value;
					}

					if(document.getElementById("grantsYiea").value !== ""){
						post_grants = document.getElementById("grantsYiea").value;
					}

					if(document.getElementById("otherReqYiea").value !== ""){
						post_OtherRqmt = document.getElementById("otherReqYiea").value;
					}

					if(document.getElementById("yieaConceptFile").value===""){
						alert("Please upload Concept Note File");
						document.getElementById("yieaConceptFile").focus();
						return;
					}else{
						post_abstractFilePath = document.getElementById("yieaConceptFile").value;
					}


				}

				//------------------Assam Bio-innovation Fellowship------------//
				else if(document.getElementById('mopAbfDiv').style.display==='block'){




					if(document.getElementById("qualification").value===""){
						alert("Please enter qualification");
						document.getElementById("qualification").focus();
						return;
					}else{
						post_qualification = document.getElementById("qualification").value;
					}

					if(document.getElementById("mopAbfExp").value===""){
						alert("Please enter experience");
						document.getElementById("mopAbfExp").focus();
						return;
					}else{
						post_expYears = document.getElementById("mopAbfExp").value;
					}

					if(document.getElementById("mopAbfCVFile").value===""){
						alert("Please upload CV");
						document.getElementById("mopAbfCVFile").focus();
						return;
					}else{
						post_cvFile = document.getElementById("mopAbfCVFile").value;
					}

					if(document.getElementById("stmtPurpose").value===""){
						alert("Please enter Statement of Purpose");
						document.getElementById("stmtPurpose").focus();
						return;
					}else{
						post_stmtPupose = document.getElementById("stmtPurpose").value;
					}

					if(document.getElementById("mopAbfRecFile").value===""){
						alert("Please upload Recommendation Letter");
						document.getElementById("mopAbfRecFile").focus();
						return;
					}else{
						post_letterFile = document.getElementById("mopAbfRecFile").value;
					}

					if(document.getElementById("mopAbfProposalFile").value===""){
						alert("Please upload detailed proposal");
						document.getElementById("mopAbfProposalFile").focus();
						return;
					}else{
						post_abstractFilePath = document.getElementById("mopAbfProposalFile").value;
					}					

					if(document.getElementById("otherReqAbf").value !== ""){
						post_OtherRqmt = document.getElementById("otherReqAbf").value;
					}
					

				}

				//--------------SITE VISIT-----------------//
				else if(document.getElementById('mopSiteDiv').style.display==='block'){



					var mopSiteDateArr = document.getElementsByName('mopSiteDate[]');
					var flagb6 = 0;
					for (var i = 0; i < mopSiteDateArr.length; i++) {
						if(mopSiteDateArr[i].checked){
							++flagb6;
							post_dateOfVisit = ( post_dateOfVisit==="" ) ? mopSiteDateArr[i].value : post_dateOfVisit+";"+mopSiteDateArr[i].value;
						}
					}
					if(flagb6===0){
						alert('Please select date of visit');
						mopSiteDateArr[0].focus();
						return;
					}

				}

				//-----------POPULATE MAIN POST FIELDS CONTINUE--------------//

				document.getElementById('post_modeOfParticipation').value = post_modeOfParticipation;
				document.getElementById('post_participationRole').value = post_participationRole;
				document.getElementById('post_sessionType').value = post_sessionType;
				document.getElementById('post_techSessOrTheme').value = post_techSessOrTheme;
				document.getElementById('post_lectureTitle').value = post_lectureTitle;
				document.getElementById('post_lectureDescOrAbstract').value = post_lectureDescOrAbstract;
				document.getElementById('post_slotsReqd').value = post_slotsReqd;
				document.getElementById('post_abstractFilePath').value = post_abstractFilePath;


				document.getElementById('post_powerRqmt').value = post_powerRqmt;
				document.getElementById('post_OtherRqmt').value = post_OtherRqmt;
				document.getElementById('post_schoolAddress').value = post_schoolAddress;
				document.getElementById('post_productName').value = post_productName;
				document.getElementById('post_grants').value = post_grants;
				document.getElementById('post_pptType').value = post_pptType;
				document.getElementById('post_incubator').value = post_incubator;
				document.getElementById('post_qualification').value = post_qualification;
				document.getElementById('post_expYears').value = post_expYears;
				document.getElementById('post_cvFile').value = post_cvFile;
				document.getElementById('post_stmtPupose').value = post_stmtPupose;
				document.getElementById('post_dateOfVisit').value = post_dateOfVisit;



				//-----------POPULATE MAIN POST FIELDS END--------------//

				if (confirm("Are you sure?") == true) {
					submitForm();
				}else{
					return;
				}
			}

			//----------ACTUAL FORWARD LOGIC---------//
			
			var currNextPageCount = +currPageCount + 1;
			divPage.style.display='none';
			document.getElementById("page_"+currNextPageCount).style.display='block';
		}


		//FUNCTION TO SUBMIT THE FORM
		function submitForm(){
			document.getElementById('submitBtn').disabled = true;
			document.getElementById('regForm').submit();
		}




		/*-----------------------------Add delete Rows for Young Minds Challenge-------------------------*/
		var tableYmc = document.getElementById('ymcTable'),
		    tbodyYmc = tableYmc.getElementsByTagName('tbody')[0],
		    cloneYmc = tbodyYmc.rows[0].cloneNode(true);

		function deleteRow(el) {
		    var i = el.parentNode.parentNode.rowIndex;
		    tableYmc.deleteRow(i);
		    while (tableYmc.rows[i]) {
		        updateRow(tableYmc.rows[i], i, false);
		        i++;
		    }
		}

		function insRow() {
			if(tbodyYmc.rows.length < 5){
				var new_row = updateRow(cloneYmc.cloneNode(true), ++tbodyYmc.rows.length, true);
		    	tbodyYmc.appendChild(new_row);	
			}else{
				alert("Max. 5 participants are allowed");
			}
		    
		}

		function updateRow(row, i, reset) {
		    

		    var inp1 = row.cells[0].getElementsByTagName('input')[0];
		    var inp2 = row.cells[1].getElementsByTagName('input')[0];
		    var inp3 = row.cells[2].getElementsByTagName('input')[0];
		    var inp4 = row.cells[3].getElementsByTagName('input')[0];
		    var disBtn = row.cells[4].getElementsByTagName('input')[0];
		    var grpRows = document.getElementById("grpRows");

		    inp1.id = 'grpName_' + i;
		    inp1.name = 'grpName_' + i;
		    inp2.id = 'grpDesig_' + i;
		    inp2.name = 'grpDesig_' + i;
		    inp3.id = 'grpEmail_' + i;
		    inp3.name = 'grpEmail_' + i;
		    inp4.id = 'grpPhone_' + i;
		    inp4.name = 'grpPhone_' + i;
		    disBtn.hidden=false;
		    grpRows.value = i;

		    if (reset) {
		        inp1.value = inp2.value = inp3.value = inp4.value = '';
		    }
		    return row;
		}


/*-----------------------------Add delete Rows for Expo-------------------------*/
		var tableExpo = document.getElementById('expoTable'),
		    tbodyExpo = tableExpo.getElementsByTagName('tbody')[0],
		    cloneExpo = tbodyExpo.rows[0].cloneNode(true);

		function deleteRowExpo(el) {
		    var i = el.parentNode.parentNode.rowIndex;
		    tableExpo.deleteRow(i);
		    while (tableExpo.rows[i]) {
		        updateRowExpo(tableExpo.rows[i], i, false);
		        i++;
		    }
		}

		function insRowExpo() {
			if(tbodyExpo.rows.length < 2){
				var new_row = updateRowExpo(cloneExpo.cloneNode(true), ++tbodyExpo.rows.length, true);
		    	tbodyExpo.appendChild(new_row);	
			}else{
				alert("Max. 2 participants are allowed");
			}
		    
		}

		function updateRowExpo(row, i, reset) {
		    

		    var inp1 = row.cells[0].getElementsByTagName('input')[0];
		    var inp2 = row.cells[1].getElementsByTagName('input')[0];
		    var inp3 = row.cells[2].getElementsByTagName('input')[0];
		    var inp4 = row.cells[3].getElementsByTagName('input')[0];
		    var inp5 = row.cells[4].getElementsByTagName('input')[0];
		    var disBtn = row.cells[5].getElementsByTagName('input')[0];
		    var partRows = document.getElementById("partRows");

		    inp1.id = 'partName_' + i;
		    inp1.name = 'partName_' + i;
		    inp2.id = 'partDesig_' + i;
		    inp2.name = 'partDesig_' + i;
		    inp3.id = 'partEmail_' + i;
		    inp3.name = 'partEmail_' + i;
		    inp4.id = 'partPhone_' + i;
		    inp4.name = 'partPhone_' + i;
		    inp5.id = 'partWebsite_' + i;
		    inp5.name = 'partWebsite_' + i;
		    disBtn.hidden=false;
		    partRows.value = i;

		    if (reset) {
		        inp1.value = inp2.value = inp3.value = inp4.value = inp5.value = '';
		    }
		    return row;
		}

/*-----------------------------Add delete Rows for Investor Pitch-------------------------*/
		var tableProd = document.getElementById('prodTable'),
		    tbodyProd = tableProd.getElementsByTagName('tbody')[0],
		    cloneProd = tbodyProd.rows[0].cloneNode(true);

		function deleteRowProd(el) {
		    var i = el.parentNode.parentNode.rowIndex;
		    tableProd.deleteRow(i);
		    while (tableProd.rows[i]) {
		        updateRowProd(tableProd.rows[i], i, false);
		        i++;
		    }
		}

		function insRowProd() {
			if(tbodyProd.rows.length < 2){
				var new_row = updateRowProd(cloneProd.cloneNode(true), ++tbodyProd.rows.length, true);
		    	tbodyProd.appendChild(new_row);	
			}else{
				alert("Max. 2 participants are allowed");
			}
		    
		}

		function updateRowProd(row, i, reset) {
		    

		    var inp1 = row.cells[0].getElementsByTagName('input')[0];
		    var inp2 = row.cells[1].getElementsByTagName('input')[0];
		    var inp3 = row.cells[2].getElementsByTagName('input')[0];
		    var inp4 = row.cells[3].getElementsByTagName('input')[0];
		    var inp5 = row.cells[4].getElementsByTagName('input')[0];
		    var disBtn = row.cells[5].getElementsByTagName('input')[0];
		    var prodPartRows = document.getElementById("prodPartRows");

		    inp1.id = 'prodPartName_' + i;
		    inp1.name = 'prodPartName_' + i;
		    inp2.id = 'prodPartDesig_' + i;
		    inp2.name = 'prodPartDesig_' + i;
		    inp3.id = 'prodPartEmail_' + i;
		    inp3.name = 'prodPartEmail_' + i;
		    inp4.id = 'prodPartPhone_' + i;
		    inp4.name = 'prodPartPhone_' + i;
		    inp5.id = 'prodPartWebsite_' + i;
		    inp5.name = 'prodPartWebsite_' + i;
		    disBtn.hidden=false;
		    prodPartRows.value = i;

		    if (reset) {
		        inp1.value = inp2.value = inp3.value = inp4.value = inp5.value = '';
		    }
		    return row;
		}

/*-----------------------------Add delete Rows for Young Innovative Entrepreneur Award-------------------------*/
		var tableYiea = document.getElementById('yieaTable'),
		    tbodyYiea = tableYiea.getElementsByTagName('tbody')[0],
		    cloneYiea = tbodyYiea.rows[0].cloneNode(true);

		function deleteRowYiea(el) {
		    var i = el.parentNode.parentNode.rowIndex;
		    tableYiea.deleteRow(i);
		    while (tableYiea.rows[i]) {
		        updateRowYiea(tableYiea.rows[i], i, false);
		        i++;
		    }
		}

		function insRowYiea() {
			if(tbodyYiea.rows.length < 2){
				var new_row = updateRowYiea(cloneYiea.cloneNode(true), ++tbodyYiea.rows.length, true);
		    	tbodyYiea.appendChild(new_row);	
			}else{
				alert("Max. 2 participants are allowed");
			}
		    
		}

		function updateRowYiea(row, i, reset) {
		    

		    var inp1 = row.cells[0].getElementsByTagName('input')[0];
		    var inp2 = row.cells[1].getElementsByTagName('input')[0];
		    var inp3 = row.cells[2].getElementsByTagName('input')[0];
		    var inp4 = row.cells[3].getElementsByTagName('input')[0];
		    var inp5 = row.cells[4].getElementsByTagName('input')[0];
		    var disBtn = row.cells[5].getElementsByTagName('input')[0];
		    var yieaPartRows = document.getElementById("yieaPartRows");

		    inp1.id = 'yieaPartName_' + i;
		    inp1.name = 'yieaPartName_' + i;
		    inp2.id = 'yieaPartDesig_' + i;
		    inp2.name = 'yieaPartDesig_' + i;
		    inp3.id = 'yieaPartEmail_' + i;
		    inp3.name = 'yieaPartEmail_' + i;
		    inp4.id = 'yieaPartPhone_' + i;
		    inp4.name = 'yieaPartPhone_' + i;
		    inp5.id = 'yieaExp_' + i;
		    inp5.name = 'yieaExp_' + i;
		    disBtn.hidden=false;
		    yieaPartRows.value = i;

		    if (reset) {
		        inp1.value = inp2.value = inp3.value = inp4.value = inp5.value = '';
		    }
		    return row;
		}


	</script>

	</body>
</html>