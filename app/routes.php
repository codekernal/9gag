<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

$_GET['person_account_data']  = array('role_id' => 0);
if(Session::has('user'))
{
	$user_session = Session::get('user');
	if(isset($user_session['account_id']))
	{
		$person_account_data = PersonAccounts::where('account_id', $user_session['account_id'])->where('resource_id', $user_session['id']);
		if($person_account_data->count() > 0)
		{
			$_GET['person_account_data'] = $person_account_data->first()->toArray();
//echo $user_session['id'];die();			
		}
	}
}


if(isset($_GET['lang']) && ($_GET['lang'] == 'gr' || $_GET['lang'] == 'en'))
{
	Session::put('lang', $_GET['lang']);
}

if(Session::has('lang'))
	App::setLocale(Session::get('lang'));
else
	App::setLocale('en');	

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('logout', function()
{
	Session::flush();
	return Redirect::to('login');	
});



Route::get('login', 'PlannerController@showLogin');
Route::get('signup', 'PlannerController@showSignup');
Route::get('services', 'PlannerController@showServices');
Route::get('profile', 'PlannerController@showProfile');
Route::get('clients', 'PlannerController@showClients');
Route::get('categories', 'PlannerController@showCategories');
Route::get('decline', 'PlannerController@declineInvitation');
Route::get('accept', 'PlannerController@acceptInvitation');
Route::get('launchpad', 'PlannerController@showLaunchpad');
Route::get('access_denied', 'PlannerController@accessDenied');
Route::get('settings', 'PlannerController@showSettings');



Route::get('dashboard', 'PlannerController@showDashboard');
Route::get('resources', 'PlannerController@showResources');
Route::get('confirm/{code}', 'PlannerController@showConfirm');
Route::get('confirm/{code}', 'PlannerController@showConfirm');
Route::get('forgot/{code}', 'PlannerController@showForgot');

// Api Calls
Route::post('api/account', 'AccountsController@addUser');
Route::put('api/profile', 'PersonsController@updateProfile');
Route::post('picture/upload', 'PersonsController@picUpload');
Route::post('vehicle/upload', 'ResourceController@vehicleUpload');
Route::post('company/upload', 'AccountsController@CompanyUpload');

Route::post('api/login', 'PersonsController@login');
Route::post('api/forgot', 'PersonsController@sendForgetEmail');
//Route::get('api/forgot/{code}', 'PersonsController@verifyForgot');
Route::post('api/password', 'PersonsController@updatePassword');
Route::post('api/password_update', 'PersonsController@updateProfilePassword');


Route::post('api/client', 'ClientController@addClient');
Route::put('api/client', 'ClientController@updateClient');
Route::get('api/client', 'ClientController@getClient');
Route::get('api/clients', 'ClientController@allClients');
Route::delete('api/client', 'ClientController@deleteClient');
Route::post('project/upload', 'ProjectController@upload');
Route::post('api/service', 'ServiceController@addService');
Route::get('api/service', 'ServiceController@getService');
Route::put('api/service', 'ServiceController@updateService');
Route::delete('api/service', 'ServiceController@deleteService');
Route::get('api/services', 'ServiceController@allServices');
Route::post('api/resource', 'ResourceController@resource');
Route::get('api/resources', 'ResourceController@resources');
Route::get('api/vehicle', 'ResourceController@singleVehicle');
Route::put('api/vehicle', 'ResourceController@updateVechile');
Route::get('api/person', 'ResourceController@singlePerson');
Route::post('api/project', 'ProjectController@addUpdateProject');
Route::get('api/project', 'ProjectController@getSingleProject');
Route::get('api/project_resources', 'ResourceController@getProjectResources');
Route::get('projects', 'PlannerController@showProject');
Route::delete('api/project', 'ProjectController@deleteProject');
Route::get('api/projects', 'ProjectController@getProjects');
Route::get('api/project_services', 'ProjectController@getServices');
Route::get('api/project_clients', 'ProjectController@getClients');
Route::delete('api/delete_resource', 'ResourceController@deleteResource');
Route::get('api/categories', 'CategoryController@getCategories');
Route::post('api/category', 'CategoryController@addCategory');
Route::delete('api/category', 'CategoryController@delCat');
Route::get('api/category', 'CategoryController@getCategory');

Route::get('api/educations', 'EducationController@getEducations');
Route::post('api/education', 'EducationController@addEducation');
Route::delete('api/education', 'EducationController@delEducation');
Route::get('api/education', 'EducationController@getEducation');

Route::get('api/salary_types', 'SalaryTypesController@getSalaryTypes');
Route::post('api/salary_type', 'SalaryTypesController@addSalaryType');
Route::delete('api/salary_type', 'SalaryTypesController@delSalaryType');
Route::get('api/salary_type', 'SalaryTypesController@getSalaryType');


Route::post('api/account_session', 'AccountsController@updateAccountSesssion');
Route::get('api/notifications', 'ProjectController@getNotifications');
Route::post('api/invite_status', 'ProjectController@updateInviteStatus');
Route::put('api/company_profile', 'AccountsController@updateCompanyProfile');
Route::get('api/night_shift', 'SurchargeController@getNightShift');
Route::put('api/night_shift', 'SurchargeController@updateNightShift');
Route::put('api/night_shift', 'SurchargeController@updateNightShift');
Route::put('api/holidays', 'SurchargeController@addHolidays');
Route::get('api/holidays', 'SurchargeController@getHolidays');

Route::get('api/getdashboardprojects', 'ProjectController@getDashboardProjects');
Route::get('api/get_resource_schedule', 'ProjectController@getResourceCalender');
Route::get('api/get_project_schedule', 'ProjectController@getProjectCalender');
Route::post('api/years_salary', 'CategoryController@updateYearSalaries');
Route::get('api/get_salary', 'ResourceController@getSalary');
Route::get('api/get-hour-stats', 'ProjectController@getDashboardStats');
Route::post('api/task', 'TaskController@addUpdateTask');
Route::get('api/tasks', 'TaskController@allTasks');
Route::delete('api/task', 'TaskController@deleteTask');
Route::get('api/task', 'TaskController@singleTask');

Route::get('trend/add','TrendController@addTrend');
Route::get('trend/get','TrendController@getTrend');
Route::get('trend/edit','TrendController@editTrend');
Route::get('trend/dlt','TrendController@dltTrend');

/*
	New Routes
*/

//category routes
Route::post('api/category/add','CategoryController@addCategory');
Route::get('api/category/get','CategoryController@getCategory');
Route::put('api/category/edit','CategoryController@editCategory');
Route::delete('api/category/dlt','CategoryController@dltCategory');

//video routes
Route::post('api/video/add','VideoController@addVideo');
Route::get('api/video/get','VideoController@getVideo');
Route::put('api/video/edit','VideoController@editVideo');
Route::delete('api/video/dlt','VideoController@dltVideo');

//view count
Route::get('api/video/view','VideoController@view_count');

//share count
Route::get('api/video/share','VideoController@share_count');

//vote_up/vote_down
Route::get('api/video/vote','VideoController@vote');
Route::get('api/video/log','VideoController@log');
