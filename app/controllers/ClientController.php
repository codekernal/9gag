<?php

class ClientController extends BaseController {

	private $repo;
    public function __construct(ClientRepo $clientRepo){
    	$this->repo = $clientRepo;
    }	

    public function addClient()
    {
    	$params = array();
    	$params['account_id'] = Session::get('user')['account_id'];
    	$params['first_name'] = Input::get('first_name');
    	$params['last_name'] = Input::get('last_name');
    	$params['phone'] = Input::get('phone');
    	$params['mobile'] = Input::get('mobile');
    	$params['fax'] = Input::get('fax');
    	$params['company_name'] = Input::get('company_name');

    	$params['email'] = Input::get('email');
    	$params['street_address'] = Input::get('street_address');
    	$params['zip'] = Input::get('zip');
    	$params['city'] = Input::get('city');
    	$params['country'] = Input::get('country');

    	$params['invoice_city'] = Input::get('invoice_city');
    	$params['invoice_zip'] = Input::get('invoice_zip');
    	$params['invoice_country'] = Input::get('invoice_country');
    	$params['express_price'] = Input::get('express_price');
    	$params['invoice_street_address'] = Input::get('invoice_street_address');

		$resp = $this->repo->insertClient($params);
		if($resp)
		{
			$status = 200;
			$data = array('status' => 'success');
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

    public function updateClient()
    {
    	$params = array();
    	$params['id'] = Input::get('id');
    	$params['first_name'] = Input::get('first_name');
    	$params['last_name'] = Input::get('last_name');
    	$params['phone'] = Input::get('phone');
    	$params['mobile'] = Input::get('mobile');
    	$params['company_name'] = Input::get('company_name');    	
    	$params['fax'] = Input::get('fax');
    	$params['email'] = Input::get('email');
    	$params['street_address'] = Input::get('street_address');
    	$params['zip'] = Input::get('zip');
    	$params['city'] = Input::get('city');
    	$params['country'] = Input::get('country');
    	$params['invoice_city'] = Input::get('invoice_city');
    	$params['invoice_zip'] = Input::get('invoice_zip');
    	$params['invoice_country'] = Input::get('invoice_country');
    	$params['express_price'] = Input::get('express_price');
    	$params['invoice_street_address'] = Input::get('invoice_street_address');
    	
		$resp = $this->repo->updateClient($params);
		if($resp)
		{
			$status = 200;
			$data = array('status' => 'success');
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

	public function deleteClient()
	{
		$id = Input::get('id');
		$resp = $this->repo->deleteClient($id);

		if($resp)
		{
			$status = 200;
			$data = array('status' => 'success');
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


	public function allClients()
	{
		$accountId = Session::get('user')['account_id'];
		$search_key = Input::get('search_key');		
    	$sortBy = Input::get('sort_by');
    	$sortOrder = Input::get('sort_order');

    	if(!empty($sortBy) && !empty($sortOrder))
    	{
    		$this->repo->sortBy = $sortBy;
    		$this->repo->sortOrder = $sortOrder;
    	}

		$resp = $this->repo->allClients($accountId, $search_key);

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

	public function getClient()
	{
		$id = Input::get('id');
		$resp = $this->repo->getClient($id);

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
