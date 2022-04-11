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

	include '../nercReg/dbconfig.php';
	include '../nercReg/mailer.php';

	$conn = connect();

	/**************Code for saving form details**********************/
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		if(!empty($_POST['post_email'])){


			
			$conn->autocommit(FALSE);
			$conn->begin_transaction();
			try{

				//----------------PREPARE MAIN INSERT STMT-----------------------//
				$mainStmt = $conn->prepare("insert into visitor_reg values('','',?,?,?,?,?,?,?,?,?,?,?,?)");
				$mainStmt->bind_param("ssssssssssss",$regNum,$post_instituteName,$post_instituteType,$post_state,$post_city,$post_address,$post_contactName,$post_contactPhone,$post_contactDesig,$post_standard,$post_email,$post_atl);

				
				//---------------------------------------------------------------//

				$thisId = retrievelastVisitor($conn) + 1;
				

				if(strlen($thisId)==1){
					$thisIdStr = '000'.$thisId;
				}else if(strlen($thisId)==2){
					$thisIdStr = '00'.$thisId;
				}else if(strlen($thisId)==3){
					$thisIdStr = '0'.$thisId;
				}else{
					$thisIdStr = $thisId;
				}


				$regNum = date("md").'V'.$thisIdStr;
				$post_instituteName = $_POST['post_instituteName']=="undefined"?"":$_POST['post_instituteName'];
				$post_instituteType = $_POST['post_instituteType']=="undefined"?"":$_POST['post_instituteType'];
				$post_state = $_POST['post_state']=="undefined"?"":$_POST['post_state'];
				$post_city = $_POST['post_city']=="undefined"?"":$_POST['post_city'];
				$post_address = $_POST['post_address']=="undefined"?"":$_POST['post_address'];
				$post_contactName = $_POST['post_contactName']=="undefined"?"":$_POST['post_contactName'];
				$post_contactPhone = $_POST['post_contactPhone']=="undefined"?"":$_POST['post_contactPhone'];
				$post_contactDesig = $_POST['post_contactDesig']=="undefined"?"":$_POST['post_contactDesig'];
				$post_standard = $_POST['post_standard']=="undefined"?"":$_POST['post_standard'];
				$post_email = $_POST['post_email']=="undefined"?"":$_POST['post_email'];
				$post_atl = $_POST['post_atl']=="undefined"?"":$_POST['post_atl'];




					//-------ADD TO DATABASE-----------------//
					$mainStmt->execute();
					$mainStmt->close();
					$conn->commit();
					sendEmailV($conn,$post_instituteName,$post_email,$regNum);
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