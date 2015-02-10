<?php

class AccountsController extends BaseController {

	private $repo;
	private $mode;	
    public function __construct(AccountsRepo $accountsRepo, PersonsRepo $personRepo){
    	$this->repo = $accountsRepo;
    	$this->personRepo = $personRepo;

    }	

    public function companyUpload()
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

    public function updateCompanyProfile()
    {
        $account_id = Session::get('user')['account_id'];    	
    	$company_name = Input::get('company_name');
    	$timezone = Input::get('timezone');
    	$logo = Input::get('pic_path');

    	$resp = $this->repo->updateCompanyProfile($account_id, $company_name, $timezone, $logo);

		if($resp)
		{
			$status = 200;
			$data = array('status' => 'success');
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'Company profile not uploaded successfuly',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}
        return Response::json($data,$status);    	
    }

	public function addUser()
	{
		$params = array();
		$companyName = Input::get('company_name');
		$params['email'] = Input::get('email');
		$emailExists = $this->personRepo->isPersonExists('email', $params['email']);

		if(!$emailExists)
		{
			// Add company
			$accountId = $this->repo->insert($companyName);

			// add person as profile
			$personObj = new PersonsRepo();
			$params['password'] = Input::get('password');
			$params['first_name'] = Input::get('first_name');
			$params['last_name'] = Input::get('last_name');		
			$params['pic'] = Input::get('pic');		
			$params['is_verified'] = '0';		
			$params['status'] = 'inactive';		
			$personId = $personObj->insert($params);

			// insert into person account
			$this->repo->addPersonAccount($personId, $accountId, 'admin', $params['first_name'], $params['last_name']);

			if($personId)
			{
				$personObj->login($params['email'], $params['password']);				
				$status = 200;
				$data = array('status' => 'success');
			}
			else
			{
		        $status = 409;
		        $data = array('error'=>array('message'=>'Email already eixsts',
										     'type'=>'CONFLICT',
										     'code'=>409));
			}			
		}
		else
		{
		        $status = 409;
		        $data = array('error'=>array('message'=>'Email already eixsts',
										     'type'=>'CONFLICT',
										     'code'=>409));
		}

        return Response::json($data,$status);
	}

	public function updateAccountSesssion()
	{
		$account_id = Input::get('account_id');
		if(!empty($account_id))
		{
			$sessionData = Session::get('user');		
			$sessionData['account_id'] = $account_id;
			Session::put('user', $sessionData);
	        return Response::json(array('status' => 'success'),200);
		}
		else
		{
		        $data = array('error'=>array('message'=>'account not assigned',
										     'type'=>'CONFLICT',
										     'code'=>401));			
	        return Response::json($data,401);

		    }


	}

}
