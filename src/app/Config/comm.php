<?php

date_default_timezone_set('PRC');

define("LIMIT", 10);//分页常量
define('SEND_PRIZE', true);//是否发放红包
define('DECODE_URL', true);//是否解码 url
define("PKEY", "656cd9b0af9435b0");
define("BKEY", "fc692268364e2ff7");
define("KEY", "RRJ");

define('HOST_NAME', $_SERVER['HTTP_HOST']);
define('PRIZE_API', 'http://www.99wgf.com/a/');//红包接口 url
define('BOX_API', 'http://www.99wgf.com/b/');//返点接口 url
define('CODE_API', 'http://www.99wgf.com/Shop/v?id=');//返点接口 url

define('SHOP_HOST', 'http://www.renrenjiu.com');
define('QR_HOST', 'qr.renrenjiu.com');


function postData($url, $json,  $sec = 30) {
    //初始化curl        
    $ch = curl_init();
    //设置超时
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    //这里设置代理，如果有的话
    //curl_setopt($ch,CURLOPT_PROXY, '8.8.8.8');
    //curl_setopt($ch,CURLOPT_PROXYPORT, 8080);
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
    curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
    //设置header
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    //要求结果为字符串且输出到屏幕上
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    //post提交方式
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    //运行curl
    $data = curl_exec($ch);

    //返回结果
    if($data) {
        curl_close($ch);
        return $data;
    } else { 
        $error = curl_errno($ch);
        curl_close($ch);
        return false;
    }
}

function NumToCNMoney($num,$mode = true,$sim = true){
    if(!is_numeric($num)) return '含有非数字非小数点字符！';
    $char    = $sim ? array('零','一','二','三','四','五','六','七','八','九')
    : array('零','壹','贰','叁','肆','伍','陆','柒','捌','玖');
    $unit    = $sim ? array('','十','百','千','','万','亿','兆')
    : array('','拾','佰','仟','','万','億','兆');
    $retval  = $mode ? '元':'点';
    //小数部分
    if(strpos($num, '.')){
        list($num,$dec) = explode('.', $num);
        $dec = strval(round($dec,2));
        if($mode){
            if (isset($dec['1']))
                $retval .= "{$char[$dec['0']]}角{$char[$dec['1']]}分";
            else
                $retval .= "{$char[$dec['0']]}角";
        }else{
            for($i = 0,$c = strlen($dec);$i < $c;$i++) {
                $retval .= $char[$dec[$i]];
            }
        }
    }
    //整数部分
    $str = $mode ? strrev(intval($num)) : strrev($num);
    for($i = 0,$c = strlen($str);$i < $c;$i++) {
        $out[$i] = $char[$str[$i]];
        if($mode){
            $out[$i] .= $str[$i] != '0'? $unit[$i%4] : '';
                if($i>1 and $str[$i]+$str[$i-1] == 0){
                $out[$i] = '';
            }
                if($i%4 == 0){
                $out[$i] .= $unit[4+floor($i/4)];
            }
        }
    }
    $retval = join('',array_reverse($out)) . $retval;
    return $retval;
}

function getStockCountType($key) {
    global $NET_SET;
    return isset($NET_SET['log_type'][$key]) ? $NET_SET['log_type'][$key] : ""; 
}

function getStockType($key) {
    global $NET_SET;
    return isset($NET_SET['stock_type'][$key]) ? $NET_SET['stock_type'][$key] : ""; 
}

function getStockTypeArray($flg) {
    global $NET_SET;
    $res = array();
    foreach($NET_SET['stock_type']  as $k=>$v) {
        if ($flg == 1) {
            if ($k < 20) $res[$k] = $v;
        } elseif($flg == 2)  {
            if ($k > 20 ) $res[$k] = $v;
        } elseif ($flg == 'all') {
            $res[$k] = $v;
        }
    }
    
    return $res;
}

function getJian($num, $i_count, $flg = '') {

    if ($i_count < 1) {
        $i_count = 1;
    }

    if ($num >0) {
      $a = floor($num /$i_count);
      $b = $num % $i_count;  
    } else {
        $num = $num * -1;
        $a = floor($num /$i_count);
        $b = $num % $i_count;  

        $a = $a* -1;
        $b = $b;
    } 


    $s = "";
    if ($num != 0) {
        if ($num < 0) {
            $num = $num * -1;
        }
        if ($b > 0)
            $s = $a."件".$b."瓶";    
        else
            $s = $a."件";    

        if ($flg != "") {
            $s .= "&nbsp;&nbsp;共".$num."瓶";
        }
    } else {
        $s = "0件";
    }
    

    return $s;
}

function get_rand($proArr) {   
    $result = '';    
    //概率数组的总概率精度   
    $proSum = array_sum($proArr);    
    //概率数组循环   
    foreach ($proArr as $key => $proCur) {   
        $randNum = mt_rand(1, $proSum);   
        if ($randNum <= $proCur) {   
            $result = $key;   
            break;   
        } else {   
            $proSum -= $proCur;   
        }         
    }   
    unset ($proArr);    
    return $result;   
} 

function getRetailerType($key) {
   global $NET_SET;
   return isset($NET_SET['retailer_type'][$key]) ? $NET_SET['retailer_type'][$key] : ""; 
}
 

function isPhone($val){
    if (preg_match("/^[0-9]{2,5}[\-]{0,1}+[0-9]{1,4}+[\-]{0,1}[0-9]{4,5}$/", $val)) {
        return true;
    }
    return false;
}

function isMobile($val){
    if(preg_match("/1[34587]{1}\d{9}$/",$val)){    
      return true;
    }
    return false;    
}

function isNumber($val) {
    if (preg_match("/^\-?[0-9]+$/", $val)) {
        return true;
    }
    return false;
}

function isEmail($val) {
    if (preg_match("/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/", trim($val))) {
        return true;
    }
    return false;
}

function isEmpty($sInput)
{
    if( !isset($sInput) )
        return true;
    $nLen=strlen(trim($sInput));

    if($nLen==0)
        return true;
    else
        return false;
}

//截取字符串
function pe_cut($str, $length, $suffix=false, $start=0, $charset="utf-8")  
{  
    if(function_exists("mb_substr"))  
        return mb_substr($str, $start, $length, $charset);  
    elseif(function_exists('iconv_substr')) {  
        return iconv_substr($str,$start,$length,$charset);  
    }  
    $re['utf-8']   = "/[/x01-/x7f]|[/xc2-/xdf][/x80-/xbf]|[/xe0-/xef][/x80-/xbf]{2}|[/xf0-/xff][/x80-/xbf]{3}/";  
    $re['gb2312'] = "/[/x01-/x7f]|[/xb0-/xf7][/xa0-/xfe]/";  
    $re['gbk']    = "/[/x01-/x7f]|[/x81-/xfe][/x40-/xfe]/";  
    $re['big5']   = "/[/x01-/x7f]|[/x81-/xfe]([/x40-/x7e]|/xa1-/xfe])/";  
    preg_match_all($re[$charset], $str, $match);  
    $slice = join("",array_slice($match[0], $start, $length));  
    if($suffix) return $slice."…";  
    return $slice;  
}

function overMaxLength($sChkStr, $maxlength, $empty_val = false)
{
    if( isEmpty($sChkStr) )
        return $empty_val;

    $nLen=strlen(trim($sChkStr));
    if($nLen==0) {
        return $empty_val;
    } else {
        mb_language("Japanese");
        mb_internal_encoding("UTF-8");
        $count = 0;
        for ($i=0; $i < mb_strlen($sChkStr); $i++)
        {
            $sStr = mb_substr($sChkStr,$i, 1);
            if(strlen($sStr) < 2) {
                $count++;
            } else {
                $count++;
                $count++;
            }
        }
        if( $count > $maxlength ) {
            return true;
        } else {
            return false;
        }
    }
}

function getTime(){
    return date('Y-m-d H:i:s');
}

function getDay(){
    return date('Y-m-d');
}

function isNum($sStr, $empty_val = true)
{
    $nLen=strlen(trim($sStr));
    if($nLen==0)
        return $empty_val;

    if(ereg("^[[:digit:]]+$", $sStr))
    {
        return TRUE;
    }
    else
    {
        return FALSE;
    }
}

function getAccountType($key) {
    global $NET_SET;
    return isset($NET_SET['account_type'][$key]) ? $NET_SET['account_type'][$key] : "";
}
function getPayway($key) {
    global $NET_SET;
    return isset($NET_SET['pay_way'][$key]) ? $NET_SET['pay_way'][$key]:"";
}

function htmlsp($str){
	echo htmlspecialchars($str);
}

function prs($s){
	echo "<pre>";
	var_dump($s);
	echo "</pre>";
}

function sf($str){
    return mysql_escape_string($str);
}

function getBk(){
    $bk = urlencode($_SERVER['REQUEST_URI']);
    return $bk;
}

function getCity($index){
	
	if ($index < 1) { return'';}
    global $NET_SET;
    $str = "";
    if(isset($NET_SET['provience_set'][$index])){
        $str = $NET_SET['provience_set'][$index];
    }
    return  $str;
}


//type : company_logo company_img retailer_img product_img
//$big : s 80x80 m 200X200 l 400X400
function getImgUrl($name, $type, $big ='s'){
    global $NET_SET;

    if (empty($name)) {
        $url = 'http://'.HOST_NAME."/img/no_img.png";
    } else {
        switch ($type) {
            case 'company_logo':
                $url = 'http://'.HOST_NAME.'/upload/'.$NET_SET['up_dir']['company_logo'] .'/'.$name;
                break;
            case 'company_img':
                $url = 'http://'.HOST_NAME.'/upload/'.$NET_SET['up_dir']['company_img'] .'/'.$name;
            break;
            case 'retailer_logo':
                $url = 'http://'.HOST_NAME.'/upload/'.$NET_SET['up_dir']['retailer_logo'] .'/'.$name;
            break;
            case 'product_img':
                $url = 'http://'.HOST_NAME.'/upload/'.$NET_SET['up_dir']['product_img'] .'/'.$name;
            break;

            case 'tp_img':
                $url = 'http://'.HOST_NAME.'/upload/'.$NET_SET['up_dir']['tp_img'] .'/'.$name;
            break;
            case 'customer_logo':
                $url = $name;
            break;
        }
    }
    return $url;
}

//递归生成目录
function mkdirs($dir, $mode = 0777, $recursive = true) {
    if( is_null($dir) || $dir === "" ){
        return FALSE;
    }
    if( is_dir($dir) || $dir === "/" ){
        return TRUE;
    }
    if( mkdirs(dirname($dir), $mode, $recursive) ){
        return mkdir($dir, $mode);
    }
    return FALSE;
}



//分页
//$allCnt  全部数量
//$limit   每页的数量
//$goto    是否添加转到
function getPageHtml($allCnt , $limit = LIMIT , $goto = 0){
    $url = str_replace($_SERVER['QUERY_STRING'],'',$_SERVER['REQUEST_URI']);
    $url = str_replace("//", "/", $url);
    $url = $url;
    $index = 1;
    $size = 1;
    if($_SERVER['QUERY_STRING'] != ""){
        //$url = str_replace($_SERVER['QUERY_STRING'],'',$_SERVER['REQUEST_URI']);
        foreach($_GET as $k=>$v){
            if($k != "p") $url .= $k.'='.urlencode($v).'&';
        }
    }else{
        $url = $url."?";
    }
    if(isset($_GET['p'])) $index = intval($_GET['p']);
    if($limit != 0)       $size  = ceil($allCnt / $limit);
    if($index < 1) $index = 1;
    if($index > $size) $index = $size;
    $pre = $index - 1;
    $nex = $index + 1;
    $str = '<div style="float:left;">
        当前第【{=index=} / {=size=}】页 记录总数【<span id="result_total_count">{=cnt=}</span>】 ';
    if($goto == 1){
        $str .= '转到 <input size="1" id="p" name="p" class="smallInput" value="{=index=}"> 页';
    }
    $str .= '</div>';


    $str .='<ul class="pagination">';
    if($index <= $size && $index != 1){
        $str .= '<li class="paginate_button"><a href="'.$url.'p=1">首页</a></li>';
    }else{
        $str .= '<li class="paginate_button disabled"><a>首页</a></li>';
    }
    if($pre <= $size && $pre > 0){
        $str .= ' <li class="paginate_button"><a href="'.$url.'p='.$pre.'">上一页</a></li> ';
    }else{
        $str .= '<li class="paginate_button disabled"><a>上一页</a></li>';
    }
    if($nex <= $size){
        $str .= ' <li class="paginate_button"><a href="'.$url.'p='.$nex.'">下一页</a></li> ';
    }else{
        $str .= '<li class="paginate_button disabled"><a>下一页</a></li>';
    }
    if($index < $size){
        $str .= ' <li class="paginate_button"><a href="'.$url.'p='.$size.'">尾页</a></li> ';
    }else{
        $str .= '<li class="paginate_button disabled"><a>尾页</a></li>';
    }

    $str .='</url>';


    /*
    $str .= '</div><div style="float:right;">';
    if($index <= $size && $index != 1){
        $str .= ' <a href="'.$url.'p=1">[首页]</a> ';
    }else{
        $str .= ' <font color="#666666" class="paginate_button">[首页]</font> ';
    }
    if($pre <= $size && $pre > 0){
        $str .= ' <a href="'.$url.'p='.$pre.'">[上一页]</a> ';
    }else{
        $str .= ' <font color="#666666">[上一页]</font> ';
    }
    if($nex <= $size){
        $str .= ' <a href="'.$url.'p='.$nex.'">[下一页]</a> ';
    }else{
        $str .= ' <font color="#666666">[下一页]</font> ';
    }
    if($index < $size){
        $str .= ' <a href="'.$url.'p='.$size.'">[尾页]</a> ';
    }else{
        $str .= ' <font color="#666666">[尾页]</font> ';
    }
    $str .="</div></div>";
    */
    $str = str_replace("{=index=}", $index , $str);
    $str = str_replace("{=cnt=}"  , $allCnt, $str);
    $str = str_replace("{=size=}" , $size  , $str);
    return $str;
}

function qianling ($str , $flg =10){
    return  sprintf("%0".$flg."d",$str);
}
function houling($str, $flg = 2){
    return   sprintf("%01.".$flg."f",$str);
}



function enCodePrize($text){

    $key = PKEY;   //key的长度必须16，32位,这里直接MD5一个长度为32位的key
    $iv='adkadf2sadaadfaa'; //加密的随机数
    $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $text, MCRYPT_MODE_CBC, $iv);
    $data = base64_encode($crypttext);
    $data = str_replace(array('+','/','='),array('-','_',''),$data);
    return $data;
}


function deCodePrize($text){
    $key = PKEY;
    $iv='adkadf2sadaadfaa';
    $data = str_replace(array('-','_'),array('+','/'),$text);
    $mod4 = strlen($data) % 4;
    if ($mod4) {
        $data .= substr('====', $mod4);
    }
    $crypttext = base64_decode($data);
    return mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $crypttext, MCRYPT_MODE_CBC, $iv); 
}

function enCodeBox($text){
    $key = BKEY;   //key的长度必须16，32位,这里直接MD5一个长度为32位的key
    $iv='adkadf2sadaadfaa'; //加密的随机数
    $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $text, MCRYPT_MODE_CBC, $iv);
    $data = base64_encode($crypttext);
    $data = str_replace(array('+','/','='),array('-','_',''),$data);
    return $data;
}

function deCodeBox($text){
    $key = BKEY;
    $iv='adkadf2sadaadfaa';
    $data = str_replace(array('-','_'),array('+','/'),$text);
    $mod4 = strlen($data) % 4;
    if ($mod4) {
        $data .= substr('====', $mod4);
    }
    $crypttext = base64_decode($data);
    return mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $crypttext, MCRYPT_MODE_CBC, $iv); 
}

function passport_encrypt($str,$key){ //加密函数
 srand((double)microtime() * 1000000);
 $encrypt_key=md5(rand(0, 32000));
 $ctr=0;
 $tmp='';
 for($i=0;$i<strlen($str);$i++){
  $ctr=$ctr==strlen($encrypt_key)?0:$ctr;
  $tmp.=$encrypt_key[$ctr].($str[$i] ^ $encrypt_key[$ctr++]);
 }
 return base64_encode(passport_key($tmp,$key));
}

function passport_decrypt($str,$key){ //解密函数
 $str=passport_key(base64_decode($str),$key);
 $tmp='';
 for($i=0;$i<strlen($str);$i++){
  $md5=$str[$i];
  $tmp.=$str[++$i] ^ $md5;
 }
 return $tmp;
}

function passport_key($str,$encrypt_key){
 $encrypt_key=md5($encrypt_key);
 $ctr=0;
 $tmp='';
 for($i=0;$i<strlen($str);$i++){
  $ctr=$ctr==strlen($encrypt_key)?0:$ctr;
  $tmp.=$str[$i] ^ $encrypt_key[$ctr++];
 }
 return $tmp;
}


function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {    
    $ckey_length = 4;
    $key = md5($key != '' ? $key : C('AUTH_KEY'));
     
    $keya = md5(substr($key, 0, 16));
    $keyb = md5(substr($key, 16, 16));
    $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';
 
    $cryptkey = $keya.md5($keya.$keyc);
    $key_length = strlen($cryptkey);
 
    $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
    $string_length = strlen($string);
    $result = '';
    $box = range(0, 255);
 
    $rndkey = array();
    for($i = 0; $i <= 255; $i++) {
            $rndkey[$i] = ord($cryptkey[$i % $key_length]);
    }
 
    for($j = $i = 0; $i < 256; $i++) {
            $j = ($j + $box[$i] + $rndkey[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
    }
 
    for($a = $j = $i = 0; $i < $string_length; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
    }
    if($operation == 'DECODE') {
            if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
                    return substr($result, 26);
            } else {
                    return '';
            }
    } else {
            return $keyc.str_replace('=', '', base64_encode($result));
    }
 
}


function getWxGroup($type) {
    global $NET_SET;

    $s = "未知";
    if (isset($NET_SET['wx_groups'][$type])){
        $s = $NET_SET['wx_groups'][$type];
    }
    return $s;
}


function getfirstchar($s0){ 
$firstchar_ord=ord(strtoupper($s0{0})); 
if (($firstchar_ord>=65 and $firstchar_ord<=91)or($firstchar_ord>=48 and $firstchar_ord<=57)) return $s0{0}; 
@$s=iconv("UTF-8","gb2312", $s0); 
$asc=ord($s{0})*256+ord($s{1})-65536; 
if($asc>=-20319 and $asc<=-20284)return "A"; 
if($asc>=-20283 and $asc<=-19776)return "B"; 
if($asc>=-19775 and $asc<=-19219)return "C"; 
if($asc>=-19218 and $asc<=-18711)return "D"; 
if($asc>=-18710 and $asc<=-18527)return "E"; 
if($asc>=-18526 and $asc<=-18240)return "F"; 
if($asc>=-18239 and $asc<=-17923)return "G"; 
if($asc>=-17922 and $asc<=-17418)return "H"; 
if($asc>=-17417 and $asc<=-16475)return "J"; 
if($asc>=-16474 and $asc<=-16213)return "K"; 
if($asc>=-16212 and $asc<=-15641)return "L"; 
if($asc>=-15640 and $asc<=-15166)return "M"; 
if($asc>=-15165 and $asc<=-14923)return "N"; 
if($asc>=-14922 and $asc<=-14915)return "O"; 
if($asc>=-14914 and $asc<=-14631)return "P"; 
if($asc>=-14630 and $asc<=-14150)return "Q"; 
if($asc>=-14149 and $asc<=-14091)return "R"; 
if($asc>=-14090 and $asc<=-13319)return "S"; 
if($asc>=-13318 and $asc<=-12839)return "T"; 
if($asc>=-12838 and $asc<=-12557)return "W"; 
if($asc>=-12556 and $asc<=-11848)return "X"; 
if($asc>=-11847 and $asc<=-11056)return "Y"; 
if($asc>=-11055 and $asc<=-10247)return "Z"; 
return null; 
} 

function math($string,$code ='UTF-8'){
        if ($code == 'UTF-8') {
         $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
        } else {
            $pa = "/[\x01-\x7f]|[\xa1-\xff][\xa1-\xff]/";
        }
        preg_match_all($pa, $string, $t_string);
        $math="";
        foreach($t_string[0] as $k=>$s){
            $math[]=$s;
        }
         return $math;
}

//得到拼音
function getPY($str) {
    $a = math($str);
    $b = "";
    foreach ($a as $key => $value) {
        $b .= getfirstchar($value);
    }
    return $b;
}


function getWinType($key){
    global $NET_SET;
    $str = $NET_SET['wine_type'][$key];
    echo $str;
}


function setGroupMenu($button , $matchrule=null){

    foreach($button as &$item){
        foreach($item as $k => $v){
            if (is_array($v)) {
                foreach($item[$k] as &$subitem){
                    foreach($subitem as $k2 => $v2){
                        $subitem[$k2] = urlencode($v2);
                    }
                }
            } else {
                $item[$k] = urlencode($v);
            }
        }
    }

    if (isset($matchrule) && $matchrule != null){
        foreach ($matchrule as $k => $v) {
            $matchrule[$k] = urlencode($v);
        }

        $data = urldecode(json_encode(array('button'=>$button, 'matchrule'=> $matchrule)));
    } else{
        $data = urldecode(json_encode(array('button'=>$button)));
    }


    return $data;

}


function deCodeUrl($str){
    $code = new Codes($str);
    return $code->de($str);
}

function enCodeUrl($str){
    $code = new Codes($str);
    return $code->en($str);
}



class Codes{
    public function en($v , $k= KEY){
        $v = $this->DeCode($v,'E',$k);
        $v = str_replace('/','-',$v);
        $v = str_replace('+','_',$v);
        return $v;
    }
    public function de($v , $k = KEY){
        $v = str_replace('-','/',$v);
        $v = str_replace('_','+',$v);
        return $this->DeCode($v,'D',$k);
    }

    private function DeCode($string,$operation,$key="")
    {
        $key=md5($key);
        $key_length=strlen($key);
        $string=$operation=='D'?base64_decode($string):substr(md5($string.$key),0,8).$string;
        $string_length=strlen($string);
        $rndkey=$box=array();
        $result="";
        for($i=0;$i<=255;$i++)
        {
            $rndkey[$i]=ord($key[$i%$key_length]);
            $box[$i]=$i;
        }
        for($j=$i=0;$i<256;$i++)
        {
            $j=($j+$box[$i]+$rndkey[$i])%256;
            $tmp=$box[$i];
            $box[$i]=$box[$j];
            $box[$j]=$tmp;
        }
        for($a=$j=$i=0;$i<$string_length;$i++)
        {
            $a=($a+1)%256;
            $j=($j+$box[$a])%256;
            $tmp=$box[$a];
            $box[$a]=$box[$j];
            $box[$j]=$tmp;
            $result.=chr(ord($string[$i])^($box[($box[$a]+$box[$j])%256]));
        }
        if($operation=='D')
        {
            if(substr($result,0,8)==substr(md5(substr($result,8).$key),0,8))
            {
                return substr($result,8);
            }
            else
            {
                return '';
            }
        }
        else
        {
            return str_replace('=', '', base64_encode($result));
        }
    }

}

function time_tran2($the_time){
    $now_time = date("Y-m-d H:i:s");
    $now_time = strtotime($now_time);
    $show_time = strtotime($the_time);
    $dur = $now_time - $show_time;
    if($dur < 60){
     return $dur.'秒前';
    }else{
     if($dur < 3600){
      return floor($dur/60).'分钟前';
     }else{
      if($dur < 86400){
       return floor($dur/3600).'小时前';
      }else{
        $day = floor($dur/86400);
        $day = substr($day,-1,1);

        $day = floor($day/3);

        if ($day <1 ) {
            $day = 1;
        }
        return $day."天前";

      }
     }
    }
}

function time_tran($the_time){
   $now_time = date("Y-m-d H:i:s");
   $now_time = strtotime($now_time);
   $show_time = strtotime($the_time);
   $dur = $now_time - $show_time;
   if($dur < 60){
    return $dur.'秒前';
   }else{
    if($dur < 3600){
     return floor($dur/60).'分钟前';
    }else{
     if($dur < 86400){
      return floor($dur/3600).'小时前';
     }else{
      if($dur < 8640000){//10天内
       return floor($dur/86400).'天前';
      }else{
       return date("Y/m/d",$show_time);
      }
     }
    }
   }
}

class thumb {   
    // *** Class variables   
    private $image;   
    private $width;
    private $height;   
    private $imageResized;

    function __construct($fileName, $new_path, $new_width, $new_height) {
        //打开一个图片
        $this->image = $this->open_image($fileName);
        //获取图片宽高
        $this->width  = imagesx($this->image);
        $this->height = imagesy($this->image);

        if ($new_width == 'auto') {
            $type = 'auto_width';
        }
        elseif ($new_height == 'auto') {
            $type = 'auto_height';
        }
        else {
            $type = 'diy';
        }
        $this->mark_image($new_width, $new_height, $type);
        $this->save_image($new_path, 90);
    }
    private function open_image($file) {   
        // *** Get extension   
        $extension = strtolower(strrchr($file, '.'));
        switch($extension) {   
            case '.jpg':   
            case '.jpeg':   
                $img = @imagecreatefromjpeg($file);   
                break;   
            case '.gif':   
                $img = @imagecreatefromgif($file);   
                break;   
            case '.png':   
                $img = @imagecreatefrompng($file);
                break;   
            default:   
                $img = false;   
                break;   
        }   
        return $img;   
    }
    public function mark_image($new_width, $new_height, $type='diy') {
        switch ($type) {   
            case 'diy':
                $size_arr = $this->get_diysize($new_width, $new_height);   
                $fix_width = $size_arr['fix_width'];   
                $fix_height = $size_arr['fix_height'];   
            break;   
            case 'auto_width':
                $fix_width = $this->get_autowidth($new_height);
                $fix_height= $new_height;   
            break;   
            case 'auto_height':
                $fix_width = $new_width;
                $fix_height= $this->get_autoheight($new_width);
            break;   
            /*case 'diy': 
                $optimalWidth = $new_width;   
                $optimalHeight = $new_height;   
            break;*/
        }
        // *** Resample - create image canvas of x, y size
        if ($type == 'diy') {
            $pos_x = abs(($new_width - $fix_width) / 2);
            $pos_y = abs(($new_height - $fix_height) / 2);
            $this->imageResized = imagecreatetruecolor($new_width, $new_height);   
            $fff = imagecolorallocate($this->imageResized, 255, 255, 255);
            imagefill($this->imageResized, 0, 0, $fff);
            imagecopyresampled($this->imageResized, $this->image, $pos_x, $pos_y, 0, 0, $fix_width, $fix_height, $this->width, $this->height);         
        }
        else {
            $this->imageResized = imagecreatetruecolor($fix_width, $fix_height);   
            imagecopyresampled($this->imageResized, $this->image, 0, 0, 0, 0, $fix_width, $fix_height, $this->width, $this->height);         
        }
    } 
    public function save_image($savePath, $imageQuality="90") {
        $Path = substr($savePath, 0, strripos($savePath, '/'));
        !is_dir($Path) && mkdir($Path , 0777 ,true);
        // *** Get extension
        $extension = strrchr($savePath, '.');
        $extension = strtolower($extension);
        switch ($extension) {
            case '.jpg':
            case '.jpeg':
                if (imagetypes() & IMG_JPG) {
                    imagejpeg($this->imageResized, $savePath, $imageQuality);  
                }
            break;
            case '.gif':
                if (imagetypes() & IMG_GIF) {
                    imagegif($this->imageResized, $savePath); 
                }
            break;
            case '.png':
                // *** Scale quality from 0-100 to 0-9
                $scaleQuality = round(($imageQuality/100) * 9);
                // *** Invert quality setting as 0 is best, not 9
                $invertScaleQuality = 9 - $scaleQuality;
                if (imagetypes() & IMG_PNG) {
                    imagepng($this->imageResized, $savePath, $invertScaleQuality);
                }   
            break;
        }
        imagedestroy($this->imageResized);   
    }

    ## --------------------------------------------------------   
    private function get_autowidth($new_height) {
        return $new_height * $this->width / $this->height;
    }
    private function get_autoheight($new_width) {
        return $new_width * $this->height / $this->width;
    }
    private function get_diysize($new_width, $new_height) {
        $old_rate = $this->width / $this->height;
        $new_rate = $new_width / $new_height;
        if ($new_rate > $old_rate) {
            $fix_height = $new_height;
            $fix_width = $this->get_autowidth($fix_height);
        }
        else {
            $fix_width = $new_width;
            $fix_height = $this->get_autoheight($fix_width);
        }
        return array('fix_width' => $fix_width, 'fix_height' => $fix_height);
    }
} 
