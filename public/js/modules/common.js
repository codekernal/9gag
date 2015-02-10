var server = window.location.hostname;
var canvas_url = "";
if (server == 'localhost' ) {
    canvas_url = location.protocol + "//" + server + "/planner/public/";
} else {
    canvas_url = location.protocol + "//planner.alcolm.software/public/";

}

var api_url = canvas_url + "api/";

function searchModule(module)
{
	var module = $('#search_module').val();
	if(module == 'clients')
	{
		getClients();
	}
	else if(module == 'resources')
	{
		getResources();
	}
	else if(module == 'projects')
	{
		getProjects();
	}
}

function sortbyFunc(sort, sortbystr, module)
{
	sortBy = sortbystr;
	obj = '.'+sortbystr;
	if(sort == 'all')
	{
		sortOrder = 'asc';
		$('.fa-sort').show();
		$('.fa-sort-asc').hide();
		$('.fa-sort-desc').hide();
		$(obj+'all').hide();
		$(obj+'desc').hide();
		$(obj+'asc').show();
	}
	else if(sort == 'asc')
	{
		sortOrder = 'desc';
		$('.fa-sort').show();
		$(obj+'all').hide();
		$(obj+'asc').hide();
		$(obj+'desc').show();
	}
	else if(sort == 'desc')
	{
		sortOrder = 'asc';
		$('.fa-sort').show();
		$(obj+'all').hide();
		$(obj+'desc').hide();
		$(obj+'asc').show();
	}

	if(module == 'projects')
	    getProjects();	
	else if(module == 'services')
	    getServices();		
	else if(module == 'clients')
	    getClients();
	else if(module == 'categories')
		getCategories()
	else if(module == 'education')
		getEducations()	
}