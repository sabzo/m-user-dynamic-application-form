<?
include_once("mysql_open_connection.php");
session_start();

//Generate Random Code	  
	  
function get_random_code() {
    $temp_rnd;
    do {
        $temp_rnd = strval( rand(0,10000));
        while(strlen($temp_rnd) < 4) {
            $temp_rnd = "0" . $temp_rnd;
        }
        $rnd_check = mysql_query("SELECT project_overview.project_id FROM project_overview WHERE (((project_overview.project_id)='" . $temp_rnd . "'));") or die(mysql_error());
        //print(temp) 
  	} while(mysql_num_rows($rnd_check) > 0);
    return $temp_rnd;
}

//Generate tempid



if(empty($_SESSION['temp_id'])) $_SESSION['temp_id'] = NULL;

if($temp_id == "") {
    $qry_temp_ids = mysql_query("SELECT temp_projects_overview.temp_project_id FROM temp_projects_overview ORDER BY temp_projects_overview.temp_project_id DESC;");
    $temp;
    if(!$qry_temp_ids) {
        $temp = 0;
    } else { 
		$result = mysql_fetch_array($qry_temp_ids);
        $temp = $result[0] + 1;
		
		$_SESSION['temp_id'] = $temp;
	}
	mysql_free_result($qry_temp_ids);
	
    mysql_query("INSERT INTO temp_projects_overview ( temp_project_id, completed ) VALUES ( " . $temp . ", 0)");

}

//

function get_temp_id() {
    global $temp_id; 
	$temp_id = $_SESSION['temp_id'];	
    if($temp_id != "") {
        $qry_temp_id = mysql_query("SELECT temp_projects_overview.temp_project_id FROM temp_projects_overview WHERE (((temp_projects_overview.temp_project_id)=" . $temp_id . "));");
        if(!$qry_temp_id) {
            $temp_id = "";
        }
    }
    $get_temp_id = $temp_id;
	return $get_temp_id;
}

//Store random code in session var
if(empty($_SESSION['rand_code'])) $_SESSION['rand_code'] = NULL;
$_SESSION['rand_code'] = get_random_code();
$_SESSION['temp_id'] = get_temp_id();
//echo $_SESSION['temp_id'];

?>