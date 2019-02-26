<?php

function __autoload($strClass)

{

	$strFile="class.".strtolower($strClass).".php";

	require_once(PATH_CLASS.$strFile);

}


function mymail($from,$to,$subject,$body,$type="Common")
{
	global $db;global $LinksDetails;
	$msgs=$db->getRow("select * from mss_epooja_mailmsg where msg_for='".$type."'");
	//$msgs=mysql_fetch_array($qry);
	$UNSUBSCRIBE=URL_ROOT.'unsubscribe.php?to='.md5($to);
	$arr_tpl_vars=array('[MESSAGE]','[ADMIN]','[LOGIN]','[SITE]', '[DATE]', '[SUBJECT]', '[UNSUBSCRIBE]','[TO]','[SITE_NAME]','[LOGO]');
	$arr_tpl_data = array(nl2br($body), $LinksDetails["mail_sender_email"], SITE_URL.'sign_in.php', SITE_URL, date('d/m/Y'), $subject, $UNSUBSCRIBE,$to,$LinksDetails["site_name"],$LinksDetails["logo"]);
	$e_msg = str_replace($arr_tpl_vars, $arr_tpl_data, $msgs["msg"]);
	$e_sub = str_replace($arr_tpl_vars, $arr_tpl_data, $msgs["subject"]);
	if($msgs["from_email"]!="")$from=$msgs["from_email"];
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: Info<info@nrpyvss.com>' . "\r\n";
	
	if(@mail($to,$e_sub,$e_msg,$headers))
	return "done";
 	
}



function sms($no,$msg){
	global $db;
	$message=urlencode($msg);
	$url="http://askandrelax.org/api/sendmsg.php?user=epujapath&pass=WW123456&sender=NRPYSS&phone=$no&text=$message&priority=ndnd&stype=normal";
	$ret = file_get_contents($url);
	//$res=$db->insertAry(SMS,array("mobile"=>$no,"added_by"=>$_SESSION["admin"]["uid"],"msg"=>$msg,"status"=>$ret));
	return $ret;
}


function dt($val) { 

    $arrWeek = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");

    return $arrWeek[$val];

}


function wehaveto_currency()
{
	 if($_SESSION["curr"]=='INR') { ?> 
     <img class="" src="<?php echo SITE_URL; ?>images/rupe.png" style="width: 10px;    margin-bottom: 7px;"> 
	 <?php } else { echo $_SESSION["curr"]; } 
}


function iWeekStart()

{	$mydate=getdate();

	if($mydate['weekday']=='Monday')

	{

	$iLastThursday = date('Y-m-d 00:00:00');

	}

	else

	{

 	$iLastThursday = date('Y-m-d 00:00:00', strtotime('last Monday', strtotime(date("m/d/Y"))));

 	}



return $iLastThursday;

}



function iWeekEnd()

{ 



	$mydate=getdate();

	if($mydate['weekday']=='Sunday')

	{

	$iComingThursday = date('Y-m-d 23:59:00');

	}

	else

	{

	$iComingThursday = date('Y-m-d 23:59:00', strtotime('Next Sunday', strtotime(date("m/d/Y"))));

	}

return $iComingThursday;

}





function redirect($url=NULL)

{

	if(is_null($url)) $url=curPageURL();

	if(headers_sent())

	{

		echo "<script>window.location='".$url."'</script>";

	}

	else

	{

		header("Location:".$url);

	}

	exit;

}





function settings()

{

$Setting=$db->getRow("select * from userdetail where id = 1");

return $aryList;

}



function currency_symbol($from_Currency) {

	global $db;

 	$from = $db->getVal("select cur_symbol from currencyrate where cur_name ='".$from_Currency."'");

	 

	return $from ;

}













function currency($from_Currency, $to_Currency, $amount) {

	global $db;

	$to=0;$from=0;

	$from = $db->getVal("select cur_rate from currencyrate where cur_name ='".$from_Currency."'");

	$to = $db->getVal("select cur_rate from currencyrate where cur_name ='".$to_Currency."'");

 	$returnData = ($amount * ($to/$from));

	return number_format((float) $returnData, 2, '.', '');;

}







function insert($table,$data)

{

	$fields="";

	$values = "";

	foreach($data as $key => $val)

	{

		$fields.=$key.',';

		$values.="'".$val."',";

	}

	$fields = substr($fields,0,strlen($fields)-1);

	$values = substr($values,0,strlen($values)-1);

	

	$q = mysql_query("insert into $table ($fields) values($values)") or die("Insert Error.".mysql_error());

	return mysql_insert_id();

}



function msg($msg)

{

	if(count($msg))

	foreach($msg as $type => $content)



	if($msg[$type]!='')

	{

	 return '<div class="alert alert-'.$type.' alert-dismissable" style="height:40px; margin-top: -5px;">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'.$content.'</div>';

	}

}



function msg_front($msg)

{

	if(count($msg))

	foreach($msg as $type => $content)



	if($msg[$type]!='')

	{

	 return '<div class="status alert alert-'.$type.'"><p style="width:100%"><img src="'.URL_IMG.'icon_'.$type.'.png" align="absmiddle">&nbsp;&nbsp;'.$content.'</p></div>';

	}

}





function chkHeader()

{

	if(strpos($_SERVER['HTTP_REFERER'],URL_ROOT)==0) return true;

	return false;

}



function setMsgPage($mod, $sec, $type, $note)

{

	//possible values for type

	//success

	//information

	//warning

	//error

	if(!isset($_SESSION['msg_er'])) $_SESSION['msg_er']=array();

	if(!isset($_SESSION['msg_er'][$mod])) $_SESSION['msg_er'][$mod]=array();

	if(!isset($_SESSION['msg_er'][$mod][$sec])) $_SESSION['msg_er'][$mod][$sec]=array();

	

	$_SESSION['msg_er'][$mod][$sec]['page']=array(

												  'type'=>$type,

												  'note'=>$note

												  );

}



function getMsgPage($mod, $sec)

{

	$return='';

	if(isset($_SESSION['msg_er'][$mod][$sec]['page']) && is_array($_SESSION['msg_er'][$mod][$sec]['page']) && count($_SESSION['msg_er'][$mod][$sec]['page'])>0)

	{

		$class=$_SESSION['msg_er'][$mod][$sec]['page']['type'];

		$return="<div class=\"notification ".$class."\">";

		$return.=$_SESSION['msg_er'][$mod][$sec]['page']['note'];

		$return.="</div>";

		

		unset($_SESSION['msg_er'][$mod][$sec]['page']);

	}

	

	clearErMsg($mod,$sec);

	

	return $return;

}



function setMsgField($mod, $sec, $field, $type, $note)

{

	//possible values for type

	//success

	//information

	//warning

	//error

	

	if(!isset($_SESSION['msg_er'])) $_SESSION['msg_er']=array();

	

	if(!isset($_SESSION['msg_er'][$mod])) $_SESSION['msg_er'][$mod]=array();

	if(!isset($_SESSION['msg_er'][$mod][$sec])) $_SESSION['msg_er'][$mod][$sec]=array();

	

	if(!isset($_SESSION['msg_er'][$mod][$sec]['field'])) $_SESSION['msg_er'][$mod][$sec]['field']=array();

	

	$_SESSION['msg_er'][$mod][$sec]['field'][$field]=array(

														   'type'=>$type,

														   'note'=>$note

														   );

}





function getMsgField($mod, $sec, $field)

{

	$return='';

	if(isset($_SESSION['msg_er'][$mod][$sec]['field'][$field]) && is_array($_SESSION['msg_er'][$mod][$sec]['field'][$field]) && count($_SESSION['msg_er'][$mod][$sec]['field'][$field])>0)

	{

		$class=$_SESSION['msg_er'][$mod][$sec]['field'][$field]['type'];

		$return="<span class=\"notification ".$class."\">";

		$return.=$_SESSION['msg_er'][$mod][$sec]['field'][$field]['note'];

		$return.="</span>";

		unset($_SESSION['msg_er'][$mod][$sec]['field'][$field]);

	}

	if(isset($_SESSION['msg_er'][$mod][$sec]['field']) && is_array($_SESSION['msg_er'][$mod][$sec]['field']) && count($_SESSION['msg_er'][$mod][$sec]['field'])===0) unset($_SESSION['msg_er'][$mod][$sec]['field']);

	

	clearErMsg($mod,$sec);

	

	return $return;

}



function clearErMsg($mod,$sec)

{

	if(isset($_SESSION['msg_er'][$mod][$sec]) && is_array($_SESSION['msg_er'][$mod][$sec]) && count($_SESSION['msg_er'][$mod][$sec])===0) unset($_SESSION['msg_er'][$mod][$sec]);

	

	if(isset($_SESSION['msg_er'][$mod]) && is_array($_SESSION['msg_er'][$mod]) && count($_SESSION['msg_er'][$mod])===0) unset($_SESSION['msg_er'][$mod]);

	

	if(isset($_SESSION['msg_er']) && is_array($_SESSION['msg_er']) && count($_SESSION['msg_er'])===0) unset($_SESSION['msg_er']);

}



function setSort($mod,$sec,$val)

{

	if(!isset($_SESSION['sort'])) $_SESSION['sort']=array();

	if(!isset($_SESSION['sort'][$mod])) $_SESSION['sort'][$mod]=array();

	

	$_SESSION['sort'][$mod][$sec]=$val;

}



function getSort($mod,$sec)

{

	return $_SESSION['sort'][$mod][$sec];

}



function curPageURL() 

{

	$pageURL = 'http';

 	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}

 	$pageURL .= "://";

 	if ($_SERVER["SERVER_PORT"] != "80") 

	{

  		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];

 	} 

	else 

	{

  		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

 	}

 	return $pageURL;

}



function getQueryString($aryQueryStr)

{

	$aryMatch=array();

	foreach($aryQueryStr as $opt=>$val) { $aryMatch[]=$opt.'='.urlencode($val); }

	return '?'.implode('&',$aryMatch);

}

function price($pid)

{

$pquery=mysql_query("SELECT price FROM package WHERE package_id='$pid'");

$pres=mysql_fetch_array($pquery);

	return $pres['price'];	

}



function selected($needle,$haystack)

{

	if(is_array($haystack) && in_array($needle,$haystack)) { return 'selected="selected"'; }

	elseif(!is_array($haystack) && $needle===$haystack) { return 'selected="selected"'; }

	else { return ''; }

}

function getvalue($field, $table, $condition="")

{



	$q = mysql_query("select $field from $table $condition") or die(mysql_error());

	$row = mysql_fetch_array($q);

	return $row[$field];

}

function update($table,$data,$condition="")

{

	$fields="";

	$values = "";

	foreach($data as $key => $val)

	{

		$fields.=$key."='".$val."',";

	}

	$fields = substr($fields,0,strlen($fields)-1);

	

	$q = mysql_query("update $table set $fields $condition")or die("Update Error.".mysql_error());

	if($q)

	{

	return $q;

	}

}



function checked($needle,$haystack)

{

	if(is_array($haystack) && in_array($needle,$haystack)) { return 'checked="checked"'; }

	elseif(!is_array($haystack) && $needle===$haystack) { return 'checked="checked"'; }

	else { return ''; }

}



function isValidDate($val)

{

	if(preg_match(REGX_DATE,$val))

	{

		list($year,$month,$date)=explode("-",$val);

		if(checkdate($month,$date,$year)) return true;

	}

	return false;

}



function getPaging($refUrl,$aryOpts,$pgCnt,$curPg)

{

 	$return='';

	$return.='<ul class="pagination">';

	if($curPg>1)

	{

		$aryOpts['pg']=1;

		$return.='<li><a href="'.$refUrl.getQueryString($aryOpts).'">First</a></li>';

		

		$aryOpts['pg']=$curPg-1;

		$return.='<li><a href="'.$refUrl.getQueryString($aryOpts).'">Prev</a></li>';

	}

	

	

	

	

		$i=$pgCnt;

 		$upto=$_GET['pg']+1;

 		$downto=$_GET['pg']-1;

		

 		if($upto>$pgCnt)

 		{

 			$upto=$pgCnt;

 		}

 		if($downto<=0)

  		{

 			$downto=1;

 		}

 		if($pgCnt>1)

		{ 

			 

			for($i=$downto;$i<=$upto;$i++)

			{

				if($i==$curPg)

 				{

 				$return.= '<li >'."<a class='selected' href=\"$refUrl?pg=$i\">".$i.'</a><li>';

 				}

 				else

 				{

 				$return.= "<li><a href=\"$refUrl?pg=$i\">".$i."</a></li>";

 				}

 			}

 		}

	

 	

	 

	if($curPg<$pgCnt)

	{

		$aryOpts['pg']=$curPg+1;

		$return.='<li><a href="'.$refUrl.getQueryString($aryOpts).'">Next</a></li>';

		$aryOpts['pg']=$pgCnt;

		$return.='<li><a href="'.$refUrl.getQueryString($aryOpts).'">Last</a></li>';

	}

	$return.='<div class="clearfix"></div></ul>';

	return $return;

}



function isAdmin()

{

	if(isset($_SESSION[LOGIN_ADMIN]) && is_array($_SESSION[LOGIN_ADMIN]) && isset($_SESSION[LOGIN_ADMIN]['id'])) return true;

	return false;

}



function getFileSize($path)

{

	if(is_array($path) && count($path)>0)

	{

		//if(!file_exists($path)) return 0;

		//if(is_file($path)) return filesize($path);

		$ret = 0;

		foreach($path as $file)

			$ret+=getFileSize($file);

		return $ret;

	}

	else

	{

		if(!file_exists($path)) return 0;

		if(is_file($path)) return filesize($path);

	}

}



//function formatBytes($bytes, $precision = 2) {

//    $units = array('B', 'KB', 'MB', 'GB', 'TB');

//  

//    $bytes = max($bytes, 0);

//    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));

//    $pow = min($pow, count($units) - 1);

//  

//    $bytes /= pow(1024, $pow);

//  

//    return round($bytes, $precision) . ' ' . $units[$pow];

//	//return $bytes;

//}



function getRealIpAddr()

{

    if(!empty($_SERVER['HTTP_CLIENT_IP']))//check ip from share internet

    { 

		$ip=$_SERVER['HTTP_CLIENT_IP'];

    }

    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))//to check ip is pass from proxy

    { 

		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];

    }

    else

    { 

		$ip=$_SERVER['REMOTE_ADDR'];

    }

    return $ip;

}



function fetchSetting($mixVal)

{

	$aryReturn=array();

	$strSetting='';

	if(is_array($mixVal) && count($mixVal)>0)

	{

		$strSetting="'".implode("', '",$mixVal)."'";

	}

	elseif(trim($mixVal)!='')

	{

		$strSetting="'".$mixVal."'";

	}

	if(trim($strSetting)!='')

	{

		global $db;

		$arySetData=$db->getRows("select * from settings where `field` in (".$strSetting.")");

		if(is_array($arySetData) && count($arySetData)>0)

		{

			foreach($arySetData as $iSetData)

			{

				$aryReturn[$iSetData['field']]=$iSetData['value'];

			}

		}

	}

	return $aryReturn;

}



function getStatusImg($status)

{

	$aryImg=array(

				  '0'=>"status_inactive.png",

				  '2'=>"status_reject.png",

				  '1'=>"status_active.png"

				  );

	return '<img src="'.URL_ADMIN_IMG.$aryImg[$status].'" title="'.getStatusStr($status).'" />';

}



function getOptionImg($status)

{

	$aryImg=array(

				  '0'=>"cross.png",

				  '1'=>"tick.png"

				  );

	return '<img src="'.URL_ADMIN_IMG."icons/".$aryImg[$status].'" />';

}



function getStatusStr($val)

{

	if($val==0)

	{

		return "Inactive";

	}

	elseif($val==1)

	{

		return "Active";

	}

	else

	{

		return "Pending";	

	}

}

function getOptionStr($val)

{

	if($val==0)

	{

		return "No";

	}

	else

	{

		return "Yes";

	}

}



function delete_directory($dirname)

{

	if (is_dir($dirname))

      $dir_handle = opendir($dirname);

   if (!$dir_handle)

      return false;

   while($file = readdir($dir_handle))

   {

      if ($file != "." && $file != "..")

	  {

         if (!is_dir($dirname.DS.$file))

            @unlink($dirname.DS.$file);

         else

            delete_directory($dirname.DS.$file);    

      }

   }

   closedir($dir_handle);

   @rmdir($dirname);

   return true;

}



function check_login($userType='User')

{

	if($userType=='User' && (!isset($_SESSION[LOGIN_USER]) || count($_SESSION[LOGIN_USER])==0))

		return false;

	elseif($userType=='Admin' && (!isset($_SESSION[LOGIN_ADMIN]) || count($_SESSION[LOGIN_ADMIN])==0))

		return false;

		

	return true;

}





function loc($page)

{?><script>

window.location='<?=$page?>';

</script>

<?php



}

function selectfetch($fields="*",$table,$condition="")

{

	$q = mysql_query("select $fields from $table $condition") or die("Select Error.".mysql_error());

	$r = mysql_fetch_object($q);

	return $r;

}



function listDirs($where){

	$directoryarr=array();

    $itemHandler=opendir($where);

    $i=0;

    while(($item=readdir($itemHandler)) !== false){

	if ($item == "." || $item == "..") { }

	else {$directoryarr[]=$item;}

       }

	  return($directoryarr);

}

function recurse_copy($src,$dst) { 

    $dir = opendir($src); 

    @mkdir($dst); 

    while(false !== ( $file = readdir($dir)) ) { 

        if (( $file != '.' ) && ( $file != '..' )) { 

            if ( is_dir($src . '/' . $file) ) { 

                recurse_copy($src . '/' . $file,$dst . '/' . $file); 

            } 

            else { 

                copy($src . '/' . $file,$dst . '/' . $file); 

            } 

        } 

    } 

    closedir($dir); 

}

function calc_dist($latitude1, $longitude1, $latitude2, $longitude2) {

$thet = $longitude1 - $longitude2;

$dist = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($thet)));

$dist = acos($dist);

$dist = rad2deg($dist);

$kmperlat = 111.325; // Kilometers per degree latitude constant

$dist = $dist * $kmperlat;

return (round($dist));

}



function randomFix($length)

{

	$random= "";

	

	srand((double)microtime()*1000000);

	

	$data = "AbcDE123IJKLMN67QRSTUVWXYZ";

	$data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";

	$data .= "0FGH45OP89";

	

	for($i = 0; $i < $length; $i++)

	{

		$random .= substr($data, (rand()%(strlen($data))), 1);

	}

	return $random;

}



function create_token($nm="token")

{

	$_SESSION[$nm] = time();

	echo '<input type="hidden" name="'.$nm.'"  value="'.$_SESSION[$nm].'"/>';

}



function token($nm="token")

{

 if($_SESSION[$nm]==$_POST[$nm])

	return true;

 else

 	return false;

}



function select($fields="*",$table,$condition="")

{

	$q = mysql_query("select $fields from $table $condition") or die("Select Query Error.".mysql_error());

	return $q;

}

function addtocart($pid,$qty)

{

	if(!isset($_SESSION['cart']))

	{

		$_SESSION['cart'][$pid] = $qty;

	}

	else

	{

			if(array_key_exists($pid,$_SESSION['cart']))

			{

				$_SESSION['cart'][$pid] =$_SESSION['cart'][$pid]+ $qty;

			}

			else

			{

				$_SESSION['cart'][$pid] =$qty;

			}

	}

	

}

function updatecart($pid,$qty)

{

if($qty ==0 or empty($qty))

	{

		unset($_SESSION['cart'][$pid]);

	}

	else

	{

		$_SESSION['cart'][$pid] = $qty;

	}

}







function convertdatenew($date)

{

$arrdate=explode('/',$date);

return $arrdate[2].'-'.$arrdate[1].'-'.$arrdate[0];

}



class Paging

{

	var $rowsPerPage =4;



	var $pageNum = 1;



	var $numrows = 0;



	var $maxPage = 0;



	var $offset = 0;



	function sql($fields="*",$table,$cond='')



	{  



	  $this->pageNum = isset($_REQUEST['gotopage'])?$_REQUEST['gotopage']:1;



	  $this->offset = ($this->pageNum - 1) * $this->rowsPerPage;

		

		$query = "select $fields from $table $cond LIMIT ".$this->offset.", ".$this->rowsPerPage;

		

		//echo $query;

		

		//echo "<br />";



	  $q = mysql_query($query);



		$query2 = "select $fields from $table $cond  ";

		

		//echo $query2;

		

		//echo "<br />";



	  $q2 = mysql_query($query2);		



	  $this->numrows = mysql_num_rows($q2);



 	  $this->maxPage = ceil($this->numrows/$this->rowsPerPage);  



	  return $q;



	}

	





 

	function navigations($param='ser=')



	{



		



	//	$self = basename($_SERVER['PHP_SELF']);	

    $self = $_SERVER['PHP_SELF']."?"; // edited	

		



		//$self = $self ."?".$param;

          $self = $self ."".$param;  // edited	



		if ($this->pageNum > 1)



		{



			$gotopage = $this->pageNum - 1;



			$prev = "<li class=\"text\" ><a  href=\"$self&gotopage=$gotopage\">Prev</a></li>";



			//$first = "<li class=\"text\"><a  href=\"$self&gotopage=1\">First</a><li>";



		} 



		else



		{



			$prev  = '';       // we're on page one, don't enable 'previous' link



			$first = ''; // nor 'first page' link



		}



		if ($this->pageNum < $this->maxPage)



		{



			$gotopage = $this->pageNum + 1;



			$next = "<li class=\"text\"><a  href=\"$self&gotopage=$gotopage\">Next</a><li>";



			//$last = "<li class=\"text\"><a  href=\"$self&gotopage=".$this->maxPage."\">Last</a></li>";



		} 



		else



		{



			$next = '';      // we're on the last page, don't enable 'next' link



			$last = ''; // nor 'last page' link



		}	



		$i=$this->pageNum;



		$upto=$i+3;



		$downto=$i-3;



		if($upto>$this->maxPage)



		{



			$upto=$this->maxPage;



		}



		



		if($downto<=0)



		



		{



			$downto=1;



		}



		



		if($this->maxPage>1)



		{



			for($i=$downto;$i<=$upto;$i++)



			{



				if($i==$this->pageNum)



				{



				$pages .= '<li >'."<a class='selected' href=\"$self&gotopage=$i\">".$i.'</a><li>';



				}



				else



				{



				$pages .= "<li><a href=\"$self&gotopage=$i\">$i</a></li>";



				}



			



			}



		}



		return '<div class="paging"><ul>'.$first . $prev."&nbsp;&nbsp;$pages&nbsp;&nbsp;".$next . $last.'</ul></div>';	



	}







}



function href($page,$param="")

{

	global $db;

	$linkParam = explode("=",$param);

	$page = explode("?",$page);

	$sef = 1;

	if($sef=="1")

	{

		$x = explode("&",$param);

		$var = array();

		foreach($x as $k1 => $v1)

		{

			$x2 = explode("=",$v1);

			$var[$x2[0]]=$x2[1];

		}

		switch($page[0])

		{	

			

			case 'page.php':

			{

				if(isset($var['id']))

				{

					$name=$db->getVal("SELECT pageurl FROM cms WHERE id=".$var['id']);

					 

					$htUrl = BASE_URL.'pages/'.$name;

					return $htUrl;

				

				}

				else

				{

				$htUrl = URL_ROOT."content/".$linkParam[1]."/".$linkParam[2];

				}

				return $htUrl;

				break;

			}

			

			

			

			case 'iBlogDetail.php':

			{

				if(isset($var['id']))

				{

					$name=$db->getVal("SELECT blog_url FROM blogs WHERE id=".$var['id']);

					$pagename=str_replace(" ","-",str_replace("+","~",str_replace("&","and",strtolower(trim($name)))));

					$htUrl = BASE_URL.'blog/'.$pagename;

					return $htUrl;

				

				}

				else

				{

				$htUrl = URL_ROOT."content/".$linkParam[1]."/".$linkParam[2];

				}

				return $htUrl;

				break;

			}

			

			

			

			case 'iFacilitesDetail.php':

			{

				if(isset($var['id']))

				{

					$name=$db->getVal("SELECT blog_url FROM facilities WHERE id=".$var['id']);

					$pagename=str_replace(" ","-",str_replace("+","~",str_replace("&","and",strtolower(trim($name)))));

					$htUrl = BASE_URL.'facilites/'.$pagename;

					return $htUrl;

				

				}

				else

				{

				$htUrl = URL_ROOT."content/".$linkParam[1]."/".$linkParam[2];

				}

				return $htUrl;

				break;

			}

			

			

			

 			case 'iProducttetail.php':

			{

				if(isset($var['id']))

				{

					$pagename=$db->getVal("SELECT product_url FROM products WHERE id=".$var['id']);

					//$pagename=str_replace(" ","-",str_replace("+","~",str_replace("&","and",strtolower(trim($name)))));

					$htUrl = BASE_URL.$pagename;

					return $htUrl;

				

				}

				else

				{

				$htUrl = URL_ROOT."content/".$linkParam[1]."/".$linkParam[2];

				}

				return $htUrl;

				break;

			}

			

			case 'socialblogdetail.php':

			{ 

				if(isset($var['id']))

				{

					$name=$db->getVal("SELECT blogurl FROM mainbloglistings WHERE mainblogid=".$var['id']);

					$pagename=str_replace(" ","-",str_replace("+","~",str_replace("&","and",strtolower(trim($name)))));

					$htUrl = URL_ROOT.''.$pagename;

					return $htUrl;

 				}

				else

				{

				$htUrl = URL_ROOT."content/".$linkParam[1]."/".$linkParam[2];

				}

				return $htUrl;

				break;

			}

			

			

			case 'socialcategory.php':

			{ 

				if(isset($var['id']))

				{

					$name=$db->getVal("SELECT categoryurl FROM categories WHERE category_id=".$var['id']);

					$pagename=str_replace(" ","-",str_replace("+","~",str_replace("&","and",strtolower(trim($name)))));

					$htUrl = URL_ROOT.'category/'.$pagename;

					return $htUrl;

 				}

				else

				{

				$htUrl = URL_ROOT."content/".$linkParam[1]."/".$linkParam[2];

				}

				return $htUrl;

				break;

			}

			

			case 'socialauthor.php':

			{ 

				if(isset($var['id']))

				{

					$name=$db->getVal("SELECT userurl FROM registeruserlist WHERE blid=".$var['id']);

 					$htUrl = URL_ROOT.'author/'.$name;

					return $htUrl;

 				}

				else

				{

				$htUrl = URL_ROOT."content/".$linkParam[1]."/".$linkParam[2];

				}

				return $htUrl;

				break;

			}

			

			

			

			

			default:

			{

				if($param=="")

				{

				  return URL_ROOT.$page;

				}

				else

				{

				  return URL_ROOT.$page.'?'.$param;

				}

			}

		

		}

	}

	else

	{ 

		if($param=="")

		{

		  return URL_ROOT.$page;

		}

		else

		{

		  return URL_ROOT.'/'.$page.'?'.$param;

		}

	}	

}







function sendmailfromlocal($to,  $subject, $message)

{  



 

include(PATH_LIB."class.phpmailer.php");

 

$mail = new PHPMailer;

 

$mail->IsSMTP();                                      // Set mailer to use SMTP

$mail->Host = 'smtp.net4india.com';                 // Specify main and backup server

$mail->Port = 587;                                    // Set the SMTP port

$mail->SMTPAuth = true;                               // Enable SMTP authentication

$mail->Username = 'info@katiyamilan.com';                // SMTP username

$mail->Password = 'info123';                  // SMTP password

$mail->SMTPSecure = '';                            // Enable encryption, 'ssl' also accepted



$mail->From = 'admin@discussioninfinity.com';

$mail->FromName = 'Info Discussion Infinity';

//$mail->AddAddress('test@trivedieffect.com', 'Trivedi Effect');  // Add a recipient

$mail->AddAddress($to);               // Name is optional

$mail->IsHTML(true);                                  // Set email format to HTML

$mail->Subject = $subject;

$mail->Body    = $message;

$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';



if(!$mail->Send()) {

   echo 'Message could not be sent.';

   echo 'Mailer Error: ' . $mail->ErrorInfo;

   exit;

}

 

return 'Message has been sent';



}









  function smart_resize_image( $file, $width = 0, $height = 0, $proportional = false, $output = 'file', $delete_original = true, $use_linux_commands = false )

 {}



?>