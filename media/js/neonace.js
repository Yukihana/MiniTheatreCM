/**
 * @package     MiniTheatre.Administrator
 * @subpackage  com_minitheatrecm
 *
 * @copyright   CherrySoft-X 2017, MiniTheatre 2017
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @link        http://minitheatre.org/
 */

// Ajax Content Execution Script (Basic)
function neonAceBasic( request_url, target_div = "neon_ajax", post_params = null )
{
	// Prepare the ajax request
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
		if ( this.readyState == 4 )
		{
			// Done: Success, Error
			if( this.status == 200 )
			{
				document.getElementById( target_div ).innerHTML = this.responseText;
			}
		}
	};

	// Send a GET request
	if( post_params == null )
	{
		xhttp.open( "GET", request_url, true );
		xhttp.send();
	}

	// Send a POST request
	else
	{
		xhttp.open( "POST", request_url, true );
		xhttp.setRequestHeader( "Content-type", "application/x-www-form-urlencoded" );
		xhttp.send( post_params );
	}
}

// Ajax Content Execution Script (Advanced)
function neonAce( request_url, myprefix = "neon_", cancel_nav = true, post_params = null, timeout = 5000 )
{
	// Loadscreen
	neonAceLoader( myprefix );

	// Prepare ajax events
	var xhttp = neonAcePrepare( myprefix, timeout );

	// Send
	neonAceSend( xhttp, request_url, post_params );

	// Cancel Navigation if applicable
	if( cancel_nav == true )
	{
		this.event.returnValue = false;
		return false;
	}
}

// Internal
function neonAcePrepare( myprefix = "neon_", timeout = 5000 )
{
	var xhttp					= new XMLHttpRequest();
	xhttp.onreadystatechange	= function(e){ neonAceEvent(this, myprefix, e); };
	xhttp.timeout				= timeout;
	xhttp.ontimeout				= function(e){ neonAceTimeout( myprefix, e ); };

	return xhttp;
}

function neonAceSend( xhttp, request_url, post_params = null )
{
	// Send a GET request
	if( post_params == null )
	{
		xhttp.open( "GET", request_url, true );
		xhttp.send();
	}

	// Send a POST request
	else
	{
		xhttp.open( "POST", request_url, true );
		xhttp.setRequestHeader( "Content-type", "application/x-www-form-urlencoded" );
		xhttp.send( post_params );
	}
}

// Actions
function neonAceLoader( myprefix = "neon_" )
{
	var r = neonAceGetVar( "loader", myprefix );

	if( r !== false )
	{
		neonAceShowAlt( r, myprefix );
	}
}

function neonAceEvent( xhttp, myprefix = "neon_", eventdata = null )
{
	// On Recieve Completed
	if( xhttp.readyState == 4 )
	{
		// On Success
		if( xhttp.status == 200 )
		{
			neonAceShowMain( xhttp.responseText, myprefix );
		}
		
		// On Error
		else
		{
			neonAceError( myprefix, xhttp.status, eventdata );
		}
	}
}

function neonAceTimeout( myprefix = "neon_", eventdata = null )
{
	var r = neonAceGetVar( "timeout", myprefix );

	if( r !== false )
	{
		neonAceShowAlt( r, myprefix );
	}
}

function neonAceError( myprefix = "neon_", errorcode = null, eventdata = null )
{
	var r = false;
	if( errorcode != null )
	{
		r = neonAceGetVar( "error" + errorcode, myprefix );
	}
	if( r === false )
	{
		r = neonAceGetVar( "error", myprefix );
	}

	if( r !== false )
	{
		neonAceShowAlt( r, myprefix );
	}
}

// Core
function neonAceShowMain( displaycontent, myprefix = "neon_" )
{
	var target = document.getElementById( myprefix + "ajax" );
	var msgbox = document.getElementById( myprefix + "msgbox" );
	var overlay = document.getElementById( myprefix + "overlay" );

	// Write to main, or log error and exit
	if( target != null )
	{
		if( displaycontent.toLowerCase() != "(-revert-)" )
		{
			target.innerHTML = displaycontent;
		}
	}
	else
	{
		neonAceErrorToConsole( "Target element missing: " + myprefix + "ajax" );
		return;
	}

	// If Overlay exists: Unblur and Enable Main, Hide Overlay
	if( overlay != null )
	{
		if( target.style.filter.indexOf("blur(3pt)") !== -1 )
		{
			target.style.filter = target.style.filter.replace("blur(3pt)", "").replace("  ", " ").trim();
		}
		target.style.pointerEvents = "initial";
		overlay.style.visibility = "hidden";
	}

	// If Msgbox exists: Clean it
	if( msgbox != null )
	{
		msgbox.innerHTML = "";
	}
}

function neonAceShowAlt( displaycontent, myprefix = "neon_" )
{
	// Revert if instructed
	if( displaycontent == "(-revert-)" )
	{
		neonAceShowMain( displaycontent, myprefix );
		return;
	}

	var target = document.getElementById( myprefix + "ajax" );
	var msgbox = document.getElementById( myprefix + "msgbox" );
	var overlay = document.getElementById( myprefix + "overlay" );

	if( msgbox != null )
	{
		// Validate msgbox, Data and write or revert
		msgbox.innerHTML = displaycontent;

		// Validate Overlay and show it.
		if( overlay != null )
		{
			overlay.style.visibility = "initial";
		}
		
		// Validate Main and blur/disable it.
		if( target != null )
		{
			if( target.style.filter.indexOf("blur(3pt)") === -1 )
			{
				target.style.filter = ( target.style.filter + " blur(3pt)" ).replace("  ", " ").trim();
			}
			target.style.pointerEvents = "none";
		}
	}
	else if( target != null )
	{
		// Validate Main and write to it
		target.innerHTML = displaycontent;
	}
	else 
	{
		// If Main is missing, show overlay anyway
		if( overlay != null )
		{
			overlay.style.visibility = "initial";
		}
		
		// Log error to console if Main is missing
		neonAceErrorToConsole( "Target element missing: " + myprefix + "ajax" );
	}
}

// Helpers
function neonAceGetVar( var_name, myprefix = "neon_", var_default = false )
{
	// Get store
	if( window.hasOwnProperty( myprefix + "store" ))
	{
		var store = window[ myprefix + "store" ];
		
		// Get data
		if( store.hasOwnProperty( var_name ))
		{
			var r = store[ var_name ];

			// Return if string
			if( typeof r == "string" )
			{
				return r;
			}
			else
			{
				return r.toString();
			}
		}
	}

	return var_default;
}

function neonAceErrorToConsole( msg = "NeonAceError", e = null )
{
	console.error( msg );
}
