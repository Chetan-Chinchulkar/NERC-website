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

<?php

	include 'dbconfig.php';
	include 'mailer.php';

	$conn = connect();

	/**************Code for saving form details**********************/
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		if(!empty($_POST['post_email'])){


			
			$conn->autocommit(FALSE);
			$conn->begin_transaction();
			try{

				//----------------PREPARE MAIN INSERT STMT-----------------------//
				$mainStmt = $conn->prepare("insert into nerc_reg values('','',?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,? ,?,?,?,?,?,?,?,?,?,?,?,?,?)");
				$mainStmt->bind_param("sssssssssssssssssssssssssssssssssssss",$regNum,$post_regMode,$post_email,$post_pwdInput,$post_title,$post_firstName,$post_surName,$post_desig,$post_dept,$post_affiliation,$post_sector,$post_nationality,$post_phone,$post_accomodationReqd,$post_transportationReqd,$post_otherRequirement,$post_modeOfParticipation,$post_participationRole,$post_sessionType,$post_techSessOrTheme,$post_lectureTitle,$post_lectureDescOrAbstract,$post_slotsReqd,$post_abstractFilePath, $post_powerRqmt, $post_OtherRqmt, $post_schoolAddress, $post_letterFile, $post_productName, $post_grants, $post_pptType, $post_incubator, $post_qualification, $post_expYears, $post_cvFile, $post_stmtPupose, $post_dateOfVisit);

				
				//---------------------------------------------------------------//

				$thisId = retrievelastUser($conn) + 1;
				

				if(strlen($thisId)==1){
					$thisIdStr = '000'.$thisId;
				}else if(strlen($thisId)==2){
					$thisIdStr = '00'.$thisId;
				}else if(strlen($thisId)==3){
					$thisIdStr = '0'.$thisId;
				}else{
					$thisIdStr = $thisId;
				}


				$regNum = date("md").'U'.$thisIdStr;

				//-------------NEW CODE START-------------------//

				$mopArr = explode(";",$_POST['post_modeOfParticipation']);

				for ($i=0; $i <= sizeof($mopArr) - 1; $i++) { 

					//----------BASIC DETAILS------------//
					$post_regMode = $_POST['post_regMode']=="undefined"?"":$_POST['post_regMode'];
					$post_email = $_POST['post_email']=="undefined"?"":$_POST['post_email'];
					$post_pwdInput = password_hash($_POST['post_pwdInput'],PASSWORD_DEFAULT);
					$post_title = $_POST['post_title']=="undefined"?"":$_POST['post_title'];
					$post_firstName = $_POST['post_firstName']=="undefined"?"":$_POST['post_firstName'];
					$post_surName = $_POST['post_surName']=="undefined"?"":$_POST['post_surName'];
					$post_desig = $_POST['post_desig']=="undefined"?"":$_POST['post_desig'];
					$post_dept = $_POST['post_dept']=="undefined"?"":$_POST['post_dept'];
					$post_affiliation = $_POST['post_affiliation']=="undefined"?"":$_POST['post_affiliation'];
					$post_sector = $_POST['post_sector']=="undefined"?"":$_POST['post_sector'];
					$post_nationality = $_POST['post_nationality']=="undefined"?"":$_POST['post_nationality'];
					$post_phone = $_POST['post_phone']=="undefined"?"":$_POST['post_phone'];
					$post_accomodationReqd = $_POST['post_accomodationReqd'];
					$post_transportationReqd = $_POST['post_transportationReqd'];
					$post_otherRequirement = $_POST['post_otherRequirement']=="undefined"?"":$_POST['post_otherRequirement'];
					$post_modeOfParticipation = $mopArr[$i];
					

					//-------------EVENT SPECIFIC DETAILS---------------------------//

					if($mopArr[$i]=='Patron(s)/Head/Vice Chancellors Meeting'){

						$post_participationRole = '';
						$post_sessionType = '';
						$post_techSessOrTheme = '';
						$post_lectureTitle = '';
						$post_lectureDescOrAbstract = '';
						$post_slotsReqd = '';
						$post_abstractFilePath = '';

						//--------------Guwahati Biotech POST Variables----------------//
						
						$post_powerRqmt = '';
						$post_OtherRqmt = '';
						$post_schoolAddress = '';
						$post_letterFile = '';
						$post_productName = '';	
						$post_grants = '';
						$post_pptType = '';
						$post_incubator = '';
						$post_qualification = '';
						$post_expYears = '';
						$post_cvFile = '';
						$post_stmtPupose = '';
						$post_dateOfVisit = '';
						//--------------------------------------------------------------//

					}
					else if($mopArr[$i]=='Plenary & Motivational R&D Talks'){

						$post_participationRole = $_POST['mopPlenaryRole'][0];
						$post_sessionType = '';
						$post_techSessOrTheme = '';
						$post_lectureTitle = $_POST['lectureTitle'];
						$post_lectureDescOrAbstract = '';
						$post_slotsReqd = '';
						$post_abstractFilePath = '';
						// $post_abstractFilePath = $_POST['abstractFilePlenary'];

						//--------------Guwahati Biotech POST Variables----------------//
						
						$post_powerRqmt = '';
						$post_OtherRqmt = '';
						$post_schoolAddress = '';
						$post_letterFile = '';
						$post_productName = '';	
						$post_grants = '';
						$post_pptType = '';
						$post_incubator = '';
						$post_qualification = '';
						$post_expYears = '';
						$post_cvFile = '';
						$post_stmtPupose = '';
						$post_dateOfVisit = '';
						//--------------------------------------------------------------//

						if($_FILES['abstractFilePlenary']['size']!=0){						//---ABSTRACT FILE UPLOAD PLENARY TALKS - UNDER ABSTRACT PATH
							$target_path = "uploads/".$regNum."/";
							if (!file_exists($target_path)) {
							    mkdir($target_path, 0777, true);
							}  
							$fileNameCmps = explode(".", $_FILES['abstractFilePlenary']['name']);
							$fileExtension = strtolower(end($fileNameCmps));
							$target_path = $target_path."plenaryTalk-".$regNum.".".$fileExtension;   
							  
							if(move_uploaded_file($_FILES['abstractFilePlenary']['tmp_name'], $target_path)) {  
							    echo "File uploaded successfully!";  
							    $post_abstractFilePath = $target_path;
							} else{  
							    echo "Sorry, file not uploaded, please try again!";  
							    throw new Exception('File Upload Problem');
							}
						}

					}
					else if($mopArr[$i]=='Parallel Technical Sessions'){
						$post_participationRole = '';
						$post_sessionType = $_POST['mopTechType'][0];
						$post_techSessOrTheme = $_POST['techSess'];
						$post_lectureTitle = $_POST['lectureTitle1'];
						$post_lectureDescOrAbstract = $_POST['lectureDesc1'];
						$post_slotsReqd = '';
						$post_abstractFilePath = '';
						// $post_abstractFilePath = $_POST['abstractFile'];

						//--------------Guwahati Biotech POST Variables----------------//
						
						$post_powerRqmt = '';
						$post_OtherRqmt = '';
						$post_schoolAddress = '';
						$post_letterFile = '';
						$post_productName = '';	
						$post_grants = '';
						$post_pptType = '';
						$post_incubator = '';
						$post_qualification = '';
						$post_expYears = '';
						$post_cvFile = '';
						$post_stmtPupose = '';
						$post_dateOfVisit = '';
						//--------------------------------------------------------------//

						if($_FILES['abstractFile']['size']!=0){						//---ABSTRACT FILE UPLOAD TECHNICAL SESSION - UNDER ABSTRACT PATH
							$target_path = "uploads/".$regNum."/";
							if (!file_exists($target_path)) {
							    mkdir($target_path, 0777, true);
							}  
							$fileNameCmps = explode(".", $_FILES['abstractFile']['name']);
							$fileExtension = strtolower(end($fileNameCmps));
							$target_path = $target_path."abstract-".$regNum.".".$fileExtension;   
							  
							if(move_uploaded_file($_FILES['abstractFile']['tmp_name'], $target_path)) {  
							    echo "File uploaded successfully!";  
							    $post_abstractFilePath = $target_path;
							} else{  
							    echo "Sorry, file not uploaded, please try again!";  
							    throw new Exception('File Upload Problem');
							}
						}
					}
					else if($mopArr[$i]=='Brain Storming Sessions & Panel Discussion'){
						$post_participationRole = $_POST['mopBrainRole'][0];
						$post_sessionType = '';
						$post_techSessOrTheme = $_POST['themes'];
						$post_lectureTitle = '';
						$post_lectureDescOrAbstract = '';
						$post_slotsReqd = '';
						$post_abstractFilePath = '';

						//--------------Guwahati Biotech POST Variables----------------//
						
						$post_powerRqmt = '';
						$post_OtherRqmt = '';
						$post_schoolAddress = '';
						$post_letterFile = '';
						$post_productName = '';	
						$post_grants = '';
						$post_pptType = '';
						$post_incubator = '';
						$post_qualification = '';
						$post_expYears = '';
						$post_cvFile = '';
						$post_stmtPupose = '';
						$post_dateOfVisit = '';
						//--------------------------------------------------------------//
					}
					else if($mopArr[$i]=='Research & Innovation Exhibition'){
						$post_participationRole = $_POST['mopResearchRole'][0];
						$post_sessionType = $_POST['mopResearchType'][0];
						$post_techSessOrTheme = '';
						$post_lectureTitle = $_POST['lectureTitle2'];
						$post_lectureDescOrAbstract = $_POST['lectureDesc2'];
						$post_slotsReqd = $_POST['numberOfSlot'];
						$post_abstractFilePath = '';

						//--------------Guwahati Biotech POST Variables----------------//
						
						$post_powerRqmt = '';
						$post_OtherRqmt = '';
						$post_schoolAddress = '';
						$post_letterFile = '';
						$post_productName = '';	
						$post_grants = '';
						$post_pptType = '';
						$post_incubator = '';
						$post_qualification = '';
						$post_expYears = '';
						$post_cvFile = '';
						$post_stmtPupose = '';
						$post_dateOfVisit = '';
						//--------------------------------------------------------------//
					}
					else if($mopArr[$i]=='Expo'){

						/*****************************Expo Participants************************/
				
				    	if(!$_POST['partName_1']==''){
				    		$partStmt = $conn->prepare("insert into abc_participants values('',?,?,?,?,?,?,?,?)");
				    		$partStmt->bind_param("ssssssss",$regNum,$role,$name,$desig,$email,$phone,$website,$exp);
				    		for ($j=1; $j<=$_POST['partRows'] ; $j++) { 	
				    			if(!$_POST['partName_'.$j]==''){

				    				$regNum = $regNum;
				    				$role = 'Expo';
				    				$name = $_POST['partName_'.$j];
				    				$desig = $_POST['partDesig_'.$j];
				    				$email = $_POST['partEmail_'.$j];
				    				$phone = $_POST['partPhone_'.$j];
				    				$website = $_POST['partWebsite_'.$j];
				    				$exp = '';
					    			$partStmt->execute();
				    			}	
				    		}
				    		$partStmt->close();
				    	}

				    	$post_participationRole = '';
						$post_sessionType = join(";",$_POST['mopExpoType']);
						$post_techSessOrTheme = '';
						$post_lectureTitle = '';
						$post_lectureDescOrAbstract = $_POST['lectureDesc3'];
						$post_slotsReqd = $_POST['numberOfSlot2'];
						$post_abstractFilePath = '';

						//--------------Guwahati Biotech POST Variables----------------//
						
						$post_powerRqmt = $_POST['mopExpoPower'];
						$post_OtherRqmt = $_POST['otherReqExpo'];
						$post_schoolAddress = '';
						$post_letterFile = '';
						$post_productName = '';	
						$post_grants = '';
						$post_pptType = '';
						$post_incubator = '';
						$post_qualification = '';
						$post_expYears = '';
						$post_cvFile = '';
						$post_stmtPupose = '';
						$post_dateOfVisit = '';
						//--------------------------------------------------------------//

					}
					else if($mopArr[$i]=='Young Minds Challenge'){

						/*****************************YMC Participants************************/

				    		$acmpStmt = $conn->prepare("insert into abc_participants values('',?,?,?,?,?,?,?,?)");
				    		$acmpStmt->bind_param("ssssssss",$regNum,$role,$name,$desig,$email,$phone,$website,$exp);

				    				$regNum = $regNum;
				    				$role = 'Accompanying';
				    				$name = $_POST['nameAcpYmc'];
				    				$desig = $_POST['desigAcpYmc'];
				    				$email = '';
				    				$phone = $_POST['phoneAcpYmc'];
				    				$website = '';
				    				$exp = '';
					    			$acmpStmt->execute();

				    		$acmpStmt->close();
				    	
						
				    	if(!$_POST['grpName_1']==''){
				    		$grpStmt = $conn->prepare("insert into abc_participants values('',?,?,?,?,?,?,?,?)");
				    		$grpStmt->bind_param("ssssssss",$regNum,$role,$name,$desig,$email,$phone,$website,$exp);
				    		for ($j=1; $j<=$_POST['grpRows'] ; $j++) { 	
				    			if(!$_POST['grpName_'.$j]==''){

				    				$regNum = $regNum;
				    				$role = 'Group';
				    				$name = $_POST['grpName_'.$j];
				    				$desig = $_POST['grpDesig_'.$j];
				    				$email = $_POST['grpEmail_'.$j];
				    				$phone = $_POST['grpPhone_'.$j];
				    				$website = '';
				    				$exp = '';
					    			$grpStmt->execute();
				    			}	
				    		}
				    		$grpStmt->close();
				    	}


						$post_participationRole = '';
						$post_sessionType = $_POST['mopYmcType'][0];
						$post_techSessOrTheme = $_POST['themesYmc'];
						$post_lectureTitle = '';
						$post_lectureDescOrAbstract = '';
						$post_slotsReqd = '';
						$post_abstractFilePath = '';
						// $post_abstractFilePath = $_POST['conceptFile'];

						//--------------Guwahati Biotech POST Variables----------------//
						
						$post_powerRqmt = '';
						$post_OtherRqmt = '';
						$post_schoolAddress = $_POST['addressYmc'];
						$post_letterFile = '';
						// $post_letterFile = $_POST['letterFile'];
						$post_productName = '';	
						$post_grants = '';
						$post_pptType = '';
						$post_incubator = '';
						$post_qualification = '';
						$post_expYears = '';
						$post_cvFile = '';
						$post_stmtPupose = '';
						$post_dateOfVisit = '';
						//--------------------------------------------------------------//

						if($_FILES['letterFile']['size']!=0){						//---LETTER OF SUPPORT FILE UPLOAD
							$target_path = "uploads/".$regNum."/";
							if (!file_exists($target_path)) {
							    mkdir($target_path, 0777, true);
							} 
							$fileNameCmps = explode(".", $_FILES['letterFile']['name']);
							$fileExtension = strtolower(end($fileNameCmps));
							$target_path = $target_path."letter-".$regNum.".".$fileExtension;   
							  
							if(move_uploaded_file($_FILES['letterFile']['tmp_name'], $target_path)) {  
							    echo "File uploaded successfully!";  
							    $post_letterFile = $target_path;
							} else{  
							    echo "Sorry, file not uploaded, please try again!";  
							    throw new Exception('File Upload Problem');
							}
						}

						if($_FILES['conceptFile']['size']!=0){					//---CONCEPT NOTE FILE UPLOAD YOUNG MINDS CHALLENGE - UNDER ABSTRACT PATH
							$target_path = "uploads/".$regNum."/";
							if (!file_exists($target_path)) {
							    mkdir($target_path, 0777, true);
							} 
							$fileNameCmps = explode(".", $_FILES['conceptFile']['name']);
							$fileExtension = strtolower(end($fileNameCmps));
							$target_path = $target_path."concept-".$regNum.".".$fileExtension;   
							  
							if(move_uploaded_file($_FILES['conceptFile']['tmp_name'], $target_path)) {  
							    echo "File uploaded successfully!";  
							    $post_abstractFilePath = $target_path;
							} else{  
							    echo "Sorry, file not uploaded, please try again!";  
							    throw new Exception('File Upload Problem');
							}
						}

					}
					else if($mopArr[$i]=='Investor Pitch'){
						/*****************************IP Participants************************/
					
				    	if(!$_POST['prodPartName_1']==''){
				    		$prodPartStmt = $conn->prepare("insert into abc_participants values('',?,?,?,?,?,?,?,?)");
				    		$prodPartStmt->bind_param("ssssssss",$regNum,$role,$name,$desig,$email,$phone,$website,$exp);
				    		for ($j=1; $j<=$_POST['prodPartRows'] ; $j++) { 	
				    			if(!$_POST['prodPartName_'.$j]==''){

				    				$regNum = $regNum;
				    				$role = 'Investor Pitch';
				    				$name = $_POST['prodPartName_'.$j];
				    				$desig = '';
				    				$email = $_POST['prodPartEmail_'.$j];
				    				$phone = $_POST['prodPartPhone_'.$j];
				    				$website = $_POST['prodPartWebsite_'.$j]=="undefined"?"":$_POST['prodPartWebsite_'.$j];;
				    				$exp = $_POST['prodPartExp_'.$j];
					    			$prodPartStmt->execute();
				    			}	
				    		}
				    		$prodPartStmt->close();
				    	}

				    	$post_participationRole = '';
						$post_sessionType = $_POST['mopPitchType'][0];
						$post_techSessOrTheme = '';
						$post_lectureTitle = '';
						$post_lectureDescOrAbstract = '';
						$post_slotsReqd = '';
						$post_abstractFilePath = '';
						// $post_abstractFilePath = $_POST['productFile'];

						//--------------Guwahati Biotech POST Variables----------------//
						
						$post_powerRqmt = '';
						$post_OtherRqmt = $_POST['otherReqIp'];
						$post_schoolAddress = '';
						$post_letterFile = '';
						$post_productName = $_POST['productName'];	
						$post_grants = $_POST['grants'];
						$post_pptType = $_POST['mopPptType'][0];
						$post_incubator = $_POST['prodIncubator'];
						$post_qualification = '';
						$post_expYears = '';
						$post_cvFile = '';
						$post_stmtPupose = '';
						$post_dateOfVisit = '';
						//--------------------------------------------------------------//

						if($_FILES['productFile']['size']!=0){						//---PRODUCT DESCRIPTION FILE UPLOAD INVESTOR PITCH UNDER ABSTRACT PATH
							$target_path = "uploads/".$regNum."/";
							if (!file_exists($target_path)) {
							    mkdir($target_path, 0777, true);
							} 
							$fileNameCmps = explode(".", $_FILES['productFile']['name']);
							$fileExtension = strtolower(end($fileNameCmps));
							$target_path = $target_path."product-".$regNum.".".$fileExtension;   
							  
							if(move_uploaded_file($_FILES['productFile']['tmp_name'], $target_path)) {  
							    echo "File uploaded successfully!";  
							    $post_abstractFilePath = $target_path;
							} else{  
							    echo "Sorry, file not uploaded, please try again!";  
							    throw new Exception('File Upload Problem');
							}
						}

					}
					else if($mopArr[$i]=='Young Innovative Entrepreneur Award'){

						/*****************************YIEA Participants************************/
					
				    	if(!$_POST['yieaPartName_1']==''){
				    		$yieaPartStmt = $conn->prepare("insert into abc_participants values('',?,?,?,?,?,?,?,?)");
				    		$yieaPartStmt->bind_param("ssssssss",$regNum,$role,$name,$desig,$email,$phone,$website,$exp);
				    		for ($j=1; $j<=$_POST['yieaPartRows'] ; $j++) { 	
				    			if(!$_POST['yieaPartName_'.$j]==''){

				    				$regNum = $regNum;
				    				$role = 'Entrepreneur';
				    				$name = $_POST['yieaPartName_'.$j];
				    				$desig = $_POST['yieaPartDesig_'.$j];
				    				$email = $_POST['yieaPartEmail_'.$j];
				    				$phone = $_POST['yieaPartPhone_'.$j];
				    				$website = '';
				    				$exp = $_POST['yieaExp_'.$j];
					    			$yieaPartStmt->execute();
				    			}	
				    		}
				    		$yieaPartStmt->close();
				    	}

						$post_participationRole = '';
						$post_sessionType = '';
						$post_techSessOrTheme = '';
						$post_lectureTitle = '';
						$post_lectureDescOrAbstract = '';
						$post_slotsReqd = '';
						$post_abstractFilePath = '';
						// $post_abstractFilePath = $_POST['yieaConceptFile'];

						//--------------Guwahati Biotech POST Variables----------------//
						
						$post_powerRqmt = '';
						$post_OtherRqmt = $_POST['otherReqYiea'];
						$post_schoolAddress = '';
						$post_letterFile = '';
						$post_productName = $_POST['productNameYiea'];	
						$post_grants = $_POST['grantsYiea'];
						$post_pptType = '';
						$post_incubator = $_POST['incubator'];
						$post_qualification = '';
						$post_expYears = '';
						$post_cvFile = '';
						$post_stmtPupose = '';
						$post_dateOfVisit = '';
						//--------------------------------------------------------------//

						if($_FILES['yieaConceptFile']['size']!=0){						//---CONCEPT NOTE FILE UPLOAD YIEA - UNDER ABSTRACT PATH
							$target_path = "uploads/".$regNum."/";
							if (!file_exists($target_path)) {
							    mkdir($target_path, 0777, true);
							} 
							$fileNameCmps = explode(".", $_FILES['yieaConceptFile']['name']);
							$fileExtension = strtolower(end($fileNameCmps));
							$target_path = $target_path."yieaConcept-".$regNum.".".$fileExtension;   
							  
							if(move_uploaded_file($_FILES['yieaConceptFile']['tmp_name'], $target_path)) {  
							    echo "File uploaded successfully!";  
							    $post_abstractFilePath = $target_path;
							} else{  
							    echo "Sorry, file not uploaded, please try again!";  
							    throw new Exception('File Upload Problem');
							}
						}

					}
					else if($mopArr[$i]=='Assam Bio-innovation Fellowship'){

						$post_participationRole = '';
						$post_sessionType = '';
						$post_techSessOrTheme = '';
						$post_lectureTitle = '';
						$post_lectureDescOrAbstract = '';
						$post_slotsReqd = '';
						$post_abstractFilePath = '';
						// $post_abstractFilePath = $_POST['mopAbfProposalFile'];

						//--------------Guwahati Biotech POST Variables----------------//
						
						$post_powerRqmt = '';
						$post_OtherRqmt = $_POST['otherReqAbf'];
						$post_schoolAddress = '';
						$post_letterFile = '';
						// $post_letterFile = $_POST['mopAbfRecFile'];
						$post_productName = '';	
						$post_grants = '';
						$post_pptType = '';
						$post_incubator = '';
						$post_qualification = $_POST['qualification'];
						$post_expYears = $_POST['mopAbfExp'];
						$post_cvFile = '';
						// $post_cvFile = $_POST['mopAbfCVFile'];
						$post_stmtPupose = $_POST['stmtPurpose'];
						$post_dateOfVisit = '';
						//--------------------------------------------------------------//

						if($_FILES['mopAbfProposalFile']['size']!=0){						//---PROPOSAL FILE UPLOAD ASSAM BIO INNOVATION FELLOWSHIP - UNDER ABSTRACT PATH
							$target_path = "uploads/".$regNum."/";
							if (!file_exists($target_path)) {
							    mkdir($target_path, 0777, true);
							} 
							$fileNameCmps = explode(".", $_FILES['mopAbfProposalFile']['name']);
							$fileExtension = strtolower(end($fileNameCmps));
							$target_path = $target_path."proposal-".$regNum.".".$fileExtension;   
							  
							if(move_uploaded_file($_FILES['mopAbfProposalFile']['tmp_name'], $target_path)) {  
							    echo "File uploaded successfully!";  
							    $post_abstractFilePath = $target_path;
							} else{  
							    echo "Sorry, file not uploaded, please try again!";  
							    throw new Exception('File Upload Problem');
							}
						}

						if($_FILES['mopAbfRecFile']['size']!=0){						//---RECOMMENDATION FILE UPLOAD
							$target_path = "uploads/".$regNum."/";
							if (!file_exists($target_path)) {
							    mkdir($target_path, 0777, true);
							} 
							$fileNameCmps = explode(".", $_FILES['mopAbfRecFile']['name']);
							$fileExtension = strtolower(end($fileNameCmps));
							$target_path = $target_path."RecommendingLetter-".$regNum.".".$fileExtension;   
							  
							if(move_uploaded_file($_FILES['mopAbfRecFile']['tmp_name'], $target_path)) {  
							    echo "File uploaded successfully!";  
							    $post_letterFile = $target_path;
							} else{  
							    echo "Sorry, file not uploaded, please try again!";  
							    throw new Exception('File Upload Problem');
							}
						}

						if($_FILES['mopAbfCVFile']['size']!=0){						//---CV FILE UPLOAD ASSAM BIO INNOVATION FELLOWSHIP
							$target_path = "uploads/".$regNum."/";
							if (!file_exists($target_path)) {
							    mkdir($target_path, 0777, true);
							} 
							$fileNameCmps = explode(".", $_FILES['mopAbfCVFile']['name']);
							$fileExtension = strtolower(end($fileNameCmps));
							$target_path = $target_path."CV-".$regNum.".".$fileExtension;   
							  
							if(move_uploaded_file($_FILES['mopAbfCVFile']['tmp_name'], $target_path)) {  
							    echo "File uploaded successfully!";  
							    $post_cvFile = $target_path;
							} else{  
							    echo "Sorry, file not uploaded, please try again!";  
							    throw new Exception('File Upload Problem');
							}
						}


					}
					else if($mopArr[$i]=='Site Visit to IITG BioNEST and GBP'){
						$post_participationRole = '';
						$post_sessionType = '';
						$post_techSessOrTheme = '';
						$post_lectureTitle = '';
						$post_lectureDescOrAbstract = '';
						$post_slotsReqd = '';
						$post_abstractFilePath = '';

						//--------------Guwahati Biotech POST Variables----------------//
						
						$post_powerRqmt = '';
						$post_OtherRqmt = '';
						$post_schoolAddress = '';
						$post_letterFile = '';
						$post_productName = '';	
						$post_grants = '';
						$post_pptType = '';
						$post_incubator = '';
						$post_qualification = '';
						$post_expYears = '';
						$post_cvFile = '';
						$post_stmtPupose = '';
						$post_dateOfVisit = join(";",$_POST['mopSiteDate']);
						//--------------------------------------------------------------//
					}
					else if($mopArr[$i]=='Panel Discussion'){
						$post_participationRole = '';
						$post_sessionType = '';
						$post_techSessOrTheme = '';
						$post_lectureTitle = '';
						$post_lectureDescOrAbstract = '';
						$post_slotsReqd = '';
						$post_abstractFilePath = '';

						//--------------Guwahati Biotech POST Variables----------------//
						
						$post_powerRqmt = '';
						$post_OtherRqmt = '';
						$post_schoolAddress = '';
						$post_letterFile = '';
						$post_productName = '';	
						$post_grants = '';
						$post_pptType = '';
						$post_incubator = '';
						$post_qualification = '';
						$post_expYears = '';
						$post_cvFile = '';
						$post_stmtPupose = '';
						$post_dateOfVisit = join(";",$_POST['mopPanelDate']);
						//--------------------------------------------------------------//
					}


					$mainStmt->execute();
				}





					$post_email = $_POST['post_email']=="undefined"?"":$_POST['post_email'];
					$post_pwdInput = password_hash($_POST['post_pwdInput'],PASSWORD_DEFAULT);

					//--------ADD TO LOGIN INFORMATION START---------------//

					$loginStmt = $conn->prepare("insert into nerc_login values('',?,?,?)");
					$loginStmt->bind_param("sss",$regNum,$email,$password);
					$regNum = $regNum;
					$email = $post_email;
					$password = $post_pwdInput;
					$loginStmt->execute();
					$loginStmt->close();


					//--------ADD TO LOGIN INFORMATION END---------------//


					//-------ADD TO DATABASE-----------------//
					
					$mainStmt->close();
					$conn->commit();
					sendEmailS($conn,$post_firstName." ".$post_surName,$post_email,$regNum);
					connClose($conn);
					echo 'You have successfully registered. Kindly check your email for your registration no.';
					echo '<script>
								    	alert("You have successfully registered. Kindly check your email for your registration no.")
								    	window.location.href="../index.html";
								    	</script>';	    	
					// header( "Location: ../index.html", true, 303 );
	   				exit();
				
				
				
			}
			catch(\Throwable $e){
				echo $e;
				$conn->rollback();
				connClose($conn);
			}

		}
	}

?>