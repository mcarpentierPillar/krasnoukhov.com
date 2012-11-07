function bubbleSort(array) {
    var swapped;
    do {
        swapped = false;
        for (var i=0; i < array.length-1; i++) {
            if (array[i] > array[i+1]) {
                var temp = array[i];
                array[i] = array[i+1];
                array[i+1] = temp;
                swapped = true;
            }
        }
    } while (swapped);
}

Array.prototype.swap = function(a, b) {
	var tmp = this[a];
	this[a] = this[b];
	this[b] = tmp;
}


function partition(array, begin, end, pivot) {
	var piv = array[pivot];
	array.swap(pivot, end-1);
	var store = begin;
	var ix;
	for(ix = begin; ix < end - 1; ++ix) {
		if(array[ix] <= piv) {
			array.swap(store, ix);
			++store;
		}
	}
	
	array.swap(end-1, store);
	
	return store;
}


function qsort(array, begin, end) {
	if(end-1 > begin) {
		var pivot = begin+Math.floor(Math.random()*(end - begin));

		pivot = partition(array, begin, end, pivot);

		qsort(array, begin, pivot);
		qsort(array, pivot+1, end);
	}
}


function quickSort(array) {
	qsort(array, 0, array.length);
}