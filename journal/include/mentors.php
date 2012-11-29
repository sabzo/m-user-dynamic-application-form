<?php
require_once('mentor.cl.php');
session_start();
$i = $_SESSION['mnt_num'];

if(empty($_SESSION['mentor_fname'][$i])) {
	  $_SESSION['mentor_fname'][$i] = NULL;
	  $_SESSION['mentor_lname'][$i] = NULL;
	  $_SESSION['mentor_email'][$i] = NULL;
	  $_SESSION['mentor_email_check'][$i] = NULL;
	  $_SESSION['mentor_phone'][$i] = NULL;
	  $_SESSION['mentor_academic_title'][$i] = NULL;
	  $_SESSION['mentor_department'][$i] = NULL;
  }  
?>
<div id="form">
<h3>Faculty Mentor Information (Page 3)</h3>
<p class="section"> <h4>Who are the Faculty Mentors you worked with</h4></p>
<?php if($_SESSION['faculty_mentors'] > 1) echo "Faculty Mentor ".$_SESSION['mnt_num']. "of ".$_SESSION['faculty_mentors']; ?>

  <form method="post" action="#" class="form" id="myform">
 
    <input type="hidden" value="mentors" name="from" />

  	<label for="mfname">First Name</label>
    	<input type="text" size="15" maxlength="20" value="<?php echo $_SESSION['mentor_fname'][$i]; ?>" name="mfname" />
    <label for="mlname">Last Name</label>
    	<input type="text" size="15" maxlength="20" value="<?php echo $_SESSION['mentor_lname'][$i]; ?>" name="mlname" />
    <label for="m_email1">E-Mail Address</label> 
    	<input type="text" size="15" maxlength="25" value="<?php echo $_SESSION['mentor_email'][$i]; ?>" name="m_email1" />
    <label for="m_email2">Confirm E-Mail Address</label>
    	<input type="text" size="15" maxlength="25" value="<?php echo $_SESSION['mentor_email_check'][$i]; ?>" name="m_email2" />
    <label for="m_phone">Daytime Telephone Number</label>
    	<input type="text" size="15" maxlength="10" value="<?php echo $_SESSION['mentor_phone'][$i]; ?>" name="m_phone" />
    <label for="academic_title">Academic Title</label>
     	<select name="academic_title">
			<option value="Professor">Professor</option>
            <option value="Assistant Professor">Assistant Professor</option>
            <option value="Graduate Student">Graduate Student</option>
        </select>
    <label for="department">Department</label>
    	<input type="text" size="15" maxlength="30" value="<?php echo $_SESSION['mentor_department'][$i]; ?>" name="department" />
     <label for="m_college">Current College/School</label>
     	<select name="m_college">
    	  <option value="BCOE" name="">Bourns College of Engineering</option>
          <option value="CHASS" name="">College of Humanities, Arts and Social Sciences (CHASS)</option>
          <option value="CNAS" name="">College of Natural & Agricultural Sciences (CNAS)</option>
          <option value="SoBA" name="">School of Business Administration</option>
    </select> 
   		<input type="submit" value="submit" name="submit" onclick="submitform(document.getElementById('myform'),'process/sessions.php','form'); return false" />
    
  </form>
</div>
