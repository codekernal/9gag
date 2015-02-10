<?php

class ProjectController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	private $repo;
	private $mode;	
    public function __construct(ProjectRepo $projectRepo){
    	$this->repo = $projectRepo;
    }	


    public function getProjectCalender()
    {
    	$start = Input::get('start');
    	$end = Input::get('end');    	

    	$resp = $this->repo->getProjectCalender($start, $end);
    	
		if($resp)
		{
			$status = 200;
			$data = $resp;
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'hours status updated',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}
		
        return Response::json($data,$status);    	
    }


    public function getResourceCalender()
    {
    	$projectId = Input::get('project_id');
    	$resourceId = Input::get('project_id');
    	$start = Input::get('start');
    	$end = Input::get('end');    	

    	$resp = $this->repo->getResourceCalender($projectId, $resourceId, $start, $end);
    	
		if($resp)
		{
			$status = 200;
			$data = $resp;
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'hours status updated',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}
		
        return Response::json($data,$status);    	
    }

    public function addUpdateProject()
    {
    	$input = Input::all();
    	if(!empty($input['start_time']))
    	{
			$input['start_time'] = date("H:i", strtotime($input['start_time']));;
    	}
    	if(!empty($input['end_time']))
    	{
			$input['end_time'] = date("H:i", strtotime($input['end_time']));;
    	}

    	$resp = $this->repo->addUpdateProject($input);


		if($resp)
		{
			$status = 200;
			$data = array('status' => 'success', 'file_name' => $resp);
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'Project not added successfuly',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}
        return Response::json($data,$status);

    }


    public function getDashboardStats()
    {
    	$resp = $this->repo->getDashboardStats();
    	
		if($resp)
		{
			$status = 200;
			$data = $resp;
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'notifications status updated',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}
        return Response::json($data,$status);
    }


    public function getDashboardProjects()
    {
    	if($_GET['person_account_data']['mode'] == 'admin')
    		$id = 0;
    	else
    		$id = $_GET['person_account_data']['resource_id'];

    	$resp = $this->repo->getDashboardProjects($id);
    	
		if($resp)
		{
			$status = 200;
			$data = $resp;
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'notifications status updated',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}
        return Response::json($data,$status);
    }

    public function updateInviteStatus()
    {		
    	$id = Input::get('id');
    	$status = Input::get('status');

    	$resp = $this->repo->updateInviteStatus($id, $status);
    	
		if($resp)
		{
			$status = 200;
			$data = $resp;
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'notifications status updated',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}
        return Response::json($data,$status);
    }


    public function getNotifications()
    {
		$account_id = Session::get('user')['account_id'];

    	$resp = $this->repo->getNotifications($account_id);

		if($resp)
		{
			$status = 200;
			$data = $resp;
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'notifications not fetched successfully',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}
        return Response::json($data,$status);

    }


    public function getClients()
    {
    	$project_id = Input::get('project_id');
		$account_id = Session::get('user')['account_id'];

    	$resp = $this->repo->getClients($project_id, $account_id);

		if($resp)
		{
			$status = 200;
			$data = $resp;
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'Clients not fetched successfully',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}
        return Response::json($data,$status);

    }

    public function getServices()
    {
    	$project_id = Input::get('project_id');
    	$client_id = Input::get('client_id');
		$account_id = Session::get('user')['account_id'];

    	$resp = $this->repo->getServices($project_id, $account_id, $client_id);

		if($resp)
		{
			$status = 200;
			$data = $resp;
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'Services not uploaded successfuly',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}
        return Response::json($data,$status);

    }



    public function getSingleProject()
    {	
    	$resp = false;
    	$project_id = Input::get('project_id');
		$account_id = Session::get('user')['account_id'];

    	if(!empty($project_id))
 	   		$resp = $this->repo->getSingleProject($project_id, $account_id);
 	   	
		if($resp)
		{
			$status = 200;
			$data = $resp;
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'Projects not found',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}
        return Response::json($data,$status);

    }


    public function deleteProject()
    {	
    	$resp = false;
    	$project_id = Input::get('project_id');
		$account_id = Session::get('user')['account_id'];

    	if(!empty($project_id))
 	   		$resp = $this->repo->deleteProject($project_id, $account_id);

		if($resp)
		{
			$status = 200;
			$data = $resp;
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'Projects not deleted successfully',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}
        return Response::json($data,$status);

    }

    public function getProjects()
    {
    	$search_key = Input::get('search_key');
    	$sortBy = Input::get('sort_by');
    	$sortOrder = Input::get('sort_order');

    	if(!empty($sortBy) && !empty($sortOrder))
    	{
    		$this->repo->sortBy = $sortBy;
    		$this->repo->sortOrder = $sortOrder;
    	}

    	$resp = $this->repo->getProjects($search_key);

		if($resp)
		{
			$status = 200;
			$data = $resp;
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'Projects not fetched successfully',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}
        return Response::json($data,$status);

    }


    public function upload()
    {
    	$resp = false;
    	if (Input::hasFile('picture') && Input::file('picture')->isValid())
    	{
	    	$pic = Input::file('picture');
	    	$resp = $this->repo->upload($pic);
    	}

		if($resp)
		{
			$status = 200;
			$data = array('status' => 'success', 'file_name' => $resp);
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'Picture not uploaded successfuly',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}
        return Response::json($data,$status);

    }



}
