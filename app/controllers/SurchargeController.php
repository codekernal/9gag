<?php

class SurchargeController extends BaseController {

	private $repo;
	private $mode;	
    public function __construct(SurchargeRepo $catRepo){
    	$this->repo = $catRepo;
    }	

    public function addHolidays()
    {
		$account_id = Session::get('user')['account_id'];
		$resp = $this->repo->addHolidays($account_id, Input::all());
		if($resp)
		{
			$status = 200;
			$data = $resp;
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'Surcharge doesn\'t exists',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}

        return Response::json($data,$status);
    }

	public function getHolidays()
	{
		$account_id = Session::get('user')['account_id'];
		$resp = $this->repo->getHolidays($account_id);
		if($resp)
		{
			$status = 200;
			$data = $resp;
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'Surcharge doesn\'t exists',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}

        return Response::json($data,$status);
	}

	public function getNightShift()
	{
		$account_id = Session::get('user')['account_id'];
		$resp = $this->repo->getNightShift($account_id);
		if($resp)
		{
			$status = 200;
			$data = $resp;
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'Surcharge doesn\'t exists',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}

        return Response::json($data,$status);
	}

	public function updateNightShift()
	{
		$account_id = Session::get('user')['account_id'];
		$start_time = Input::get('start_time');		
		$end_time = Input::get('end_time');		
		$raise = Input::get('night_shift_raise');		
		$resp = $this->repo->updateNightShift($account_id, $start_time, $end_time, $raise);		
        return Response::json(array('status' => 'success'),200);
	}

}
