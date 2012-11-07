window.onload = function() {
	//document.getElementsByTagName("form")[0].onsubmit = function() {
	document.getElementById("btn-submit").onclick = function() {
	
		var value = parseInt(document.getElementsByName("size")[0].value);
		
		//validating form data
		if(value == '' || isNaN(value) || value < 1) {
			alert("Enter array size!");
		} else {
	
			var size = document.getElementsByName("size")[0].value;
			var arr1 = new Array();
			var	arr2 = new Array();
			
			//filling arrays with random values
			for (i = 0; i < size; i++) {
				arr1[i] = Math.floor(Math.random()*3001);
				arr2[i] = arr1[i];
			}
					
			//measuring time of sorting
			var start = new Date();
			quickSort(arr1);
			var end = new Date();			
			var result1 = end.getTime() - start.getTime();
			
			var start = new Date();
			bubbleSort(arr2);
			var end = new Date();
			var result2 = end.getTime() - start.getTime();
			alert("QuickSort sorting time = "+result1+"ms\nBubbleSort sorting time = "+result2+"ms");
		}
			
		return false;
	}
};