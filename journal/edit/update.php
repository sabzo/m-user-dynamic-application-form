<?php
/*
/*
This page UPDATES and also Performs the Necessary ERROR Checks
*/
//Default Connections and Needed Files
if($_POST['from'] == "p")
{
	require_once('journal/include/student.cl.php');
	require_once('journal/include/mentor.cl.php');
}else{
require_once('../include/student.cl.php');
require_once('../include/mentor.cl.php');
}
session_start();

//So whhat should I update?
$from = $_POST['from'];
$what = substr($from,0,1);
$number = substr($from,1);

//Process Student Changes
if($what =="s"){
	//Gather The Student Data
	$sid = $_POST['sid'];
	$sfname = $_POST['sfname'];
	$slname = $_POST['slname'];
	$street = $_POST['s_address'];
	$city = $_POST['s_city'];
	$state = $_POST['s_state'];
	$zip = $_POST['s_zip'];
	$s_phone = $_POST['s_phone'];
	$s_email1 = $_POST['s_email1'];
	$s_email2 = $_POST['s_email2'];
	$major = $_POST['major'];
	$college = $_POST['college'];
	//Update Changes to the Student
	$_SESSION['students'][$number]->update($sid, $sfname, $slname, $street, $city, $state, $zip, $s_email1, $s_email2, $s_phone, $major, $college);
		echo "Successfully made changes to student's information <br>
	<form id=\"myform\"><br><input type=\"submit\" value=\"Summary\" name=\"submit\" onclick=\"submitform(document.getElementById('myform'),'include/summary.php','data'); return false\"></form>";
}
//Process Mentor Changes
elseif($what == "m"){
	//Gather Student Data
	$mfname = $_POST['mfname'];
	$mlname = $_POST['mlname'];
	$m_email = $_POST['m_email1'];
	$m_email_check = $_POST['m_email2'];
	$m_phone = $_POST['m_phone'];
	$m_title = $_POST['academic_title'];
	$department = $_POST['department'];
	$m_college = $_POST['m_college'];
	
	//Update Changes to the Mentor
	$_SESSION['mentors'][$number]->update($mfname, $mlname, $m_email, $m_email_check, $m_phone, $department, $m_college, $m_title);
		echo "Successfully updated mentor's Information<br>";
		echo "<form id=\"myform\"><br><input type=\"submit\" value=\"Summary\" name=\"submit\" onclick=\"submitform(document.getElementById('myform'),'include/summary.php','data'); return false\"></form>";
}
//Process Changes about the Paper
elseif($what == "p")
{
	
	 echo "<div id=\"data\">";
	 //in This is to create the "form" background color. I'll use a div and class it with the form.
	 echo "<div class=\"form\">";
	
	$title = $_POST['paper_title'];
	$aor = $_POST['area_of_research'];
	$sci_notation = $_POST['is_sci'];
	$use_humans = $_POST['use_humans'];
	$use_animals = $_POST['use_animals'];
	/*
	if($_POST['use_humans']) echo $_POST['use_animals']."<br>"; else echo "humans -> fail <br>";
	if($_POST['use_animals']) echo $_POST['use_animals']."<br>"; else echo "animals -> fail <br>";
	if($_POST['is_sci']) echo $_POST['is_sci']."<br>"; else echo "is_sci -> fail <br>";
	if($_POST['paper_title']) echo $_POST['paper_title']."<br>"; else echo "paper title -> fail";
	if($_POST['area_of_research']) echo $_POST['area_of_research']."<br>"; else echo "aor -> fail <br>";
    */	
	 
	  $_SESSION['paper_title'] = $title;
	  $_SESSION['aor'] = $aor;
	  $_SESSION['sci_notation'] = $sci_notation;
	  $_SESSION['human_subjects_permission'] = $use_humans;
	  $_SESSION['animal_subjects_permission'] = $use_animals;
	
			//File Upload section  
	  $errMsg = "";
	if ( $_FILES["file"]["error"] > 0 ) {
	   if ( $_FILES["file"]["error"] == 1 )
		 $errMsg = "Upload Error: the uploaded file is to large ";
	   else if ( $_FILES["file"]["error"] == 2 )
		 $errMsg = "Upload Error: the uploaded file is to large";
	   else if ( $_FILES["file"]["error"] == 3 )
		 $errMsg = "Upload Error: the uploaded file was only partially uploaded"; 
	   else if ( $_FILES["file"]["error"] == 4 )
		 $errMsg = "Upload Error: no file was uploaded"; 
	   else if ( $_FILES["file"]["error"] == 6 )
		 $errMsg = "Upload Error: missing a temporary folder"; 
	   else if ( $_FILES["file"]["error"] == 7 )
		 $errMsg = "Upload Error: failed to write file to disk"; 
	} else {
	   if ( $_FILES['file']['type'] != "application/vnd.openxmlformats-officedocument.wordprocessingml.document" && $_FILES['file']['type'] !="application/msword" )
		 $errMsg = "Upload Error: either the file size exceeds 10MB and/or you have submitted an incorrect file format.  CLICK <a href=\"javascript:history.go(-1)\">OK</a> to return to the previous page and follow the instructions for submitting in the proper file format.  If your document exceeds 10MB please email your document to ugrj@ucr.edu.";
	   else	 {
	   
	   		if(is_uploaded_file($_FILES['file']['tmp_name'])); else "File was not uploaded to the server";
	   		$file_loc = "journal/uploads/".$_SESSION['rand_code']."_version1.doc";
			echo "<br><div id=\"data\">";
			if( move_uploaded_file( $_FILES['file']['tmp_name'], $file_loc) ) {
				echo "<form id=\"myform\"><br><input type=\"submit\" value=\"View Summary\" name=\"submit\" onclick=\"submitform(document.getElementById('myform'),'include/summary.php','data'); return false\"></form> </div></div>";
				
				} else die("FILE ERROR");
		 }
	}
	
 echo $errMsg;
	  
	 
	
}