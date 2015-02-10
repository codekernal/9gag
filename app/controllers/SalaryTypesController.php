<?php

class SalaryTypesController extends BaseController {

	private $repo;
	private $mode;	
    public function __construct(SalaryTypesRepo $catRepo){
    	$this->repo = $catRepo;
    }	


	public function getSalaryType()
	{
		$account_id = Session::get('user')['account_id'];
		$id = Input::get('id');
		$resp = $this->repo->getSalaryType($account_id, $id);
		if($resp)
		{
			$status = 200;
			$data = $resp;
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'Salary Type doesn\'t exists',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}

        return Response::json($data,$status);
	}

	public function delSalaryType()
	{
		$account_id = Session::get('user')['account_id'];
		$id = Input::get('id');
		$resp = $this->repo->delSalaryType($account_id, $id);
		if($resp)
		{
			$status = 200;
			$data = array('status' => 'success');
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'Salary Type doesn\'t exists',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}

        return Response::json($data,$status);
	}


	public function addSalaryType()
	{
		$account_id = Session::get('user')['account_id'];
		$input = Input::all();
		$resp = $this->repo->addUpdateSalaryType($account_id, $input);
		if($resp)
		{
			$status = 200;
			$data = array('status' => 'success');
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'Salary Type doesn\'t exists',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}

        return Response::json($data,$status);
	}

	public function getSalaryTypes()
	{
		$account_id = Session::get('user')['account_id'];
		$resp = $this->repo->getSalaryTypes($account_id);
		if($resp)
		{
			$status = 200;
			$data = $resp;
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'Salary Types doesn\'t exists',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}

        return Response::json($data,$status);
	}



}
