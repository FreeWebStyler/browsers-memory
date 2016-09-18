<?php 

include 'helpers.php';

$browserExeName = 'browser.exe'; // Yandex.browser
$browserExeName = 'opera.exe'; // Opera

//echo '<plaintext>'; //$str = shell_exec('dir 2>&1'); $str = iconv('CP866', "UTF-8//IGNORE", $str); echo $str;
$res = iconv('CP866', "UTF-8//IGNORE", shell_exec('c:\\Windows\\System32\\tasklist.exe /fi "imagename eq '.$browserExeName.'" 2>&1'));
//echo $res;
$ar= explode("\n",$res);
pre($ar);
$sum=0;
$sval='22';
foreach($ar as $val){

/* echo 'val: '.$val; echo '<br>'; toOrd($val);  echo '<p>';*/
 //$val=str_replace(chr(160),'',$val);
 
 $val=str_replace('  ',' ',$val);
 $val=explode('Console',$val);
 if(isset($val[1])){
     $val=str_replace('KB',' ',$val[1]);


 //$val=str_replace(' ','',$val);
 //$val = str_replace('á','',$val);
 //$val= preg_replace('/\s+/', '', $val);
 $val=(string)substr(clean($val),1);
 if($val!='') $sval=$val;

 
 
 //echo $sum.' + '.(int)$val.' = ';
 
 $sum+=(int)$val;
 
 //echo $sum.' KB<br>';

 }
 
 
/* if(isset($val[count($val)-2])){
  echo $val[count($val)-2].'<br>';
  $sum+=(int)$val[count($val)-2];
  }*/
 
 //echo ' sum:',$sum.'<br>';
}

//echo 'sval:'.$sval; echo 'sval:'.ord($sval[4]); die;

//echo '==========================';
echo '<br>Total: '.floor($sum/1024). ' Mb';

?>