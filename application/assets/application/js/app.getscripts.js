(function( jQuery ) {
 
	var getScript = jQuery.getScript;
 
	jQuery.getScripts = function( resources, callback ) {
		var // reference declaration & localization
		length = resources.length, 
		handler = function() { counter++; },
		deferreds = [],
		counter = 0, 
		idx = 0;
 
		for ( ; idx < length; idx++ ) {
			deferreds.push(
				getScript( resources[ idx ], handler )
			);
		}
 
		jQuery.when.apply( null, deferreds ).then(function() {
			callback && callback();
		});
	};
 
})( jQuery );