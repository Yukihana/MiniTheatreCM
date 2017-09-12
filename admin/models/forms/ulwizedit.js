jQuery(function(){
	document.formvalidator.setHandler('wname',
		function (value) {
			regex=/^[^0-9]+$/;
			return regex.test(value);
		});
});