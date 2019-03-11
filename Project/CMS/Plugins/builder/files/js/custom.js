$("a[class^='gallery-']").unbind();

$('.featured').magnificPopup({
	type:'image',
	callbacks: {
		elementParse: function(item) {
			// Function will fire for each target element
			// "item.el" is a target DOM element (if present)
			// "item.src" is a source that you may modify

			console.log(item); // Do whatever you want with "item" object
		}
	},
	gallery: {
		enabled: true
	}
});