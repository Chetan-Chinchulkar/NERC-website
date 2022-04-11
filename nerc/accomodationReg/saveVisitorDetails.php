<?php
    /* at the top of 'check.php' */
    if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
        /* 
           Up to you which header to send, some prefer 404 even if 
           the files does exist for security
        */
        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );

        /* choose the appropriate page to redirect users */
        die( header( 'location: ../accomodation.html' ) );

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

			var_dump($_POST);
			
			$conn->autocommit(FALSE);
			$conn->begin_transaction();
			try{

				//----------------PREPARE MAIN INSERT STMT-----------------------//
				$mainStmt = $conn->prepare("insert into accomodation_reg values('',?,?,?,?,?,?,?,?,?,?,?,?)");
				$mainStmt->bind_param("ssssssssssss",$post_participationType,$post_email,$post_contactName,$post_contactPhone,$post_instituteName,$post_hotelAddress,$post_flightTrainNo,$post_arrivalDate,$post_pickupLocation,$post_departureDate,$post_dropLocation,$post_hotelToVenue);

				
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


				// $regNum = date("md").'V'.$thisIdStr;
				$post_participationType = $_POST['post_participationType']=="undefined"?"":$_POST['post_participationType'];
				$post_email = $_POST['post_email']=="undefined"?"":$_POST['post_email'];
				$post_contactName = $_POST['post_contactName']=="undefined"?"":$_POST['post_contactName'];
				$post_contactPhone = $_POST['post_contactPhone']=="undefined"?"":$_POST['post_contactPhone'];
				$post_instituteName = $_POST['post_instituteName']=="undefined"?"":$_POST['post_instituteName'];
				$post_hotelAddress = $_POST['post_hotelAddress']=="undefined"?"":$_POST['post_hotelAddress'];
				$post_flightTrainNo = $_POST['post_flightTrainNo']=="undefined"?"":$_POST['post_flightTrainNo'];
				$post_arrivalDate = $_POST['post_arrivalDate']=="undefined"?"":$_POST['post_arrivalDate'];
				$post_pickupLocation = $_POST['post_pickupLocation']=="undefined"?"":$_POST['post_pickupLocation'];
				$post_departureDate = $_POST['post_departureDate']=="undefined"?"":$_POST['post_departureDate'];
				$post_dropLocation = $_POST['post_dropLocation']=="undefined"?"":$_POST['post_dropLocation'];
				$post_hotelToVenue = $_POST['post_hotelToVenue']=="undefined"?"":$_POST['post_hotelToVenue'];


					//-------ADD TO DATABASE-----------------//
					$mainStmt->execute();
					$mainStmt->close();
					$conn->commit();
					//sendEmailA($conn,$post_contactName,$post_email);
					connClose($conn);
					echo 'You have successfully registered. Kindly check your email.';
					echo '<script>
								    	alert("You have successfully registered. Kindly check your email.")
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