<?php
define("KEY", "JLL");
$de = new Codes;

for($i=0;$i<=100;$i++){
	$str = $de->en("JLLJX0000000".$i);
	echo $str."\n";
}

echo "\n\n";
echo $de->de('FrZkgPWzTb-umBu9HIneyLTc4pYTug');

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

?>