<?php
class student{

//vars
 private $sid; //int and 10 character limit
 private $sfname;
 private $slname;
 private $street;
 private $city;
 private $state;
 private $zip;
 private $s_email;
 private $s_email_check;
 private $s_phone;
 private $major;
 private $college;
 protected static $student_total = 0;
 private $num;//Number of student total.

public function __construct($sid, $sfname, $slastname, $street, $city, $state, $zip, $s_email, $s_email_check, $s_phone, $major, $college )
{
	  $this->sid = $sid;
	  $this->sfname = $sfname;
	  $this->slname = $slastname;
	  $this->street = $street;
	  $this->city = $city;
	  $this->state = $state;
	  $this->zip = $zip;
	  $this->s_email = $s_email;
	  $this->s_email_check = $s_email_check;
	  $this->s_phone = $s_phone;
	  $this->major = $major;
	  $this->college = $college;	
	  
	  self::$student_total++;
	  
}

public function set($name, $value)
{
	$this->$name = $value;
}

public function get($name)
{
	return $this->$name;
}

public function update($sid, $sfname, $slastname, $street, $city, $state, $zip, $s_email, $s_phone, $major, $college)
{
  	  $this->sid = $sid;
	  $this->sfname = $sfname;
	  $this->slname = $slastname;
	  $this->street = $street;
	  $this->city = $city;
	  $this->state = $state;
	  $this->zip = $zip;
	  $this->s_email = $s_email;
	  $this->s_phone = $s_phone;
	  $this->major = $major;
	  $this->college = $college;	
}


//end of class
}
?>
	

