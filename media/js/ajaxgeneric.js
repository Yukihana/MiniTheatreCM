/**
 * @package     MiniTheatre.Administrator
 * @subpackage  com_minitheatrecm
 *
 * @copyright   CherrySoft-X 2017, MiniTheatre 2017
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @link        http://minitheatre.org/
 */

function neonAjaxContent(request_url,target_div='neon_ajax',var_prefix='neonajax_',post_params=null)
{
	// Loadscreen
	neonAjaxRenderAlt('loader',target_div,var_prefix);
	
	// Prepare
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if (this.readyState == 4){
			// Done: Success, Error
			if(this.status == 200){
				document.getElementById(target_div).innerHTML = this.responseText;
			}else{
				neonAjaxRenderAlt('error',target_div,var_prefix,this.status);
	}	}	};
	
	// Timeout
	xhttp.timeout = 2000;
	xhttp.ontimeout = function(e){neonAjaxRenderAlt('timeout',target_div,var_prefix);};
	
	// Execute GET or POST
	if(post_params==null){
		xhttp.open("GET", request_url, true);
		xhttp.send();
	}else{
		xhttp.open("POST", request_url, true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send(post_params);
	}
	this.event.returnValue = false;
	return false;
}

// Alternative Renderers
function neonAjaxRenderAlt(type,target_div='neon_ajax',var_prefix='neonajax_',data='')
{
	var r = false;
	if(type=='error'){ // Error404 / Error returning undefined: find out why
		r = neonAjaxSafeVarStr(var_prefix+type+data);
		if( r === false || r == undefined ){
			r = neonAjaxSafeVarStr(var_prefix+type);
	}	}
	else{
		r = neonAjaxSafeVarStr(var_prefix+type);
	}
	
	// Output
	if( r !== false && r !== undefined ){
		document.getElementById(target_div).innerHTML = r;
	}
}

// Subfunctions
function neonAjaxSafeVarStr(var_name,var_default=false)
{
	if( typeof( window[var_name] ) !== undefined ){
		return window[var_name];
	}else{
		return var_default;
	}
}