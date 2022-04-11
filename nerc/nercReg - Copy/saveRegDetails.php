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

				$post_regMode = $_POST['post_regMode'];
				$post_email = $_POST['post_email'];
				$post_pwdInput = password_hash($_POST['post_pwdInput'],PASSWORD_DEFAULT);
				$post_title = $_POST['post_title'];
				$post_firstName = $_POST['post_firstName'];
				$post_surName = $_POST['post_surName'];
				$post_desig = $_POST['post_desig'];
				$post_dept = $_POST['post_dept'];
				$post_affiliation = $_POST['post_affiliation'];
				$post_sector = $_POST['post_sector']=="undefined"?"":$_POST['post_sector'];
				$post_nationality = $_POST['post_nationality'];
				$post_phone = $_POST['post_phone'];
				$post_accomodationReqd = $_POST['post_accomodationReqd'];
				$post_transportationReqd = $_POST['post_transportationReqd'];
				$post_otherRequirement = $_POST['post_otherRequirement']=="undefined"?"":$_POST['post_otherRequirement'];
				$post_modeOfParticipation = $_POST['post_modeOfParticipation'];
				$post_participationRole = $_POST['post_participationRole']=="undefined"?"":$_POST['post_participationRole'];
				$post_sessionType = $_POST['post_sessionType']=="undefined"?"":$_POST['post_sessionType'];
				$post_techSessOrTheme = $_POST['post_techSessOrTheme']=="undefined"?"":$_POST['post_techSessOrTheme'];
				$post_lectureTitle = $_POST['post_lectureTitle']=="undefined"?"":$_POST['post_lectureTitle'];
				$post_lectureDescOrAbstract = $_POST['post_lectureDescOrAbstract']=="undefined"?"":$_POST['post_lectureDescOrAbstract'];
				$post_slotsReqd = $_POST['post_slotsReqd']=="undefined"?"":$_POST['post_slotsReqd'];
				$post_abstractFilePath = $_POST['post_abstractFilePath']=="undefined"?"":$_POST['post_abstractFilePath'];

				//--------------Guwahati Biotech POST Variables----------------//
				
				$post_powerRqmt = $_POST['post_powerRqmt']=="undefined"?"":$_POST['post_powerRqmt'];
				$post_OtherRqmt = $_POST['post_OtherRqmt']=="undefined"?"":$_POST['post_OtherRqmt'];
				$post_schoolAddress = $_POST['post_schoolAddress']=="undefined"?"":$_POST['post_schoolAddress'];
				$post_letterFile = $_POST['post_letterFile']=="undefined"?"":$_POST['post_letterFile'];
				$post_productName = $_POST['post_productName']=="undefined"?"":$_POST['post_productName'];		
				$post_grants = $_POST['post_grants']=="undefined"?"":$_POST['post_grants'];
				$post_pptType = $_POST['post_pptType']=="undefined"?"":$_POST['post_pptType'];
				$post_incubator = $_POST['post_incubator']=="undefined"?"":$_POST['post_incubator'];
				$post_qualification = $_POST['post_qualification']=="undefined"?"":$_POST['post_qualification'];
				$post_expYears = $_POST['post_expYears']=="undefined"?"":$_POST['post_expYears'];
				$post_cvFile = $_POST['post_cvFile']=="undefined"?"":$_POST['post_cvFile'];
				$post_stmtPupose = $_POST['post_stmtPupose']=="undefined"?"":$_POST['post_stmtPupose'];
				$post_dateOfVisit = $_POST['post_dateOfVisit']=="undefined"?"":$_POST['post_dateOfVisit'];
				//--------------------------------------------------------------//


				
				

				

				

					/*****************************Expo Participants************************/
				
			    	if(!$_POST['partName_1']=='' && $post_modeOfParticipation == 'Expo'){
			    		$partStmt = $conn->prepare("insert into abc_participants values('',?,?,?,?,?,?,?,?)");
			    		$partStmt->bind_param("ssssssss",$regNum,$role,$name,$desig,$email,$phone,$website,$exp);
			    		for ($i=1; $i<=$_POST['partRows'] ; $i++) { 	
			    			if(!$_POST['partName_'.$i]==''){

			    				$regNum = $regNum;
			    				$role = 'Expo';
			    				$name = $_POST['partName_'.$i];
			    				$desig = $_POST['partDesig_'.$i];
			    				$email = $_POST['partEmail_'.$i];
			    				$phone = $_POST['partPhone_'.$i];
			    				$website = $_POST['partWebsite_'.$i];
			    				$exp = '';
				    			$partStmt->execute();
			    			}	
			    		}
			    		$partStmt->close();
			    	}

			    	/*****************************YMC Participants************************/

			    	if($post_modeOfParticipation == 'Young Minds Challenge'){
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
			    	}
					
			    	if(!$_POST['grpName_1']=='' && $post_modeOfParticipation == 'Young Minds Challenge'){
			    		$grpStmt = $conn->prepare("insert into abc_participants values('',?,?,?,?,?,?,?,?)");
			    		$grpStmt->bind_param("ssssssss",$regNum,$role,$name,$desig,$email,$phone,$website,$exp);
			    		for ($i=1; $i<=$_POST['grpRows'] ; $i++) { 	
			    			if(!$_POST['grpName_'.$i]==''){

			    				$regNum = $regNum;
			    				$role = 'Group';
			    				$name = $_POST['grpName_'.$i];
			    				$desig = $_POST['grpDesig_'.$i];
			    				$email = $_POST['grpEmail_'.$i];
			    				$phone = $_POST['grpPhone_'.$i];
			    				$website = '';
			    				$exp = '';
				    			$grpStmt->execute();
			    			}	
			    		}
			    		$grpStmt->close();
			    	}

			    	


			    	
			    	/*****************************IP Participants************************/
					
			    	if(!$_POST['prodPartName_1']=='' && $post_modeOfParticipation == 'Investor Pitch'){
			    		$prodPartStmt = $conn->prepare("insert into abc_participants values('',?,?,?,?,?,?,?,?)");
			    		$prodPartStmt->bind_param("ssssssss",$regNum,$role,$name,$desig,$email,$phone,$website,$exp);
			    		for ($i=1; $i<=$_POST['prodPartRows'] ; $i++) { 	
			    			if(!$_POST['prodPartName_'.$i]==''){

			    				$regNum = $regNum;
			    				$role = 'Investor Pitch';
			    				$name = $_POST['prodPartName_'.$i];
			    				$desig = $_POST['prodPartDesig_'.$i];
			    				$email = $_POST['prodPartEmail_'.$i];
			    				$phone = $_POST['prodPartPhone_'.$i];
			    				$website = $_POST['prodPartWebsite_'.$i];
			    				$exp = '';
				    			$prodPartStmt->execute();
			    			}	
			    		}
			    		$prodPartStmt->close();
			    	}


			    	/*****************************YIEA Participants************************/
					
			    	if(!$_POST['yieaPartName_1']=='' && $post_modeOfParticipation == 'Young Innovative Entrepreneur Award'){
			    		$yieaPartStmt = $conn->prepare("insert into abc_participants values('',?,?,?,?,?,?,?,?)");
			    		$yieaPartStmt->bind_param("ssssssss",$regNum,$role,$name,$desig,$email,$phone,$website,$exp);
			    		for ($i=1; $i<=$_POST['yieaPartRows'] ; $i++) { 	
			    			if(!$_POST['yieaPartName_'.$i]==''){

			    				$regNum = $regNum;
			    				$role = 'Entrepreneur';
			    				$name = $_POST['yieaPartName_'.$i];
			    				$desig = $_POST['yieaPartDesig_'.$i];
			    				$email = $_POST['yieaPartEmail_'.$i];
			    				$phone = $_POST['yieaPartPhone_'.$i];
			    				$website = '';
			    				$exp = $_POST['yieaExp_'.$i];
				    			$yieaPartStmt->execute();
			    			}	
			    		}
			    		$yieaPartStmt->close();
			    	}
					//----------------FILE UPLOAD SECTION----------------------//
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

					if($_FILES['conceptFile']['size']!=0){	
					print_r($_FILES['conceptFile']['error']);					//---CONCEPT NOTE FILE UPLOAD YOUNG MINDS CHALLENGE - UNDER ABSTRACT PATH
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

					if($_FILES['yieaConceptFile']['size']!=0){	
					print_r($_FILES['yieaConceptFile']['error']);					//---CONCEPT NOTE FILE UPLOAD YIEA - UNDER ABSTRACT PATH
						$target_path = "uploads/".$regNum."/";
						if (!file_exists($target_path)) {
						    mkdir($target_path, 0777, true);
						} 
						$fileNameCmps = explode(".", $_FILES['yieaConceptFile']['name']);
						$fileExtension = strtolower(end($fileNameCmps));
						$target_path = $target_path."concept-".$regNum.".".$fileExtension;   
						  
						if(move_uploaded_file($_FILES['yieaConceptFile']['tmp_name'], $target_path)) {  
						    echo "File uploaded successfully!";  
						    $post_abstractFilePath = $target_path;
						} else{  
						    echo "Sorry, file not uploaded, please try again!";  
						    throw new Exception('File Upload Problem');
						}
					}

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

					if($_FILES['mopAbfRecFile']['size']!=0){						//---RECOMMENDATION FILE UPLOAD
						$target_path = "uploads/".$regNum."/";
						if (!file_exists($target_path)) {
						    mkdir($target_path, 0777, true);
						} 
						$fileNameCmps = explode(".", $_FILES['mopAbfRecFile']['name']);
						$fileExtension = strtolower(end($fileNameCmps));
						$target_path = $target_path."letter-".$regNum.".".$fileExtension;   
						  
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
					
					//---------------FILE UPLOAD SECTION ENDS------------------//
					//-------ADD TO DATABASE-----------------//
					$mainStmt->execute();
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