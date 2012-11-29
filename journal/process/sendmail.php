<?php

//send email
function send_email( $subjectx, $tox, $bodyx ) {
	ini_set("SMTP","smtp.ucr.edu");
	
	$headers = 'From: UGRJ<ugrj@ucr.edu>'."\r\n".
				'Content-Type: text/html; charset=iso-8859-1';
				
	//$headers = 'From: SCCUR 2005<sccur@ucr.edu>'."\r\n".
				//'CC: sccur@ucr.edu';
	
	mail($tox,$subjectx,$bodyx,$headers);	
}

$body_xy;

//send student an e-mail confirmation
function email_student( $name_x, $title_x, $code_x ) {
	//$MyServer = $_SERVER['SERVER_NAME'];
	$MyLink = "http://ugrj.ucr.edu/submit/abstract_status_list.php?code=" . $code_x."s1";
	
	$body = "<html><body style=\"font-size:12px; font-family:'Times New Roman', Times, serif\"><table border='0' cellspacing='0' cellpadding='0'><tr><td>";
	$body .= "
		Dear $name_x:

		<p>Thank you for completing the research paper submission form entitled '$title_x'.</p>
		
		<p>In order to read the submission, please click the link below:<br>
		
		<a href='$MyLink'>$MyLink</a></p>
		
		<p>A copy of your submission has been sent to your faculty mentor for approval. Perchance the faculty mentor does not approve your submission, he or she has a code to enable revision of the abstract so it can be resubmitted when edited and approved. Any revision must be made through your faculty mentor.</p>
		
		<p>Once the review process for the submission is complete, you, any co-authors, and your faculty mentors will be sent another e-mail about whether the submission was accepted, not accepted, or needs modification. This second email should be received by mid-April.</p>
		
		<p>If the paper needs modification all further revisions will be made through the iLearn system.  Each article will be assigned two student editorial Board (SEB) members and one Faculty Advisor Board liaison.  You will communicate only with the SEB editor-in-chief.</p>
		
		<p>In the meantime, please let us know if you have any questions, suggestions or concerns about the 
		Journal: <a href='mailto:ugrj@ucr.edu'>ugrj@ucr.edu</a></p>
		
		Regards,<br>
		Student Editorial Board<br>
		Faculty Advisory Board<br>
		UCR Undergraduate Research Journal, Volume V<br>
		<a href='http://ugrj.ucr.edu'>ugrj.ucr.edu</a>
	";
	$body = $body . "</td></tr></table></body></html>";
    return $body;
}

//send the mentor an e-mail confirmation


function email_mentor( $name_x, $title_x, $code_x ) {
	$MyServer = $_SERVER['SERVER_NAME'];
    $MyLink = "http://ugrj.ucr.edu/submit/abstract_status_list.php?code=" . $code_x."m1";
	
	$body = "<html><body style=\"font-size:12px; font-family:'Times New Roman', Times, serif\"><table border='0' cellspacing='0' cellpadding='0'><tr><td>";
	$body .= "
		Dear $name_x:

		<p>This email is to notify you of your student's submission of the paper entitled 
		\"$title_x\" for Volume IV of the <i>University of California, Riverside Undergraduate Research 
		Journal</i>.  The Journal's Faculty Advisory Board and Student Editorial Board request faculty mentor approval of the submission before they begin to review the article. 

		<p>If the text provided is approved by you, please respond to this email indicating your consent. If you do not approve the text submitted below, use the pass code given to revise the text. Your student does not have this access or pass code, so will need to work with you in revising the article.   
		
		<p>When approved, resubmit the article with a notation of your approval, prior to the Tuesday March 29, 2011 deadline. Upon your approval of the submission, the Student Editorial Board (SEB) will place the text on the Journal's iLearn account and work with the student author(s) and faculty mentor(s) to make corrections/modifications.  You will be notified by the SEB Editor-in-Chief, by mid-April if the SEB does accept, does not accept, or requests further modification of the paper. 
		
		<p>The text of the submission, author information, approval form, and revision passcode are included in the link 
		below:<br>
		<a href='$MyLink'>$MyLink</a>
		
		
		<p>In the meantime, please let us know if you have any questions, suggestions or concerns about the 
		Journal, <a href='mailto:ugrj@ucr.edu'>ugrj@ucr.edu.</a>
		
		<p>Regards,<br>
		Student Editorial Board<br>
		Faculty Advisory Board<br>
		UCR Undergraduate Research Journal, Volume V<br>
		<a href='http://ugrj.ucr.edu'>ugrj.ucr.edu</a>
	";
	$body = $body . "</p></td></tr></table></body></html>";
    return $body;
	session_destroy();
}
?>