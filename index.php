<div align=center>
<div align=left style=width:25%>
<form method=POST>
<input type=checkbox value=chrome.exe name=browser><label>Chrome</label><br>
<input type=checkbox value=browser.exe name=browser><label>Yandex.browser</label><br>
<input type=checkbox value=opera.exe name=browser><label>Opera</label><br>
<input type=checkbox value=vivaldi.exe name=browser><label>Vivladi</label><br>
<input type=checkbox value=vivaldi.exe name=browser><label>All</label><p>
<!-- <input value='Specify' name=browser><br> -->
<input type=submit value=Choose>
</form><p>
<?php 

include 'helpers.php';

$data = file_get_contents('php://input');
parse_str($data);
if(!isset($browser)) die('Please, choose your browser!');
//dd($browser);

// CP866 uses for Russian localization of Windows, if you have trouble with it, change it to yours language encoding

$res = iconv('CP866', "UTF-8//IGNORE", shell_exec('c:\\Windows\\System32\\tasklist.exe /fi "imagename eq '.$browser.'" 2>&1'));
$ar = explode("\n",$res);
pre($ar);
$sum = 0;

foreach($ar as $val){
    $val=str_replace('  ',' ',$val);
    $val=explode('Console',$val);
    if(isset($val[1])){
        $val=str_replace('kB',' ',$val[1]);
        $val=(string)substr(clean($val),1);
        //echo $sum.' + '.(int)$val.' = ';
        $sum+=(int)$val;
        //echo $sum.' kB<br>';
    }
}

//echo '==========================';
echo '<br>Total: '.floor($sum/1024). ' mB';

?>
</div>
</div>