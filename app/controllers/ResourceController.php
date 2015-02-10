<?php

class ResourceController extends BaseController {

	private $repo;
	private $mode;	
    public function __construct(ResourceRepo $resourceRepo){
    	$this->repo = $resourceRepo;
    }	

    public function vehicleUpload()
    {
    	$resp = false;
    	if (Input::hasFile('vehicle_picture') && Input::file('vehicle_picture')->isValid())
    	{
	    	$pic = Input::file('vehicle_picture');
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


    public function getSalary()
    {
    	$id = Input::get('id');
    	$hire_date = Input::get('hire_date');    	
    	$cat_id = Input::get('cat_id');    	
    	$resp = $this->repo->getSalary($id, $hire_date, $cat_id);

		if($resp)
		{
			$status = 200;
			$data = $resp;
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'Resources not found',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}
        return Response::json($data,$status);

    }

    public function resources()
    {
    	$keyword = Input::get('keyword');
    	$resp = $this->repo->resources('', $keyword);

		if($resp)
		{
			$status = 200;
			$data = $resp;
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'Resources not found',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}
        return Response::json($data,$status);

    }


    public function resource()
    {
    	$id = Input::get('id');
    	$input = Input::all();
    	
    	$resource_type = Input::get('resource_type');
    	if(empty($id) && $resource_type == 'vehicle')
    		$resp = $this->repo->addVehicle($input);
    	else if(empty($id) && $resource_type == 'person')
    		$resp = $this->repo->addPerson($input);
    	else if(!empty($id) && $resource_type == 'vehicle')
    		$resp = $this->repo->updateVehicle($id, $input);
    	else if(!empty($id) && $resource_type == 'person')
    		$resp = $this->repo->updatePerson($id, $input);

		if($resp)
		{
			$status = 200;
			$data = array('status' => 'success');
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


    public function deleteResource()
    {
    	$id = Input::get('id');
    	$type = Input::get('type');

    	$resp = false;
    	
    	if(!empty($id) && !empty($type))
    	{
    		$resp = $this->repo->deleteResource($id, $type);
    	}

		if($resp)
		{
			$status = 200;
			$data = array('status' => 'success');
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'resource not found',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}
        return Response::json($data,$status);

    }

    public function singlePerson()
    {
    	$id = Input::get('id');
    	$resp = false;
    	if(!empty($id))
    	{
    		$resp = $this->repo->singlePerson($id);
    	}

		if($resp)
		{
			$status = 200;
			$data = $resp;
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'Person not found',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}
        return Response::json($data,$status);

    }



    public function getProjectResources()
    {
    	$project_id = Input::get('project_id');
    	$service_id = Input::get('service_id');
    	$task_id = Input::get('task_id');

    	$resp = false;
   		$resp = $this->repo->getProjectResources($task_id, $service_id);

		if($resp)
		{
			$status = 200;
			$data = $resp;
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'resoruces not found',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}
        return Response::json($data,$status);

    }
    public function singleVehicle()
    {
    	$id = Input::get('id');
    	$resp = false;
    	if(!empty($id))
    	{
    		$resp = $this->repo->getVehicle($id);
    	}

		if($resp)
		{
			$status = 200;
			$data = $resp;
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'Vehicle not found',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}
        return Response::json($data,$status);

    }

}
