<?php

class PersonsController extends BaseController {

	private $repo;
	private $mode;	
    public function __construct(PersonsRepo $personsRepo){
    	$this->repo = $personsRepo;
    }	

    public function login()
    {
    	$email = Input::get('email');
    	$password = Input::get('password');    	
		$resp = $this->repo->login($email, $password);
		if($resp['auth'])
		{
			$status = 200;
			$data = array('status' => 'success', 'account_type' => $resp['account_type']);
		}
		else
		{
	        $status = 401;
	        $data = array('error'=>array('message'=>'User doesn\'t exists',
									     'type'=>'Unauthorized',
									     'code'=>401));
		}
        return Response::json($data,$status);
    }

    public function picUpload()
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


	public function updateProfile()
	{
		$param = array();
		$param['first_name'] = Input::get('first_name');
		$param['last_name'] = Input::get('last_name');
		$param['mobile'] = Input::get('mobile');
		$param['pic_path'] = Input::get('pic_path');
		$userId = Session::get('user')['id'];
		$resp = $this->repo->updateProfile($userId, $param);
		if($resp)
		{
			$status = 200;
			$data = array('status' => 'success', 'msg' => Lang::get('auth.EMAIL_SENT'));
		}
		else
		{
	        $status = 404;
	        $data = array('error'=>array('message'=> Lang::get('auth.NO_EMAIL_EXISTS'),
									     'type'=>'NOTFOUND',
									     'code'=>404));
		}
        return Response::json($data,$status);
	}

	public function sendForgetEmail()
	{
		$email = Input::get('email');
		$resp = $this->repo->sendForgetEmail($email);
		if($resp)
		{
			$status = 200;
			$data = array('status' => 'success', 'msg' => Lang::get('auth.EMAIL_SENT'));
		}
		else
		{
	        $status = 404;
	        $data = array('error'=>array('message'=> Lang::get('auth.NO_EMAIL_EXISTS'),
									     'type'=>'NOTFOUND',
									     'code'=>404));
		}
        return Response::json($data,$status);
	}


	public function confirmAccount($code)
	{
		$resp = $this->repo->verifyAccount($code);
		if($resp)
		{
			$status = 200;
			$data = array('status' => 'success');
		}
		else
		{
	        $status = 404;
	        $data = array('error'=>array('message'=>'Code doesn\'t exists',
									     'type'=>'NOTFOUND',
									     'code'=>404));
		}
        return Response::json($data,$status);
	}

	public function verifyForgot($code)
	{
		$resp = $this->repo->verifyForgot($code);
		if($resp)
		{
			$status = 200;
			$data = array('status' => 'success');
		}
		else
		{
	        $status = 404;
	        $data = array('error'=>array('message'=>'Code doesn\'t exists',
									     'type'=>'NOTFOUND',
									     'code'=>404));
		}
        return Response::json($data,$status);
	}	


	public function updateProfilePassword()
	{
		$password = Input::get('password');
		$currentPassword = Input::get('current_password');	
			
		$resp = $this->repo->updateProfilePassword($password, $currentPassword);
		if($resp)
		{
			$status = 200;
			$data = array('status' => 'success');
		}
		else
		{
	        $status = 404;
	        $data = array('error'=>array('message'=>'password doesn\'t exists',
									     'type'=>'NOTFOUND',
									     'code'=>404));
		}
        return Response::json($data,$status);
	}	
	public function updatePassword()
	{
		$password = Input::get('password');
		$code = Input::get('code');	
			
		$resp = $this->repo->updatePassword($password, $code);
		if($resp)
		{
			$status = 200;
			$data = array('status' => 'success');
		}
		else
		{
	        $status = 404;
	        $data = array('error'=>array('message'=>'Code doesn\'t exists',
									     'type'=>'NOTFOUND',
									     'code'=>404));
		}
        return Response::json($data,$status);
	}	
}
