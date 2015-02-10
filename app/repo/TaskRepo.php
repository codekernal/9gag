<?php

class TaskRepo
{	
	public function addUpdateTask($params)
	{
		// add resources
		if(isset($params['resources']))
			$resources = $params['resources'];
		else
			$resources = array();

		if(!empty($params['start_date']))
			$startDate = date('Y-m-d', strtotime($params['start_date']));
		else
			$startDate = '0000-00-00';
		if(!empty($params['end_date']))
			$endDate = date('Y-m-d', strtotime($params['end_date']));
		else
			$endDate = '0000-00-00';		

		if(!isset($params['days']))
			$days = array();
		else
			$days = $params['days'];

    	if(!empty($params['start_time']))
    	{
			$startTime = date("H:i", strtotime($params['start_time']));
    	}
		else
		{
		 	$startTime = '00:00:00';			
		}    	
    	if(!empty($params['end_time']))
    	{
			$endTime = date("H:i", strtotime($params['end_time']));;
    	}
    	else
    	{
			$endTime = '00:00:00';
    	}

		if(isset($params['task_id']) && !empty($params['task_id']))
		{
			$id = $params['task_id'];
			// Task update
			$this->addUpdateIndividualTask($params['task_id'], $params['service_id'],  $params['name'], $params['project_id'], $params['time_type'], $startDate, $endDate, $startTime, $endTime);	
		}
		else
		{
			$id = $this->addUpdateIndividualTask(0, $params['service_id'], $params['name'], $params['project_id'], $params['time_type'], $startDate, $endDate, $startTime, $endTime);	
		}

		$this->addDays($id, $days, $params['time_type']);


		$this->addProjectResoruces($id, $resources);

		return true;
	}

	public function allTasks($project_id)
	{
		$tasks = Task::where('project_id', $project_id)->get()->toArray();
		return $tasks;
	}

	public function singleTask($task_id)
	{
		$task = Task::find($task_id);
		if(!empty($task))
		{
			$task = $task->toArray();
	    	if(!empty($task['start_time']))
	    	{
				$task['start_time'] = date("H:i", strtotime($task['start_time']));
	    	}
	    	if(!empty($project['end_time']))
	    	{
				$task['end_time'] = date("H:i", strtotime($task['end_time']));;
	    	}			

			if(!empty($task['start_date']) && $task['start_date'] != '0000-00-00')
				$task['start_date'] = date('m/d/Y', strtotime($task['start_date']));
			else
				$task['start_date'] = '';	

			if(!empty($task['end_date']) && $task['end_date'] != '0000-00-00')
				$task['end_date'] = date('m/d/Y', strtotime($task['end_date']));
			else
				$task['end_date'] = '';
			$task['days'] = array();
			$project_days = Days::where('task_id', $task_id)->get()->toArray();
			if(!empty($project_days))
			{
				foreach($project_days as $project_day)
				{
					$start_day_time = date("H:i", strtotime($project_day['start_time']));;
					$end_day_time = date("H:i", strtotime($project_day['end_time']));;
					$task['days'][] = array('day_code' => $project_day['day_code'], 'start_time' => $start_day_time, 'end_time' => $end_day_time);
				}
			}
			return $task;
		}
		else
			return false;
	}

	public function deleteTask($task_id)
	{
		Task::where('id', $task_id)->delete();		
		TaskResources::where('task_id', $task_id)->delete();		
		Days::where('task_id', $task_id)->delete();		
		return true;
	}

	public function addProjectResoruces($task_id, $resources)
	{
		$oldResources = array('Vehicle' => array(), 'Person' => array());
		$oldPersons = array();		
		if(!empty($task_id))
		{
//			ProjectResources::where('project_id',$project_id)->delete();

			$prevResources = TaskResources::where('task_id',$task_id)->get()->toArray();
			if(!empty($prevResources))
			{
				foreach($prevResources as $prevResource)
					$oldResources[$prevResource['type']][$prevResource['resource_id']] = $prevResource['resource_id'];
			}
		}


		if(!empty($resources))
		{
			foreach($resources as $resource)
			{
				if(in_array($resource['resource_id'], $oldResources[$resource['resource_type']]))
				{					
					unset($oldResources[$resource['resource_type']][$resource['resource_id']]);
					$obj = TaskResources::where('task_id', $task_id)->where('resource_id', $resource['resource_id'])->where('type', $resource['resource_type'])->first();
					$mode = 'update';
				}
				else
				{
					$mode = 'add';
					$obj = new TaskResources();
				}

				$obj->task_id = $task_id;
				$obj->resource_id = $resource['resource_id'];
				if($resource['resource_type'] == 'Vehicle')
					$obj->type = 'Vehicle';
				else if($resource['resource_type'] == 'Person')
					$obj->type = 'Person';

				if(!empty($resource['invite']))
				{
					// Send project invitation
					//$account_id = Session::get('user')['account_id'];		
					//$projectData = $this->getSingleProject($project_id, $account_id);
//					print_R($projectData);
					$obj->invite_status = 'pending';
				}

				if($resource['confirm'] === 'yes')
					$obj->confirmed = 'yes';
				else
					$obj->confirmed = 'no';


				if($mode == 'add')
					$obj->save();
				else
					$obj->update();
			}
		}

		$types = array('Vehicle', 'Person');
		foreach($types as $type)
		{
			if(!empty($oldResources[$type]))
			{
				foreach($oldResources[$type] as $resource)
				{
					TaskResources::where('task_id', $task_id)->where('resource_id', $resource)->where('type', $type)->delete();
				}
			}
		}

	}

	public function addUpdateIndividualTask($id, $service_id, $name, $project_id, $timeType, $startDate, $endDate, $startTime, $endTime)
	{
		$accountId = Session::get('user')['account_id'];		

		if(empty($id))
			$task = new Task;
		else
			$task = Task::find($id);

		$task->account_id = $accountId;
		$task->service_id = $service_id;
		$task->name = $name;
		$task->project_id = $project_id;
		$task->time_type = $timeType;
		$task->start_time = $startTime;
		$task->end_time = $endTime;
		$task->start_date = $startDate;
		$task->end_date = $endDate;

		if(empty($id))
		{
			$task->save();
			$id = $task->id;
		}
		else
			$task->update();
		return $id;
	}


	public function addDays($task_id, $days, $time_type)
	{
		if(!empty($task_id))
		{
			$del = Days::where('task_id', $task_id)->delete();
		}

		if(!empty($days) && $time_type == 'recurring')
		{
			foreach($days as $day_key => $day)
			{
				if(!empty($day))
				{
					$obj = new Days();
					$obj->task_id = $task_id;
					$obj->day_code = $day_key;
					if(!empty($day['start_time']))
						$obj->start_time = date("H:i:s", strtotime($day['start_time']));
					if(!empty($day['end_time']))
						$obj->end_time = date("H:i:s", strtotime($day['end_time']));
					$obj->save();
				}
			}
		}
	}	
}