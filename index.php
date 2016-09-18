<?php 

include 'helpers.php';

$browserExeName = 'browser.exe'; // Yandex.browser
$browserExeName = 'opera.exe'; // Opera

$res = iconv('CP866', "UTF-8//IGNORE", shell_exec('c:\\Windows\\System32\\tasklist.exe /fi "imagename eq '.$browserExeName.'" 2>&1'));
$ar = explode("\n",$res);
pre($ar);
$sum = 0;

foreach($ar as $val){
    $val=str_replace('  ',' ',$val);
    $val=explode('Console',$val);
    if(isset($val[1])){
        $val=str_replace('KB',' ',$val[1]);
        $val=(string)substr(clean($val),1);
        //echo $sum.' + '.(int)$val.' = ';
        $sum+=(int)$val;
        //echo $sum.' КБ<br>';
    }
}

//echo '==========================';
echo '<br>Total: '.floor($sum/1024). ' Mb';

?>