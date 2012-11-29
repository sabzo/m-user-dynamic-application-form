<?php
require_once('../include/student.cl.php');
require_once('../include/mentor.cl.php');
session_start();
/*
------------
------------
This is the Central HUB where one will find ALL the code to send the necessary information to the database. The tables are above the code that pertains to it. For technical reasons ( 2-d array SESSIONS from a Class), Classes must be included before session_start(). 
-----------
-----------
*/
// MYSQL CONNECTION CODES

$host = "private_host";
$user = "private_user";
$pwd = "private_pwd";
$db = "private_db";

$mysql = mysql_connect($host, $user, $pwd) or die(mysql_error()); ;
mysql_select_db($db) or die(mysql_error());

//------------Necessary Includes------------------------
if(!include("sendmail.php")) echo"Cannot find the E-mail file";// else echo"Successfully included mail send <br><br>";

//------------STUDENTS table------------------------
for($i = 0; $i <= $_SESSION['student_authors']-1; $i++)
{
	
$sql = "insert INTO students (student_code, project_id, student_number, first_name, last_name, address1, city, state, zip, email, major, phone_number, institution, sid, status)
values ('".$_SESSION['rand_code']."s".($i+1)."', '".$_SESSION['rand_code']."','".$_SESSION['student_authors']."','".$_SESSION['students'][$i]->get('sfname')."','".$_SESSION['students'][$i]->get('slname')."','".$_SESSION['students'][$i]->get('street')."', '".$_SESSION['students'][$i]->get('city')."','".$_SESSION['students'][$i]->get('state')."','".$_SESSION['students'][$i]->get('zip')."','".$_SESSION['students'][$i]->get('s_email')."','".$_SESSION['students'][$i]->get('major')."','".$_SESSION['students'][$i]->get('s_phone')."','".$_SESSION['students'][$i]->get('college')."','".$_SESSION['students'][$i]->get('sid')."','3')";
	if(mysql_query($sql));// echo "Successfully entered data into STUDENTS table <br>"; 
	else echo "Unable to enter data into STUDENTS table <br>";
}

//-------------MENTORS table------------------------
$status = 6; //6 is the default value that I figured out just by observing the Mentors table and the previous entries.
for($i = 0; $i <= $_SESSION['faculty_mentors']-1; $i++)
{
$sql = "insert INTO mentors (mentor_code, project_id, first_name, last_name, email, phone_number, department, current_university, acedemic_title, mentor_number, status) values ('".$_SESSION['rand_code']."m".($i+1)."', '".$_SESSION['rand_code']."','".$_SESSION['mentors'][$i]->get('mfname')."','".$_SESSION['mentors'][$i]->get('mlname')."','".$_SESSION['mentors'][$i]->get('m_email')."', '".$_SESSION['mentors'][$i]->get('m_phone')."','".$_SESSION['mentors'][$i]->get('department')."','".$_SESSION['mentors'][$i]->get('m_college')."','".$_SESSION['mentors'][$i]->get('m_title')."','".$_SESSION['faculty_mentors']."','".$status."')";
	if(mysql_query($sql))// echo "Successfully entered data into MENTORS table <br>"; 
	;else echo "Unable to enter data into MENTORS table <br>";
}

//--------------Project Overview------------------------
$sql ="INSERT INTO project_overview (project_id, number_of_students, number_of_mentors, temp_project_id) VALUES ('".$_SESSION['rand_code']."', '".$_SESSION['student_authors']."','".$_SESSION['faculty_mentors']."','".$_SESSION['temp_id']."')";
	if(mysql_query($sql)) //echo "successfully entered data into project_overview";
	 ;else echo"Unable to enter data into project_overview <br>";
 
//-------------Project Abstract------------------------
 $sql = "INSERT INTO project_abstract(sub_date, version, project_id) values ('".date("n/j/Y g:i a")."','1', '".$_SESSION['rand_code']."')";
 
 	if(mysql_query($sql)) //echo "Successfully entered data into project_abstract "; 
	;else echo "Unable to insert data into project_abstract";

//------------project_information------------------------
 
//is_faculty_reviewed i put the default value of 0. I assume it will be 1 when abstract is reviewed by the mentor through the control panel.
$sql = "insert INTO project_information (project_id, abstract_title, area_of_research, is_scientific_notation, use_humans, use_animals, is_faculty_reviewed) values ('".$_SESSION['rand_code']."', '".$_SESSION['paper_title']."','N/A','".$_SESSION['sci_notation']."', '".$_SESSION['human_subjects_permission']."','".$_SESSION['animal_subjects_permission']."', 0)";
	if(mysql_query($sql)) //echo "Successfully entered data into project_information table <br>" ; 
	;else echo "Unable to enter data into project_information table <br>";

//----------project_status------------------------
	//Question on status column. What to put on it?

$sql = "insert INTO project_status(project_id, is_scheduled) value('".$_SESSION['rand_code']."',-1)";
	if(mysql_query($sql))// echo "Successfuly entered data into project_status"; 
	;else echo"Failed to insert data to project_status";

//------------Send Confirmation E-mail for Students--------------------------
for($i = 0; $i <= $_SESSION['student_authors']-1; $i++)
{
		 $body_xy = email_student ( $_SESSION['students'][$i]->get('sfname'), $_SESSION['paper_title'], $_SESSION['rand_code'] );
       	 if(send_email( "UGRJ Submission (Code = " . $_SESSION['rand_code'] . ")", $_SESSION['students'][$i]->get('s_email'), $body_xy ));
	//echo"<br><br>E-mail successfuly sent to student<br><br>asdfas"; 
}

//------------Send Confirmation E-mail for Mentors------------------------
for($i = 0; $i <= $_SESSION['faculty_mentors']-1; $i++)
{
        $body_xy = email_mentor ( $_SESSION['mentors'][$i]->get('mlname'), $_SESSION['paper_title'], $_SESSION['rand_code'] );
        if(send_email ( "UGRJ Submission (Code = " . $_SESSION['rand_code']  . ")", $_SESSION['mentors'][$i]->get('m_email'), $body_xy )); //echo"<br>E-mail successfully sent to Mentor"; //else echo "Unable to send email confirmation to mentor";
}
 
//-------------Confirmation Message After Application is submited------------------------
echo "<h4>Success!</h4><p>Thank you for submitting your research paper for consideration in <i>UCR Undergraduate Research Journal's</i> Volume IV.  A confirmation of this submission will also be sent electronically to the addresses you provided for yourself, any co-authors, and your faculty mentor(s).</p>

<p>Your faculty mentor's message contains: 1) a request to approve this version of your paper before the editorial evaluation process continues; and 2) a pass-code required to revise this version of your paper.  If your faculty mentor requests changes be made, please work with him or her, and then the mentor will need to submit the revised paper along with his/her approval. 

<p>If the electronic size of your paper was over 10MB, and you submitted only your abstract through the online process, make sure that you directly e-mail your entire document as an attachment to ugrj@ucr.edu. Please include your name, faculty mentor's name, and title of your paper on the message page to which your document is attached.  This must be done before the deadline of Tuesday, March 29, 2011. The Office of Undergraduate Education will send your paper to your faculty mentor(s) for approval.

<p>If your paper is over 50MB, and you submitted only your abstract through the online process, make sure you provide a CD version to Patsy Oppenheim, Assistant Vice Provost for Undergraduate Education, 321 Surge. This must be done before 9:00 am, Monday March 29, 2010. The Office of Undergraduate Education will send your paper to your faculty mentor(s) for approval.

<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You will soon receive an e-mail confirmation of your submission; thank you again for your participation.

<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sincerely,
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Student Editorial Board
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Faculty Advisory Board
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;UCR Undergraduate Research Journal Volume IV
";	
session_unset();
?>
