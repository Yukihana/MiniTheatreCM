function mtcmPagerNav( pagerprefix, task )
{
	var pager = document.getElementById( pagerprefix + 'pager' );
	var entries = document.getElementsByName( pagerprefix + 'entry' );
	var maxc = entries.length;
	var activeindex = parseInt(pager.getAttribute('activeindex'));
	var nextactive = activeindex;
	
	switch(task)
	{
		case 'previous':
			if(activeindex!=0)
				nextactive=activeindex-1;
			break;
		case 'next':
			if(activeindex!=maxc-1)
				nextactive=activeindex+1;
			break;
		case 'last':
			nextactive=maxc-1;
			break;
		default:
			nextactive=0;
	}
	
	pager.setAttribute('activeindex', nextactive);
	document.getElementById( pagerprefix + 'index' ).innerHTML = (nextactive==0)? "Latest" : (nextactive+' / '+(maxc-1));
	
	entries.forEach(
		function(item,index,arr){
			item.style.display= (index==nextactive)?'block':'none';
		});
}