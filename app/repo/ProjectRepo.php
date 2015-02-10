<?php

class ProjectRepo
{	
	public $sortBy = '';
	public $sortOrder = 'asc';

	public function upload($pic)
	{
		$destinationPath = public_path().'/data/project/';
		$extension = $pic->getClientOriginalExtension();
		$fileName = time().'.'.$extension;
		$pic->move($destinationPath, $fileName);
		return $fileName;
	}

	public function week_from_monday($date) {
	    // Assuming $date is in format DD-MM-YYYY
	    list($day, $month, $year) = explode("-", $date);

	    // Get the weekday of the given date
	    $wkday = date('l',mktime('0','0','0', $month, $day, $year));

	    switch($wkday) {
	        case 'Monday': $numDaysToMon = 0; break;
	        case 'Tuesday': $numDaysToMon = 1; break;
	        case 'Wednesday': $numDaysToMon = 2; break;
	        case 'Thursday': $numDaysToMon = 3; break;
	        case 'Friday': $numDaysToMon = 4; break;
	        case 'Saturday': $numDaysToMon = 5; break;
	        case 'Sunday': $numDaysToMon = 6; break;   
	    }

	    // Timestamp of the monday for that week
	    $monday = mktime('0','0','0', $month, $day-$numDaysToMon, $year);

	    $seconds_in_a_day = 86400;

	    // Get date for 7 days from Monday (inclusive)
	    for($i=0; $i<7; $i++)
	    {
	        $dates[$i] = date('Y-m-d',$monday+($seconds_in_a_day*$i));
	    }

	    return $dates;
	}
 
	public function getDashboardStats()
	{
		$todayDate =  date('N');
		if($todayDate == 1)
			$date = date('d-m-Y');
		else
			$date = date('d-m-Y', strtotime('last monday'));

		$weekRange = $this->week_from_monday($date);
		$monthRange = Utility::createDateRangeArray(date('Y-m-01'), date('Y-m-t'));

		$today = date('Y-m-d');
		$account_id = Session::get('user')['account_id'];

		$projectsCountArr = array('today' => array(), 'week' => array(), 'month' => array());
		$clientCountArr = array('today' => array(), 'week' => array(), 'month' => array());
		$vehicleCountArr = array('today' => array(), 'week' => array(), 'month' => array());
		$personCountArr = array('today' => array(), 'week' => array(), 'month' => array());
		$resourcesArr = array('vehicle' => array(), 'person' => array());
		$bookedHoursArr = array('today' => 0, 'week' => 0, 'month' => 0);
		
		$projects = Projects::where('account_id', $account_id)->get();
		if(!empty($projects))
		{
			foreach ($projects as $key => $projectData)
			{
				// get resources
				$resourcesRecs = TaskResources::where('task_id', $projectData->id)->get()->toArray();
				if(!empty($resourcesRecs))
				{
					foreach($resourcesRecs as $resourcesRec)
					{
						if($resourcesRec['type'] == 'Vehicle')
						{
							if(!in_array($resourcesRec['resource_id'], $resourcesArr['vehicle']))
								$resourcesArr['vehicle'][] = $resourcesRec['resource_id'];
						}
						else if($resourcesRec['confirmed'] == 'yes')
						{

							if(!in_array($resourcesRec['resource_id'], $resourcesArr['person']))
								$resourcesArr['person'][] = $resourcesRec['resource_id'];

						}
					}
				}


				$startDate = $projectData->start_date;
				$endDate = $projectData->end_date;
				$projectDates = Utility::createDateRangeArray($startDate, $endDate);

				if($projectData->time_type == 'single')
				{
					$day = date('N', strtotime($endDate));
					$semanticDay = date('l', strtotime($endDate));
					$startTimestamp = strtotime($today . ' ' . $projectData->start_time);
					$endTimestamp = strtotime($today . ' ' . $projectData->end_time);
					$total_hours = ($endTimestamp - $startTimestamp) / 3600;
					$projectdays[$day] = array('day_code' => $day, 'semantic_day' => $semanticDay, 'start_time' => $projectData->start_time, 'end_time' => $projectData->end_time, 'total_duration' => $total_hours);
				}
				else
				{
					$projectdays = $this->getProjectDays($projectData->id);
					foreach($projectdays as &$projectday)
					{
						$startTimestamp = strtotime($today . ' ' . $projectday['start_time']);
						$endTimestamp = strtotime($today . ' ' . $projectday['end_time']);
						$total_hours = ($endTimestamp - $startTimestamp) / 3600;
						$projectday['total_duration'] = $total_hours;
					}
				}


				$projectDuration = Utility::createDateRangeArray($startDate, $endDate);
	
				if(!empty($projectDates))
				{
					foreach($projectDates as $projectDate)
					{
						// Week
						if(in_array($projectDate, $weekRange))
						{
	 						$calendarDayCode = date('N', strtotime($projectDate));
	 						if(array_key_exists($calendarDayCode, $projectdays))
	 						{
								$dayData = $projectdays[$calendarDayCode];

								// projects count
								if(!in_array($projectData->id, $projectsCountArr['week']))
								{
									$projectsCountArr['week'][] = $projectData->id;
								}

								// client count
								if(!in_array($projectData->client_id, $clientCountArr['week']))
								{
									$clientCountArr['week'][] = $projectData->client_id;
								}

								// Bookings hours counts
								$bookedHoursArr['week'] += $dayData['total_duration'];

								// Vehicle count
								if(!empty($resourcesArr['vehicle']))
								{
									foreach ($resourcesArr['vehicle'] as $key => $vehicle) {
										if(!in_array($vehicle, $vehicleCountArr['week']))
											$vehicleCountArr['week'][] = $vehicle;
									}
								}


								// person count
								if(!empty($resourcesArr['person']))
								{
									foreach ($resourcesArr['person'] as $key => $person) {
										if(!in_array($person, $personCountArr['week']))
											$personCountArr['week'][] = $person;
									}
								}

	 						}

						}

						// Months
						if(in_array($projectDate, $monthRange))
						{
	 						$calendarDayCode = date('N', strtotime($projectDate));
	 						if(array_key_exists($calendarDayCode, $projectdays))
	 						{
								$dayData = $projectdays[$calendarDayCode];
								
								// projects count
								if(!in_array($projectData->id, $projectsCountArr['month']))
								{
									$projectsCountArr['month'][] = $projectData->id;
								}

								// client count
								if(!in_array($projectData->client_id, $clientCountArr['month']))
								{
									$clientCountArr['month'][] = $projectData->client_id;
								}	

								// Booking hours
								$bookedHoursArr['month'] += $dayData['total_duration'];

								// Vehicle count
								if(!empty($resourcesArr['vehicle']))
								{
									foreach ($resourcesArr['vehicle'] as $key => $vehicle) {
										if(!in_array($vehicle, $vehicleCountArr['month']))
											$vehicleCountArr['month'][] = $vehicle;
									}
								}


								// person count
								if(!empty($resourcesArr['person']))
								{
									foreach ($resourcesArr['person'] as $key => $person) {
										if(!in_array($person, $personCountArr['month']))
											$personCountArr['month'][] = $person;
									}
								}

	 						}
						}




						// today
						if($projectDate == $today)
						{
	 						$calendarDayCode = date('N', strtotime($projectDate));
	 						if(array_key_exists($calendarDayCode, $projectdays))
	 						{
								$dayData = $projectdays[$calendarDayCode];

								// projects count
								if(!in_array($projectData->id, $projectsCountArr['today']))
								{
									$projectsCountArr['today'][] = $projectData->id;
								}

								// client count
								if(!in_array($projectData->client_id, $clientCountArr['today']))
								{
									$clientCountArr['today'][] = $projectData->client_id;
								}			

								// Booking hours
								$bookedHoursArr['today'] += $dayData['total_duration'];																							


								// Vehicle count
								if(!empty($resourcesArr['vehicle']))
								{
									foreach ($resourcesArr['vehicle'] as $key => $vehicle) {
										if(!in_array($vehicle, $vehicleCountArr['today']))
											$vehicleCountArr['today'][] = $vehicle;
									}
								}


								// person count
								if(!empty($resourcesArr['person']))
								{
									foreach ($resourcesArr['person'] as $key => $person) {
										if(!in_array($person, $personCountArr['today']))
											$personCountArr['today'][] = $person;
									}
								}
	 						}
						}


	//					if(in_array($projectday, $projectDuration))
	//					{
	// 						$calendarDayCode = date('N', strtotime($calenderDay));
	// 						if(array_key_exists($calendarDayCode, $projectdays))
	// 						{
	// 							$dayData = $projectdays[$calendarDayCode];
	// //							$finalJson[] = array('title' => $projectData->name, 'start' => $calenderDay.'T'.$dayData['start_time'].'-'.$dayData['end_time'], 'end' => $calenderDay.'T'.$dayData['start_time'].'-'.$dayData['end_time']);
	// 							$finalJson[] = array('title' => $projectData->name.$client_company_name, 'start' => $calenderDay.'T'.$dayData['start_time'].'-05:00', 'end' => $calenderDay.'T'.$dayData['end_time'].'-05:00');
	// 						}
	//					}
					}
				}
			}
		}


		$resp = array( 'projects' => $projectsCountArr, 'booked_hours' => $bookedHoursArr, 'persons' => $personCountArr, 'vehicles' => $vehicleCountArr, 'clients' => $clientCountArr);
		return $resp;
	}

	public function getProjectCalender($start, $end)
	{

		$account_id = Session::get('user')['account_id'];		
		$projects = Projects::where('account_id', $account_id)->get();
		if(!empty($projects))
		{
			$finalJson = array();			
		foreach ($projects as $key => $projectData) 
		{
			$client_company_name = '';
			if(!empty($projectData->client_id))
			{
				$clientData = Clients::find($projectData->client_id);
				if(!empty($clientData))
					$client_company_name = ' - '. $clientData->company_name;
			}
//			$projectData = Projects::find($projectId);
			$startDate = $projectData->start_date;
			$endDate = $projectData->end_date;

			if($projectData->time_type == 'single')
			{
				$day = date('N', strtotime($endDate));
				$semanticDay = date('l', strtotime($endDate));			
				$projectdays[$day] = array('day_code' => $day, 'semantic_day' => $semanticDay, 'start_time' => $projectData->start_time, 'end_time' => $projectData->end_time);
			}
			else
			{
				$projectdays = $this->getProjectDays($projectData->id);
			}

			$calenderDays = Utility::createDateRangeArray($start, $end);
			$projectDuration = Utility::createDateRangeArray($startDate, $endDate);


			if(!empty($calenderDays))
			{
				foreach($calenderDays as $calenderDay)
				{
					if(in_array($calenderDay, $projectDuration))
					{
						$calendarDayCode = date('N', strtotime($calenderDay));
						if(array_key_exists($calendarDayCode, $projectdays))
						{
							$dayData = $projectdays[$calendarDayCode];
//							$finalJson[] = array('title' => $projectData->name, 'start' => $calenderDay.'T'.$dayData['start_time'].'-'.$dayData['end_time'], 'end' => $calenderDay.'T'.$dayData['start_time'].'-'.$dayData['end_time']);
							$finalJson[] = array('title' => $projectData->name.$client_company_name, 'start' => $calenderDay.'T'.$dayData['start_time'].'-05:00', 'end' => $calenderDay.'T'.$dayData['end_time'].'-05:00');
						}
					}
				}
			}
		}


		return $finalJson;
	}


	}	




	public function getResourceCalender($projectId, $resourceId, $start, $end)
	{
		$projectData = Projects::find($projectId);
		$tasks = Task::where('project_id', $projectId)->get();
		if(!empty($tasks))
		{
			foreach ($tasks as $key => $task) {
				$startDate = $task->start_date;
				$endDate = $task->end_date;

				if($task->time_type == 'single')
				{
					$day = date('N', strtotime($endDate));
					$semanticDay = date('l', strtotime($endDate));			
					$taskDays[$day] = array('day_code' => $day, 'semantic_day' => $semanticDay, 'start_time' => $task->start_time, 'end_time' => $task->end_time);
				}
				else
				{
					$taskDays = $this->getTaskDays($task->id);
				}

				$calenderDays = Utility::createDateRangeArray($start, $end);
				$projectDuration = Utility::createDateRangeArray($startDate, $endDate);

				$finalJson = '';
				if(!empty($calenderDays))
				{
					foreach($calenderDays as $calenderDay)
					{
						if(in_array($calenderDay, $projectDuration))
						{
							$calendarDayCode = date('N', strtotime($calenderDay));
							if(array_key_exists($calendarDayCode, $taskDays))
							{
								$dayData = $taskDays[$calendarDayCode];
								$finalJson[] = array('start' => $calenderDay.'T'.$dayData['start_time'].'-'.$dayData['end_time'], 'end' => $calenderDay.'T'.$dayData['start_time'].'-'.$dayData['end_time']);
							}
						}
					}
				}
			}
		}


		return $finalJson;



	}	

	public function getDashboardProjects($id = 0)
	{
    	if($_GET['person_account_data']['mode'] == 'admin')
    		$id = 0;
    	else
    		$id = $_GET['person_account_data']['resource_id'];

    	$resp = array('projects' => array() , 'id' => $id);

		$account_id = Session::get('user')['account_id'];

		$projectRs = DB::select("select * from projects where account_id= ".$account_id);

		// if(isset($_GET['dev']))
		// {
		// 	echo 'id:'.$id. "select * from projects where account_id= ".$account_id;
		// 	echo "<pre>";
		// 	print_r($_GET['person_account_data']);
		// 	die();
		// }

		$projects = array();
		foreach($projectRs as $project)
		{

			$client_company_name = '';
			if(!empty($project->client_id))
			{
				$clientData = Clients::find($project->client_id);
				if(!empty($clientData))
					$client_company_name = ' - '. $clientData->company_name;
			}

			$project = (array) $project;
 			$project['name'] .= $client_company_name;



			if(!empty($project['logo']))
				$project['logo'] = URL::to('/data/project/'.$project['logo']);
			else
				$project['logo'] = URL::to('images/placeholder.png');

			$projects[$project['id']]['resources'] = array();

			$resources = TaskResources::where('task_id', $project['id'])->where('type' , 'Person')->get()->toArray();
			if(!empty($resources))
			{
				foreach ($resources as $resource) 
				{
					$resourceData = PersonAccounts::where('resource_id', $resource['resource_id'])->first()->toArray();
		
					if(!empty($resourceData['pic']))
						$resourceData['pic'] = URL::to('/data/pictures/'.$resourceData['pic']);
					else
						$resourceData['pic'] = URL::to('images/avatar.jpg');

					if(!empty($id))
					{
						if($id == $resource['resource_id'])
							$resp['projects'][$project['id']]['resources'][$resource['resource_id']] = $resourceData;
					}
					else
					{
						$resp['projects'][$project['id']]['resources'][$resource['resource_id']] = $resourceData;
					}		
				}
		
				$resp['projects'][$project['id']]['project'] = $project;

			}
		}

		return $resp;

	}

	public function updateProjectInfo($account_id, $project_id, $name, $code, $image, $notes, $status, $project_budget, $client_id, $employee_count, $budget_type , $price, $express_price, $street_address, $city, $zip, $country)
	{
		$project = Projects::where('id', $project_id)->where('account_id', $account_id)->first();
		if(!empty($project))
		{
			// if(!empty($start_date))
			// 	$start_date = date('Y-m-d', strtotime($start_date));
			// else
			// 	$start_date = '0000-00-00';
			// if(!empty($end_date))
			// 	$end_date = date('Y-m-d', strtotime($end_date));
			// else
			// 	$end_date = '0000-00-00';
			if(empty($client_id))
				$client_id = 0;


			$project->budget_type = $budget_type;

			if(!empty($budget_type))
				$project->price = $price;
			else
				$project->price = 0;

			$project->name = $employee_count;
			$project->name = $name;
//			$project->time_type = $time_type;			
			$project->client_id = $client_id;
			$project->code = $code;
			$project->pic = $image;
			$project->express_price = $express_price;
			$project->city = $city;
			$project->street_address = $street_address;
			$project->country = $country;
			$project->zip = $zip;

			// if($time_type == 'recurring')
			// {
			// 	$project->start_time = '00:00:00';
			// 	$project->end_time = '00:00:00';				
			// }
			// else
			// {
			// 	$project->start_time = $start_time;
			// 	$project->end_time = $end_time;				
			// }

			$project->employee_count = $employee_count;
			$project->notes = $notes;
			$project->status = $status;
			// $project->start_date = $start_date;				
			// $project->end_date = $end_date;		
			$project->budget = $project_budget;
			$project->update();
			return true;
		}
		else
			return false;
	}

	public function addUpdateProject($input)
	{
		$account_id = Session::get('user')['account_id'];
		$project_id = $input['project_id'];
		if(!empty($project_id))
		{
			// update project info
			$this->updateProjectInfo($account_id,$project_id, $input['project_name'], $input['project_code'], $input['image'], $input['notes'], $input['status'], $input['project_budget'], $input['client_id'], $input['employee_count'], $input['budget_type'], $input['price'], $input['express_price'], $input['street_address'], $input['city'], $input['zip'], $input['country']);

			// update links
			$this->addProjectLinks($project_id, $input);

			// days
			// if(!isset($input['days']))
			// 	$days = array();
			// else
			// 	$days = $input['days'];


			// $this->addDays($project_id, $days, $input['time_type']);


			// add services
			// if(isset($input['services']))
			// 	$services = $input['services'];
			// else
			// 	$services = array();
			// $this->addProjectServices($project_id, $services);

			// add resources
			// if(isset($input['resources']))
			// 	$resources = $input['resources'];
			// else
			// 	$resources = array();

			// $this->addProjectResoruces($project_id, $resources);			
		}
		else
		{
			$project_id = $this->addProject($account_id, $input['project_name'], $input['project_code'], $input['image'], $input['notes'], $input['status'], $input['project_budget'], $input['client_id'], $input['employee_count'],  $input['budget_type'], $input['price'], $input['express_price'], $input['street_address'], $input['city'], $input['zip'], $input['country']);
			if(!empty($project_id))
			{
				// add links
				$this->addProjectLinks($project_id, $input);

				// // add days
				// if(isset($input['days']))
				// 	$this->addDays($project_id, $input['days'], $input['time_type']);

				// // add services
				// if(isset($input['services']))
				// 	$this->addProjectServices($project_id, $input['services']);

				// // add resources
				// if(isset($input['resources']))
				// 	$this->addProjectResoruces($project_id, $input['resources']);

			}
		}
		return true;
	}

	public function deleteProject($project_id, $account_id)
	{
		// delete from project
		Projects::where('id', $project_id)->where('account_id', $account_id)->delete();

		// delete days
		Days::where('project_id', $project_id)->delete();

		// project resources
		ProjectResources::where('project_id', $project_id)->delete();

		// project services
		ProjectServices::where('project_id', $project_id)->delete();

		// social Links
		SocialLinks::where('project_id', $project_id)->delete();

		return true;
	}

	public function getNotifications($project_id)
	{
		$account_id = Session::get('user')['account_id'];

		$resp = array();
		if(isset($_GET['person_account_data']))
		{
			if(isset($_GET['person_account_data']['resource_id']))	
			{
				$resource_id = $_GET['person_account_data']['resource_id'];
				$projects = TaskResources::where('resource_id', $resource_id)->where('type' , 'Person')
							->where('invite_status', '=', 'pending')->orderBy('id', 'DESC')->get()->toArray();
				if(!empty($projects))
				{
					foreach($projects as $project)
					{
//						$project_data = Projects::find($project['project_id']);
						$project_data = $this->getSingleProject($project['project_id'], $account_id);
						if(!empty($project_data))
						{
							$resp[] = array('id' => $project['id'],'project_name' => $project_data['name'], 'invite_status' => $project['invite_status'], 'project_data' => $project_data);
						}
					}
				}
			}
		}

		return $resp;
	}

	public function updateInviteStatus($id, $status)
	{
		if($status)
			$status = 'accepted';
		else
			$status = 'declined';
		$projectdata = ProjectResources::find($id);
		if(!empty($projectdata))
		{
			$projectdata->invite_status = $status;
			$projectdata->update();
		}
		return true;
	}

	public function getTaskDays($taskId)
	{
		$semantic_days = array(1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday', 4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday', 7 => 'Sunday');

		$days = array();
		$taskDays = Days::where('task_id', $taskId)->get()->toArray();
		if(!empty($taskDays))
		{
			foreach($taskDays as $taskDay)
			{
				$days[$taskDays['day_code']] = array('day_code' => Lang::get('auth.DAY'.$taskDays['day_code']), 'semantic_day' => $semantic_days[$taskDays['day_code']], 'start_time' => date('H:i', strtotime($taskDays['start_time'])), 'end_time' => date('H:i', strtotime($taskDays['end_time'])));
			}
		}	
		return $days;	
	}

	public function getProjects($search_key = '')
	{

		$resourcerepo = new ResourceRepo();
		$account_id = Session::get('user')['account_id'];
		//$services = Services::where('account_id', $account_id)->get()->toArray();
		// $account_services = array();
		// if(!empty($services))
		// {
		// 	foreach($services as $service)
		// 	{
		// 		$account_services[$service['id']] = $service['name'];
		// 	}
		// }
		
		if(!empty($search_key))
		{
			$search_key = '%'.$search_key.'%';
			$projects = Projects::where('account_id', $account_id)
		 	->Where(function($query) use ($search_key)
            {
                $query->orWhere('code', 'like', $search_key)
                      ->orWhere('name', 'like', $search_key)
//                      ->orWhere('time_type', 'like', $search_key)
                      ->orWhere('status', 'like', $search_key) 
                      ->orWhere('notes', 'like', $search_key);
            });
		}
		else
		{
			$projects = Projects::where('account_id', $account_id);			
		}	

		if(!empty($this->sortBy) && !empty($this->sortOrder))
		{
			$projects =$projects->orderBy($this->sortBy, strtoupper($this->sortOrder));
		}

		$projects = $projects->get()->toArray();

		if(!empty($projects))
		{
			foreach($projects as &$project)
			{
				$project['client_name'] = '';
				if(!empty($project['client_id']))
				{
					$client_data = Clients::find($project['client_id']);
					if(!empty($client_data))
						$project['client_name'] = $client_data->first_name.' '.$client_data->last_name;
					$project['client_company'] = $client_data->company_name;

				}
				
				// services
				// $project['services'] = array();
				// $project['days'] = array();
				// $project['resources'] = array();

				// $project_resources = $resourcerepo->getProjectResources($project['id']);
				// if(!empty($project_resources))
				// {
				// 	foreach($project_resources as $project_resource)
				// 	{
				// 		if($project_resource['is_resource'])
				// 		{
				// 			$project['resources'][] = array('type' => $project_resource['type'], 'name' => $project_resource['name']);
				// 		}
				// 	}
				// }

				// $projectServices = ProjectServices::where('project_id', $project['id'])->get()->toArray();
				// if(!empty($projectServices))
				// {
				// 	foreach($projectServices as $projectService)
				// 	{
				// 		if(isset($account_services[$projectService['service_id']]))
				// 			$project['services'][] = $account_services[$projectService['service_id']];
				// 	}
				// }




				// $project['days'] = $this->getProjectDays($project['id']);

				// $start_date = $project['start_date'];
				// $end_date = $project['end_date'];
				// $timediff = 0;
				// if($project['time_type'] == 'single')
				// {
				// 	if(!empty($project['start_time']) && !empty($project['end_time']))
				// 	{
				// 		$timediff = strtotime($project['end_time']) - strtotime($project['start_time']);
				// 		$hours = floor($timediff / 3600);
				// 		$minutes = floor(($timediff / 60) % 60);
				// 		$project['project_hours'] = $hours.' '.Lang::get('auth.HOURS').' '.$minutes.' '.Lang::get('auth.MINUTES');
				// 		$project['start_time'] = date('H:i', strtotime($project['start_time']));
				// 		$project['end_time'] = date('H:i', strtotime($project['end_time']));

				// 	}
				// }
				// else
				// {
				// 	if(!empty($start_date) && !empty($end_date))
				// 	{
				// 		$date_range = Utility::createDateRangeArray($start_date, $end_date);
				// 		if(!empty($date_range))
				// 		{
				// 			foreach($date_range as $ind_day)
				// 			{
				// 				$semantic_day = date('N', strtotime($ind_day));
				// 				if(array_key_exists($semantic_day, $project['days']))
				// 				{
				// 					$timing = $project['days'][$semantic_day];
				// 					$timediff += (strtotime($timing['end_time']) - strtotime($timing['start_time']));
				// 				}
				// 			}

				// 			if($timediff > 0)
				// 			{
				// 				$hours = floor($timediff / 3600);
				// 				$minutes = floor(($timediff / 60) % 60);
				// 				$project['project_hours'] = $hours.' Hours '.$minutes.' Minutes';
				// 			}
				// 		}

				// 	}

				// }

				$pic = URL::to('/images/placeholder.png');

				if(!empty($project['pic']))
				{
					$root_pic = public_path().'/data/project/'.$project['pic'];					
					if(file_exists($root_pic))
						$pic = URL::to('/data/project/'.$project['pic']);
				}
				$project['pic'] = $pic;
			}
		}
		return $projects;
	}

// 	public function addProjectResoruces($project_id, $resources)
// 	{
// 		$oldResources = array('Vehicle' => array(), 'Person' => array());
// 		$oldPersons = array();		
// 		if(!empty($project_id))
// 		{
// //			ProjectResources::where('project_id',$project_id)->delete();

// 			$prevResources = ProjectResources::where('project_id',$project_id)->get()->toArray();
// 			if(!empty($prevResources))
// 			{
// 				foreach($prevResources as $prevResource)
// 					$oldResources[$prevResource['type']][$prevResource['resource_id']] = $prevResource['resource_id'];
// 			}
// 		}


// 		if(!empty($resources))
// 		{
// 			foreach($resources as $resource)
// 			{
// 				if(in_array($resource['resource_id'], $oldResources[$resource['resource_type']]))
// 				{					
// 					unset($oldResources[$resource['resource_type']][$resource['resource_id']]);
// 					$obj = ProjectResources::where('project_id', $project_id)->where('resource_id', $resource['resource_id'])->where('type', $resource['resource_type'])->first();
// 					$mode = 'update';
// 				}
// 				else
// 				{
// 					$mode = 'add';
// 					$obj = new ProjectResources();
// 				}

// 				$obj->project_id = $project_id;
// 				$obj->resource_id = $resource['resource_id'];
// 				if($resource['resource_type'] == 'Vehicle')
// 					$obj->type = 'Vehicle';
// 				else if($resource['resource_type'] == 'Person')
// 					$obj->type = 'Person';

// 				if(!empty($resource['invite']))
// 				{
// 					// Send project invitation
// 					$account_id = Session::get('user')['account_id'];		
// 					$projectData = $this->getSingleProject($project_id, $account_id);
// //					print_R($projectData);
// 					$obj->invite_status = 'pending';					
// 				}

// 				if($resource['confirm'] === 'yes')
// 					$obj->confirmed = 'yes';
// 				else
// 					$obj->confirmed = 'no';


// 				if($mode == 'add')
// 					$obj->save();
// 				else
// 					$obj->update();
// 			}
// 		}

// 		$types = array('Vehicle', 'Person');
// 		foreach($types as $type)
// 		{
// 			if(!empty($oldResources[$type]))
// 			{
// 				foreach($oldResources[$type] as $resource)
// 				{
// 					ProjectResources::where('project_id', $project_id)->where('resource_id', $resource)->where('type', $type)->delete();
// 				}
// 			}
// 		}

// 	}

	public function getClients($project_id, $account_id)
	{
		$obj = new ClientRepo();
		$clients = $obj->allClients($account_id);
		return $clients;
	}

	// public function addProjectServices($project_id, $services)
	// {
	// 	if(!empty($project_id))
	// 	{
	// 		$del = ProjectServices::where('project_id', $project_id)->delete();
	// 	}

	// 	if(!empty($services))
	// 	{
	// 		foreach($services as $service)
	// 		{
	// 			$obj = new ProjectServices();
	// 			$obj->project_id = $project_id;
	// 			$obj->service_id = $service;
	// 			$obj->save();
	// 		}
	// 	}
	// }

	// public function addDays($project_id, $days, $time_type)
	// {
	// 	if(!empty($project_id))
	// 	{
	// 		$del = Days::where('project_id', $project_id)->delete();
	// 	}

	// 	if(!empty($days) && $time_type == 'recurring')
	// 	{
	// 		foreach($days as $day_key => $day)
	// 		{
	// 			if(!empty($day))
	// 			{
	// 				$obj = new Days();
	// 				$obj->project_id = $project_id;
	// 				$obj->day_code = $day_key;
	// 				if(!empty($day['start_time']))
	// 					$obj->start_time = date("H:i:s", strtotime($day['start_time']));			
	// 				if(!empty($day['end_time']))
	// 					$obj->end_time = date("H:i:s", strtotime($day['end_time']));
	// 				$obj->save();
	// 			}
	// 		}
	// 	}
	// }

	// public function getServices($project_id, $accountId, $client_id)
	// {
	// 	$obj = new ServiceRepo();
	// 	$services = $obj->allServices($accountId, $client_id);
		
	// 	$service_ids = array();
	// 	$project_services = ProjectServices::where('project_id', $project_id)->get()->toArray();

	// 	if(!empty($project_services))
	// 	{
	// 		foreach($project_services as $service)
	// 		{
	// 			$service_ids[] = $service['service_id'];
	// 		}
	// 	}

	// 	if(!empty($services))
	// 	{
	// 		foreach($services as &$service)
	// 		{
	// 			$service['is_service'] = false;				
	// 			if(!empty($project_id))
	// 			{
	// 				if(in_array($service['id'], $service_ids))
	// 				{
	// 					$service['is_service'] = true;				
	// 				}
	// 			}
	// 		}
	// 		return $services;
	// 	}
	// 	else
	// 		return false;
	// }

	public function addProjectLinks($project_id, $input)
	{
		$linksExists = SocialLinks::where('project_id', $project_id);
		$count = $linksExists->count();
		if($count)
		{
			$links = $linksExists->first();
		}
		else
		{
			$links = new SocialLinks();			
			$links->project_id = $project_id;			
		}

		$links->basecamp = $input['basecamp'];
		$links->trello = $input['trello'];
		$links->google = $input['google'];				
		$links->dropbox = $input['dropbox'];
		$links->harvest = $input['harvest'];

		if($count)
			$links->update();
		else
			$links->save();			
	}

	public function addProject($account_id, $name, $code, $image, $notes, $status, $project_budget, $client_id, $employee_count, $budget_type, $price, $express_price, $street_address, $city, $zip, $country)
	{
		// if(!empty($start_date))
		// 	$start_date = date('Y-m-d', strtotime($start_date));
		// else
		// 	$start_date = '0000-00-00';
		// if(!empty($end_date))
		// 	$end_date = date('Y-m-d', strtotime($end_date));
		// else
		// 	$end_date = '0000-00-00';		
		if(empty($client_id))
			$client_id = 0;

		$date = date('Y-m-d H:i:s');
		$project = new Projects();
		$project->account_id = $account_id;
		$project->name = $name;
		$project->client_id = $client_id;
		$project->code = $code;
		// $project->start_time = $start_time;
		// $project->end_time = $end_time;				
		$project->pic = $image;
		// $project->time_type = $time_type;		
		$project->budget_type = $budget_type;	
		$project->express_price = $express_price;	

		$project->city = $city;
		$project->street_address = $street_address;
		$project->country = $country;
		$project->zip = $zip;
		if(!empty($budget_type))
			$project->price = $price;
		else
			$project->price = 0;

		$project->employee_count = $employee_count;
		$project->notes = $notes;
		// $project->time_type = $time_type;		
		$project->status = $status;		
		// $project->start_date = $start_date;				
		// $project->end_date = $end_date;		
		$project->date_created = $date;		
		$project->budget = $project_budget;
		if($project->save())
			return $project->id;
		else
			return 0;
	}

	public function getSingleProject($project_id, $account_id)
	{
		$project = Projects::where('id', $project_id)->where('account_id', $account_id);
		if($project->count() > 0)
		{
			$project = $project->first()->toArray();

			$client_name = '';				

			if(!empty($project['client_id']))
			{
				$clientData = Clients::find($project['client_id']);
				if(!empty($clientData))
					$client_name = $clientData->company_name;
			}
			$project['url'] = URL::to('/images/placeholder.png');

			if(!empty($project['pic']))
			{
				if(file_exists(public_path().'/data/project/'.$project['pic']))
					$project['url'] = URL::to('/data/project/'.$project['pic']);
			}

			$project['client_name'] = $client_name;
			$project['trello'] = '';
			$project['harvest'] = '';
			$project['google'] = '';
			$project['dropbox'] = '';
			$project['basecamp'] = '';


	   //  	if(!empty($project['start_time']))
	   //  	{
				// $project['start_time'] = date("H:i", strtotime($project['start_time']));
	   //  	}
	   //  	if(!empty($project['end_time']))
	   //  	{
				// $project['end_time'] = date("H:i", strtotime($project['end_time']));;
	   //  	}


			// project links 
			$project_links = SocialLinks::where('project_id', $project_id)->first();
			if(!empty($project_links))
			{
				$project['trello'] = $project_links->trello;
				$project['harvest'] = $project_links->harvest;
				$project['google'] = $project_links->google;
				$project['dropbox'] = $project_links->dropbox;
				$project['basecamp'] = $project_links->basecamp;
			}

			// if(!empty($project['start_date']) && $project['start_date'] != '0000-00-00')
			// 	$project['start_date'] = date('m/d/Y', strtotime($project['start_date']));
			// else
			// 	$project['start_date'] = '';	

			if(empty($project['budget_type']))
				$project['price'] = 0;

			// if(!empty($project['end_date']) && $project['end_date'] != '0000-00-00')
			// 	$project['end_date'] = date('m/d/Y', strtotime($project['end_date']));
			// else
			// 	$project['end_date'] = '';

			// $project_days = Days::where('project_id', $project_id)->get()->toArray();
			// if(!empty($project_days))
			// {
			// 	foreach($project_days as $project_day)
			// 	{
			// 		$start_day_time = date("H:i", strtotime($project_day['start_time']));;
			// 		$end_day_time = date("H:i", strtotime($project_day['end_time']));;
			// 		$project['days'][] = array('day_code' => $project_day['day_code'], 'start_time' => $start_day_time, 'end_time' => $end_day_time);
			// 	}
			// }


			return $project;
		}
		else
			return false;
	}





}