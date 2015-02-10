<?php

class ServiceController extends BaseController {

	private $repo;
    public function __construct(ServiceRepo $serviceRepo){
    	$this->repo = $serviceRepo;
    }	

	public function addService()
	{
		$accountId = Session::get('user')['account_id'];
		$name = Input::get('name');
		$employee_price = Input::get('employee_price');
		$client_price = Input::get('client_price');
		$client_id = Input::get('client_id');
		$desc = Input::get('desc');
		$resp = $this->repo->insertService($accountId, $name, $employee_price, $client_price, $desc, $client_id);

		if($resp)
		{
			$status = 200;
			$data = array('status' => 'success');
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'service doesn\'t exists',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}
        return Response::json($data,$status);						
	}

	public function updateService()
	{
		$id = Input::get('id');
		$name = Input::get('name');
		$employee_price = Input::get('employee_price');
		$client_id = Input::get('client_id');		
		$desc = Input::get('desc');
		$client_price = Input::get('client_price');
		$resp = $this->repo->updateService($id, $name,$employee_price, $client_price, $desc, $client_id);

		if($resp)
		{
			$status = 200;
			$data = array('status' => 'success');
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'service doesn\'t exists',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}
        return Response::json($data,$status);						
	}


	public function deleteService()
	{
		$id = Input::get('id');
		$resp = $this->repo->deleteService($id);

		if($resp)
		{
			$status = 200;
			$data = array('status' => 'success');
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'service doesn\'t exists',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}
        return Response::json($data,$status);						
	}


	public function allServices()
	{
		$accountId = Session::get('user')['account_id'];
    	$sortBy = Input::get('sort_by');
    	$sortOrder = Input::get('sort_order');
    	$clientId = Input::get('client_id');
    	if(empty($clientId))
    		$clientId = 0;

    	if(!empty($sortBy) && !empty($sortOrder))
    	{
    		$this->repo->sortBy = $sortBy;
    		$this->repo->sortOrder = $sortOrder;
    	}

		$resp = $this->repo->allServices($accountId, $clientId);

		if($resp)
		{
			$status = 200;
			$data = $resp;
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'client doesn\'t exists',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}
        return Response::json($data,$status);						
	}


	public function getService()
	{
		$id = Input::get('id');
		$resp = $this->repo->getService($id);

		if($resp)
		{
			$status = 200;
			$data = $resp;
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'client doesn\'t exists',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}
        return Response::json($data,$status);						
	}



}
