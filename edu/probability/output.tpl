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
			{foreach from=$DATA item=item name=data_loop}
				{if $smarty.foreach.part1_loop.iteration%10 == 1}
					<tr>
				{/if}

					{foreach from=$item item=v}
						<td class="data"><div class="l">{$v}</div></td>
					{/foreach}

				{if $smarty.foreach.part1_loop.iteration%10 == 0}
					</tr>
				{/if}
			{/foreach}
		</table>
		
		<h1>1. Построение вариационного ряда, нахождение эмпирических частот</h1>
		
		<table class="general">
			{foreach from=$RES.part1 item=item key=key name=part1_loop}
				{if $smarty.foreach.part1_loop.iteration%10 == 1}
					<tr>
						<td class="data">
							<div class="s">X<sub>i</sub></div>
							<div>m<sub>i</sub></div>
							<div class="l">P<sub>i</sub></div>
						</td>
				{/if}

				<td class="data">
					<div class="s">{$key}</div>
					<div>{$item}</div>
					<div class="l">{$item/100}</div>
				</td>

				{if $smarty.foreach.part1_loop.iteration%10 == 0}
					</tr><tr><td>&nbsp;</td></tr>
				{/if}
			{/foreach}
			</tr>
		</table>

		<h1>2. Строим эмпирическую функцию распределения</h1>

		<table class="general sm">
			{foreach from=$RES.part2 item=item key=key name=part2_loop}
				<tr>
					<td class="data">
						<div class="s l">{$item.value}</div>
					</td>
					<td class="data">
						<div class="l">{$item.title}</div>
					</td>
				</tr>
			{/foreach}
			</tr>
		</table>
		
		<div class="coords">
			{assign var="x" value=20}
			{assign var="y" value=890}
			
			{section name=axis1_loop1 start=0 loop=10}
				<div class="y" style="left: {$x}px; top: {$y}px">{$smarty.section.axis1_loop1.iteration/10}<span>&mdash;</span></div>
				{assign var="y" value=$y-97}
			{/section}

			{assign var="x" value=50}
			{assign var="y" value=945}

			{foreach name=axis1_loop2 from=$RES.part2 item=item}
				
				<div class="x" style="left: {$x}px; top: {$y}px">
					<div class="line" style="top: {math equation="-900*v-5" v=$item.value}px"></div>
					<b>|</b><br />
					{$item.key}
				</div>

				{assign var="x" value=$x+20}
			{/foreach}
		</div>

		<h1>3. Строим статистический ряд распределения, определяем размах выборки R</h1>
		<p>Выборку разбиваем на {$RES.DATA.S} разрядов. Величина разряда равна {$RES.DATA.R}. Крайний правый равен {$RES.DATA.M}</p>

		<table class="general">
			<tr>
				<td class="data">
					<div class="s l">I<sub>i</sub></div>
					<div class="s">&nbsp;</div>
					<div>m<sub>i</sub></div>
					<div class="l">P<sub>i</sub></div>
				</td>
			{foreach from=$RES.part3 item=item name=part3_loop}
				<td class="data">
					<div class="s l">{$item.from}</div>
					<div class="s">{$item.to}</div>
					<div>{$item.s}</div>
					<div class="l">{$item.s/100}</div>
				</td>
			{/foreach}
			</tr>
		</table>		

		<p>Строим гистограмму</p>

		<div class="coords">
			{assign var="x" value=20}
			{assign var="y" value=892}
			
			{section name=axis2_loop1 start=0 loop=20}
				<div class="y y2" style="left: {$x}px; top: {$y}px">{$smarty.section.axis2_loop1.iteration/100}<span>&mdash;</span></div>
				{assign var="y" value=$y-45}
			{/section}

			{assign var="x" value=150}
			{assign var="y" value=960}

			{foreach name=axis2_loop2 from=$RES.part3 item=item}
				<div class="x" style="left: {$x}px; top: {$y}px">
					<div class="sq" style="top: {math equation="-s*45-15" s=$item.s}px; height: {math equation="s*45+3" s=$item.s}px;"></div>
					{$item.from}
				</div>

				{assign var="x" value=$x+90}
			{/foreach}
		</div>

		<h1>4. Вычисляем выборочные оценки мат. ожидания и дисперсии</h1>
		<p>Основные формулы:<br /><br /><br /><br /><br /><br /><br /><br /></p>
		<p>
			<b>&alpha;<sub>1</sub></b> = {$RES.part4.s1.str} = {$RES.part4.s1.val}
		</p>
		<p>
			<b>&alpha;<sub>2</sub></b> = {$RES.part4.s2.str} = {$RES.part4.s2.val}
		</p>
		<p>
			<b>&sigmaf;</b> = {$RES.part4.s3.str} = {$RES.part4.s3.val}
		</p>

		<h1>5. Строим статистическую функцию распределения</h1>

		<table class="general sm">
			{foreach from=$RES.part5 item=item key=key name=part5_loop}
				<tr>
					<td class="data">
						<div class="s l">{$item.value}</div>
					</td>
					<td class="data">
						<div class="l">{$item.title}</div>
					</td>
				</tr>
			{/foreach}
			</tr>
		</table>
		
		<div class="coords">
			{assign var="x" value=20}
			{assign var="y" value=840}
			
			{section name=axis3_loop1 start=0 loop=9}
				<div class="y" style="left: {$x}px; top: {$y}px">{$smarty.section.axis3_loop1.iteration/10}<span>&mdash;</span></div>
				{assign var="y" value=$y-97}
			{/section}

			{assign var="x" value=70}
			{assign var="y" value=945}

			{foreach name=axis3_loop2 from=$RES.part5 key=key item=item}
				{if $key != -1}
					<div class="x" style="left: {$x}px; top: {$y}px">
						<div class="line" style="width: 95px; top: {math equation="-950*v" v=$item.value}px"></div>
						<b>|</b><br />
						{$item.key}
					</div>
	
					{assign var="x" value=$x+90}
				{/if}
			{/foreach}
		</div>

		<br /><br /><br /><br />
		<h1>6. Находим статистические оценки мат. ожидания, дисперсии, среднеквадратического отклонения</h1>
		<p>Формулы:<br /><br /><br /><br /><br /><br /><br /><br /></p>
		<p>
			<b>М</b> = {$RES.part6.s1.str} = {$RES.part6.s1.val}
		</p>
		<p>
			<b>D</b> = {$RES.part6.s2.str} = {$RES.part6.s2.val|round:2}
		</p>
		<p>
			<b>&sigmaf;</b> = {math equation="round(pow(v,1/2),2)" v=$RES.part6.s2.val}
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
				{section name=part7_header start=0 loop=8}
				<td class="data" width="10%"><div class="l">{$smarty.section.part7_header.iteration}</div></td>
				{/section}
			</tr>
			{foreach from=$RES.part7 item=item name=part7_loop}
				<tr>
					<td class="data">
						<div class="s l">{$item.from}</div>
						<div class="s l">{$item.to}</div>
					</td>
					<td class="data">
						<div class="l">{$item.s1}</div>
					</td>
					<td class="data">
						<div class="l">{$item.s2}</div>
					</td>
					<td class="data">
						<div class="l">{$item.s3}</div>
					</td>
					<td class="data">
						<div class="l">{$item.s4}</div>
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
			{/foreach}
			</tr>
		</table>
	</div>

  {literal}
	<script type="text/javascript">
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
		try {
		var pageTracker = _gat._getTracker("UA-9475550-1");
		pageTracker._trackPageview();
		} catch(err) {}
	</script>
	{/literal}
</body>