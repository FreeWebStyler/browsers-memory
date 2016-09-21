<div align=center>
<div align=left style=width:25%>
<!-- <form method=POST>
<input type=checkbox value=chrome.exe name=browser><label>Chrome</label><br>
<input type=checkbox value=browser.exe name=browser><label>Yandex.browser</label><br>
<input type=checkbox value=opera.exe name=browser><label>Opera</label><br>
<input type=checkbox value=vivaldi.exe name=browser><label>Vivladi</label><br>
<input type=checkbox value=vivaldi.exe name=browser><label>All</label><p>
 <input value='Specify' name=browser><br>
<input type=submit value=Choose>
</form> -->

<form method=POST style=display:inline><input type=hidden value=Yandex.browser name=browser><input type=submit value=Yandex.browser></form>
<form method=POST style=display:inline><input type=hidden value=Opera name=browser><input type=submit value=Opera></form>
<form method=POST style=display:inline><input type=hidden value=Vivladi name=browser><input type=submit value=Vivladi></form>
<form method=POST style=display:inline><input type=hidden value=Chrome name=browser><input type=submit value=Chrome></form>
<form method=POST style=display:inline><input type=hidden value=all name=browser><input type=submit value=All></form>

<p>
<?php 

include 'helpers.php';

$browsers = ['Yandex.browser' => 'browser.exe', 'Chrome' => 'chrome.exe', 'Opera' => 'opera.exe', 'Vivladi' => 'vivaldi.exe'];

$data = file_get_contents('php://input');
parse_str($data);
if(!isset($browser)) die('Please, choose your browser!');
//dd($browser);

// CP866 uses for Russian localization of Windows, if you have trouble with it, change it to yours language encoding

function getData($browserExe, $browserName) {
    $res = iconv('CP866', "UTF-8//IGNORE", shell_exec('c:\\Windows\\System32\\tasklist.exe /fi "imagename eq '.$browserExe.'" 2>&1'));
    //echo $res;
    $ar = explode("\n",$res);
    
    if(count($ar) == 2) return;
    unset($ar[0]); unset($ar[count($ar)]);
    
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
    
    echo '<br>'.$browserName.': '.floor($sum/1024). ' mB (total memory usage)';
    pre($ar);
}

if($browser == 'all') foreach($browsers as $key => $value) getData($value, $key); else getData($browsers[$browser], $browser);
    
//echo '==========================';


?>
</div>
</div>