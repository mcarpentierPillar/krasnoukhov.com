// settings
var settings = {
	prs: 15
}

// all theory
var trs;

// ready func
$().ready(
	function() {
		// get all theory
		$.get(
			'./data/tr.js',
			{},
			function(data) {
				eval(data);
				trs = vars;

				// get index
				getIx(0);

				// get header
				$.get(
					'./lib/header.html',
					{},
					function(data) {
						$('#header').html(data);
					}
				);
		
				// get footer
				$.get(
					'./lib/footer.html',
					{},
					function(data) {
						$('#footer').html(data);
					}
				);
		
				// hash change
				$().bind('hashChange',
					function() {
						if($(location.hash).attr('id')) {
							$.scrollTo(location.hash, 100);
							return;
						}
						
						var query = location.hash.replace('#','').split('/');
				
						// switch by type
						switch(query[0]) {
							case 'ix':
								getIx(query[1]);
							break;
							case 'pr':
								getPr(query[1]);
							break;
							case 'tr':
								getTr(query[1]);
							break;
							case 'ts':
								getTs(query[1]);
							break;
							default:
								//getIx(0);
							break;
						}
					}
				);

			}
		);		
	}
);

// get index
function getIx(id) {
	$.get(
		'./lib/index.html',
		{},
		function(data) {
			$('#content').html(data);
		}
	);
}

// get praktychna
function getPr(id) {
	// get json file
	$.get(
		'./data/pr/'+id+'.js',
		{},
		function(data) {
			// get data to vars
			eval(data);

			// get template
			$.get(
				'./lib/pr.html',
				{},
				function(data) {
					$('#content').html(data);

					// setup vars
					$('#title').append(id);
					$('#subject').append(vars.subject);
					$('#effect').append(vars.effect);
					
					// theory
					if(vars.theory) {
						for(var i in vars.theory) {
							var ix = vars.theory[i];
							$('#theory ol').append('<li><a href="#tr/'+ix+'">'+trs[ix].title+'</a></li>');
						}
					}

					// get contents
					$.get(
						'./data/pr/'+id+'.html',
						{},
						function(data) {
							if(data.length > 0) {
								$('#data').html(data);
								
								// set up variants
								$('a.variant').each(
									function() {
										var i = this.id.replace('variant','');
										$('#todo ul').append('<li><a href="#variant'+i+'">'+i+'</a></li>');
									}
								);
								
								
								// unset hashs
								if(!$('#otodo').attr('id')) {
									$('#todo').css('display','none');
								}
								
								if(!$('#oexample').attr('id')) {
									$('#example').css('display','none');
								}

								if(!$('#oquestions').attr('id')) {
									$('#questions').css('display','none');
								}

								if(!$('#otstats').attr('id')) {
									$('#tstats').css('display','none');
								}
							}
						}
					);					
				}
			);			
		}
	);
}

// get teoria
function getTr(id) {
	// get json file
	$.get(
		'./data/tr/index_'+id+'.html',
		{},
		function(data) {
			$('#content').html(data);
		}
	);
}

// get test
function getTs(id) {
	if(trs) {
		initTest(id);
	}else{
		location.hash = '#ix/0';
	}
}

// init test
var step = -1;
var answers = new Array();
var loc = '';
var all = 0;
var tid = 0;

function initTest(id) {
	var test = trs[id].test;
	
	if(test) {
		if(step == -1 || tid != id) {
			all = 0;
			tid = id;

			for(var i in test) {
				all++;
			}
			
			step = 1;
			loc = location.hash;
			drawTest(id);
		}else if(!test[step] && answers[step-1]){
			// get test
			$.get(
				'./lib/result.html',
				{},
				function(data) {
					$('#content').html(data);
	
					var w = 0;
					for(var i in test) {
						var a = answers[i];
						var r = test[i].right;

						var ttl1 = test[i].answers[a];
						ttl1 = ttl1.replace('<','&lt;').replace('>','&gt;');

						var ttl2 = test[i].answers[r];
						ttl2 = ttl2.replace('<','&lt;').replace('>','&gt;');
	
						if(a != r) {
							$('#list').append('<li><h2><b>'+i+'.</b> '+test[i].title+'</h2><h3><strike>'+ttl1+'</strike></h3><h3>'+ttl2+'</h3><h3><a class="s" href="#tr/'+id+'">'+test[i].where+'</a></h3></li>');
							w++;
						}
					}
					
					$('#title').append(' '+i-w+'/'+i);

					all = 0;
					answers = new Array();
					step = -1;
				}
			);			
		}
	}
}

// draw step
function drawTest(id) {
	var test = trs[id].test;

	if(test[step]) {
		// get test
		$.get(
			'./lib/test.html',
			{},
			function(data) {
				$('#content').html(data);
				$('#content').append('<input type="hidden" id="ans" value="1">');

				// set vars
				$('#title').html('<b>'+step+'/'+all+'.</b> '+test[step].title);
				
				for(var i in test[step].answers) {
					var ttl = test[step].answers[i];
					ttl = ttl.replace('<','&lt;').replace('>','&gt;');
					
					$('#answers').append('<li><input class="rad" type="radio" id="ans_'+i+'" value="'+i+'"> '+ttl+'</li>');
					$('#ans_'+i).bind('click',function() { $('.rad').attr('checked',false); $('#ans').attr('value',this.value); this.checked = true; } );
				}
				
				var tid = id;
				$('#check').bind('click',function() { checkTest(tid); } );

				location.hash = loc+'/'+step;
				step++;
			}
		);
	}
}

// check step
function checkTest(id) {
	var ans = $('#ans').attr('value');
	
	var test = trs[id].test;
	answers[step-1] = ans;

	if(test[step]) {
		drawTest(id);
	}else{
		location.hash = loc;
		loc = '';
		all = 0;
	}
}