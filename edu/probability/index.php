<?
	require 'includes.php';
	require 'smarty/Smarty.class.php';
	
	// set up smarty
	$smarty = new Smarty();
	$smarty->template_dir = '';
	$smarty->compile_dir = 'smarty/tmp';
	
	// query
	$vars = explode('&',$_SERVER['QUERY_STRING']);
	
	// getting data
	$tmp = file('files/'.($vars[0]?$vars[0]:'data').'.txt');
	$data = array();
	$result = array();
	
	foreach($tmp as $line) {
		$t = explode(',',$line);
		if(count($t) > 1) {
			$data[$t[0]][$t[1]] = (float)trim($t[2]);
		}else{
			$t = explode('=',$line);
			$result['DATA'][$t[0]] = (float)($t[1]);
		}
	}
	$result['DATA']['Z'] = $vars[1]?$vars[1]:-50;

	// part 1
	$result['part1'] = array();
	foreach($data as $line) {
		foreach($line as $v) {
			if(!$result['part1']["$v"]) {
				$result['part1']["$v"] = 1;
			}else{
				$result['part1']["$v"]++;			
			}
		}
	}
	ksort($result['part1']);
	
	// part 2
	$result['part2'] = array();
	$result['tmp'] = array_keys($result['part1']);
	$i = 0;
	foreach($result['part1'] as $k => $v) {
		if($i == 0) {
			$result['part2'][-1] = array(
				'value' => 0,
				'title' => 'x < '.$k,
				'key' => $k
			);
		}

		if($result['tmp'][$i+1]) {
			$result['part2'][$i] = array(
				'value' => $result['part2'][$i-1]['value']+($v/100),
				'title'=> $result['part2'][$i-1]['key'].' < x < '.$result['tmp'][$i+1],
				'key' => $result['tmp'][$i+1]
			);
		}

		if($i == count($result['part1'])-1){
			$result['part2'][$i+1] = array(
				'value' => 1,
				'title' => 'x > '.$k,
				'key' => $k
			);		
		}		
		
		$i++;
	}
	
	// part 3
	$result['part3'] = array();
	$max = max(array_keys($result['part1']))-$result['DATA']['Z'];
	$result['DATA']['M'] = $max;
	for($i = $result['DATA']['S'];$i>0;$i--) {
		$to = $max-$result['DATA']['R'];
		$result['part3'][$i] = array(
			'to' => $max,
			'from' => $to,
			's' => 0
		);
		
		foreach($result['part1'] as $k => $v) {
			if($k > $to && $k <= $max) {
				$result['part3'][$i]['s'] += $v;
			}
		}
		
		if($i == 1 && $vars[0] == 'medved') {
			$result['part3'][$i]['s']--;
		}

		$max -= $result['DATA']['R'];
	}
	$result['part3'] = array_reverse($result['part3']);
	
	// part 4
	$result['part4'] = array();
	$result['part4']['s1'] = array(
		'str' => '0.01*(',
		'val' => 0
	);
	$result['part4']['s2'] = array(
		'str' => '0.01*(',
		'val' => 0
	);

	foreach($result['part1'] as $m => $x) {
		// subpart 1
		$result['part4']['s1']['str'] .= $m*$x.' + ';
		$result['part4']['s1']['val'] += $m*$x;

		// subpart 2
		$result['part4']['s2']['str'] .= '('.$m.')<sup>2</sup>*'.$x.' + ';
		$result['part4']['s2']['val'] += pow($m,2)*$x;
	}

	$result['part4']['s1']['str'] = substr($result['part4']['s1']['str'],0,-3).')';
	$result['part4']['s1']['val'] *= 0.01;

	$result['part4']['s2']['str'] = substr($result['part4']['s2']['str'],0,-3).')';
	$result['part4']['s2']['val'] *= 0.01;

	$result['part4']['s3']['str'] = '1.01*('.$result['part4']['s2']['val'].' - '.$result['part4']['s1']['val'].'<sup>2</sup>)';
	$result['part4']['s3']['val'] = 1.01*($result['part4']['s2']['val']-pow($result['part4']['s1']['val'],2));
	
	// part 5
	$result['part5'] = $result['part3'];
	foreach($result['part5'] as $k => $v) {
		$value = $v['s']/100;
		if($result['part5'][$k-1]['value']) {
			$value += $result['part5'][$k-1]['value'];
		}
		
		$result['part5'][$k] = array(
			'value' => $value,
			'title' => $v['from'].' < x < '.$v['to'],
			'key' => $v['from']
		);
		
		if($k == 0) {
			$min = $v['from'];
		}elseif($k == count($result['part5'])-1) {
			$max = $v['to'];
		}
	}
	
	$result['part5'][-1] = array(
		'value' => 0,
		'title' => 'x < '.$min,
		'key' => $min
	);

	$result['part5'][$k+1] = array(
		'value' => 1,
		'title' => $max.' < x',
		'key' => $max
	);

	ksort($result['part5']);

	// part 6
	$result['part6'] = array();
	$result['part6']['s1'] = array(
		'str' => '',
		'val' => 0
	);
	$result['part6'] = array();
	$result['part6']['s2'] = array(
		'str' => '',
		'val' => 0
	);

	foreach($result['part3'] as $v) {
		$x = ($v['to']+$v['from'])/2;
		$m = $v['s']/100;
	
		// subpart 1
		$result['part6']['s1']['str'] .= $x.'*'.$m.' + ';
		$result['part6']['s1']['val'] += $m*$x;
	}
	
	foreach($result['part3'] as $v) {
		$x = ($v['to']+$v['from'])/2;
		$m = $v['s']/100;

		// subpart 2
		$result['part6']['s2']['str'] .= '('.$x.'-'.$result['part6']['s1']['val'].')<sup>2</sup>*'.($m).' + ';
		$result['part6']['s2']['val'] += pow($x-$result['part6']['s1']['val'],2)*($m);	
	}

	$result['part6']['s1']['str'] = substr($result['part6']['s1']['str'],0,-3);
	$result['part6']['s2']['str'] = substr($result['part6']['s2']['str'],0,-3);
	$result['part6']['s3']['val'] = pow($result['part6']['s2']['val'],1/2);
	
	// part 7
	$result['part7'] = $result['part3'];
	foreach($result['part7'] as $k => $v) {
		$result['part7'][$k]['s1'] = $v['from']-$result['part4']['s1']['val'];
		$result['part7'][$k]['s2'] = $v['to']-$result['part4']['s1']['val'];
		$result['part7'][$k]['s3'] = round($result['part7'][$k]['s1']/pow($result['part6']['s2']['val'],1/2),2);
		$result['part7'][$k]['s4'] = round($result['part7'][$k]['s2']/pow($result['part6']['s2']['val'],1/2),2);

		$result['part7'][$k]['s5'] = 1/pow(2*pi(),1/2)*simpson($result['part6']['s3']['val'],abs($result['part7'][$k]['s3']),'intg');
		$result['part7'][$k]['s6'] = 1/pow(2*pi(),1/2)*simpson($result['part6']['s3']['val'],abs($result['part7'][$k]['s4']),'intg');

		if($result['part7'][$k]['s6']>$result['part7'][$k]['s5']) {
			$result['part7'][$k]['s7'] = $result['part7'][$k]['s6']-$result['part7'][$k]['s5'];
		}else{
			$result['part7'][$k]['s7'] = $result['part7'][$k]['s5']-$result['part7'][$k]['s6'];
		}
	}
	
	$smarty->assign('DATA',$data);
	$smarty->assign('RES',$result);
	$smarty->display('output.tpl');
?>