<?php

//-----------REQUIRED FOR TRANSACTION CONTROL- START-----------//
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

//-----------REQUIRED FOR TRANSACTION CONTROL- START-----------//



//Function to connect to DB
function connect(){
/*  $servername = "localhost:3306";
  $username = "rnd";
  $password = "rnd@6721";
  $dbname = "rndDb";*/

  $servername = "localhost:3306";
  $username = "root";
  $password = "";
  $dbname = "test";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }else{
    $conn->set_charset('utf8mb4'); // always set the charset-- REQUIRED FOR TRANSACTION CONTROL
    return $conn;
  }

}

function connClose($conn){
  $conn->close();
}


function retrievelastUser($conn){
  $sql = "select * from nerc_reg ORDER BY id DESC LIMIT 1";
  $result = mysqli_query($conn,$sql);
  if($result->num_rows>0)
    return $result->fetch_assoc()['id'];
  else
    return 0;
}


function retrieveUser($conn,$regNum){
  $sql= "select * from nerc_reg where regNum='$regNum'";
  $result = mysqli_query($conn,$sql);

  $data=array();
  if ($result)
    {
        while($row = $result->fetch_assoc())
        {
            $data[] = $row;
        }
    }
  return $data;
}

function retrieveUserByEmail($conn,$email){
  $sql= "select * from nerc_reg where email='$email'";
  $result = mysqli_query($conn,$sql);

  $data=array();
  if ($result)
    {
        while($row = $result->fetch_assoc())
        {
            $data[] = $row;
        }
    }
  return $data;
}

//-----------RETRIEVE ALL REGISTRATIONS---------------//
function retrieveRegs($conn){   

  $sql = "select * from nerc_reg";
  $result = mysqli_query($conn,$sql);

  $data = array();
  if($result){
    while($row=$result->fetch_assoc())
    {
      $data[] = $row;
    }
  }
  return $data;

}


function retrieveGrp($conn){   

  $sql = "select * from abc_participants";
  $result = mysqli_query($conn,$sql);

  $data = array();
  if($result){
    while($row=$result->fetch_assoc())
    {
      $data[] = $row;
    }
  }
  return $data;

}





//------------UTILITY FUNCTIONS-------------------------//


//------------RETRIEVE THEME NAME-----------------------//

function getThemeName($theme){

  $themeName = "";

  switch ($theme) {
    case 'Theme 1':
      $themeName="Handholding Mechanism for Sustained Research & Innovations Among North-East Institutions";
      break;
    case 'Theme 2':
      $themeName="Harnessing Traditional Knowledge of North Eastern States";
      break;
    case 'Theme 3':
      $themeName="Conservation of Biodiversity through R&D Interventions";
      break;
    case 'Theme 4':
      $themeName="North East Disaster Management & R&D Interventions";
      break;
    case 'Theme 5':
      $themeName="Government R&D Policies for North Eastern States";
      break;
    case 'Theme 6':
      $themeName="A Road Map for Standardisation of Grass root Innovations through R&D practices";
      break;
    case 'Theme 8':
      $themeName="Intervention of AI in MedTech";
      break;
    case 'Theme 9':
      $themeName="Eco Conservation through Biotech";
      break;
    case 'Theme 10':
      $themeName="Bio Solution of Solid Waste Management";
      break;
    case 'Theme 11':
      $themeName="Digital Agriculture and New age farms";
      break;
    case 'Theme 12':
      $themeName="Bioenergy- Opportunities and Challenges";
      break;
    
    default:
      break;
  }

  return $themeName;

}




?>
