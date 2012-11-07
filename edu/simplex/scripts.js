/*
* @todo: n, o checkboxes
* @todo: save/load examples
*/
var data = {
	int: 32768,
	tpi: 7,
	repeat: 0,
	
	lang: {
		no_data: 'Наразі немає даних',
		error: {
			no_positive: 'Немає рішень, щоб x були більше нуля'
		}
	},
	
	save: false,
	
	current: {
	},
	
	example: {
	},

	// redraw form
	_redrawForm: function() {
		j = parseInt($('input[name="f[j]"]').val());
		html = 'L = ';
		for(var i=1; i<=j; i++) {
			value = "0";
			if(this.save.l && this.save.l[i]) {
				value = this.save.l[i];
			}else if(this.current.l && this.current.l[i]) {
				value = this.current.l[i];
			}
			
			html += '<input type="text" name="f[l]['+i+']" value="'+value+'"> x<sub>'+i+'</sub>';
			if(i != j) {
				html += ' + ';
			}
		}
		
		$('.function').html(html);
		this._redrawRestr();
	},

	// redraw form
	_redrawRestr: function() {
		j = parseInt($('input[name="f[j]"]').val());
		k = parseInt($('input[name="f[k]"]').val());

		//alert(JSON.stringify(this.save.q[1]));
		
		html = '';
		for(var l=1; l<=k; l++) {
			for(var i=1; i<=j; i++) {
				value = "0";
				if(this.save.q && this.save.q[l] && this.save.q[l][i]) {
					value = this.save.q[l][i];
				}else if(this.current.q && this.current.q[l] && this.current.q[l][i]) {
					value = this.current.q[l][i];
				}

				
				html += '<input type="text" name="f[q]['+l+']['+i+']" value="'+value+'"> x<sub>'+i+'</sub>';
	
				if(i != j) {
					html += ' + ';
				}
			}

			value = "0";
			if(this.save.q && this.save.q[l] && this.save.q[l].b) {
				value = this.save.q[l].b;
			}

			html += ' = <input type="text" name="f[q]['+l+'][b]" value="'+value+'"><br />';
		}
		
		$('.restrictions').html(html);
	},

	// example
	_example: function(n) {
		example = this.example[n];

		$('input[name="f[t]"][value="'+example.t+'"]').attr('checked', true);
		$('input[name="f[j]"]').val(example.j);
		$('input[name="f[k]"]').val(example.k);
		
		this._redrawForm();
		this._redrawRestr();
		
		for(var i in example.l) {
			$('input[name="f[l]['+i+']"]').val(example.l[i]);
		}

		for(var i in example.q) {
			for(var j in example.q[i]) {
				$('input[name="f[q]['+i+']['+j+']"]').val(example.q[i][j]);
			}
		}
		
		if(example.n) {
			$('input[name="f[n]"]').attr('checked', 1);
		}else{
			$('input[name="f[n]"]').attr('checked', 0);
		}

		if(example.o) {
			$('input[name="f[o]"]').attr('checked', 1);
		}else{
			$('input[name="f[o]"]').attr('checked', 0);
		}

		$('input[name="f[calc]"]').click();
	},

	// current
	_current: function(ctr) {
		html = 'L = ';

		for(var i in this.current.l) {
			if(this.current.l[i] != 0) {
				if(html != 'L = ') {
					if(this.current.l[i] < 0) {
						html += ' - ';
					}else{
						html += ' + ';
					}
				}

				if(this.current.l[i] != 1) {
					html += Math.abs(this.current.l[i]);
				}
				html += 'x<sub>'+i+'</sub>';
			}
		}

		html += '&nbsp;&rarr;&nbsp;';
		if(this.current.t == 1) {
			html += 'min';
		}else if(this.current.t == 2) {
			html += 'max';
		}
		html += '<br /><br />';

		html += '<div class="sys"><ins class="t"></ins><ins class="b"></ins>';
		for(var i in this.current.q) {
			stat = '';
			
			for(var j in this.current.q[i]) {
				if(this.current.q[i][j] != 0) {
					if(stat != '' && j != 'b') {
						if(this.current.q[i][j] < 0) {
							html += ' - ';
						}else{
							html += ' + ';
						}
					}else if(j == 'b'){
						html += ' = ';
					}
	
					if(Math.abs(this.current.q[i][j]) != 1 || j == 'b') {
						html += Math.abs(this.current.q[i][j]);
						stat += Math.abs(this.current.q[i][j]);
					}
					
					if(j != 'b'){
						html += 'x<sub>'+j+'</sub>';
						stat += 'x<sub>'+j+'</sub>';
					}
				}
			}

			html += '<br />';
		}
		html += '</div>';

		if(!ctr) {		
			if(this.current.n) {
				html += '<br /> x<sub>j</sub> ∈ N';
			}
			if(this.current.o) {
				html += '<br /> x<sub>j</sub> ≥ 0';
			}

			html += '<br /><br /><input type="button" name="f[s]" value="Зберегти">';
		}
		$('#'+(ctr ? ctr : 'inserted')).html(html);

		// save bind
		$('input[name="f[s]"]').unbind('click');
		$('input[name="f[s]"]').bind('click',function () {
			alert(JSON.stringify(data.save));
		});

		return html;
	},

	// calculate
	_calculate: function() {
		// parse to current
		this.current = {
			t: parseInt($('input[name="f[t]"]:checked').val()),
			j: parseInt($('input[name="f[j]"]').val()),
			k: parseInt($('input[name="f[k]"]').val()),
			l: {},
			q: {},
			b: {},
			d: {},
			r: {
				i: 0,
				v: {}
			},
			a: {},
			dn: {},
			p: {},
			// natural
			n: $('input[name="f[n]"]').attr('checked'),
			// only positive
			o: $('input[name="f[o]"]').attr('checked')
		};

		// func
		for(var i=1; i<=this.current.j; i++) {
			this.current.l[i] = parseInt($('input[name="f[l]['+i+']"]').val());
		}
		
		// restr
		for(var i=1; i<=this.current.k; i++) {
			this.current.q[i] = {};
			for(var j=1; j<=this.current.j; j++) {
				this.current.q[i][j] = parseInt($('input[name="f[q]['+i+']['+j+']"]').val());
			}

			this.current.q[i].b = parseInt($('input[name="f[q]['+i+'][b]"]').val());
		}

		if(!this.save) {
			this.save = this._objClone(this.current);
		}
		
		// current
		this._current();
		
		// do calc
		$('#result').html('');
		this._simplex();
	},
		
	// simplex
	_simplex: function(kn, km) {
		// get basic with 0 and 1
		for(var i=1; i<=this.current.k; i++) {
			for(var l=1; l<=this.current.j; l++) {
				var t = 0;
				var f = 0;
				var key = 0;

				for(var k=1; k<=this.current.k; k++) {
					if(this.current.q[k][l] == 0) {
						f++;
					}

					if(this.current.q[k][l] == 1) {
						t++;
						key = k;
					}
				}
				
				var s = t + f;
				if(
					t == 1 && f != 0 &&
					s == this.current.k &&
					!this._objIn(this.current.b, l) && 
					!this.current.dn[l]
				) {
					if(!this.current.b[key]) {
						this.current.b[key] = l;

						if(this._objLength(this.current.b) != this.current.k) {
							this._print();
						}
						
						break;
					}
				}
			}
		}		
		
		// get other basic
		if(this._objLength(this.current.b) != this.current.k || kn) {
			for(var i=1; i<=this.current.k; i++) {
				if(!this.current.b[i] || (kn == i)) {
					//this._log(kn+' '+km);
					if(km) {
						mk = km;
						this._log('km: ', i, mk);
					}else{
						mk = false;
						for(var l in this.current.q[i]) {
							if(
								!this._objIn(this.current.b, l) && 
								!this.current.dn[l] && 
								(
									this.current.q[i][l] == 1 ||
									this.current.q[i][l] == -1
								) &&
								l != 'b'
							) {
								mk = l;
								break;
							}
						}

						var r = this._getRand(1);
						
						if(r == 1) {
							if(!mk) {
								mk = this._objAbsMax(this.current.q[i], this.current.b);
							}
						}else{
							if(!mk) {
								for(var l in this.current.q[i]) {
									if(!this._objIn(this.current.b, l)) {
										mk = l;
										break;
									}
								}
							}
						}												
						
						this._log('mk: ', i, mk);
					}
					
					var mv = this.current.q[i][mk];
					this.current.b[i] = mk;
					
					// change table for 1
					if(mv != 1) {
						for(var m in this.current.q[i]) {
							this.current.q[i][m] = this.current.q[i][m]/mv;
						}
						this.current.a[i] = '÷'+this._round(mv);
					}else{
						this.current.a[i] = '';
					}
					
					// change other cols for 0
					for(var c in this.current.q) {
						var cf = this.current.q[c][mk];
						if(c != i && cf != 0) {
							// change col 'c'
							for(var m in this.current.q[c]) {
								this.current.q[c][m] = -this.current.q[i][m]*cf+this.current.q[c][m];
							}
							
							this.current.a[c] = (cf > 0 ? '-' : '+')+'&'+((i < c) ? 'u' : 'd')+'arr;';
							if(cf != 1 && cf != -1) {
								this.current.a[c] += ' * '+this._round(cf);
							}
						}
					}					

					if(this._objLength(this.current.b) != this.current.k) {
						this.current.r.i++;
						this._print();
					}
				}
			}
		}
		
		
		var flag = true;
		for(var i in this.current.p) {
			if(i == JSON.stringify(this.current.b)) {
				flag = false;
			}
		}		

		//this._log(JSON.stringify(this.current.p)+' '+this.current.r.i);
		//this._log(JSON.stringify(this.current.b)+' '+flag);

		p = JSON.stringify(this.current.b);
		this.current.p[p] = 1;
		this.current.r.i++;
				
		// delta
		for(var i=1; i<=this.current.j; i++) {
			var d = -this.current.l[i];

			for(var j=1; j<=this.current.k; j++) {
				var key = this.current.b[j];
				d += this.current.l[key]*this.current.q[j][i];
			}
			
			this.current.d[i] = d;
		}
		
		// result
		if(this.current.t == 1) {
			k = this._objMax(this.current.d);
			m = this.current.d[k];
		}else if(this.current.t == 2) {
			k = this._objMin(this.current.d);
			m = this.current.d[k];
		}
		
		if(
			(this.current.t == 1 && m <= 0) || 
			(this.current.t == 2 && m >= 0)
		) {
			var l = 0;
			for(var i in this.current.b) {
				var k = this.current.b[i];
				var v = this.current.q[i].b

				this.current.r.v[k] = v;
				l += this.current.l[k]*v;
			}

			this.current.r.l = l;			

			// only positive
			if(this.current.o) {
				k = this._objMin(this.current.r.v);
				v = this.current.r.v[k];
				if(v < 0) {
				
					if(this.repeat <= Math.pow(this.current.k, this.current.j)) {
						flag = false;

						this.repeat++;
						this._log('repeat: ', this.repeat);
						this._calculate();
					}else{
						alert(this.lang.error.no_positive);
					}
				}
			}

			// print
			if(flag)
				this._print();

			// is natural
			if(this.current.n) {
				nFlag = true;
				for(var i in this.current.r.v) {
					v = this._round(this.current.r.v[i]);
					if(v != Math.floor(v)) {
						nFlag = false;
					}
				}

				if(!nFlag) {
					// do gomori
					var t = false;
					var kt = false;
					for(var i in this.current.r.v) {
						if(!t) {
							t = i;
						}
						if(this._getd(this.current.r.v[t]) < this._getd(this.current.r.v[i])) {
							t = i;
						}
					}
					
					//alert(JSON.stringify(this.current.b));
					for(var i in this.current.b) {
						if(this.current.b[i] == t) {
							kt = i;
						}
					}

					q = this._objClone(this.current.q);
					this.current.l = this._objClone(this.save.l);
					//this.current.q = this._objClone(this.save.q);
					
					// change q, j, k
					this.current.j++;
					this.current.l[this.current.j] = 0;
					for(var i = 1; i <= this.current.k; i++) {
						this.current.q[i][this.current.j] = 0;
					}
					this.current.dn[this.current.j] = this.current.j;
					
					// make next q
					this.current.k++;
					this.current.q[this.current.k] = {};
					for(var i in q[kt]) {
						this.current.q[this.current.k][i] = this._getd(q[kt][i])/10;
						if(q[kt][i] < 0) {
							this.current.q[this.current.k][i] = -this._getd(q[kt][i])/10;
						}
					}
					this.current.q[this.current.k][this.current.j] = -1;							
										
					html = '<h3>Метод Гоморі (по x<sub>'+t+'</sub>)</h3>';
					html += this._current('null');
					$('#result').append(html);
					
					this._simplex();
				}
			}
		}else{
			if(this.current.r.i <= Math.pow(this.current.k, this.current.j)) {

				var m = parseInt(this._objAbsMax(this.current.d, this.current.b));
				var n = Math.floor(Math.random()*this.current.k)+1;

				// print
				if(flag)
					this._print();

				this._simplex(n, m);
			}else{
				// repeating
				if($('input[name="f[c]"]').attr('checked') && this.repeat <= Math.pow(this.current.k, this.current.j)) {
					this.repeat++;
					this._log('repeat: ', this.repeat);
					this._calculate();
				}else{
					this.current.r.l = '—';
					this.current.r.i = this._objLength(this.current.p);
					this._print();
				}			
			}
		}
	},
	
	// print
	_print: function() {
		html = '<table>';
		html += '<tr>';
		html += '<td>Б.Р.</td>';
		for(var i=1; i<=this.current.j; i++) {
			html += '<td>x<sub>'+i+'</sub></td>';
		}		
		html += '<td>b<sub>i</sub></td>';
		html += '<td>Дія</td>';
		html += '</tr>';

		for(var i in this.current.q) {
			html += '<tr>';
			html += '<td><b>x<sub>'
			html += (this.current.b[i] != undefined ? this.current.b[i] : '?');
			html += '</sub></b></td>';

			for(var j in this.current.q[i]) {
				html += '<td>'+this._round(this.current.q[i][j])+'</td>';
			}

			if(this.current.a[i]) {
				html += '<td><b>'+this.current.a[i]+'</b></td>';
			}else{
				html += '<td><b>—</b></td>';
			}

			html += '</tr>';
		}		
		
		html += '<tr>';
		html += '<td>Δ</td>';

		var m = this._objAbsMax(this.current.d);
		for(var i=1; i<=this.current.j; i++) {
			html += '<td>';
			if(i == m) {
				html += '<b>';
			}
			html += (this.current.d[i] != undefined ? this._round(this.current.d[i]) : '?');
			if(i == m) {
				html += '</b>';
			}
			html += '</td>';
		}
		html += '<td>&mdash;</td>';
		html += '<td>&nbsp;</td>';
		
		html += '</tr>';
		html += '</table>';

		if(this.current.r.l || this.current.r.l == 0) {
			html += '<h3>Результат</h3>';
			html += 'X = (';
			for(var i=1; i<=this.current.j; i++) {
				if(this.current.r.v[i]) {
					html += this._round(this.current.r.v[i]);
				}else{
					html += '0';
				}
				
				if(i!=this.current.j) {
					html += ',';
				}
			}
			html += ')<br />';
			html += 'L<sub>';

			if(this.current.t == 1) {
				html += 'min';
			}else if(this.current.t == 2) {
				html += 'max';
			}
			
			html += '</sub> = '+this._round(this.current.r.l)+'<br />';
			html += 'Ітерацій: '+this.current.r.i+'<br />';
			html += 'Час студента: '+this._getTime(this.current.r.i, this.tpi)+' хвилин';
		}

		$('#result').append(html);
	},
	
	// round
	_round: function(num) {
		dec = 2;
		if(isNaN(num)) {
			return num;
		}else{
			if(typeof num.toFixed == 'function') {
				var result = Math.round(num*Math.pow(10,dec))/Math.pow(10,dec);
				return result;
			}
		}
	},
	
	// get time
	_getTime: function(i,t) {
		var a = 0;
		for(var k=1; k<=i; k++) {
			a += t;
			t += 3;
		}
		
		return a;
	},

	// get json obj min
	_objMax: function(obj) {
		var j = 0;
		var m;
		var k;
		for(var i in obj) {
			if(j == 0) {
				m = obj[i];
				k = i;
			}else{
				if(obj[i] > m) {
					m = obj[i];
					k = i;
				}
			}			
			
			j++;
		}
		
		return k;
	},

	// get json obj min
	_objMin: function(obj) {
		var j = 0;
		var m;
		var k;
		for(var i in obj) {
			if(j == 0) {
				m = obj[i];
				k = i;
			}else{
				if(obj[i] < m) {
					m = obj[i];
					k = i;
				}
			}			
			
			j++;
		}
		
		return k;
	},

	// get json obj absolute min
	_objAbsMax: function(obj, ni) {
		var j = 0;
		var m;
		var k;
		for(var i in obj) {
			if(j == 0) {
				m = Math.abs(obj[i]);
				k = i;
			}else{
				if(Math.abs(obj[i]) > m && Math.abs(obj[i]) != 0 && !this._objIn(ni, i) && !isNaN(i)) {
					m = Math.abs(obj[i]);
					k = i;
				}
			}			
			
			j++;
		}
		
		return k;
	},

	// get json obj absolute min
	_objAbsMin: function(obj, ni) {
		var j = 0;
		var m;
		var k;
		for(var i in obj) {
			if(j == 0) {
				m = Math.abs(obj[i]);
				k = i;
			}else{
				//this._log('ni: ', ni, i);
				if(Math.abs(obj[i]) < m && Math.abs(obj[i]) != 0 && !this._objIn(ni, i) && !isNaN(i)) {
					m = Math.abs(obj[i]);
					k = i;
				}
			}			
			
			j++;
		}
		
		return k;
	},

	// get json obj in
	_objIn: function(obj, v) {
		for (var k in obj) {
			if(obj[k] == v) {
				return true;
				break;
			}
		}
		
		return false;
	},
		
	// get json obj length
	_objLength: function(obj) {
		var count = 0;
		for (var k in obj) {
			count++;
		}
		
		return count;
	},
	
	// get json next key
	_objNextKey: function(obj) {
		return this._objLength(obj);
	},
	
	// clone
	_objClone: function(o) {
		 if(!o || 'object' !== typeof o)  {
		   return o;
		 }
		 var c = 'function' === typeof o.pop ? [] : {};
		 var p, v;
		 for(p in o) {
		 if(o.hasOwnProperty(p)) {
		  v = o[p];
		  if(v && 'object' === typeof v) {
		    c[p] = this._objClone(v);
		  }
		  else {
		    c[p] = v;
		  }
		 }
		}
	 return c;
	},
	
	// get rand num
	_getRand: function(n) {
		return Math.floor(Math.random()*n);
	},
	
	// get page
	_getPage: function(p) {
		if(p == '#none') return false;
		
		$().jOverlay({
			url: 'pages/'+p.replace('#','')+'.html'
		});
	},

	// get d
	_getd: function(a) {
		var m = a.toString().split('.');
		if(m[1]) {
			return parseInt(m[1]);
		}else{
			return 0;
		}
	},

	// log
	_log: function(a, b, c, d) {
		if(typeof console == 'object') {
			console.log(a, b, c, d);
		}
	},
	
	// sleep
	_sleep: function(milliseconds) {
	  var start = new Date().getTime();
	  for (var i = 0; i < 1e7; i++) {
	    if ((new Date().getTime() - start) > milliseconds){
	      break;
	    }
	  }
	}
}

// events binding
$(document).ready(function () {
	// hash change
	$().bind('hashChange', function() {
		data._getPage(location.hash);
	});
	
	// j minus
	$('input[name="f[jm]"]').bind('click',function () {
		j = $('input[name="f[j]"]').val();
		j--;
		
		if(j > 1) {
			$('input[name="f[j]"]').val(j);
			data._redrawForm();
		}
	});

	// j plus
	$('input[name="f[jp]"]').bind('click',function () {
		j = $('input[name="f[j]"]').val();
		j++;
		
		if(j > 1) {
			$('input[name="f[j]"]').val(j);
			data._redrawForm();
		}
	});

	// k minus
	$('input[name="f[km]"]').bind('click',function () {
		k = $('input[name="f[k]"]').val();
		k--;
		
		if(k > 0) {
			$('input[name="f[k]"]').val(k);
			data._redrawForm();
		}
	});

	// k plus
	$('input[name="f[kp]"]').bind('click',function () {
		k = $('input[name="f[k]"]').val();
		k++;
		
		if(k > 0) {
			$('input[name="f[k]"]').val(k);
			data._redrawForm();
		}
	});

	// calculate
	$('input[name="f[calc]"]').bind('click',function () {
		data.repeat = 0;
		data.save = false;
		data._calculate();
	});

	// example
	$('input[name="f[example]"]').bind('click',function () {
		n = $(this).attr('n');
		data._example(n);
	});
	
	data._redrawForm();
});