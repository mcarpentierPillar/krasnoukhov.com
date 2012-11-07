<?php /* Smarty version 2.6.26, created on 2012-04-12 11:40:10
         compiled from output.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'output.tpl', 90, false),array('modifier', 'round', 'output.tpl', 205, false),)), $this); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru_RU"> 
<head> 
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" /> 
	<meta http-equiv="Pragma" content="no-cache" /> 
	<meta http-equiv="Cache-control" content="no-cache, proxy-revalidate, must-revalidate" /> 
 
	<title>Теория Вероятности</title> 
	
	<style type="text/css"> 
		@import "./styles.css?10";
	</style> 
</head> 
<body> 
	<div class="content">
		<h1><a href="add.php?new">Посчитать другое</a></h1>
		<table class="general">
			<?php $_from = $this->_tpl_vars['DATA']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['data_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['data_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['data_loop']['iteration']++;
?>
				<?php if ($this->_foreach['part1_loop']['iteration']%10 == 1): ?>
					<tr>
				<?php endif; ?>

					<?php $_from = $this->_tpl_vars['item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
						<td class="data"><div class="l"><?php echo $this->_tpl_vars['v']; ?>
</div></td>
					<?php endforeach; endif; unset($_from); ?>

				<?php if ($this->_foreach['part1_loop']['iteration']%10 == 0): ?>
					</tr>
				<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
		</table>
		
		<h1>1. Построение вариационного ряда, нахождение эмпирических частот</h1>
		
		<table class="general">
			<?php $_from = $this->_tpl_vars['RES']['part1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['part1_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['part1_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['part1_loop']['iteration']++;
?>
				<?php if ($this->_foreach['part1_loop']['iteration']%10 == 1): ?>
					<tr>
						<td class="data">
							<div class="s">X<sub>i</sub></div>
							<div>m<sub>i</sub></div>
							<div class="l">P<sub>i</sub></div>
						</td>
				<?php endif; ?>

				<td class="data">
					<div class="s"><?php echo $this->_tpl_vars['key']; ?>
</div>
					<div><?php echo $this->_tpl_vars['item']; ?>
</div>
					<div class="l"><?php echo $this->_tpl_vars['item']/100; ?>
</div>
				</td>

				<?php if ($this->_foreach['part1_loop']['iteration']%10 == 0): ?>
					</tr><tr><td>&nbsp;</td></tr>
				<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
			</tr>
		</table>

		<h1>2. Строим эмпирическую функцию распределения</h1>

		<table class="general sm">
			<?php $_from = $this->_tpl_vars['RES']['part2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['part2_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['part2_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['part2_loop']['iteration']++;
?>
				<tr>
					<td class="data">
						<div class="s l"><?php echo $this->_tpl_vars['item']['value']; ?>
</div>
					</td>
					<td class="data">
						<div class="l"><?php echo $this->_tpl_vars['item']['title']; ?>
</div>
					</td>
				</tr>
			<?php endforeach; endif; unset($_from); ?>
			</tr>
		</table>
		
		<div class="coords">
			<?php $this->assign('x', 20); ?>
			<?php $this->assign('y', 890); ?>
			
			<?php unset($this->_sections['axis1_loop1']);
$this->_sections['axis1_loop1']['name'] = 'axis1_loop1';
$this->_sections['axis1_loop1']['start'] = (int)0;
$this->_sections['axis1_loop1']['loop'] = is_array($_loop=10) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['axis1_loop1']['show'] = true;
$this->_sections['axis1_loop1']['max'] = $this->_sections['axis1_loop1']['loop'];
$this->_sections['axis1_loop1']['step'] = 1;
if ($this->_sections['axis1_loop1']['start'] < 0)
    $this->_sections['axis1_loop1']['start'] = max($this->_sections['axis1_loop1']['step'] > 0 ? 0 : -1, $this->_sections['axis1_loop1']['loop'] + $this->_sections['axis1_loop1']['start']);
else
    $this->_sections['axis1_loop1']['start'] = min($this->_sections['axis1_loop1']['start'], $this->_sections['axis1_loop1']['step'] > 0 ? $this->_sections['axis1_loop1']['loop'] : $this->_sections['axis1_loop1']['loop']-1);
if ($this->_sections['axis1_loop1']['show']) {
    $this->_sections['axis1_loop1']['total'] = min(ceil(($this->_sections['axis1_loop1']['step'] > 0 ? $this->_sections['axis1_loop1']['loop'] - $this->_sections['axis1_loop1']['start'] : $this->_sections['axis1_loop1']['start']+1)/abs($this->_sections['axis1_loop1']['step'])), $this->_sections['axis1_loop1']['max']);
    if ($this->_sections['axis1_loop1']['total'] == 0)
        $this->_sections['axis1_loop1']['show'] = false;
} else
    $this->_sections['axis1_loop1']['total'] = 0;
if ($this->_sections['axis1_loop1']['show']):

            for ($this->_sections['axis1_loop1']['index'] = $this->_sections['axis1_loop1']['start'], $this->_sections['axis1_loop1']['iteration'] = 1;
                 $this->_sections['axis1_loop1']['iteration'] <= $this->_sections['axis1_loop1']['total'];
                 $this->_sections['axis1_loop1']['index'] += $this->_sections['axis1_loop1']['step'], $this->_sections['axis1_loop1']['iteration']++):
$this->_sections['axis1_loop1']['rownum'] = $this->_sections['axis1_loop1']['iteration'];
$this->_sections['axis1_loop1']['index_prev'] = $this->_sections['axis1_loop1']['index'] - $this->_sections['axis1_loop1']['step'];
$this->_sections['axis1_loop1']['index_next'] = $this->_sections['axis1_loop1']['index'] + $this->_sections['axis1_loop1']['step'];
$this->_sections['axis1_loop1']['first']      = ($this->_sections['axis1_loop1']['iteration'] == 1);
$this->_sections['axis1_loop1']['last']       = ($this->_sections['axis1_loop1']['iteration'] == $this->_sections['axis1_loop1']['total']);
?>
				<div class="y" style="left: <?php echo $this->_tpl_vars['x']; ?>
px; top: <?php echo $this->_tpl_vars['y']; ?>
px"><?php echo $this->_sections['axis1_loop1']['iteration']/10; ?>
<span>&mdash;</span></div>
				<?php $this->assign('y', $this->_tpl_vars['y']-97); ?>
			<?php endfor; endif; ?>

			<?php $this->assign('x', 50); ?>
			<?php $this->assign('y', 945); ?>

			<?php $_from = $this->_tpl_vars['RES']['part2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['axis1_loop2'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['axis1_loop2']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['axis1_loop2']['iteration']++;
?>
				
				<div class="x" style="left: <?php echo $this->_tpl_vars['x']; ?>
px; top: <?php echo $this->_tpl_vars['y']; ?>
px">
					<div class="line" style="top: <?php echo smarty_function_math(array('equation' => "-900*v-5",'v' => $this->_tpl_vars['item']['value']), $this);?>
px"></div>
					<b>|</b><br />
					<?php echo $this->_tpl_vars['item']['key']; ?>

				</div>

				<?php $this->assign('x', $this->_tpl_vars['x']+20); ?>
			<?php endforeach; endif; unset($_from); ?>
		</div>

		<h1>3. Строим статистический ряд распределения, определяем размах выборки R</h1>
		<p>Выборку разбиваем на <?php echo $this->_tpl_vars['RES']['DATA']['S']; ?>
 разрядов. Величина разряда равна <?php echo $this->_tpl_vars['RES']['DATA']['R']; ?>
. Крайний правый равен <?php echo $this->_tpl_vars['RES']['DATA']['M']; ?>
</p>

		<table class="general">
			<tr>
				<td class="data">
					<div class="s l">I<sub>i</sub></div>
					<div class="s">&nbsp;</div>
					<div>m<sub>i</sub></div>
					<div class="l">P<sub>i</sub></div>
				</td>
			<?php $_from = $this->_tpl_vars['RES']['part3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['part3_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['part3_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['part3_loop']['iteration']++;
?>
				<td class="data">
					<div class="s l"><?php echo $this->_tpl_vars['item']['from']; ?>
</div>
					<div class="s"><?php echo $this->_tpl_vars['item']['to']; ?>
</div>
					<div><?php echo $this->_tpl_vars['item']['s']; ?>
</div>
					<div class="l"><?php echo $this->_tpl_vars['item']['s']/100; ?>
</div>
				</td>
			<?php endforeach; endif; unset($_from); ?>
			</tr>
		</table>		

		<p>Строим гистограмму</p>

		<div class="coords">
			<?php $this->assign('x', 20); ?>
			<?php $this->assign('y', 892); ?>
			
			<?php unset($this->_sections['axis2_loop1']);
$this->_sections['axis2_loop1']['name'] = 'axis2_loop1';
$this->_sections['axis2_loop1']['start'] = (int)0;
$this->_sections['axis2_loop1']['loop'] = is_array($_loop=20) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['axis2_loop1']['show'] = true;
$this->_sections['axis2_loop1']['max'] = $this->_sections['axis2_loop1']['loop'];
$this->_sections['axis2_loop1']['step'] = 1;
if ($this->_sections['axis2_loop1']['start'] < 0)
    $this->_sections['axis2_loop1']['start'] = max($this->_sections['axis2_loop1']['step'] > 0 ? 0 : -1, $this->_sections['axis2_loop1']['loop'] + $this->_sections['axis2_loop1']['start']);
else
    $this->_sections['axis2_loop1']['start'] = min($this->_sections['axis2_loop1']['start'], $this->_sections['axis2_loop1']['step'] > 0 ? $this->_sections['axis2_loop1']['loop'] : $this->_sections['axis2_loop1']['loop']-1);
if ($this->_sections['axis2_loop1']['show']) {
    $this->_sections['axis2_loop1']['total'] = min(ceil(($this->_sections['axis2_loop1']['step'] > 0 ? $this->_sections['axis2_loop1']['loop'] - $this->_sections['axis2_loop1']['start'] : $this->_sections['axis2_loop1']['start']+1)/abs($this->_sections['axis2_loop1']['step'])), $this->_sections['axis2_loop1']['max']);
    if ($this->_sections['axis2_loop1']['total'] == 0)
        $this->_sections['axis2_loop1']['show'] = false;
} else
    $this->_sections['axis2_loop1']['total'] = 0;
if ($this->_sections['axis2_loop1']['show']):

            for ($this->_sections['axis2_loop1']['index'] = $this->_sections['axis2_loop1']['start'], $this->_sections['axis2_loop1']['iteration'] = 1;
                 $this->_sections['axis2_loop1']['iteration'] <= $this->_sections['axis2_loop1']['total'];
                 $this->_sections['axis2_loop1']['index'] += $this->_sections['axis2_loop1']['step'], $this->_sections['axis2_loop1']['iteration']++):
$this->_sections['axis2_loop1']['rownum'] = $this->_sections['axis2_loop1']['iteration'];
$this->_sections['axis2_loop1']['index_prev'] = $this->_sections['axis2_loop1']['index'] - $this->_sections['axis2_loop1']['step'];
$this->_sections['axis2_loop1']['index_next'] = $this->_sections['axis2_loop1']['index'] + $this->_sections['axis2_loop1']['step'];
$this->_sections['axis2_loop1']['first']      = ($this->_sections['axis2_loop1']['iteration'] == 1);
$this->_sections['axis2_loop1']['last']       = ($this->_sections['axis2_loop1']['iteration'] == $this->_sections['axis2_loop1']['total']);
?>
				<div class="y y2" style="left: <?php echo $this->_tpl_vars['x']; ?>
px; top: <?php echo $this->_tpl_vars['y']; ?>
px"><?php echo $this->_sections['axis2_loop1']['iteration']/100; ?>
<span>&mdash;</span></div>
				<?php $this->assign('y', $this->_tpl_vars['y']-45); ?>
			<?php endfor; endif; ?>

			<?php $this->assign('x', 150); ?>
			<?php $this->assign('y', 960); ?>

			<?php $_from = $this->_tpl_vars['RES']['part3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['axis2_loop2'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['axis2_loop2']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['axis2_loop2']['iteration']++;
?>
				<div class="x" style="left: <?php echo $this->_tpl_vars['x']; ?>
px; top: <?php echo $this->_tpl_vars['y']; ?>
px">
					<div class="sq" style="top: <?php echo smarty_function_math(array('equation' => "-s*45-15",'s' => $this->_tpl_vars['item']['s']), $this);?>
px; height: <?php echo smarty_function_math(array('equation' => "s*45+3",'s' => $this->_tpl_vars['item']['s']), $this);?>
px;"></div>
					<?php echo $this->_tpl_vars['item']['from']; ?>

				</div>

				<?php $this->assign('x', $this->_tpl_vars['x']+90); ?>
			<?php endforeach; endif; unset($_from); ?>
		</div>

		<h1>4. Вычисляем выборочные оценки мат. ожидания и дисперсии</h1>
		<p>Основные формулы:<br /><br /><br /><br /><br /><br /><br /><br /></p>
		<p>
			<b>&alpha;<sub>1</sub></b> = <?php echo $this->_tpl_vars['RES']['part4']['s1']['str']; ?>
 = <?php echo $this->_tpl_vars['RES']['part4']['s1']['val']; ?>

		</p>
		<p>
			<b>&alpha;<sub>2</sub></b> = <?php echo $this->_tpl_vars['RES']['part4']['s2']['str']; ?>
 = <?php echo $this->_tpl_vars['RES']['part4']['s2']['val']; ?>

		</p>
		<p>
			<b>&sigmaf;</b> = <?php echo $this->_tpl_vars['RES']['part4']['s3']['str']; ?>
 = <?php echo $this->_tpl_vars['RES']['part4']['s3']['val']; ?>

		</p>

		<h1>5. Строим статистическую функцию распределения</h1>

		<table class="general sm">
			<?php $_from = $this->_tpl_vars['RES']['part5']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['part5_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['part5_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['part5_loop']['iteration']++;
?>
				<tr>
					<td class="data">
						<div class="s l"><?php echo $this->_tpl_vars['item']['value']; ?>
</div>
					</td>
					<td class="data">
						<div class="l"><?php echo $this->_tpl_vars['item']['title']; ?>
</div>
					</td>
				</tr>
			<?php endforeach; endif; unset($_from); ?>
			</tr>
		</table>
		
		<div class="coords">
			<?php $this->assign('x', 20); ?>
			<?php $this->assign('y', 840); ?>
			
			<?php unset($this->_sections['axis3_loop1']);
$this->_sections['axis3_loop1']['name'] = 'axis3_loop1';
$this->_sections['axis3_loop1']['start'] = (int)0;
$this->_sections['axis3_loop1']['loop'] = is_array($_loop=9) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['axis3_loop1']['show'] = true;
$this->_sections['axis3_loop1']['max'] = $this->_sections['axis3_loop1']['loop'];
$this->_sections['axis3_loop1']['step'] = 1;
if ($this->_sections['axis3_loop1']['start'] < 0)
    $this->_sections['axis3_loop1']['start'] = max($this->_sections['axis3_loop1']['step'] > 0 ? 0 : -1, $this->_sections['axis3_loop1']['loop'] + $this->_sections['axis3_loop1']['start']);
else
    $this->_sections['axis3_loop1']['start'] = min($this->_sections['axis3_loop1']['start'], $this->_sections['axis3_loop1']['step'] > 0 ? $this->_sections['axis3_loop1']['loop'] : $this->_sections['axis3_loop1']['loop']-1);
if ($this->_sections['axis3_loop1']['show']) {
    $this->_sections['axis3_loop1']['total'] = min(ceil(($this->_sections['axis3_loop1']['step'] > 0 ? $this->_sections['axis3_loop1']['loop'] - $this->_sections['axis3_loop1']['start'] : $this->_sections['axis3_loop1']['start']+1)/abs($this->_sections['axis3_loop1']['step'])), $this->_sections['axis3_loop1']['max']);
    if ($this->_sections['axis3_loop1']['total'] == 0)
        $this->_sections['axis3_loop1']['show'] = false;
} else
    $this->_sections['axis3_loop1']['total'] = 0;
if ($this->_sections['axis3_loop1']['show']):

            for ($this->_sections['axis3_loop1']['index'] = $this->_sections['axis3_loop1']['start'], $this->_sections['axis3_loop1']['iteration'] = 1;
                 $this->_sections['axis3_loop1']['iteration'] <= $this->_sections['axis3_loop1']['total'];
                 $this->_sections['axis3_loop1']['index'] += $this->_sections['axis3_loop1']['step'], $this->_sections['axis3_loop1']['iteration']++):
$this->_sections['axis3_loop1']['rownum'] = $this->_sections['axis3_loop1']['iteration'];
$this->_sections['axis3_loop1']['index_prev'] = $this->_sections['axis3_loop1']['index'] - $this->_sections['axis3_loop1']['step'];
$this->_sections['axis3_loop1']['index_next'] = $this->_sections['axis3_loop1']['index'] + $this->_sections['axis3_loop1']['step'];
$this->_sections['axis3_loop1']['first']      = ($this->_sections['axis3_loop1']['iteration'] == 1);
$this->_sections['axis3_loop1']['last']       = ($this->_sections['axis3_loop1']['iteration'] == $this->_sections['axis3_loop1']['total']);
?>
				<div class="y" style="left: <?php echo $this->_tpl_vars['x']; ?>
px; top: <?php echo $this->_tpl_vars['y']; ?>
px"><?php echo $this->_sections['axis3_loop1']['iteration']/10; ?>
<span>&mdash;</span></div>
				<?php $this->assign('y', $this->_tpl_vars['y']-97); ?>
			<?php endfor; endif; ?>

			<?php $this->assign('x', 70); ?>
			<?php $this->assign('y', 945); ?>

			<?php $_from = $this->_tpl_vars['RES']['part5']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['axis3_loop2'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['axis3_loop2']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['axis3_loop2']['iteration']++;
?>
				<?php if ($this->_tpl_vars['key'] != -1): ?>
					<div class="x" style="left: <?php echo $this->_tpl_vars['x']; ?>
px; top: <?php echo $this->_tpl_vars['y']; ?>
px">
						<div class="line" style="width: 95px; top: <?php echo smarty_function_math(array('equation' => "-950*v",'v' => $this->_tpl_vars['item']['value']), $this);?>
px"></div>
						<b>|</b><br />
						<?php echo $this->_tpl_vars['item']['key']; ?>

					</div>
	
					<?php $this->assign('x', $this->_tpl_vars['x']+90); ?>
				<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
		</div>

		<br /><br /><br /><br />
		<h1>6. Находим статистические оценки мат. ожидания, дисперсии, среднеквадратического отклонения</h1>
		<p>Формулы:<br /><br /><br /><br /><br /><br /><br /><br /></p>
		<p>
			<b>М</b> = <?php echo $this->_tpl_vars['RES']['part6']['s1']['str']; ?>
 = <?php echo $this->_tpl_vars['RES']['part6']['s1']['val']; ?>

		</p>
		<p>
			<b>D</b> = <?php echo $this->_tpl_vars['RES']['part6']['s2']['str']; ?>
 = <?php echo ((is_array($_tmp=$this->_tpl_vars['RES']['part6']['s2']['val'])) ? $this->_run_mod_handler('round', true, $_tmp, 2) : round($_tmp, 2)); ?>

		</p>
		<p>
			<b>&sigmaf;</b> = <?php echo smarty_function_math(array('equation' => "round(pow(v,1/2),2)",'v' => $this->_tpl_vars['RES']['part6']['s2']['val']), $this);?>

		</p>

		<br />
		<h1>7. Построим таблицу для выравнивания выборки нормальным законом</h1>
		<br />

		<table class="general">
			<tr>
				<td class="data" width="10%"><div class="l">I<sub>i</sub></div></td>
				<td class="data" width="10%"><div class="l">X<sub>i-1</sub> &minus; &alpha;<sub>1</sub></div></td>
				<td class="data" width="10%"><div class="l">X<sub>i</sub> &minus; &alpha;<sub>1</sub></div></td>
				<td class="data" width="10%">
					<div class="f">
						X<sub>i-1</sub> &minus; &alpha;<sub>1</sub>
					</div>
					<div class="l f">
						&sigmaf;
					</div>
				</td>
				<td class="data" width="10%">
					<div class="f">
						X<sub>i</sub> &minus; &alpha;<sub>1</sub>
					</div>
					<div class="l f">
						&sigmaf;
					</div>
				</td>
				<td class="data" width="10%"><div class="l">Ф(X<sub>i-1</sub><sup>o</sup>)</div></td>
				<td class="data" width="10%"><div class="l">Ф(X<sub>i</sub><sup>o</sup>)</div></td>
				<td class="data" width="10%"><div class="l">Ф(X<sub>i</sub><sup>o</sup>) &minus; Ф(X<sub>i-1</sub><sup>o</sup>)</div></td>
			</tr>
			<tr>
				<?php unset($this->_sections['part7_header']);
$this->_sections['part7_header']['name'] = 'part7_header';
$this->_sections['part7_header']['start'] = (int)0;
$this->_sections['part7_header']['loop'] = is_array($_loop=8) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['part7_header']['show'] = true;
$this->_sections['part7_header']['max'] = $this->_sections['part7_header']['loop'];
$this->_sections['part7_header']['step'] = 1;
if ($this->_sections['part7_header']['start'] < 0)
    $this->_sections['part7_header']['start'] = max($this->_sections['part7_header']['step'] > 0 ? 0 : -1, $this->_sections['part7_header']['loop'] + $this->_sections['part7_header']['start']);
else
    $this->_sections['part7_header']['start'] = min($this->_sections['part7_header']['start'], $this->_sections['part7_header']['step'] > 0 ? $this->_sections['part7_header']['loop'] : $this->_sections['part7_header']['loop']-1);
if ($this->_sections['part7_header']['show']) {
    $this->_sections['part7_header']['total'] = min(ceil(($this->_sections['part7_header']['step'] > 0 ? $this->_sections['part7_header']['loop'] - $this->_sections['part7_header']['start'] : $this->_sections['part7_header']['start']+1)/abs($this->_sections['part7_header']['step'])), $this->_sections['part7_header']['max']);
    if ($this->_sections['part7_header']['total'] == 0)
        $this->_sections['part7_header']['show'] = false;
} else
    $this->_sections['part7_header']['total'] = 0;
if ($this->_sections['part7_header']['show']):

            for ($this->_sections['part7_header']['index'] = $this->_sections['part7_header']['start'], $this->_sections['part7_header']['iteration'] = 1;
                 $this->_sections['part7_header']['iteration'] <= $this->_sections['part7_header']['total'];
                 $this->_sections['part7_header']['index'] += $this->_sections['part7_header']['step'], $this->_sections['part7_header']['iteration']++):
$this->_sections['part7_header']['rownum'] = $this->_sections['part7_header']['iteration'];
$this->_sections['part7_header']['index_prev'] = $this->_sections['part7_header']['index'] - $this->_sections['part7_header']['step'];
$this->_sections['part7_header']['index_next'] = $this->_sections['part7_header']['index'] + $this->_sections['part7_header']['step'];
$this->_sections['part7_header']['first']      = ($this->_sections['part7_header']['iteration'] == 1);
$this->_sections['part7_header']['last']       = ($this->_sections['part7_header']['iteration'] == $this->_sections['part7_header']['total']);
?>
				<td class="data" width="10%"><div class="l"><?php echo $this->_sections['part7_header']['iteration']; ?>
</div></td>
				<?php endfor; endif; ?>
			</tr>
			<?php $_from = $this->_tpl_vars['RES']['part7']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['part7_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['part7_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['part7_loop']['iteration']++;
?>
				<tr>
					<td class="data">
						<div class="s l"><?php echo $this->_tpl_vars['item']['from']; ?>
</div>
						<div class="s l"><?php echo $this->_tpl_vars['item']['to']; ?>
</div>
					</td>
					<td class="data">
						<div class="l"><?php echo $this->_tpl_vars['item']['s1']; ?>
</div>
					</td>
					<td class="data">
						<div class="l"><?php echo $this->_tpl_vars['item']['s2']; ?>
</div>
					</td>
					<td class="data">
						<div class="l"><?php echo $this->_tpl_vars['item']['s3']; ?>
</div>
					</td>
					<td class="data">
						<div class="l"><?php echo $this->_tpl_vars['item']['s4']; ?>
</div>
					</td>
					<td class="data">
						<div class="l"></div>
					</td>
					<td class="data">
						<div class="l"></div>
					</td>
					<td class="data">
						<div class="l"></div>
					</td>
				</tr>
			<?php endforeach; endif; unset($_from); ?>
			</tr>
		</table>
	</div>

  <?php echo '
	<script type="text/javascript">
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src=\'" + gaJsHost + "google-analytics.com/ga.js\' type=\'text/javascript\'%3E%3C/script%3E"));
		try {
		var pageTracker = _gat._getTracker("UA-9475550-1");
		pageTracker._trackPageview();
		} catch(err) {}
	</script>
	'; ?>

</body>