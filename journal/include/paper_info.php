<?php
session_start();
//Ajax subit is next line.
//onclick="submitform(document.getElementById('myform'),'process/sessions.php','form'); return false"
if(empty($_SESSION['paper_title']) ) {
		$_SESSION['paper_title'] = NULL;
		$_SESSION['aor'] = NULL;
}

?>
<div id="form">
<h3>Research Paper Information (Page 4)</h3>

  <form enctype="multipart/form-data" method="post" action="submit.html" class="form" id="myform">
<p>
	<input type="hidden" name="from" value="paper_info" />
      <label for="paper_title">Paper Title</label>
        <input type="text" size="25" maxlength="50" name="paper_title" value="<?php echo $_SESSION['paper_title'];?>" />
     
        
      <label for="is_sci">Does Paper Title contain any special characters?</label>
      	<input type="radio" name="is_sci" value="1" /> Yes
        <input type="radio" name="is_sci" value="0"  /> No
      <label for="file">Upload Paper </label>
      <font color="#CC9900">If Unable to upload word file please <a href="mailto:ugrj@ucr.edu">e-mail</a> us your paper along with your UCR Student ID</font><br/>
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
 <input type="submit" value="submit" name="submit" />
</form>
</div>
</body>
</html>