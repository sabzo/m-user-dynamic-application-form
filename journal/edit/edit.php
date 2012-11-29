<?php
/*
/*

This page provides the necessary FORMS to change the user input
*/
//Default tools needed
require_once('../include/student.cl.php');
require_once('../include/mentor.cl.php');
session_start();
include_once("../include/mysql_open_connection.php");

//Expecting 2 letter string. First letter will be either s or m, 2nd will be a number telling me which student/mentor to edit
$from = $_POST['from'];
$from = substr($from,0,1);
$i = substr($_POST['from'],1,1);
$i = ($i-1);
//edit page 1
if($from=="s"){
	
?>

<form method="post" action="#"  id="student">
 <input type="hidden" value="s<?php echo $i; ?>" name="from" />
 <label for="sid">SID ( UCR Student ID Number)</label>
	<input type="text" size="15" maxlength="9" name="sid" value="<?php echo $_SESSION['students'][$i]->get('sid');?>"/>
 <label for="sfname">First Name</label>
	<input type="text" size="15" maxlength="15" name="sfname" value="<?php echo $_SESSION['students'][$i]->get('sfname');?>"/>
 <label for="slname">Last Name</label>
	<input type="text" size="15" maxlength="18" name="slname" value="<?php echo $_SESSION['students'][$i]->get('slname');?>" />
 <label for="s_address">Street Address</label> 
 	<input type="text" size="15" maxlength="25" name="s_address" value="<?php echo $_SESSION['students'][$i]->get('street'); ?>" />
 <label for="s_city">City</label> 
  	<input type="text" size="15" maxlength="15" name="s_city" value="<?php echo  $_SESSION['students'][$i]->get('city'); ?>" />
 <label for="s_state">State</label>
 	<input type="text" size="15" maxlength="12" name="s_state" value="<?php echo $_SESSION['students'][$i]->get('state');?>" />    
 <label for="s_zip">Zip Code</label>
 	<input type="text" size="5" maxlength="5" name="s_zip" value="<?php echo $_SESSION['students'][$i]->get('zip');?>" />
 <label for="s_email1">E-mail address<label>
 	<input type="text" size="15" maxlength="25" name="s_email1" value="<?php echo $_SESSION['students'][$i]->get('s_email'); ?>" />
 <label for="s_email2">Confirm E-mail</label>
 	<input type="text" size="15" maxlength="25" name="s_email2" value="Enter E-mail Address again" />
 <label for="s_phone">Daytime telephone number</label>
 	<input type="text" size="15" maxlength="10" name="s_phone" value="<?php echo $_SESSION['students'][$i]->get('s_phone'); ?>" />
 <label for="major">Major</label>
 	<input type="text" size="15" maxlength="25" name="major" value="<?php echo $_SESSION['students'][$i]->get('major'); ?>" />
 <label for="college">College</label>
	<select name="college">
    	<option value="BCOE" name="college">Bourns College of Engineering</option>
        <option value="CHASS" name="college">College of Humanities, Arts and Social Sciences (CHASS)</option>
        <option value="CNAS" name="college">College of Natural & Agricultural Sciences (CNAS)</option>
        <option value="SoBA" name="college">School of Business Administration</option>
    </select>  
<input type="submit" value="submit" name="submit" onclick="submitform(document.getElementById('student'),'edit/update.php','form'); return false" />
   
</form>
<?php 
}
elseif( $from == "m") {?>
	
  <form method="post" action="#" id="mentor">
  
    <input type="hidden" value="m<?php echo $i; ?>" name="from" />

  	<label for="mfname">First Name</label>
    	<input type="text" size="15" maxlength="20" value="<?php echo $_SESSION['mentors'][$i]->get('mfname'); ?>" name="mfname" />
    <label for="mlname">Last Name</label>
    	<input type="text" size="15" maxlength="20" value="<?php echo $_SESSION['mentors'][$i]->get('mlname'); ?>" name="mlname" />
    <label for="m_email1">E-Mail Address</label> 
    	<input type="text" size="15" maxlength="25" value="<?php echo $_SESSION['mentors'][$i]->get('m_email'); ?>" name="m_email1" />
    <label for="m_email2">Confirm E-Mail Address</label>
    	<input type="text" size="15" maxlength="25" value="Enter E-mail Address" name="m_email2" />
    <label for="m_phone">Daytime Telephone Number</label>
    	<input type="text" size="15" maxlength="10" value="<?php echo $_SESSION['mentors'][$i]->get('m_phone'); ?>" name="m_phone" />
    <label for="academic_title">Academic Title</label>
     	<input type="text" size="15" maxlength="25"  value="<?php echo $_SESSION['mentors'][$i]->get('m_title'); ?>" name="academic_title" />
    <label for="department">Department</label>
    	<input type="text" size="15" maxlength="30" value="<?php echo $_SESSION['mentors'][$i]->get('department'); ?>" name="department" />
     <label for="m_college">Current College/School</label>
     	<select name="m_college">
    	  <option value="BCOE" name="">Bourns College of Engineering</option>
          <option value="CHASS" name="">College of Humanities, Arts and Social Sciences (CHASS)</option>
          <option value="CNAS" name="">College of Natural & Agricultural Sciences (CNAS)</option>
          <option value="SoBA" name="">School of Business Administration</option>
    </select> 
   		<input type="submit" value="submit" name="submit" onclick="submitform(document.getElementById('mentor'),'edit/update.php','form'); return false" />
    
  </form>
<?php
}

elseif($from =="p")
{
?>
<h3>Research Paper Information (Page 4)</h3>

  <form enctype="multipart/form-data" method="post" action="submit.html" id="paper">
<p>
	<input type="hidden" name="from" value="p" />
      <label for="paper_title">Paper Title</label>
        <input type="text" size="25" maxlength="50" name="paper_title" value="<?php echo $_SESSION['paper_title'];?>" />
        
      <label for="area_of_research">Area of Research</label>
        <input type="text" size="25" maxlength="50" name="area_of_research" value="<?php echo $_SESSION['aor'];?>" />
        
      <label for="is_sci">Does Paper Title contain any special characters?</label>
      	<input type="radio" name="is_sci" value="1" /> Yes
        <input type="radio" name="is_sci" value="0" /> No
  <label for="file">Upload Paper</label>
        <input type="file" size="25" name="file" maxlength="75"  />
     <p>
      <label for="use_humans">If this project involves the student's use of human subjects or data/specimens from living humans, has it been approved by the UCR Institutional Review Board (IRB) at the institution(s)?
      </label></p>
    
       <input type="radio" name="use_humans"  value="1" />Yes
       <input type="radio" name="use_humans" value="0" />No
       <input type="radio" name="use_humans" value="" />Not Applicable        
  <p>
  If this project involves the student's use of live vertebrate animals, has it been approved by the UCR Institutional Animal Care and Use Committee (IACUC) at the institution(s)?  </p>
  
    <input type="radio" name="use_animals"  value="1" />Yes
     <input type="radio" name="use_animals" value="0" />No
    <input type="radio" name="use_animals" value="" />Not Applicable    
    
  	</p>
  	<p>After you submit this form, you and your  		  co-authors will receive an e-mail that contains a code that  		  will allow you to access and update your contact information, as  well  		  as view (but not revise) your paper submission. </p>
    <p>A confirmation of this submission will also be sent              electronically to your faculty  mentor(s).               Their message will contain: 1) a request to approve this  version              of your paper before the editorial evaluation process can              continue; and 2) a pass-code required to revise this paper  if              your mentor does not approve as submitted.</p>
    <p>In the event that your faculty mentor(s) might require              revisions before they will consent to approve your initial submission, all changes must              still be completed and your mentor-approved version uploaded  by              March 28th (online) and if your paper is too large by March  29th              at 9:00 a.m. (CD delivery only).</p>
    <p>&nbsp; </p>
 <input type="submit" value="submit" name="submit"  />
</form>
<?php 
}//onclick="submitform(document.getElementById('paper'),'edit/update.php','form'); return false" 
?>
	
	