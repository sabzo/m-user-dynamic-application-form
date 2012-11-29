<?php
if($_POST['from'] == "paper_info")
{
	require_once('journal/include/student.cl.php');
	require_once('journal/include/mentor.cl.php');
	require_once('journal/include/error.cl.php');
}else{
require_once('../include/student.cl.php');
require_once('../include/mentor.cl.php');
require_once('../include/error.cl.php');
}
session_start();
/*
--------
--------
SECTION 1: Collect the Form Variables depending on which page the data was sent.
SECTION 2: Process the form variables and save as a preparation for them to be sent to the database.
-------
-------
*/
//Session Variables will be determined according to which page the information comes from
$from = $_POST['from'];
//page 2  --student info

if($from == "students") {
$sid = addslashes(trim($_POST['sid']));
$sfname = addslashes(trim($_POST['sfname']));
$slastname = addslashes(trim($_POST['slname']));
$street = addslashes(trim($_POST['s_address']));
$city = addslashes(trim($_POST['s_city']));
$state = addslashes(trim($_POST['s_state']));
$zip = addslashes(trim($_POST['s_zip'])); //int and 5 ints permitted
$s_email = addslashes(trim($_POST['s_email1']));// Email check. Have an option to confirm the e-mail.
$s_email_check = addslashes(trim($_POST['s_email2'])); //checks if email is the same
$s_phone = addslashes(trim($_POST['s_phone']));
$major = addslashes(trim($_POST['major']));
$college = addslashes(trim($_POST['college']));
}
//All the MENTOR variables
//page 3
if($from == "mentors") {
$mfname = addslashes(trim($_POST['mfname']));
$mlname = addslashes(trim($_POST['mlname']));
$m_email = addslashes(trim($_POST['m_email1']));
$m_email_check = addslashes(trim($_POST['m_email2']));
$m_phone = addslashes(trim($_POST['m_phone'])); //int, 10 digits, must include area code
$department = addslashes(trim($_POST['department']));
$m_college = addslashes(trim($_POST['m_college']));
$m_title = addslashes(trim($_POST['academic_title']));
}
if($from == 'paper_info')
{
//All the PROPOSAL variables
//page 4
$title = addslashes(trim($_POST['paper_title']));
$sci_notation = addslashes(trim($_POST['is_sci']));
$use_humans = addslashes(trim($_POST['use_humans']));
$use_animals = addslashes(trim($_POST['use_animals']));
}

// ----------- Error Checks ---------------
$fields = array(); //key component

//PAGE 1 CHECKS  -- how many authors and how many mentors
//this error checks and processes
if($from == "participants")
{	 //Sanitize Input
	  $student_authors = addslashes(trim($_POST['students']));
	  $faculty_mentors = addslashes(trim($_POST['mentors']));
	 //Transfer input into Session variables if the all input fields are filled
 	 $check1 = new error("participants.php");
  // All Fields Have Values?
	 $check1->_all(array("Number of Students" => $student_authors, "Number of Mentors" => $faculty_mentors));
	try
	 {
		$check1->_each(array("Number of Student Authors" => $student_authors, "Number of Faculty Mentors" => $faculty_mentors));
	 }	catch(Exception $e){
		die($e->getMessage());
	}	
 // All fields fit the required format?
   try
   {
	 $check1->_int(array("Number of Students" => $student_authors, "Number of Mentors" => $faculty_mentors));
	}catch(Exception $e){
			die($e->getMessage());
   }	
 	
	 
	if($student_authors && $faculty_mentors) {
		 $_SESSION['student_authors'] = $_POST['students']; //number of students GOES TO STUDENTS table 'student_number'
		 $_SESSION['faculty_mentors'] = $_POST['mentors'];//number of faculty mentors
	 // Will store the student object
		 $_SESSION['students'] = array();
	// Will store the mentor object
		 $_SESSION['mentors'] = array();
	 // Counter for the number of students. IT will decrease as each student enters info.
		$_SESSION['std_num'] = $_SESSION['student_authors'];  //The default value for the student counter is the the number of students as entered on the first page!
		$_SESSION['mnt_num'] = $_SESSION['faculty_mentors'];  //The default value for the mentor counter is the number of students as entered on the first page!
		
		
	header("Location: ../include/students.php");
	}
	else {
		echo "<div class=\"form\">Please <a href=\"javascript:history.go(0)\"> go back </a> fill in all the required fields.</div>";
	}
}

// PAGE 2 CHECKS -- Student Info
// table:students'

if($from == "students")
{
	 //store info
	 $i = $_SESSION['std_num'];
	  $_SESSION['sid'][$i] = $sid;
	  $_SESSION['sfname'][$i] = $sfname;
	  $_SESSION['slname'][$i] = $slastname;
	  $_SESSION['street'][$i] = $street;
	  $_SESSION['city'][$i] = $city;
	  $_SESSION['state'][$i] = $state;
	  $_SESSION['zip'][$i] = $zip;
	  $_SESSION['s_email'][$i] = $s_email;
	  $_SESSION['s_email_check'][$i] = $s_email_check;
	  $_SESSION['s_phone'][$i] = $s_phone;
	  $_SESSION['major'][$i] = $major;
	  $_SESSION['college'][$i] = $college;
	  
	  //Page 2 Error Checking
	  
	$array = array("SID" => $sid, "Firstname" => $sfname, "Lastname" => $slastname, "Address" => $street, "City" => $city, "State" => $state, "Zip" => $zip, "E-mail" => $s_email, "Email Verification" => $s_email_check, "Phone #" => $s_phone, "Major" => $major, "College" => $college);
//check input
	$check2 = new error("students.php");//return to page
	//check each input
	
	try
	{
		$check2->_all($array);
	}	catch(Exception $e)
	{
		die($e->getMessage());
	}	
	
	
	// Validate E-mail address
	try
	{
		$check2->_email($array["E-mail"]);
	} catch (Exception $e)
	{
		die($e->getMessage());
	}
		
	//match email fields
	try{
		$check2->_match(array("E-mail" => $array["E-mail"], "Email Verification" => $array["Email Verification"])); 
	} catch (Exception $e)
	{
		die($e->getMessage());
	}
	

	//process student and check for additional students
	if($_SESSION['student_authors'] >= 1 && $_SESSION['std_num'] > 0) {
		$num = --$_SESSION['std_num'];
		$_SESSION['students'][$num] = new student($sid, $sfname, $slastname, $street, $city, $state, $zip, $s_email, $s_email_check, $s_phone, $major, $college );
		//echo "<h1>num is".$num." std_num is: ".$_SESSION['std_num']."</h1>";
		if($num > 0)
		{
			header("Location: ../include/students.php");	
		}
		
		if($num == 0) header("Location: ../include/mentors.php");

	}	else{
		 header("Location: ../include/mentors.php");
	}
}

//PAGE 3 CHECKS -- Mentor Info
// table: mentors

elseif($from == "mentors")
{
	$i = $_SESSION['mnt_num'];
	  $_SESSION['mentor_fname'][$i] = $mfname;
	  $_SESSION['mentor_lname'][$i] = $mlname;
	  $_SESSION['mentor_email'][$i] = $m_email;
	  $_SESSION['mentor_email_check'][$i] = $m_email_check;
	  $_SESSION['mentor_phone'][$i] = $m_phone;
	  $_SESSION['mentor_department'][$i] = $department;
	  $_SESSION['mentor_college'][$i] = $m_college;
	  $_SESSION['mentor_academic_title'][$i]= $m_title;
	  
	 //error checks
	 
      $array = array('Mentor First Name' => $mfname, 'Mentor Last Name' => $mlname, 'Mentor email' => $m_email, 'Email Verification' => $m_email_check, 'Mentor Phone' => $m_phone, 'department'=>$department, 'College' => $m_college, 'Academic Title' =>$m_title);
	  //new error check
	  $check3 = new error('mentors.php');
	  $check3 ->_all($array);
	  try{
	  	$check3->_each($array);
	  } catch (Exception $e) {
		  die($e->getMessage());
	  }
	 // Validate E-mail address
	try
	{
		$check3->_email($array["Mentor email"]);
	} catch (Exception $e)
	{
		die($e->getMessage());
	}	 
	
	 //check to see if e-mail addresses match 
	  try{
		$check3->_match( array('E-Mail Address' =>$m_email, 'E-Mail Verification' =>$m_email_check) );
	  } catch ( Exception $e){
		  die($e->getMessage());
	  }
	// Next process 
	  if($_SESSION['faculty_mentors'] >=1 && $_SESSION['mnt_num'] > 0){

	 	$num = --$_SESSION['mnt_num'];

		$_SESSION['mentors'][$num] = new mentor($mfname, $mlname, $m_email, $m_email_check, $m_phone, $department, $m_college, $m_title);
		
		if($num > 0) 
		{
			header("Location: ../include/mentors.php");
		}
		if($num == 0) header("Location: ../include/paper_info.php");
		
	   } 
}

//PAGE 4 CHECKS -- Research Paper Info
// table: project_information
elseif($from == "paper_info")
{
	//error check
	$check4 = new error("paper_info.php");
	$check4->_all(array("Paper Title" =>$title, "Scientific Notation"=> $sci_notation, "Human Subject Permission" => $use_humans, "Animal Subject Permission" => $use_animals) );
	
	 if(empty($_SESSION['rand_code'])) $_SESSION['rand_code'] = NULL;
	 
	  if(!$_SESSION['rand_code']) require_once("journal/include/random_numbers.php");
	  $_SESSION['paper_title'] = $title;
	  //$_SESSION['aor'] = $aor;
	  $_SESSION['sci_notation'] = $sci_notation;
	  if($use_humans = NULL) $_SESSION['human_subjects_permission'] = NULL;
	  	else $_SESSION['human_subjects_permission'] = $use_humans;
	  if($use_animals = NULL) $_SESSION['animal_subjects_permission'] = NULL;
	  $_SESSION['animal_subjects_permission'] = $use_animals;
	  
	//File Upload section  
	  $errMsg = "";
	  if(!is_uploaded_file($_FILES['file']['tmp_name']))
	   {
		   echo "<div id=\"data\"><form class=\"form\" id=\"myform\"><br><input type=\"submit\" value=\"View Summary\" name=\"submit\" onclick=\"submitform(document.getElementById('myform'),'include/summary.php','data'); return false\"></form> </div>";
	  }
	  else {
	if ( $_FILES["file"]["error"] > 0 ) {
			   if ( $_FILES["file"]["error"] == 1 )
				 $errMsg = "Upload Error: the uploaded file is to large CLICK <a href=\"javascript:history.go(-1)\">OK</a> to return to the previous page and follow the instructions for submitting in the proper file format.  If your document exceeds 10MB please email your document to ugrj@ucr.edu. <b>Please make sure to include your name and student ID (860______)</b>";
			   else if ( $_FILES["file"]["error"] == 2 )
				 $errMsg = "Upload Error: the uploaded file is to large CLICK <a href=\"javascript:history.go(-1)\">OK</a> to return to the previous page and follow the instructions for submitting in the proper file format.  If your document exceeds 10MB please email your document to ugrj@ucr.edu. <b>Please make sure to include your name and student ID (860______)</b>";
			   else if ( $_FILES["file"]["error"] == 3 )
				 $errMsg = "Upload Error: the uploaded file was only partially uploaded CLICK <a href=\"javascript:history.go(-1)\">OK</a> to return to the previous page and follow the instructions for submitting in the proper file format.  If your document exceeds 10MB please email your document to ugrj@ucr.edu. <b>Please make sure to include your name and student ID (860______)</b>"; 
			   else if ( $_FILES["file"]["error"] == 4 )
				 $errMsg = "Upload Error: no file was uploaded CLICK <a href=\"javascript:history.go(-1)\">OK</a> to return to the previous page and follow the instructions for submitting in the proper file format.  If your document exceeds 10MB please email your document to ugrj@ucr.edu."; 
			   else if ( $_FILES["file"]["error"] == 6 )
				 $errMsg = "Upload Error: missing a temporary folder CLICK <a href=\"javascript:history.go(-1)\">OK</a> to return to the previous page and follow the instructions for submitting in the proper file format.  If your document exceeds 10MB please email your document to ugrj@ucr.edu."; 
			   else if ( $_FILES["file"]["error"] == 7 )
				 $errMsg = "Upload Error: failed to write file to disk CLICK <a href=\"javascript:history.go(-1)\">OK</a> to return to the previous page and follow the instructions for submitting in the proper file format.  If your document exceeds 10MB please email your document to ugrj@ucr.edu."; 
			} 
	else 
	{
	   	if ( $_FILES['file']['type'] != "application/vnd.openxmlformats-officedocument.wordprocessingml.document" && $_FILES['file']['type'] !="application/msword" )
		 $errMsg = "Upload Error: either the file size exceeds 10MB and/or you have submitted an incorrect file format.  CLICK <a href=\"javascript:history.go(-1)\">OK</a> to return to the previous page and follow the instructions for submitting in the proper file format.  If your document exceeds 10MB please email your document to ugrj@ucr.edu.";
	   else	 {
	   
	   		if(is_uploaded_file($_FILES['file']['tmp_name'])); else "File was not uploaded to the server";
	   		$file_loc = "journal/uploads/".$_SESSION['rand_code']."_version1.doc";
			echo "<br><div id=\"data\">";
			if( move_uploaded_file( $_FILES['file']['tmp_name'], $file_loc) ) {
				echo "<form class=\"form\" id=\"myform\"><br><input type=\"submit\" value=\"View Summary\" name=\"submit\" onclick=\"submitform(document.getElementById('myform'),'include/summary.php','data'); return false\"></form> </div>";
				
				} else die("FILE ERROR");
		 }
	}
	  }
	
 echo $errMsg;
	  
	  
}


?>