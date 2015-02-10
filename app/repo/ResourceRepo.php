<?php

class ResourceRepo
{	
	public static function responseinvitation($id, $mode)
	{
		$resp  = false;
		if(!empty($id))
		{
			$id = base64_decode($id);
			$rec = PersonAccounts::find($id);
			if(!empty($rec))
			{

				if($mode == 'accepted')
				{
					$rec->invite_status = 'accepted';
				}
				else if($mode == 'declined')
				{
					$rec->invite_status = 'declined';
				}
				$rec->update();
				return true;
			}
		}
		return false;
	}

	public function getSalary($id, $hire_date, $cat_id)
	{
		$year = false;

		if(!empty($hire_date) && !empty($cat_id))
		{
			$year = '0.00';

			$hire_date = date('Y-m-d', strtotime($hire_date));
			$today = date('Y-m-d');
			$date_range = Utility::createDateRangeArray($hire_date, $today);
			if(!empty($date_range))
			{
				$givenyear = round(count($date_range) / 365);
				if($givenyear >= 1 && $givenyear <= 10)
				{
					$givenyear = 'year'.$givenyear;
					$rs = EmployeeCat::find($cat_id);
					$year = $rs->$givenyear;
				}	
			}
		}

		return $year;

	}
	public function upload($pic)
	{
		$destinationPath = public_path().'/data/vehicle/';
		$extension = $pic->getClientOriginalExtension();
		$fileName = time().'.'.$extension;
		$pic->move($destinationPath, $fileName);
		return $fileName;
	}

	public function addVehicle($input)
	{
		$newVehicle = new Vehicle();
		$newVehicle->account_id = Session::get('user')['account_id'];
		$newVehicle->name = $input['vehicle_name'];
		$newVehicle->pic = $input['vehicle_pic_path'];
		$newVehicle->timezone = $input['vehicle_timezone'];
		$newVehicle->color = $input['vehicle_color'];
		$newVehicle->notes = $input['vehicle_notes'];
		if($newVehicle->save())
		{
			$vehicle_id = $newVehicle->id;
			return true;
		}
		else
			return false;
	}

	public function updateVechicle($input)
	{

	}

	public function canAddPerson($email, $account_id)
	{
		$cannadd = false;
		$person = Persons::where('email', $email);
		if($person->count() > 0)
		{
			$person = $person->first();
			$resourceId = $person->id;
			if(!empty($resourceId))
			{
				$personAccount = PersonAccounts::where('account_id', $account_id)->where('resource_id', $resourceId);
				if($personAccount->count() > 0)
					$canadd = false;
				else
					$canadd = $resourceId;
			}
		}
		else
		{
			$canadd = true;
		}
		return $canadd;
	}



	public function sendInvite($id, $first_name, $last_name, $email)
	{
		$code = Utility::getCode();		
		$personData = Persons::where('email', $email);
		if($personData->count() > 0)
		{
			$personData = $personData->first();
			if($personData->password == '')
			{
				$personData->code = $code;
				$personData->update();
				$accept_link = URL::to('forgot/'.$code.'?id='.base64_encode($id));
				$decline_link = URL::to('decline?id='.base64_encode($id));
				$subject = 'Invite';
				$template = 'account_invite';
			}
			else
			{
				$accept_link = URL::to('accept?id='.base64_encode($id));
				$decline_link = URL::to('decline?id='.base64_encode($id));
				$subject = 'Invite';
				$template = 'invite';				
			}

			$emailParam = array('accept_link' => $accept_link,
								'decline_link' => $decline_link,
								 'invitee_name' => Session::get('user')['full_name'],
								 'invitee_email' => Session::get('user')['email'],
								 'name' => $first_name.' '.$last_name,
								 'email' => $email,	
								 'subject' => $subject,							 
								 );


			// send to account create and invitation email
			Mail::send('emails.'.$template, $emailParam, function($message) use ($emailParam){
		 				$message->to($emailParam['email'], $emailParam['name'])
		 						->subject($emailParam['subject']);
			});		

		}
	}

	public function addEducation($account_id, $id, $educations)
	{
		PersonEducations::where('account_id' , $account_id)->where('resource_id', $id)->delete();		
		if(!empty($educations))
		{
			foreach($educations as $education)
			{
				$rs = new PersonEducations();
				$rs->resource_id = $id;
				$rs->education_id = $education;
				$rs->account_id = $account_id;
				$rs->save();
			}
		}								
	}


	public function addPerson($input)
	{
		$account_id = Session::get('user')['account_id'];
		$canadd = $this->canAddPerson($input['email'], $account_id);
		if(!empty($input['birthday']))
			$input['birthday'] = date('Y-m-d', strtotime($input['birthday']));
		else
			$input['birthday'] = '0000-00-00';
		if(!empty($input['hire_date']))
			$input['hire_date'] = date('Y-m-d', strtotime($input['hire_date']));
		else
			$input['hire_date'] = '0000-00-00';

		if(!empty($input['leaving_date']))
			$input['leaving_date'] = date('Y-m-d', strtotime($input['leaving_date']));
		else
			$input['leaving_date'] = '0000-00-00';

		if($input['salary_payment'] == '')
			$input['salary_payment'] = 'monthly';
		if($input['cat_id'] == '') 
			$input['cat_id'] = 0;

		if($canadd === true)
		{
			$person = new Persons();
			$person->email = $input['email'];
			$person->first_name = $input['first_name'];
			$person->last_name = $input['last_name'];
			$person->mobile = $input['mobile'];
			$person->pic = $input['pic_path'];
			$person->status = 'inactive';
			$person->is_verified = 0;
			$person->code = Utility::getCode();

			if($person->save())
			{
				$resource_id = $person->id;

				// add data to accounts
				$account = new PersonAccounts();
				$account->resource_id = $resource_id;
				$account->account_id = $account_id;
				$account->mode = 'resource';
				$account->first_name = $input['first_name'];
				$account->last_name = $input['last_name'];
				$account->color = $input['person_color'];
				$account->timezone = $input['timezone'];
				$account->notes = $input['notes'];
				$account->mobile = $input['mobile'];				
				$account->role_id = $input['role_id'];				
				$account->pic = $input['pic_path'];
				$account->birthday = $input['birthday'];
				$account->avh = $input['avh'];
				$account->personal_nr = $input['personal_nr'];
				$account->hire_date = $input['hire_date'];
				$account->leaving_date = $input['leaving_date'];
				$account->cat_id = $input['cat_id'];
				$account->salary_payment = $input['salary_payment'];
				$account->bank_name = $input['bank_name'];
				$account->account_number = $input['account_number'];
				$account->status = $input['status'];
				$account->salary_type_id = $input['salary_type_id'];
				$account->city = $input['city'];
				$account->street_address = $input['street_address'];
				$account->country = $input['country'];
				$account->zip = $input['zip'];

				if($input['invite'])
				{
					$account->invite_status = 'pending';
				}
				else
				{
					$account->invite_status = 'not_invited';					
				}

				$account->save();
				$id = $account->id;

				PersonServices::where('account_id' , $account_id)->where('resource_id', $id)->delete();		
				if(!empty($input['services']))
				{
					foreach($input['services'] as $service)
					{
						$rs = new PersonServices();
						$rs->resource_id = $id;
						$rs->service_id = $service;
						$rs->account_id = $account_id;
						$rs->save();
					}
				}				

			if(!isset($input['educations']))
				$input['educations'] = array();
			$this->addEducation($account_id, $id, $input['educations']);

			if($input['invite'])
			{
				$this->sendInvite($id, $input['first_name'], $input['last_name'], $input['email']);
			}

			return true;

			}
		}
		else if($canadd === false)
			return false;
		else
		{
			$account = new PersonAccounts();
			$account->resource_id = $canadd;
			$account->account_id = $account_id;
			$account->mode = 'resource';				
			$account->first_name = $input['first_name'];
			$account->last_name = $input['last_name'];
			$account->color = $input['person_color'];
			$account->timezone = $input['timezone'];
			$account->mobile = $input['mobile'];
			$account->notes = $input['notes'];
			$account->birthday = $input['birthday'];
			$account->role_id = $input['role_id'];	
			$account->avh = $input['avh'];
			$account->personal_nr = $input['personal_nr'];			
			$account->hire_date = $input['hire_date'];
			$account->leaving_date = $input['leaving_date'];
			$account->cat_id = $input['cat_id'];
			$account->salary_payment = $input['salary_payment'];
			$account->bank_name = $input['bank_name'];
			$account->account_number = $input['account_number'];
			$account->status = $input['status'];
			$account->salary_type_id = $input['salary_type_id'];
			$account->education_id = $input['education_id'];
			$account->city = $input['city'];
			$account->street_address = $input['street_address'];
			$account->country = $input['country'];
			$account->zip = $input['zip'];
			$account->save();
			$id = $account->id;
			PersonServices::where('account_id' , $account_id)->where('resource_id', $id)->delete();		
			if(!empty($input['services']))
			{
				foreach($input['services'] as $service)
				{
					$rs = new PersonServices();
					$rs->resource_id = $id;
					$rs->service_id = $service;
					$rs->account_id = $account_id;
					$rs->save();
				}
			}

			if(!isset($input['educations']))
				$input['educations'] = array();
			$this->addEducation($account_id, $id, $input['educations']);

			if($input['invite'])
			{
				$this->sendInvite($id, $input['first_name'], $input['last_name'], $input['email']);
			}

			return true;			
		}
	}

	public function getResourceServices($resourceId)
	{
		$rec = PersonServices::where('resource_id', $resourceId)->get()->toArray();
		return $rec;
	}

	public function resources($service_id, $searchKey = '')
	{
		$vehicles = array();
		$persons = array();

		// name, type, pic
		$account_id = Session::get('user')['account_id'];
		if(!empty($searchKey))
		{
			$searchKeyLike = '%'.$searchKey.'%';
			$vehiclesRec = Vehicle::where('account_id',$account_id)
		 	->Where(function($query) use ($searchKeyLike)
            {
                $query->orWhere('name', 'like', $searchKeyLike)
                      ->orWhere('notes', 'like', $searchKeyLike);
            })->get()->toArray();
		}
		else
		{
			$vehiclesRec = Vehicle::where('account_id',$account_id)->get()->toArray();
		}

		if(!empty($vehiclesRec))
		{
			foreach($vehiclesRec as $vehicle)
			{
				if(!empty($vehicle['pic']) && file_exists(public_path().'/data/vehicle/'.$vehicle['pic']))
					$pic = URL::to('/data/vehicle/'.$vehicle['pic']);
				else
					$pic = '';
				$vehicles[] = array('id' => $vehicle['id'], 'name' => $vehicle['name'], 'pic' => $pic,'timezone'=> $vehicle['timezone'], 'color'=>$vehicle['color'], 'notes' => $vehicle['notes'], 'type' => 'Vehicle',"is_resource" => false);
			}
		}

		if(!empty($searchKey))
		{
			$searchKeyLike = '%'.$searchKey.'%';
			$accounts = PersonAccounts::where('account_id', $account_id)
		 	->Where(function($query) use ($searchKeyLike)
            {
                $query->orWhere('first_name', 'like', $searchKeyLike)
                      ->orWhere('last_name', 'like', $searchKeyLike)
                      ->orWhere('mobile', 'like', $searchKeyLike)
                      ->orWhere('notes', 'like', $searchKeyLike);
            })->get()->toArray();

		}
		else
		{
			$accounts = PersonAccounts::where('account_id', $account_id)->get()->toArray();			
		}
		if($accounts != '')
		{
			foreach($accounts as $account)
			{
				$resourceId = $account['resource_id'];
				$personData = Persons::find($resourceId);
				if(!empty($personData))
				{
					$services = array();
					$servicesRec = $this->getResourceServices($resourceId);
					if(!empty($servicesRec))
					{
						foreach ($servicesRec as $key => $item) {
							$services[] = $item['service_id'];
						}
					}

					if(!empty($account['pic']) && file_exists(public_path().'/data/pictures/'.$account['pic']))
						$pic = URL::to('/data/pictures/'.$account['pic']);
					else
						$pic = '';

					$serviceRelated = true;
					if(!empty($service_id))
					{
						$serviceRelated = false;
						if(in_array($service_id, $services))
						{
							$serviceRelated = false;
						}
					}
						$persons[] = array('id' => $account['id'], "email" => $personData['email'], 'name' => $account['first_name'].' '.$account['last_name'], 'pic' => $pic,'timezone'=> $account['timezone'], 'color'=>$account['color'],'mobile' => $account['mobile'] ,'notes' => $account['notes'], 'type' => 'Person',"is_resource" => false, 'services' => $services, 'status' => $account['status'], 'personal_nr' => $account['personal_nr']);
					

				}
			}
		}


		$resp = array('vehicles' => $vehicles, 'persons' => $persons);
//		$resp = array_merge($vehicles, $persons);
		return $resp;
	}

	public function updateVehicle($id, $input)
	{
		$vehicle = Vehicle::find($id);
		if(!empty($vehicle))
		{	
			$newVehicle = $vehicle->first();
			$newVehicle->name = $input['vehicle_name'];
			$newVehicle->pic = $input['vehicle_pic_path'];
			$newVehicle->timezone = $input['vehicle_timezone'];
			$newVehicle->color = $input['vehicle_color'];
			$newVehicle->notes = $input['vehicle_notes'];
			$newVehicle->update(); 
			return true;
		}
		else
			return false;
	}


	public function singlePerson($id)
	{
		$account_id = Session::get('user')['account_id'];

		$person = PersonAccounts::find($id);
		if(!empty($person))
		{
			$email = '';
			$personData = Persons::find($person->resource_id);

			if(!empty($personData))
			{
				if(isset($personData->email))
					$email = $personData->email;
			}

			if(!empty($person->pic) && file_exists(public_path().'/data/pictures/'.$person->pic))
			{
				$url = URL::to('/data/pictures/'.$person->pic);
			}
			else
				$url = '';

			if(!empty($person->birthday) && $person->birthday != '0000-00-00')
				$person->birthday = date('m/d/Y', strtotime($person->birthday));
			else
				$person->birthday = '';

			if(!empty($person->hire_date) && $person->hire_date != '0000-00-00')
				$person->hire_date = date('m/d/Y', strtotime($person->hire_date));
			else
				$person->hire_date = '';

			if(!empty($person->leaving_date) && $person->leaving_date != '0000-00-00')
				$person->leaving_date = date('m/d/Y', strtotime($person->leaving_date));
			else
				$person->leaving_date = '';

			$services = array();
			$account_id = Session::get('user')['account_id'];

			// sservices
			$services_rs = PersonServices::where('resource_id' , $person->id)->where('account_id', $account_id)->get()->toArray();
			if(!empty($services_rs))
			{
				foreach($services_rs as $service_rec)
				{
					$serviceData = Services::find($service_rec['service_id']);
					if(!empty($serviceData))
					{	
						$service_rec['name'] = $serviceData->name;
						$services[] = $service_rec;
					}
				}
			}
			
			$educations = array();
			$educations_rs = PersonEducations::where('resource_id' , $person->id)->where('account_id', $account_id)->get()->toArray();
			if(!empty($educations_rs))
			{
				foreach($educations_rs as $education_rec)
				{
					$educationData = Education::find($education_rec['education_id']);
					if(!empty($educationData))
					{	
						$education_rec['name'] = $educationData->name;
						$educations[] = $education_rec;
					}
				}
			}

			$catData = array();
			if(!empty($person->cat_id))
			{
				$catObj = new CategoryRepo();
				$catData = $catObj->getCategory($account_id, $person->cat_id);
			}

			$resourceProjects = array();


			$projectrepo = new ProjectRepo();
			$projectIds = ProjectResources::where('resource_id', $person->id)->where('type', 'Person')->get()->toArray();
			$workingHours = array('monthly' => 0, 'yearly' => 0);

			if(!empty($projectIds))
			{

				foreach($projectIds as $projectId)
				{
					$projectWorkingHours = array('monthly' => 0, 'yearly' => 0);
					$monthlyHours = 0;
					$yearlyHours = 0;

					$projectData = Projects::find($projectId['project_id']);
					if(!empty($projectData))
					{
						$resourceProjects[$projectId['project_id']] = $projectData->name;

						if($projectData->time_type == 'single')
						{
							$workingHours['monthly'] += strtotime($projectData->end_time) - strtotime($projectData->start_time);
							$workingHours['yearly'] += strtotime($projectData->end_time) - strtotime($projectData->start_time);							

							$projectWorkingHours['monthly'] += strtotime($projectData->end_time) - strtotime($projectData->start_time);
							$projectWorkingHours['yearly'] += strtotime($projectData->end_time) - strtotime($projectData->start_time);							
						}
						else
						{
							$today = date('Y-m-d');
							$firstDaytoday = date('Y-m-01');
							$yearFirstDay = date('Y-m-d', strtotime('first day of January this year'));
							$yearlastDay = date('Y-m-d', strtotime('last day of December this year'));

							$projectDays = $projectrepo->getProjectDays($projectData->id);
							$semanticProjectDays = array();
							if(!empty($projectDays))
							{
								foreach($projectDays as &$projectDay)
								{
									$projectDay['timediff'] = strtotime($projectDay['end_time']) - strtotime($projectDay['start_time']);
									$semanticProjectDays[$projectDay['semantic_day']] = $projectDay;
								}
							}


							$dateRange = Utility::createDateRangeArray($projectData->start_date,$projectData->end_date);

							if(!empty($dateRange))
							{
								foreach($dateRange as $indDay)
								{
									$semanticDay = date('l', strtotime($indDay));
									if(array_key_exists($semanticDay, $semanticProjectDays))
									{
										if(($today >= $indDay) && ($indDay >=$firstDaytoday))
										{
											$workingHours['monthly'] += $semanticProjectDays[$semanticDay]['timediff'];
											$projectWorkingHours['monthly'] += $semanticProjectDays[$semanticDay]['timediff'];
										}

										if(($today >= $indDay) && ($indDay >= $yearFirstDay) )
										{
											$workingHours['yearly'] += $semanticProjectDays[$semanticDay]['timediff'];
											$projectWorkingHours['yearly'] += $semanticProjectDays[$semanticDay]['timediff'];											
										}
									}
								}						
							}
						}
					}
				}
			}


			if($workingHours['monthly'] > 0)
				$workingHours['monthly'] = ceil($workingHours['monthly'] / 3600);
			if($workingHours['yearly'] > 0)
				$workingHours['yearly'] = ceil($workingHours['yearly'] / 3600);

			$inv_status = Lang::get('auth.invite_'.$person->invite_status);
			if(!empty($person->pic))
				$abs_pic = URL::to('/data/pictures/'.$person->pic);
			else
				$abs_pic = '';

			if(empty($person->salary_type_id))
				$person->salary_type_id = 0;
			if(empty($person->education_id))
				$person->education_id = 0;			
			$resp = array('id'=>$person->id,'first_name'=>$person->first_name ,'last_name'=>$person->last_name,'timezone'=>$person->timezone,
				'color'=>$person->color,'pic'=>$person->pic, 'url' => $url,'mobile'=>$person->mobile, 'email' => $email,
				"birthday" => $person->birthday, "avh" => $person->avh, "hire_date"=>$person->hire_date, "leaving_date"=>$person->leaving_date,
				"cat_id" => $person->cat_id, "salary_payment" => $person->salary_payment, "bank_name" => $person->bank_name,
				"status" => $person->status, "account_number" => $person->account_number,'services' => $services, 'invite_status' => $person->invite_status,
				"role_id" => $person->role_id, 'cat_data' => $catData, 'projects' => $resourceProjects, 'working_hours' => $workingHours, 
				'semantic_role' => Lang::get('auth.ROLE'.$person->role_id), 'inv_status' => $inv_status, 'abs_pic' => $abs_pic, 'notes' => $person->notes,
				'salary_type_id' => $person->salary_type_id, 'education_id' => $person->education_id, 'educations' => $educations,
				'city' => $person->city, 'street_address' => $person->street_address, 'country' => $person->country, 'zip' => $person->zip,  'personal_nr' => $person->personal_nr,
				);
			return $resp;
		}
		else
			return false;
	}

	public function getVehicle($id)
	{
		$vehicle = Vehicle::find($id);
		if(!empty($vehicle))
		{
			if(!empty($vehicle->pic) && file_exists(public_path().'/data/vehicle/'.$vehicle->pic))
			{
				$url = URL::to('/data/vehicle/'.$vehicle->pic);
			}
			else
				$url = '';
			$resp = array('id'=>$vehicle->id,'name'=>$vehicle->name,'timezone'=>$vehicle->timezone,'color'=>$vehicle->color,'pic'=>$vehicle->pic, 'url' => $url);
			return $resp;
		}
		else
			return false;
	}

	public function getProjectResources($task_id, $service_id)
	{
		$invite_statuses = array();
		$ids = array('vehicle' => array(), 'person' => array());
		$confirmed_arr = array();	

		if(!empty($task_id))
		{
			$project_resources = TaskResources::where('task_id', $task_id)->get()->toArray();
			if(!empty($project_resources))
			{
				foreach($project_resources as $single_resource)
				{
					if($single_resource['type'] == 'Vehicle')
					{
						$ids['vehicle'][] = $single_resource['resource_id'];
					}
					else
					{
						$ids['person'][] = $single_resource['resource_id'];	
						$invite_statuses[$single_resource['resource_id']] = $single_resource['invite_status'];
						$confirmed_arr[$single_resource['resource_id']] = $single_resource['confirmed'];
					}

				}
			}
		}

		$allresources = $this->resources($service_id);
//		$resources = array_merge($allresources['vehicles'], $allresources['persons']);
		foreach($allresources as $resourceType => &$resources)
		{
//			print_r($resources);
			if(!empty($task_id) && !empty($resources))
			{	
				foreach($resources as &$resource)
				{	
					if($resourceType == 'vehicles')
					{
						if(in_array($resource['id'], $ids['vehicle']))
							$resource['is_resource'] = true;
					}
					else
					{
						if(in_array($resource['id'], $ids['person']))
							$resource['is_resource'] = true;

						if(isset($invite_statuses[$resource['id']]))
						{
								$resource['invite_status'] = $invite_statuses[$resource['id']];
						}
						else
							$resource['invite_status'] = 'not_invited';					

						if(isset($confirmed_arr[$resource['id']]))
						{
							$resource['confirmed'] = $confirmed_arr[$resource['id']];
						}


					}
				}
			}			
		}

		return $allresources;
	}

	public function deleteResource($id, $type)
	{
		// delete resource
		if($type == 'Vehicle')
		{
			Vehicle::where('id', $id)->delete();
			ProjectResources::where('resource_id', $id)->where('type', 'Vehicle')->delete();			
		}
		else
		{
			Persons::where('id', $id)->delete();
			ProjectResources::where('resource_id', $id)->where('type', 'Person')->delete();
		}

		return true;
	}

	public function updatePerson($id, $input)
	{
		if(!empty($input['birthday']))
			$input['birthday'] = date('Y-m-d', strtotime($input['birthday']));
		else
			$input['birthday'] = '0000-00-00';
		if(!empty($input['hire_date']))
			$input['hire_date'] = date('Y-m-d', strtotime($input['hire_date']));
		else
			$input['hire_date'] = '0000-00-00';

		if(!empty($input['leaving_date']))
			$input['leaving_date'] = date('Y-m-d', strtotime($input['leaving_date']));
		else
			$input['leaving_date'] = '0000-00-00';

		if($input['salary_payment'] == '')
			$input['salary_payment'] = 'monthly';
		if($input['cat_id'] == '') 
			$input['cat_id'] = 0;

		$account = PersonAccounts::find($id);
		if($input['invite'])
		{
			$inv_status = array('pending', 'not_invited', 'declined'); 
			if(in_array($account->invite_status, $inv_status))
				$this->sendInvite($id, $input['first_name'], $input['last_name'], $input['email']);
		}



		$account->first_name = $input['first_name'];
		$account->last_name = $input['last_name'];
		$account->color = $input['person_color'];
		$account->timezone = $input['timezone'];
		$account->mobile = $input['mobile'];
		$account->notes = $input['notes'];
		$account->pic = $input['pic_path'];
		$account->birthday = $input['birthday'];
		$account->avh = $input['avh'];
		$account->personal_nr = $input['personal_nr'];
		$account->role_id = $input['role_id'];
		$account->hire_date = $input['hire_date'];
		$account->leaving_date = $input['leaving_date'];
		$account->cat_id = $input['cat_id'];
		$account->salary_payment = $input['salary_payment'];
		$account->bank_name = $input['bank_name'];
		$account->account_number = $input['account_number'];
		$account->status = $input['status'];		
		$account->salary_type_id = $input['salary_type_id'];		
		$account->city = $input['city'];
		$account->street_address = $input['street_address'];
		$account->country = $input['country'];
		$account->zip = $input['zip'];

		$account->update();

		// delete services
		$account_id = Session::get('user')['account_id'];

		if(!isset($input['educations']))
			$input['educations'] = array();

		$this->addEducation($account_id, $id, $input['educations']);

		PersonServices::where('account_id' , $account_id)->where('resource_id', $id)->delete();		
		if(!empty($input['services']))
		{
			foreach($input['services'] as $service)
			{
				$rs = new PersonServices();
				$rs->resource_id = $id;
				$rs->service_id = $service;
				$rs->account_id = $account_id;
				$rs->save();
			}
		}
		return true;
	}

}