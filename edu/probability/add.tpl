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

	{literal}
	<script type="text/javascript">
		function doRandom() {
			for(i=1;i<=10;i++) {
				for(j=1;j<=10;j++) {
					document.getElementById('data_'+i+'_'+j).value = Math.floor(Math.random()*500)+80;
				}
			}
		}
	</script>
	{/literal}
</head> 
<body> 
	<div class="content">
		<h1 class="s">Добавить данные</h1>
		
		<table width="100%" height="100%">
		<form action="add.php" method="post">

		Имя файла: <input type="text" name="file" value="{$VARS.0}"><br />
		Разрядов: <input type="text" name="data[S]" value="10"><br />
		Величина разряда: <input type="text" name="data[R]" value="52"><br />
		
			{section name=loop1 start=1 loop=11}
				{assign var="i" value=$smarty.section.loop1.index}
				<tr>
					{section name=loop2 start=1 loop=11}
						{assign var="j" value=$smarty.section.loop2.index}

						<td><input type="text" id="data_{$i}_{$j}" name="data[{$i}][{$j}]" style="width: 50px; margin: 5px;" value="{$DATA.$i.$j}"></td>
					{/section}
				</tr>
			{/section}
			<tr><td colspan="10"><br /><input type="button" value="Случайные" onclick="doRandom()"> <input type="submit" value="Добавить"></td></tr>
		</form>
		</table>
	</div>
</body>
