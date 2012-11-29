<?php
require_once('student.cl.php');
require_once('mentor.cl.php');
session_start();
include_once("mysql_open_connection.php");

//hide session variables to keep potential intruders away from our code
//if(empty($_SESSION['students'])
?>

<?php
echo"<div id=\"form\" class=\"form\" >";

	 echo "<br/><b>student authors:</b> ".$_SESSION['student_authors'];//int
	 echo "<br/><b>faculty mentors:</b> ".$_SESSION['faculty_mentors'];//int
	
	//page2  : Student Info
	
	  for($i = 0; $i <= $_SESSION['student_authors']-1; $i++)
	  {
		  $j = ($i+1);
	  echo"<h2>Student ".$j."
	  
	  </h2>
	  <form method=\"post\" id=\"student".$j."\" >
	  <input type=\"hidden\" name=\"from\" value=\"s".$j."\"/>
	  <input type=\"submit\" name=\"submit\" value=\"edit\" onclick=\"submitform(document.getElementById('student".$j."'),'edit/edit.php','form'); return false\"/>
	  </form>
	  ";
	  
	  echo "<b>sid:</b> ". $_SESSION['students'][$i]->get('sid');
	  echo "<br/><b>firstname:</b> ".$_SESSION['students'][$i]->get('sfname');
	  echo "<br/><b>lastname:</b> ".$_SESSION['students'][$i]->get('slname');
	  echo "<br/><b>street:</b> ".$_SESSION['students'][$i]->get('street');
	  echo "<br/><b>city:</b> ".$_SESSION['students'][$i]->get('city');
	  echo "<br/><b>state:</b> ".$_SESSION['students'][$i]->get('state');
	  echo  "<br/><b>zip:</b> ".$_SESSION['students'][$i]->get('zip');
	  echo  "<br/><b>student email:</b> ".$_SESSION['students'][$i]->get('s_email');
	  echo  "<br/><b>student email check:</b> ".$_SESSION['students'][$i]->get('s_email_check');
	  echo "<br/><b>student phone:</b> ".$_SESSION['students'][$i]->get('s_phone');
	  echo  "<br/><b>major:</b> ".$_SESSION['students'][$i]->get('major');
	  echo "<br/><b>college:</b> ".$_SESSION['students'][$i]->get('college');
	  echo "<p></p>";
	  }
	  
	  echo "<p></p>";
	  //page 3 : Mentor Info
	  
	  for($i = 0; $i <= $_SESSION['faculty_mentors']-1; $i++)
	  {
	  echo"<h2>Mentor ".($i+1)."</h2>
	  <form method=\"post\" id=\"mentor\" >
	  <input type=\"hidden\" name=\"from\" value=\"m".($i+1)."\"/>
	  <input type=\"submit\" name=\"submit\" value=\"edit\" onclick=\"submitform(document.getElementById('mentor'),'edit/edit.php','form'); return false\"/>
	  </form>
	  ";
	  echo "<b>mentor's first name:</b> ".$_SESSION['mentors'][$i]->get('mfname');
	  echo "<br/><b>mentor's last name:</b> ".$_SESSION['mentors'][$i]->get('mlname');
	  echo "<br/><b>mentor's email address:</b> ".$_SESSION['mentors'][$i]->get('m_email');
	  echo "<br/><b>mentor's confirmation of e-mail:</b> ".$_SESSION['mentors'][$i]->get('m_email_check');
	  echo "<br/><b>mentor's phone #:</b> ".$_SESSION['mentors'][$i]->get('m_phone');
	  echo "<br/><b>mentor department:</b> ".$_SESSION['mentors'][$i]->get('department');
	  echo "<br/><b>mentor college:</b> ".$_SESSION['mentors'][$i]->get('m_college');
	  echo "<br/><b>Mentor's academic title:</b> ".$_SESSION['mentors'][$i]->get('m_title');
	  echo "<p></p>";

	  }
	
	 //

	  //page4
	  echo "<h2>Paper Information</h2>
	  <form method=\"post\" id=\"paper\" >
	  <input type=\"hidden\" name=\"from\" value=\"p\"/>
	  <input type=\"submit\" name=\"submit\" value=\"edit\" onclick=\"submitform(document.getElementById('paper'),'edit/edit.php','form'); return false\"/>
	  </form>	  
	  
	  ";
	  
	  echo "<br/><b>paper title:</b> ".$_SESSION['paper_title'];
	  echo "<br/><b>area of research:</b> ".$_SESSION['aor'];
	  if($_SESSION['sci_notation'] == 0) echo "<br/><b>Scientific Notation:</b> Paper Title contains no Scientific Symbols"; else echo "<br/><b>Scientific Notation:</b> Paper Title contains Scientific Symbols";
	  
	  
	  if($_SESSION['human_subjects_permission'] == '')
	  { 
	  	 echo "<br/><strong>human subjects:</strong> Not Applicable";
	  }
	  else echo "<br/><b>human subjects:</b> ".$_SESSION['human_subjects_permission'];
	  if($_SESSION['animal_subjects_permission']=="") 
	  {
		 echo "<br/><strong>animal subjects:</strong> Not applicable";
	  }
	  else echo "<br/><b>animal subjects:</b> ".$_SESSION['animal_subjects_permission'];
	  
	
	//echo "<b>Random Number: ".$_SESSION['rand_code']."<br>";
	//echo "<b>Temporary Number: ".$_SESSION['temp_id']."<br";
	
	echo "<br><br><h2>Submit Application!</h2><form method=\"post\" id=\"send\" >
	  <input type=\"hidden\" name=\"from\" value=\"m".($i+1)."\"/>
	  <input type=\"submit\" name=\"submit\" value=\"Submit\" onclick=\"submitform(document.getElementById('mentor'),'process/sendtodb.php','form'); return false\"/>
	  </form>";
	echo"</div>";
	  ?>
</body>
</html>