<?php
require_once('student.cl.php');
session_start();

$i = $_SESSION['std_num'];
if(empty($_SESSION['sid'][$i])) {
	  $_SESSION['sid'][$i] = NULL;
	  $_SESSION['sfname'][$i] = NULL;
	  $_SESSION['slname'][$i] = NULL;
	  $_SESSION['street'][$i] = NULL;
	  $_SESSION['city'][$i] = NULL;
	  $_SESSION['state'][$i] = NULL;
	  $_SESSION['zip'][$i] = NULL;
	  $_SESSION['s_email'][$i] = NULL;
	  $_SESSION['s_email_check'][$i]= NULL;
	  $_SESSION['s_phone'][$i] = NULL;
	  $_SESSION['major'][$i] = NULL;
  }  
  
  
 

	 // echo "<br/><b>firstname:</b> ".$_SESSION['students'][$i]->get('sfname');
?>

<div id="form">
<h3>Student Author Information (Page 2)</h3> 
<p class="section">
 <h4>Now we would like to know about the student authors involved.</h4><br>
</p>
<?php  if($_SESSION['student_authors']> 1 && $_SESSION['std_num']>1) echo "(<b> ". $_SESSION['std_num']." students out of ".$_SESSION['student_authors']."</b>) left"; 
	   if($_SESSION['student_authors']>1 && $_SESSION['std_num']==1) echo "(<b> ". $_SESSION['std_num']." student out of ".$_SESSION['student_authors']."</b>) left";

?>

<form method="post" action="#" class="form" id="myform">
 <input type="hidden" value="students" name="from" />
 <label for="sid">SID ( UCR Student ID Number)</label>
	<input type="text" size="15" maxlength="9" name="sid" value="<?php echo $_SESSION['sid'][$i]; ?>"/>
 <label for="sfname">First Name</label>
	<input type="text" size="15" maxlength="15" name="sfname" value="<?php echo $_SESSION['sfname'][$i]; ?>"/>
 <label for="slname">Last Name</label>
	<input type="text" size="15" maxlength="18" name="slname" value="<?php echo $_SESSION['slname'][$i]; ?>" />
 <label for="s_address">Street Address</label> 
 	<input type="text" size="15" maxlength="25" name="s_address" value="<?php echo $_SESSION['street'][$i]; ?>" />
 <label for="s_city">City</label> 
  	<input type="text" size="15" maxlength="15" name="s_city" value="<?php echo $_SESSION['city'][$i]; ?>" />
 <label for="s_state">State</label>
 	<input type="text" size="15" maxlength="12" name="s_state" value="<?php echo $_SESSION['state'][$i]; ?>" />    
 <label for="s_zip">Zip Code</label>
 	<input type="text" size="5" maxlength="5" name="s_zip" value="<?php echo $_SESSION['zip'][$i]; ?>" />
 <label for="s_email1">E-mail address<label>
 	<input type="text" size="15" maxlength="25" name="s_email1" value="<?php echo $_SESSION['s_email'][$i]; ?>" />
 <label for="s_email2">Confirm E-mail</label>
 	<input type="text" size="15" maxlength="25" name="s_email2" value="<?php echo $_SESSION['s_email_check'][$i]; ?>" />
 <label for="s_phone">Daytime telephone number</label>
 	<input type="text" size="15" maxlength="10" name="s_phone" value="<?php echo $_SESSION['s_phone'][$i]; ?>" />
 <label for="major">Major</label>
 	<input type="text" size="15" maxlength="25" name="major" value="<?php echo $_SESSION['major'][$i]; ?>" />
 <label for="college">College</label>
	<select name="college">
    	<option value="BCOE" name="college">Bourns College of Engineering</option>
        <option value="CHASS" name="college">College of Humanities, Arts and Social Sciences (CHASS)</option>
        <option value="CNAS" name="college">College of Natural & Agricultural Sciences (CNAS)</option>
        <option value="SoBA" name="college">School of Business Administration</option>
    </select>  
<input type="submit" value="submit" name="submit" onclick="submitform(document.getElementById('myform'),'process/sessions.php','form'); return false" />
   
</form>
</div>
