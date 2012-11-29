<?php

class mentor{
	private $mfname;
	private $mlname;
	private $m_email;
	private $m_email_check;
	private $m_phone; //int, 10 digits, must include area code
	private $department;
	private $m_college;
	private $m_title;
	
	private $num;
	// protected static $mentor_total = 0;

	
	public function __construct($mfname, $mlname, $m_email, $m_email_check, $m_phone, $department, $m_college, $m_title)
	{
		$this->mfname = $mfname;
		$this->mlname = $mlname;
		$this->m_email = $m_email;
		$this->m_email_check = $m_email_check;
		$this->m_phone = $m_phone;
		$this->department = $department;
		$this->m_college = $m_college;
		$this->m_title = $m_title;
	}
	
 	public function get($name){
	    return $this->$name;
 	}
	
	public function update($mfname, $mlname, $m_email, $m_email_check, $m_phone, $department, $m_college, $m_title)
	{
		$this->mfname = $mfname;
		$this->mlname = $mlname;
		$this->m_email = $m_email;
		$this->m_email_check = $m_email_check;
		$this->m_phone = $m_phone;
		$this->department = $department;
		$this->m_college = $m_college;
		$this->m_title = $m_title;
	}
	
	
}