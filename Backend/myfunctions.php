<?php

function br($n){
		$s = "";
		for($i=0;$i<$n;$i++){
			$s.="<br>";
		}
		return $s;
}

function rep($s){
	return str_replace("\"","'",$s);
}

?>