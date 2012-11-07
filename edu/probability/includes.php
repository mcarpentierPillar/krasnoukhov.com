<?
ini_set('error_reporting', 0);

// dump
function dump($var,$flg = true,$print = true) {
	ob_start();
		var_dump($var);
	$data = ob_get_clean();

	if($print) {
		print('<pre style="font-size: 12px;">'.$data.'</pre>');
	}

	if($flg) exit;
	return $data;
}

function array_average($arr) { 
   return array_sum($arr) / count($arr); 
}

function simpson($a,$b,$f) {
	return ($b-$a)/6*($f($a)+4*$f(($a+$b)/2)+$f($b));
}

function intg($x) {
	return exp(-pow($x,2)/2);
}

?>