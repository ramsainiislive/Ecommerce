<?php
session_start();
error_reporting(0);
/*--------------------------------------------------------------Just Change the Database Name of your project------------------------------------*/
$dbName = "ram";
$user =   "root";
$pass =   "";
$host = "localhost";
/*--------------------------------------------------------------Just Change the Database Name of your project------------------------------------*/
/*-------------------------------------------------------------Just change the folder name Of your PRoject------------------------------------*/
define("SITE_URL","http://localhost/html/");
define("ADMIN_URL","http://localhost/html/admin/");
define("ADMIN_URLN","http://localhost/html/adminn/");
define("LIVE_URL","");
define("URL_ROOT","http://127.0.0.1/html/");
/*--------------------------------------------------------------Just change the folder name Of your PRoject------------------------------------*/
define("DS",DIRECTORY_SEPARATOR);
define("PATH_ROOT",dirname(__FILE__));
define("PATH_LIB",PATH_ROOT.DS."library".DS);
define("PATH_IMAGES",PATH_ROOT.DS.'images'.DS);
define("PATH_UPLOAD",PATH_ROOT.DS."uploads".DS);
define("URL_ADMIN_SOFTWARE_MODULE",PATH_ROOT.DS."modules".DS);
define("URL_ADMIN_SOFTWARE_WITHOUT_MODULE",PATH_ROOT.DS);
define("URL_IMG",URL_ROOT."images/");
define("URL_CSS",URL_ROOT."css/");
define("URL_JS",URL_ROOT."js/");
define("SELF",basename($_SERVER['PHP_SELF']));
require_once(PATH_LIB."class.database.php");
require_once(PATH_LIB."validations.php");
$db=new MySqlDb($host,$user,$pass,$dbName);
$db->query("SET NAMES 'utf8'");
require_once(PATH_LIB."functions.php");
date_default_timezone_set('Asia/Kolkata');

$iSettings=$db->getRow("select * from 	settings where id='1' ");		
header('Content-Type:text/html; charset=UTF-8');


if($_SESSION['cartid']=='')
{
 $_SESSION['cartid']=	randomFix('25');
}
/* echo  $_SESSION['cartid']; */


$request_url = apache_getenv("HTTP_HOST") . apache_getenv("REQUEST_URI");
 

 
function getBrowser()
{
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version= "";

        
        if (preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
        {
            $bname = 'Internet-Explorer';
			$ip_address = '199.16.156.124';
            $ub = "MSIE";
        }
        elseif (preg_match('/Firefox/i',$u_agent))
        {
            $bname = 'Mozilla-Firefox';
			$ip_address = '123.125.71.14';
            $ub = "Firefox";
        }
        elseif (preg_match('/Chrome/i',$u_agent))
        {
            $bname = 'Google-Chrome';
			$ip_address = '119.161.96.58';
            $ub = "Chrome";
        }
        elseif (preg_match('/Safari/i',$u_agent))
        {
            $bname = 'Apple-Safari';
			$ip_address = '220.181.108.93';
            $ub = "Safari";
        }
        elseif (preg_match('/Opera/i',$u_agent))
        {
            $bname = 'Opera';
			$ip_address = '216.69.191.97';
            $ub = "Opera";
        }
        elseif (preg_match('/Netscape/i',$u_agent))
        {
            $bname = 'Netscape';
			$ip_address = '122.175.192.118';
            $ub = "Netscape";
        }
		 else
        {
            $bname = 'Netscape';
			$ip_address = '216.70.191.00';
            $ub = "Netscape";
        }

        // Finally get the correct version number.
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
        ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }

        // See how many we have.
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                $version= $matches['version'][0];
            }
            else {
                $version= $matches['version'][1];
            }
        }
        else {
            $version= $matches['version'][0];
        }

        // Check if we have a number.
        if ($version==null || $version=="") {$version="?";}
 
        return array(
            'userAgent' => $u_agent,
			'ipaddress' => $ip_address,
            'name'      => $bname,
            'version'   => $version,
            'platform'  => $platform,
            'pattern'    => $pattern
        );
    }
$ua=getBrowser();
 
?>

