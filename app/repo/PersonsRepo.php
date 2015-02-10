<?php

class PersonsRepo
{	
	public function insert($params)
	{
		if($this->isPersonExists('email', $params['email']) === 0)
		{
			$code = Utility::getCode();
			$person = new Persons();
			$person->email = $params['email'];		
			$person->password = Hash::make($params['password']);
			$person->first_name = $params['first_name'];
			$person->last_name = $params['last_name'];
			$person->pic = $params['pic'];
			$person->code = Utility::getCode();
			$person->status = $params['status'];
			$person->is_verified = $params['is_verified'];		
			$personId = $person->save();

			// send email to user
			$params['link'] = URL::to('confirm/'.$code);
/*			Mail::send('emails.confirm', $params, function($message) use ($params){
		 				$message->to($params['email'], $params['first_name'])
		 						->subject('Confirm Account');
			});
*/
			return $person->id;
		}
		else
			return false;

	}

	public function isPersonExists($field, $value)
	{
		return Persons::where($field, $value)->count();
	}

	public function updateProfile($userId, $params)
	{
		$resp = false;
		$updatedData = array();
		if(!empty($userId))
		{
			$user = Persons::find($userId);
			if(!empty($user))
			{
				$sessionData = Session::get('user');

				if(!empty($params['first_name']))
				{
					$user->first_name = $params['first_name'];
					$sessionData['first_name'] = $params['first_name'];
				}

				if(!empty($params['last_name']))
				{
					$user->last_name = $params['last_name'];
					$sessionData['last_name'] = $params['last_name'];
				}

				$sessionData['full_name'] = $params['last_name'] . ' ' .$params['last_name'];

				if(!empty($params['mobile']))
				{
					$user->mobile = $params['mobile'];
					$sessionData['mobile'] = $params['mobile'];
				}

				if(!empty($params['pic_path']))
				{
					$user->pic = $params['pic_path'];
					$sessionData['pic'] = $params['pic_path'];
				}

				$user->update();

				$account_id = Session::get('user')['account_id'];

				if(!empty($account_id) && !empty($user))
				{
					$account = PersonAccounts::where('account_id' , $account_id)->where('resource_id', $userId);
					if($account->count() > 0)
					{
						$account = $account->first();
						$account->first_name = $params['first_name'];
						$account->last_name = $params['last_name'];						
						$account->pic = $params['pic_path'];
						$account->mobile = $params['mobile'];
						$account->update();
					}
				}

				Session::put('user', $sessionData);
				$resp = true;
			}
		}
		return true;
	}

	public function login($email, $password)
	{
		$accounttype = 'single';
		$auth = false;
		$person =  Persons::where('email', $email)->first();

		if(isset($person->password))
		{
			if (Hash::check($password, $person->password))
			{
				// set data in session
				unset($person->password);
				$person = $person->toArray();
				$person['full_name'] = $person['first_name'].' '.$person['last_name'];

				// Get account id
				$account = PersonAccounts::where('resource_id', $person['id']);
				if($account->count() > 0)
				{
					if($account->count() == 1)
					{
						$account = $account->first();
						if($account['mode'] == 'admin')
							$person['account_id'] = $account->account_id;
						else
							$accounttype = 'mutiple';
					}
					else
					{
						$accounttype = 'mutiple';						
					}
				}


				Session::put('user', $person);
				$auth = true;
			}
		}

		return array('auth' => $auth, 'account_type' => $accounttype);
	}

	public function upload($pic)
	{
		$destinationPath = public_path().'/data/pictures/';
		$extension = $pic->getClientOriginalExtension();
		$fileName = time().'.'.$extension;
		$pic->move($destinationPath, $fileName);
		return $fileName;
	}

	public function verifyForgot($code)
	{
		$resp = false;
		if(!empty($code))
		{
			$person =  Persons::where('code', $code);
			if($person->count())
			{
				$person = $person->first();
				return true;
			}
		}
		return $resp;
	}



	public function verifyAccount($code)
	{
		$resp = false;
		if(!empty($code))
		{
			$person =  Persons::where('code', $code)->where('is_verified','0');

			if($person->count())
			{
				$person = $person->first();
				
				// activate 
				$this->activate($person->id);
				return true;
			}
		}
		return $resp;
	}

	public function updateProfilePassword($password, $currentPassword)
	{
		$resp = false;
		if(!empty($currentPassword))
		{
			$personData = Persons::where('id', Session::get('user')['id']);
			if($personData->count())
			{
				$personData = $personData->first();
				if (Hash::check($currentPassword, $personData->password))
				{
					$personData->password = Hash::make($password);				
					$personData->update();
					return true;
				}

			}
		}
		return $resp;
	}

	public function updatePassword($password, $code)
	{
		$resp = false;
		if(!empty($code))
		{
			$person =  Persons::where('code', $code);
			if($person->count())
			{
				$person = $person->first();
				$person->code = '';
				$person->password = Hash::make($password);				
				$person->update();
				return true;
			}
		}
		return $resp;
	}

	public function sendForgetEmail($email)
	{
//		$person =  Persons::where('email', $email)->where('is_verified','1')->where('status','active');
		$person =  Persons::where('email', $email);
		if($person->count() > 0)
		{
			$person = $person->first();
			$code = Utility::getCode();
			$link = URL::to('forgot/'.$code);
			$data = array('first_name' => $person->first_name, 'link' => $link, 'email' => $email);

			Mail::send('emails.forgot', $data, function($message) use ($data){
		 				$message->to($data['email'], $data['first_name'])
		 						->subject('Forgot Password');
			});

			// Update code in database
			$person->code = $code;
			$person->update();
			return true;
		}
		else
			return false;
	}

	public function activate($personId)
	{
		$person = Persons::find($personId);
		$person->is_verified = 1;
		$person->code = '';		
		$person->status = 'active';		
		$person->update();		
	}


}