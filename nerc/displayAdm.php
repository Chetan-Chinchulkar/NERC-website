<?php
	header('Access-Control-Allow-Origin: *');
    /* at the top of 'check.php' */
    if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
        /* 
           Up to you which header to send, some prefer 404 even if 
           the files does exist for security
        */
        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );

        /* choose the appropriate page to redirect users */
        die( header( 'location: index.html' ) );

    }
?>
<?php 
	session_start();
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	include 'nercReg/dbconfig.php';

	$conn=connect();


	$regArr = retrieveRegs($conn);
	$grpArr = retrieveGrp($conn);


	if($_SERVER["REQUEST_METHOD"]=="POST"){
		if(isset($_POST['signOut'])){
			session_destroy();
			header( "Location: index.html", true, 303 );
			die();
		}


		

	}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin Page</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<style type="text/css">
		body{
			height: 100%;
			position: relative;
		}
		.header{
			position: relative;
		}
		.mainContainer{
				width: 100%;
				height: 100%;
				position: relative;
				margin-top: 0;
				margin-bottom: 0;
		}
		/* Style tab links */
		.tablink {
		  background-color: #555;
		  color: white;
		  float: left;
		  border: none;
		  outline: none;
		  cursor: pointer;
		  padding: 14px 16px;
		  font-size: 17px;
		  width: calc(100%/6);
		}

		.tablink:hover {
		  background-color: #777;
		  color: #555;
		}


		/* Style the tab content (and add height:100% for full page content) */
		.tabcontent {
		  display: none;
		  padding: 100px 20px;
		  height: 100%;
		}
		table{
			border-collapse: collapse;
			width: 100%;
    		max-width: 100%;
		}
		td, th{
			border: 1px solid #ccc ;
			padding:  5px;
		}
		.highlightRow{
			border: 8px solid #ccc;
		}

		.headerGrp{
			display: flex;
			justify-content: space-between;
		}

	</style>
</head>
<body>
	<div class="header">
			<!-- <div style="display: flex; flex-direction: row; align-items: center;">
				<img src="images/iitg.png" style="width:7%"/><p>&nbsp IIT GUWAHATI</p>
			</div> -->
			<h3>Admin Page</h3>
			
		</div>
		<div class="mainContainer">
			<!-- <button class="tablink" onclick="openPage('JCN', this)">JCN</button>
			<button class="tablink" onclick="openPage('', this)">JCN</button> -->
			<div class="headerGrp">
				<div>
					<label for="mopSelect">Select Mode Of Participation:</label>
					<select id="mopSelect" onchange="openPage(this.value)">
						<option class="tablink" value='All'>All</option>
						<option class="tablink" value='mode1'>Patron(s)/Head/Vice Chancellors Meeting</option>
						<option class="tablink" value='mode2'>Plenary & Motivational R&D Talks</option>
						<option class="tablink" value='mode3' selected="selected" id="defaultOpenNERC">Parallel Technical Sessions</option>
						<option class="tablink" value='mode4'>Brain Storming Sessions & Panel Discussion</option>
						<option class="tablink" value='mode5'>Research & Innovation Exhibition</option>
						<option class="tablink" value='mode6' id="defaultOpenABC">Expo</option>
						<option class="tablink" value='mode7'>Young Minds Challenge</option>
						<option class="tablink" value='mode8'>Investor Pitch</option>
						<option class="tablink" value='mode9'>Young Innovative Entrepreneur Award</option>
						<option class="tablink" value='mode10'>Assam Bio-innovation Fellowship</option>
						<option class="tablink" value='mode11'>Site Visit to IITG BioNEST and GBP</option>
						<option class="tablink" value='mode12'>Panel Discussion</option>
					</select>
				</div>
				<form class="signOutForm" method="post">
					<button type="submit" name="signOut">Sign Out <i class="fa fa-sign-out"></i></button>
				</form>
			</div>

			<!-------------All TAB---------------->
			<div id="All" class="tabcontent">
			  <table>
			  	<thead>
			  		<tr>
			  			<th>Sl. no.</th>
			  			<th>Registration No.</th>
			  			<th>Mode Of Participation</th>
			  			<th>E-mail</th>
			  			<th>Full Name</th>
			  			<th>Designation</th>
			  			<th>Department</th>
			  			<th>Affiliation</th>
			  			<th>Sector</th>
			  			<th>Nationality</th>
			  			<th>Phone</th>
			  			<th>Accomodation Reqd.</th>
			  			<th>Transportation Reqd.</th>
			  			<th>Other requirement</th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php 
			  		$i = 1;
			  		foreach ($regArr as $key => $value){
				  		echo '<tr>
				  				<td>'.$i++.'</td>
				  				<td>'.$value['regNum'].'</td>
				  				<td>'.$value['modeOfParticipation'].'</td>
				  				<td>'.$value['email'].'</td>
				  				<td>'.$value['firstName'].'</td>
				  				<td>'.$value['desig'].'</td>
				  				<td>'.$value['dept'].'</td>
				  				<td>'.$value['affiliation'].'</td>
				  				<td>'.$value['sector'].'</td>
				  				<td>'.$value['nationality'].'</td>
				  				<td>'.$value['phone'].'</td>
				  				<td>'.$value['accomodationReqd'].'</td>
				  				<td>'.$value['transportationReqd'].'</td>
				  				<td>'.$value['otherRequirement'].'</td>
				  			</tr>';
			  		}
			  		?>
			  	</tbody>
			  </table>
			</div>


			<!-------------Patrons TAB---------------->
			<div id="mode1" class="tabcontent">
			  <table>
			  	<thead>
			  		<tr>
			  			<th>Sl. no.</th>
			  			<th>Registration No.</th>
			  			<th>Mode Of Participation</th>
			  			<th>E-mail</th>
			  			<th>Full Name</th>
			  			<th>Designation</th>
			  			<th>Department</th>
			  			<th>Affiliation</th>
			  			<th>Sector</th>
			  			<th>Nationality</th>
			  			<th>Phone</th>
			  			<th>Accomodation Reqd.</th>
			  			<th>Transportation Reqd.</th>
			  			<th>Other requirement</th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php 
			  		$i = 1;
			  		foreach ($regArr as $key => $value){
			  			if($value['modeOfParticipation'] =="Patron(s)/Head/Vice Chancellors Meeting")
				  		echo '<tr>
				  				<td>'.$i++.'</td>
				  				<td>'.$value['regNum'].'</td>
				  				<td>'.$value['modeOfParticipation'].'</td>
				  				<td>'.$value['email'].'</td>
				  				<td>'.$value['firstName'].'</td>
				  				<td>'.$value['desig'].'</td>
				  				<td>'.$value['dept'].'</td>
				  				<td>'.$value['affiliation'].'</td>
				  				<td>'.$value['sector'].'</td>
				  				<td>'.$value['nationality'].'</td>
				  				<td>'.$value['phone'].'</td>
				  				<td>'.$value['accomodationReqd'].'</td>
				  				<td>'.$value['transportationReqd'].'</td>
				  				<td>'.$value['otherRequirement'].'</td>
				  			</tr>';
			  		}
			  		?>
			  	</tbody>
			  </table>
			</div>

			<!-------------Plenary Talks TAB---------------->
			<div id="mode2" class="tabcontent">
			  <table>
			  	<thead>
			  		<tr>
			  			<th>Sl. no.</th>
			  			<th>Registration No.</th>
			  			<th>Mode Of Participation</th>
			  			<th>E-mail</th>
			  			<th>Full Name</th>
			  			<th>Phone</th>
			  			<th>Role</th>
			  			<th>Lecture Title</th>
			  			<th>Lecture Description</th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php 
			  		$i = 1;
			  		foreach ($regArr as $key => $value){
			  			if($value['modeOfParticipation'] =="Plenary & Motivational R&D Talks")
				  		echo '<tr>
				  				<td>'.$i++.'</td>
				  				<td>'.$value['regNum'].'</td>
				  				<td>'.$value['modeOfParticipation'].'</td>
				  				<td>'.$value['email'].'</td>
				  				<td>'.$value['firstName'].'</td>
				  				<td>'.$value['phone'].'</td>
				  				<td>'.$value['participationRole'].'</td>
				  				<td>'.$value['lectureTitle'].'</td>
				  				<td>'.$value['lectureDescOrAbstract'].'</td>
				  			</tr>';
			  		}
			  		?>
			  	</tbody>
			  </table>
			</div>

			<!-------------Technical Sessions TAB---------------->
			<div id="mode3" class="tabcontent">
			  <table>
			  	<thead>
			  		<tr>
			  			<th>Sl. no.</th>
			  			<th>Registration No.</th>
			  			<th>Mode Of Participation</th>
			  			<th>E-mail</th>
			  			<th>Full Name</th>
			  			<th>Phone</th>
			  			<th>Session Type</th>
			  			<th>Participation Role</th>
			  			<th>Technical Session Area</th>
			  			<th>Lecture Title</th>
			  			<th>Lecture Description</th>
			  			<th>Abstract File Uploaded</th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php 
			  		$i = 1;
			  		foreach ($regArr as $key => $value){
			  			if($value['modeOfParticipation'] =="Parallel Technical Sessions")
				  		echo '<tr>
				  				<td>'.$i++.'</td>
				  				<td>'.$value['regNum'].'</td>
				  				<td>'.$value['modeOfParticipation'].'</td>
				  				<td>'.$value['email'].'</td>
				  				<td>'.$value['firstName'].'</td>
				  				<td>'.$value['phone'].'</td>
				  				<td>'.$value['sessionType'].'</td>
				  				<td>'.$value['participationRole'].'</td>
				  				<td>'.$value['techSessOrTheme'].'</td>
				  				<td>'.$value['lectureTitle'].'</td>
				  				<td>'.$value['lectureDescOrAbstract'].'</td>
				  				<td><a href="nercReg/'.$value['abstractFilePath'].'" target="_blank">Abstract File</a></td>
				  			</tr>';
			  		}
			  		?>
			  	</tbody>
			  </table>
			</div>

			<!-------------Brain Storming TAB---------------->
			<div id="mode4" class="tabcontent">
			  <table>
			  	<thead>
			  		<tr>
			  			<th>Sl. no.</th>
			  			<th>Registration No.</th>
			  			<th>Mode Of Participation</th>
			  			<th>E-mail</th>
			  			<th>Full Name</th>
			  			<th>Phone</th>
			  			<th>Participation Role</th>
			  			<th>Theme Selected</th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php 
			  		$i = 1;
			  		foreach ($regArr as $key => $value){
			  			if($value['modeOfParticipation'] =="Brain Storming Sessions & Panel Discussion"){
			  				$themeName = getThemeName($value['techSessOrTheme']);
					  		echo '<tr>
					  				<td>'.$i++.'</td>
					  				<td>'.$value['regNum'].'</td>
					  				<td>'.$value['modeOfParticipation'].'</td>
					  				<td>'.$value['email'].'</td>
					  				<td>'.$value['firstName'].'</td>
					  				<td>'.$value['phone'].'</td>
					  				<td>'.$value['participationRole'].'</td>
					  				<td>'.$themeName.'</td>
					  			</tr>';
			  			}
			  			
			  		}
			  		?>
			  	</tbody>
			  </table>
			</div>

			<!-------------Exhibition TAB---------------->
			<div id="mode5" class="tabcontent">
			  <table>
			  	<thead>
			  		<tr>
			  			<th>Sl. no.</th>
			  			<th>Registration No.</th>
			  			<th>Mode Of Participation</th>
			  			<th>E-mail</th>
			  			<th>Full Name</th>
			  			<th>Phone</th>
			  			<th>Participation Role</th>
			  			<th>Exhibition Type</th>
			  			<th>Lecture Title</th>
			  			<th>Lecture Description</th>
			  			<th>No. of 3m x 3m slots required</th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php 
			  		$i = 1;
			  		foreach ($regArr as $key => $value){
			  			if($value['modeOfParticipation'] =="Research & Innovation Exhibition")
				  		echo '<tr>
				  				<td>'.$i++.'</td>
				  				<td>'.$value['regNum'].'</td>
				  				<td>'.$value['modeOfParticipation'].'</td>
				  				<td>'.$value['email'].'</td>
				  				<td>'.$value['firstName'].'</td>
				  				<td>'.$value['phone'].'</td>
				  				<td>'.$value['participationRole'].'</td>
				  				<td>'.$value['sessionType'].'</td>
				  				<td>'.$value['lectureTitle'].'</td>
				  				<td>'.$value['lectureDescOrAbstract'].'</td>
				  				<td>'.$value['slotsReqd'].'</td>
				  			</tr>';
			  		}
			  		?>
			  	</tbody>
			  </table>
			</div>


			<!-------------Expo TAB---------------->
			<div id="mode6" class="tabcontent">
			  <table>
			  	<thead>
			  		<tr>
			  			<th>Sl. no.</th>
			  			<th>Registration No.</th>
			  			<th>Mode Of Participation</th>
			  			<th>E-mail</th>
			  			<th>Full Name</th>
			  			<th>Phone</th>
			  			<th>Participations</th>
			  			<th>Type of Display</th>
			  			<th>About the product</th>
			  			<th>Power Requirement</th>
			  			<th>No. of Slots</th>
			  			<th>Other Requirement</th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php 
			  		$i = 1;
			  		foreach ($regArr as $key => $value){
			  			if($value['modeOfParticipation'] =="Expo"){

			  				echo '<tr>
					  				<td>'.$i++.'</td>
					  				<td>'.$value['regNum'].'</td>
					  				<td>'.$value['modeOfParticipation'].'</td>
					  				<td>'.$value['email'].'</td>
					  				<td>'.$value['firstName'].'</td>
					  				<td>'.$value['phone'].'</td>
					  				<td>
					  					<table class="innerTable">
					  						<thead>
					  							<th>Role</th>
					  							<th>Name</th>
					  							<th>Designation</th>
					  							<th>Email</th>
					  							<th>Phone</th>
					  						</thead>
					  						<tbody>
							  				';
							  					foreach ($grpArr as $key0 => $value0) {
							  						if($value0['regNum']==$value['regNum']){

							  							echo '
							  								<tr>
							  									<td>'.$value0['role'].'</td>
							  									<td>'.$value0['name'].'</td>
							  									<td>'.$value0['desig'].'</td>
							  									<td>'.$value0['email'].'</td>
							  									<td>'.$value0['phone'].'</td>
							  								</tr>

							  							';

							  						}

							  					}
							  						
							  			echo	'	</tbody>
							  						</table>
							  					</td>';

							  			echo 	'
							  				<td>'.$value['sessionType'].'</td>
							  				<td>'.$value['lectureDescOrAbstract'].'</td>
							  				<td>'.$value['powerRqmt'].'</td>
							  				<td>'.$value['slotsReqd'].'</td>
							  				<td>'.$value['OtherRqmt'].'</td>
					  			</tr>';

			  			}
				  		
			  		}
			  		?>
			  	</tbody>
			  </table>
			</div>

			<!-------------YMC TAB---------------->
			<div id="mode7" class="tabcontent">
			  <table>
			  	<thead>
			  		<tr>
			  			<th>Sl. no.</th>
			  			<th>Registration No.</th>
			  			<th>E-mail</th>
			  			<th>Full Name</th>
			  			<th>Phone</th>
			  			<th>Participations</th>
			  			<th>Address of School</th>
			  			<th>Theme</th>
			  			<th>Mode of Submission</th>
			  			<th>Letter of Support</th>
			  			<th>Concept Note</th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php 
			  		$i = 1;
			  		foreach ($regArr as $key => $value){
			  			if($value['modeOfParticipation'] =="Young Minds Challenge"){

			  				echo '<tr>
					  				<td>'.$i++.'</td>
					  				<td>'.$value['regNum'].'</td>
					  				<td>'.$value['email'].'</td>
					  				<td>'.$value['firstName'].'</td>
					  				<td>'.$value['phone'].'</td>
					  				<td>
					  					<table class="innerTable">
					  						<thead>
					  							<th>Role</th>
					  							<th>Name</th>
					  							<th>Standard</th>
					  							<th>Address</th>
					  							<th>Phone</th>
					  						</thead>
					  						<tbody>
							  				';
							  					foreach ($grpArr as $key0 => $value0) {
							  						if($value0['regNum']==$value['regNum']){

							  							echo '
							  								<tr>
							  									<td>'.$value0['role'].'</td>
							  									<td>'.$value0['name'].'</td>
							  									<td>'.$value0['desig'].'</td>
							  									<td>'.$value0['email'].'</td>
							  									<td>'.$value0['phone'].'</td>
							  								</tr>

							  							';

							  						}

							  					}
							  						
							  			echo	'	</tbody>
							  						</table>
							  					</td>';

							  			echo 	'
							  				<td>'.$value['schoolAddress'].'</td>
							  				<td>'.getThemeName($value['techSessOrTheme']).'</td>
							  				<td>'.$value['sessionType'].'</td>
							  				<td><a href="nercReg/'.$value['letterFile'].'" target="_blank">Letter of Support</a></td>
							  				<td><a href="nercReg/'.$value['abstractFilePath'].'" target="_blank">Concept Note</a></td>
					  			</tr>';

			  			}
				  		
			  		}
			  		?>
			  	</tbody>
			  </table>
			</div>


			<!-------------INVESTOR PITCH TAB---------------->
			<div id="mode8" class="tabcontent">
			  <table>
			  	<thead>
			  		<tr>
			  			<th>Sl. no.</th>
			  			<th>Registration No.</th>
			  			<th>Mode Of Participation</th>
			  			<th>E-mail</th>
			  			<th>Full Name</th>
			  			<th>Phone</th>
			  			<th>Participations</th>
			  			<th>Name of the Product/Technology</th>
			  			<th>Start-up Stage</th>
			  			<th>Grants Availed</th>
			  			<th>Other Requirements</th>
			  			<th>Product/Technology Details</th>
			  			<th>Type of Presentation</th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php 
			  		$i = 1;
			  		foreach ($regArr as $key => $value){
			  			if($value['modeOfParticipation'] =="Investor Pitch"){

			  				echo '<tr>
					  				<td>'.$i++.'</td>
					  				<td>'.$value['regNum'].'</td>
					  				<td>'.$value['modeOfParticipation'].'</td>
					  				<td>'.$value['email'].'</td>
					  				<td>'.$value['firstName'].'</td>
					  				<td>'.$value['phone'].'</td>
					  				<td>
					  					<table class="innerTable">
					  						<thead>
					  							<th>Role</th>
					  							<th>Name</th>
					  							<th>Designation</th>
					  							<th>Email</th>
					  							<th>Phone</th>
					  							<th>Website</th>
					  						</thead>
					  						<tbody>
							  				';
							  					foreach ($grpArr as $key0 => $value0) {
							  						if($value0['regNum']==$value['regNum']){

							  							echo '
							  								<tr>
							  									<td>'.$value0['role'].'</td>
							  									<td>'.$value0['name'].'</td>
							  									<td>'.$value0['desig'].'</td>
							  									<td>'.$value0['email'].'</td>
							  									<td>'.$value0['phone'].'</td>
							  									<td>'.$value0['website'].'</td>
							  								</tr>

							  							';

							  						}

							  					}
							  						
							  			echo	'	</tbody>
							  						</table>
							  					</td>';

							  			echo 	'
							  				<td>'.$value['productName'].'</td>
							  				<td>'.$value['sessionType'].'</td>
							  				<td>'.$value['grants'].'</td>
							  				<td>'.$value['OtherRqmt'].'</td>
							  				<td><a href="nercReg/'.$value['abstractFilePath'].'" target="_blank">Details of the product/technology</a></td>
							  				<td>'.$value['pptType'].'</td>
					  			</tr>';

			  			}
				  		
			  		}
			  		?>
			  	</tbody>
			  </table>
			</div>


			<!-------------YOUNG INNOVATIVE ENTREPRENEUR AWARD TAB---------------->
			<div id="mode9" class="tabcontent">
			  <table>
			  	<thead>
			  		<tr>
			  			<th>Sl. no.</th>
			  			<th>Registration No.</th>
			  			<th>Mode Of Participation</th>
			  			<th>E-mail</th>
			  			<th>Full Name</th>
			  			<th>Phone</th>
			  			<th>Participations</th>
			  			<th>Name of the Product/Technology</th>
			  			<th>Incubator</th>
			  			<th>Grants Already Availed</th>
			  			<th>Other Requirements</th>
			  			<th>Concept Note</th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php 
			  		$i = 1;
			  		foreach ($regArr as $key => $value){
			  			if($value['modeOfParticipation'] =="Young Innovative Entrepreneur Award"){

			  				echo '<tr>
					  				<td>'.$i++.'</td>
					  				<td>'.$value['regNum'].'</td>
					  				<td>'.$value['modeOfParticipation'].'</td>
					  				<td>'.$value['email'].'</td>
					  				<td>'.$value['firstName'].'</td>
					  				<td>'.$value['phone'].'</td>
					  				<td>
					  					<table class="innerTable">
					  						<thead>
					  							<th>Role</th>
					  							<th>Name</th>
					  							<th>Designation</th>
					  							<th>Email</th>
					  							<th>Phone</th>
					  							<th>Years of Experience</th>
					  						</thead>
					  						<tbody>
							  				';
							  					foreach ($grpArr as $key0 => $value0) {
							  						if($value0['regNum']==$value['regNum']){

							  							echo '
							  								<tr>
							  									<td>'.$value0['role'].'</td>
							  									<td>'.$value0['name'].'</td>
							  									<td>'.$value0['desig'].'</td>
							  									<td>'.$value0['email'].'</td>
							  									<td>'.$value0['phone'].'</td>
							  									<td>'.$value0['exp'].'</td>
							  								</tr>

							  							';

							  						}

							  					}
							  						
							  			echo	'	</tbody>
							  						</table>
							  					</td>';

							  			echo 	'
							  				<td>'.$value['productName'].'</td>
							  				<td>'.$value['incubator'].'</td>
							  				<td>'.$value['grants'].'</td>
							  				<td>'.$value['OtherRqmt'].'</td>
							  				<td><a href="nercReg/'.$value['abstractFilePath'].'" target="_blank">Concept Note</a></td>
					  			</tr>';

			  			}
				  		
			  		}
			  		?>
			  	</tbody>
			  </table>
			</div>

			<!-------------ASSAM BIO-INNOVATION FELLOWSHIP  TAB---------------->
			<div id="mode10" class="tabcontent">
			  <table>
			  	<thead>
			  		<tr>
			  			<th>Sl. no.</th>
			  			<th>Registration No.</th>
			  			<th>Mode Of Participation</th>
			  			<th>E-mail</th>
			  			<th>Full Name</th>
			  			<th>Phone</th>
			  			<th>Educational Qualification</th>
			  			<th>Years of Experience</th>
			  			<th>CV</th>
			  			<th>Statement of Purpose</th>
			  			<th>Recommendation Letter</th>
			  			<th>Detailed Proposal</th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php 
			  		$i = 1;
			  		foreach ($regArr as $key => $value){
			  			if($value['modeOfParticipation'] =="Assam Bio-innovation Fellowship"){

			  				echo '<tr>
					  				<td>'.$i++.'</td>
					  				<td>'.$value['regNum'].'</td>
					  				<td>'.$value['modeOfParticipation'].'</td>
					  				<td>'.$value['email'].'</td>
					  				<td>'.$value['firstName'].'</td>
					  				<td>'.$value['phone'].'</td>
							  		<td>'.$value['qualification'].'</td>
							  		<td>'.$value['expYears'].'</td>
							  		<td><a href="nercReg/'.$value['cvFile'].'" target="_blank">Download CV</a></td>
							  		<td>'.$value['stmtPupose'].'</td>
							  		<td><a href="nercReg/'.$value['letterFile'].'" target="_blank">Recommendation Letter</a></td>
							  		<td><a href="nercReg/'.$value['abstractFilePath'].'" target="_blank">Detailed Proposal</a></td>
					  			</tr>';

			  			}
				  		
			  		}
			  		?>
			  	</tbody>
			  </table>
			</div>

			<!-------------SITE VISIT  TAB---------------->
			<div id="mode11" class="tabcontent">
			  <table>
			  	<thead>
			  		<tr>
			  			<th>Sl. no.</th>
			  			<th>Registration No.</th>
			  			<th>Mode Of Participation</th>
			  			<th>E-mail</th>
			  			<th>Full Name</th>
			  			<th>Phone</th>
			  			<th>Date of Visit</th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php 
			  		$i = 1;
			  		foreach ($regArr as $key => $value){
			  			if($value['modeOfParticipation'] =="Site Visit to IITG BioNEST and GBP"){

			  				echo '<tr>
					  				<td>'.$i++.'</td>
					  				<td>'.$value['regNum'].'</td>
					  				<td>'.$value['modeOfParticipation'].'</td>
					  				<td>'.$value['email'].'</td>
					  				<td>'.$value['firstName'].'</td>
					  				<td>'.$value['phone'].'</td>
					  				<td>'.$value['dateOfVisit'].'</td>
					  			</tr>';

			  			}
				  		
			  		}
			  		?>
			  	</tbody>
			  </table>
			</div>

			<!-------------Panel Discussion  TAB---------------->
			<div id="mode12" class="tabcontent">
			  <table>
			  	<thead>
			  		<tr>
			  			<th>Sl. no.</th>
			  			<th>Registration No.</th>
			  			<th>Mode Of Participation</th>
			  			<th>E-mail</th>
			  			<th>Full Name</th>
			  			<th>Phone</th>
			  			<th>Sessions Selected</th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php 
			  		$i = 1;
			  		foreach ($regArr as $key => $value){
			  			if($value['modeOfParticipation'] =="Panel Discussion"){

			  				echo '<tr>
					  				<td>'.$i++.'</td>
					  				<td>'.$value['regNum'].'</td>
					  				<td>'.$value['modeOfParticipation'].'</td>
					  				<td>'.$value['email'].'</td>
					  				<td>'.$value['firstName'].'</td>
					  				<td>'.$value['phone'].'</td>
					  				<td>'.$value['dateOfVisit'].'</td>
					  			</tr>';

			  			}
				  		
			  		}
			  		?>
			  	</tbody>
			  </table>
			</div>

		</div>

	<script>


		function submitShortlistForm(elem){
			var form = elem.parentNode;
			console.log(form);
			console.log(form.action+">"+form.method);
			console.log(new FormData(form));
			// Post data using the Fetch API
			fetch(form.action, {
				method: 'POST',
				body: 'title=hello&message=world',
			});
			
			
		}
		function highlightRow(elem){
			elem.classList.toggle("highlightRow");
		}
		function openPage(pageName) {
			var i, tabcontent, tablinks;
			tabcontent = document.getElementsByClassName("tabcontent");
			for (i = 0; i < tabcontent.length; i++) {
				tabcontent[i].style.display = "none";
			} 
			document.getElementById(pageName).style.display = "block";
		}
		// Get the element with id="defaultOpen" and click on it
		var user = '<?php echo $_SESSION["username"]; ?>';
		if(user==="nerc@iitg.ac.in"){
			openPage('mode3');
			document.getElementById("defaultOpenNERC").selected="true";
		}else{
			openPage('mode6');
			document.getElementById("defaultOpenABC").selected="true";
		}
		

		//sortTable();

		function sortTable() {
			  var table, rows, switching, i, x, y, shouldSwitch;
			  table = document.getElementById("projPropTable");
			  switching = true;
			  /*Make a loop that will continue until
			  no switching has been done:*/
			  while (switching) {
			    //start by saying: no switching is done:
			    switching = false;
			    rows = table.rows;
			    /*Loop through all table rows (except the
			    first, which contains table headers):*/
			    for (i = 1; i < (rows.length - 1); i++) {
			      //start by saying there should be no switching:
			      shouldSwitch = false;
			      /*Get the two elements you want to compare,
			      one from current row and one from the next:*/
			      x = rows[i].getElementsByTagName("TD")[2];
			      y = rows[i + 1].getElementsByTagName("TD")[2];
			      //check if the two rows should switch place:
			      if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
			        //if so, mark as a switch and break the loop:
			        shouldSwitch = true;
			        break;
			      }
			    }
			    if (shouldSwitch) {
			      /*If a switch has been marked, make the switch
			      and mark that a switch has been done:*/
			      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
			      switching = true;
			    }
			  }
			}

			
	</script>
	   	
</body>
</html>