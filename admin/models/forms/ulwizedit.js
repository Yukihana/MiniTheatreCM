jQuery(function(){
	document.formvalidator.setHandler('wname',
		function (value) {
			regex=/^[a-zA-Z_]/;
			return regex.test(value);
		});
});