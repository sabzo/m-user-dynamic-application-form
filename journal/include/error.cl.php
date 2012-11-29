<?php
class error{
	private $return_to;
	private $incomplete;
	private $back_button;
	private $close;
	
	public function __construct($return_to)
	{
		$this->return_to = $return_to;
		$this->incomplete = true;
		$this->back_button = 
				"<div id=\"data\"><div id=\"error\" class=\"form\">
						<form method=\"post\" id=\"send\" >
			   <input type=\"hidden\" name=\"back_to\" value=\"".$this->return_to."\"/>
			   <input type=\"submit\" name=\"submit\" value=\"back\" onclick=\"submitform(document.getElementById('send'),'include/back_to.php','data'); return false\"/>
			   </form>";
		$this->close = "</div></div>";
	}
	
	
//Checks if All required Fields have been filled out as a whole
	public function _all($array){
		if(in_array("", $array)) {
			echo "<h1>Please fill in all the required fields <br/></h1>". $this->back_button;
			throw new Exception('Please fill in all the required fields');
		}else{$this->incomplete = false; return true;}
	}
	
	
	
//A more specific check detailing which fields have not been filled in
	public function _each($array){
		$once = 1;
		foreach($array as $key => $value){
			if(!isset($value)){
				
				if($once == 1){ echo " The Following Fields were not filled out.<ul>"; $once--;}
				echo "<li>Please complete the <b>$key</b> field.</li>".$this->back_button;
				throw new Exception('');
			} 
		}if($once == 0) {
			echo "</ul></div></div>";
			throw new Exception('All fields must be complete');
			}
	}
	
	
	
// Fields Match
	public function _match($array){
		$once = 1;
		$match = array_shift($array);
		foreach($array as $key => $value){
			if($value != $match){
				
				if($once ==1){ if(!$this->incomplete) echo $this->back_button; echo "The following fields don't match <ul>";  $once--;}
				echo "<li><strong>$key</strong></li>";
				throw new Exception('Please make sure the e-mail fields match');
			}
			else {return true;}
		}if($once == 0) echo "</ul>"; if(!$this->incomplete) echo "<div></div>";
	}
	
	
		
// Email Right Syntax
	public function _email($input){
		
		$filtered = filter_var($input, FILTER_VALIDATE_EMAIL);
		if (!$filtered) {
			echo $this->back_button;
			throw new Exception('Please enter a valid e-mail address');
			echo "</ul></div></div>";
		}
	}
	
// Integer Check
	public function _int($input){
		foreach($input as $key => $value){
			$filtered = filter_var($value, filter_id('int'));
			if(!$filtered){
				echo $this->back_button;
				throw new Exception('Please make sure you entered a number for the field representing <b>'.$key.'</b>');
				echo $this->close;
			}
			//Range
			
			$filtered = filter_var($value, filter_id('int'), array("options" =>array("min_range" =>"1", "max_range" =>"4") ));
			if(!$filtered){
				echo $this->back_button;
				throw new Exception('Cannot have <b>less</b> than 1 participant or <b>more</b> than 4 participants representing <b>'.$key.'</b>.');
				echo $this->close;
			}
		}
	}
}
?>
</div>
