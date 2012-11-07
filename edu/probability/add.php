<?
	require 'includes.php';
	require 'smarty/Smarty.class.php';
	
	// set up smarty
	$smarty = new Smarty();
	$smarty->template_dir = '';
	$smarty->compile_dir = 'smarty/tmp';

	// post
	if($_POST) {
		$data = '';
		foreach($_POST['data'] as $k => $v) {
			if(!is_array($v)) {
				$data .= $k.'='.$v."\n";
			}else{
				foreach($v as $k1 => $v1) {
					$data .= $k.','.$k1.','.$v1."\n";
				}
			}
		}

		file_put_contents('files/'.$_POST['file'].'.txt',$data);
		header('Location: ./?'.$_POST['file']);
		exit;
	}

	// query
	$vars = explode('&',$_SERVER['QUERY_STRING']);

	// getting data
	if($vars[0]) {
		$tmp = @file('files/'.($vars[0]?$vars[0]:'data').'.txt');
		$data = array();
		$result = array();
		
		if($tmp) {
			foreach($tmp as $line) {
				$t = explode(',',$line);
				if(count($t) > 1) {
					$data[$t[0]][$t[1]] = intval(trim($t[2]));
				}
			}
		}
	
		$smarty->assign('VARS',$vars);
		$smarty->assign('DATA',$data);
	}

	$smarty->display('add.tpl');
?>