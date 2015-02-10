<?php

class EducationController extends BaseController {

	private $repo;
	private $mode;	
    public function __construct(EducationRepo $catRepo){
    	$this->repo = $catRepo;
    }	


	public function getEducation()
	{
		$account_id = Session::get('user')['account_id'];
		$id = Input::get('id');
		$resp = $this->repo->getEducation($account_id, $id);
		if($resp)
		{
			$status = 200;
			$data = $resp;
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'Education doesn\'t exists',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}

        return Response::json($data,$status);
	}

	public function delEducation()
	{
		$account_id = Session::get('user')['account_id'];
		$id = Input::get('id');
		$resp = $this->repo->delEducation($account_id, $id);
		if($resp)
		{
			$status = 200;
			$data = array('status' => 'success');
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'Education doesn\'t exists',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}

        return Response::json($data,$status);
	}


	public function addEducation()
	{
		$account_id = Session::get('user')['account_id'];
		$input = Input::all();
		$resp = $this->repo->addUpdateEducation($account_id, $input);
		if($resp)
		{
			$status = 200;
			$data = array('status' => 'success');
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'Education doesn\'t exists',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}

        return Response::json($data,$status);
	}

	public function getEducations()
	{
		$account_id = Session::get('user')['account_id'];

    	$sortBy = Input::get('sort_by');
    	$sortOrder = Input::get('sort_order');

    	if(!empty($sortBy) && !empty($sortOrder))
    	{
    		$this->repo->sortBy = $sortBy;
    		$this->repo->sortOrder = $sortOrder;
    	}
		
		$resp = $this->repo->getEducations($account_id);
		if($resp)
		{
			$status = 200;
			$data = $resp;
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'Categories doesn\'t exists',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}

        return Response::json($data,$status);
	}



}
