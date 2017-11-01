function mtcmPagerNav(prefix,task)
{
	var pager=document.getElementById(prefix+'-pagepanel');
	var entries=document.getElementsByName(prefix+'-entry');
	var indexer=document.getElementById(prefix+'-index');
	var maxc=entries.length;
	var activeindex=parseInt(pager.getAttribute('activeindex'));
	var nextactive=activeindex;
	
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
	
	pager.setAttribute('activeindex',nextactive);
	
	if(indexer!=null)
	{
		indexer.innerHTML=(nextactive+1)+' / '+(maxc);
	}
	
	entries.forEach(
		function(item,index,arr){
			item.style.display=(index==nextactive)?'block':'none';
		});
}

function mtcmTabberNav(prefix,active,tabname)
{
	var pager=document.getElementById(prefix+'-tabpanel');
	var entries=document.getElementsByName(prefix+'-entry');
	var indexer=document.getElementById(prefix+'-index');
	
	if(indexer!=null)
	{
		indexer.innerHTML=(typeof tabname!=='undefined')?tabname:'';
	}
	
	entries.forEach(
		function(item,index,arr){
			item.style.display=(index==active)?'block':'none';
		});
}