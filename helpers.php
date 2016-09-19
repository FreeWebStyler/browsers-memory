<?php

function pr(){ foreach(func_get_args() as $arg){ print_r($arg); } }
function pre(){ echo '<pre>'; foreach(func_get_args() as $arg){ print_r($arg); } echo '</pre>'; }
function pt(){ echo '<plaintext>'; foreach(func_get_args() as $arg){ print_r($arg); } }
function dd(){ echo '<pre>'; foreach(func_get_args() as $arg){ print_r($arg); } die('</pre>'); }

function toOrd($str){
 $lim=strlen($str);
 echo 'ords: ';
 for($i=0;$i<$lim;$i++){
     echo '_'.$str[$i].'_  '.ord($str[$i]).' | ';
 }    
}

function clean($str){
 $lim=mb_strlen($str,'8bit');
 $retstr='';
 for($i=0;$i<$lim;$i++) if(ord($str[$i])>47 && ord($str[$i])<58) $retstr.=$str[$i];
 return $retstr;
}