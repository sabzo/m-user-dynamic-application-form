<div id="theform">
<h3>Research Journal Submission Process</h3>
Through this online form you will be able to submit your Research Journal. You will be presented with a total of <em>4 pages </em>and at the end of completion you will receive an e-mail confirmation at the e-mail address you will supply in the next page.
<h4> How many Students and Faculty were involved?</h4>
<form action="#" class="form" id="myform" method="post">
<div class="column_"> 
    <input name="from" type="hidden" value="participants" />
	<label for="students">Indicate the number of STUDENT authors</label>
    <input maxlength="2" name="students" size="2" type="text" />
 </div>
<div class="column_">
    <label for="mentors">Indicate the number of FACULTY mentors</label>
    <input maxlength="2" name="mentors" size="2" type="text" />
    
</div>
<div class="formclear">
<label for="submit">Submit</label>
<input onclick="submitform(document.getElementById('myform'),'process/sessions.php','theform'); return false" name="submit" type="submit" value="submit" />
</div>
</form>
</div>
<br />