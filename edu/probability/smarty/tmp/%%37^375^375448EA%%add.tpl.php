<?php /* Smarty version 2.6.26, created on 2012-04-12 11:40:35
         compiled from add.tpl */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru_RU"> 
<head> 
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" /> 
	<meta http-equiv="Pragma" content="no-cache" /> 
	<meta http-equiv="Cache-control" content="no-cache, proxy-revalidate, must-revalidate" /> 
 
	<title>Теория Вероятности</title> 
	
	<style type="text/css"> 
		@import "./styles.css?5";
	</style> 

	<?php echo '
	<script type="text/javascript">
		function doRandom() {
			for(i=1;i<=10;i++) {
				for(j=1;j<=10;j++) {
					document.getElementById(\'data_\'+i+\'_\'+j).value = Math.floor(Math.random()*500)+80;
				}
			}
		}
	</script>
	'; ?>

</head> 
<body> 
	<div class="content">
		<h1 class="s">Добавить данные</h1>
		
		<table width="100%" height="100%">
		<form action="add.php" method="post">

		Имя файла: <input type="text" name="file" value="<?php echo $this->_tpl_vars['VARS']['0']; ?>
"><br />
		Разрядов: <input type="text" name="data[S]" value="10"><br />
		Величина разряда: <input type="text" name="data[R]" value="52"><br />
		
			<?php unset($this->_sections['loop1']);
$this->_sections['loop1']['name'] = 'loop1';
$this->_sections['loop1']['start'] = (int)1;
$this->_sections['loop1']['loop'] = is_array($_loop=11) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['loop1']['show'] = true;
$this->_sections['loop1']['max'] = $this->_sections['loop1']['loop'];
$this->_sections['loop1']['step'] = 1;
if ($this->_sections['loop1']['start'] < 0)
    $this->_sections['loop1']['start'] = max($this->_sections['loop1']['step'] > 0 ? 0 : -1, $this->_sections['loop1']['loop'] + $this->_sections['loop1']['start']);
else
    $this->_sections['loop1']['start'] = min($this->_sections['loop1']['start'], $this->_sections['loop1']['step'] > 0 ? $this->_sections['loop1']['loop'] : $this->_sections['loop1']['loop']-1);
if ($this->_sections['loop1']['show']) {
    $this->_sections['loop1']['total'] = min(ceil(($this->_sections['loop1']['step'] > 0 ? $this->_sections['loop1']['loop'] - $this->_sections['loop1']['start'] : $this->_sections['loop1']['start']+1)/abs($this->_sections['loop1']['step'])), $this->_sections['loop1']['max']);
    if ($this->_sections['loop1']['total'] == 0)
        $this->_sections['loop1']['show'] = false;
} else
    $this->_sections['loop1']['total'] = 0;
if ($this->_sections['loop1']['show']):

            for ($this->_sections['loop1']['index'] = $this->_sections['loop1']['start'], $this->_sections['loop1']['iteration'] = 1;
                 $this->_sections['loop1']['iteration'] <= $this->_sections['loop1']['total'];
                 $this->_sections['loop1']['index'] += $this->_sections['loop1']['step'], $this->_sections['loop1']['iteration']++):
$this->_sections['loop1']['rownum'] = $this->_sections['loop1']['iteration'];
$this->_sections['loop1']['index_prev'] = $this->_sections['loop1']['index'] - $this->_sections['loop1']['step'];
$this->_sections['loop1']['index_next'] = $this->_sections['loop1']['index'] + $this->_sections['loop1']['step'];
$this->_sections['loop1']['first']      = ($this->_sections['loop1']['iteration'] == 1);
$this->_sections['loop1']['last']       = ($this->_sections['loop1']['iteration'] == $this->_sections['loop1']['total']);
?>
				<?php $this->assign('i', $this->_sections['loop1']['index']); ?>
				<tr>
					<?php unset($this->_sections['loop2']);
$this->_sections['loop2']['name'] = 'loop2';
$this->_sections['loop2']['start'] = (int)1;
$this->_sections['loop2']['loop'] = is_array($_loop=11) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['loop2']['show'] = true;
$this->_sections['loop2']['max'] = $this->_sections['loop2']['loop'];
$this->_sections['loop2']['step'] = 1;
if ($this->_sections['loop2']['start'] < 0)
    $this->_sections['loop2']['start'] = max($this->_sections['loop2']['step'] > 0 ? 0 : -1, $this->_sections['loop2']['loop'] + $this->_sections['loop2']['start']);
else
    $this->_sections['loop2']['start'] = min($this->_sections['loop2']['start'], $this->_sections['loop2']['step'] > 0 ? $this->_sections['loop2']['loop'] : $this->_sections['loop2']['loop']-1);
if ($this->_sections['loop2']['show']) {
    $this->_sections['loop2']['total'] = min(ceil(($this->_sections['loop2']['step'] > 0 ? $this->_sections['loop2']['loop'] - $this->_sections['loop2']['start'] : $this->_sections['loop2']['start']+1)/abs($this->_sections['loop2']['step'])), $this->_sections['loop2']['max']);
    if ($this->_sections['loop2']['total'] == 0)
        $this->_sections['loop2']['show'] = false;
} else
    $this->_sections['loop2']['total'] = 0;
if ($this->_sections['loop2']['show']):

            for ($this->_sections['loop2']['index'] = $this->_sections['loop2']['start'], $this->_sections['loop2']['iteration'] = 1;
                 $this->_sections['loop2']['iteration'] <= $this->_sections['loop2']['total'];
                 $this->_sections['loop2']['index'] += $this->_sections['loop2']['step'], $this->_sections['loop2']['iteration']++):
$this->_sections['loop2']['rownum'] = $this->_sections['loop2']['iteration'];
$this->_sections['loop2']['index_prev'] = $this->_sections['loop2']['index'] - $this->_sections['loop2']['step'];
$this->_sections['loop2']['index_next'] = $this->_sections['loop2']['index'] + $this->_sections['loop2']['step'];
$this->_sections['loop2']['first']      = ($this->_sections['loop2']['iteration'] == 1);
$this->_sections['loop2']['last']       = ($this->_sections['loop2']['iteration'] == $this->_sections['loop2']['total']);
?>
						<?php $this->assign('j', $this->_sections['loop2']['index']); ?>

						<td><input type="text" id="data_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['j']; ?>
" name="data[<?php echo $this->_tpl_vars['i']; ?>
][<?php echo $this->_tpl_vars['j']; ?>
]" style="width: 50px; margin: 5px;" value="<?php echo $this->_tpl_vars['DATA'][$this->_tpl_vars['i']][$this->_tpl_vars['j']]; ?>
"></td>
					<?php endfor; endif; ?>
				</tr>
			<?php endfor; endif; ?>
			<tr><td colspan="10"><br /><input type="button" value="Случайные" onclick="doRandom()"> <input type="submit" value="Добавить"></td></tr>
		</form>
		</table>
	</div>
</body>